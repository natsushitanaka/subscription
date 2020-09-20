<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\VisitData;
use App\Plan;
use App\Http\Requests\AddCustomer;
use Carbon\Carbon;
use App\Mail\HelloEmail;
use Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AppController extends Controller
{
    // ログイン認証
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Customer一覧
    public function list()
    {
        $customers = Customer::all();
        
        if(is_null($customers->first())){
            return view('customer.add', [
                'msg' => 'Please add customer as no data yet.',
            ]);    
        }

        return view('customer.list', [
            'customers' => $customers,
        ]);
    }

    // 論理削除済Customer一覧
    public function deleted()
    {
        $customers = Customer::onlyTrashed()->get(); 
 
        return view('customer.deleted',[
            'customers' => $customers,
        ]);
    }

    // 論理削除復元
    public function restore($id)
    {
        Customer::onlyTrashed()->find($id)->restore(); 
 
        return redirect()->route('customer.list.deleted');
    }

    // 論理削除
    public function delete(Customer $customer)
    {
        Customer::find($customer->id)->delete();

        return redirect()->route('customer.list');
    }
    
    // 物理削除
    public function forceDelete($id)
    {
        Customer::onlyTrashed()->find($id)->forceDelete(); 
 
        return redirect()->route('customer.list.deleted');
    }

    // Customer登録フォーム表示
    public function showAdd()
    {
        return view('customer.add');
    }

    // Customer編集フォーム表示
    public function showEdit(Customer $customer)
    {
        $customer = Customer::find($customer->id);

        return view('customer.edit', [
            'customer' => $customer,
        ]);
    }

    // Customer登録
    public function add(AddCustomer $request)
    {
        $customer = Customer::create($request->all());
        
        if($request->plan === "1"){
            // プラン購入者は
            // plan_started_atカラムに現在時刻追加
            $customer->plan = "1";
            $customer->plan_started_at = Carbon::now();
            $customer->save();
            // Planテーブルに追加、customer_idと紐付ける
            Plan::create(['customer_id' => $customer->id]);
        }

        \QrCode::format('png')->size(150)->generate('https://qiita.com', public_path('/qrcode/'. $customer->id . '.png'));

        return redirect()->route('customer.add');
    }

    // Customer編集
    public function edit(Customer $customer, AddCustomer $request)
    {
        $customer = Customer::find($customer->id);
        // データ更新
        $customer->update($request->all());

        // Planテーブルの論理削除されていないレコード数取得
        $count_plan = Plan::where('customer_id', $customer->id)->count('id');

        // すでにレコードがある場合はPlanを追加しない
        // Planテーブルのレコードは手動で削除できない
        if($request->plan === "1" && $count_plan === 0){
            $customer->plan = "1";
            $customer->plan_started_at = Carbon::now();
            $customer->save();
            Plan::create(['customer_id' => $customer->id]);
        }

        return redirect()->route('detail', [
            'customer' => $customer->id,
        ]);
    }

    public function data(Customer $customer)
    {
        // VisitDataを日付降順で取得
        $visit_datas = VisitData::where('customer_id', $customer->id)->orderByRaw('date desc')->get();

        return view('customer.data', [
            'customer' => $customer,
            'visit_datas' => $visit_datas,
        ]);

    }
    
    // Customer詳細
    public function detail(Customer $customer)
    {        
        // VisitData、Planから金額、人数、来店回数の合計を取得
        $total_payment = VisitData::where('customer_id', $customer->id)->sum('pay');
        $total_people = VisitData::where('customer_id', $customer->id)->sum('person');
        $total_visit = VisitData::where('customer_id', $customer->id)->count('id');
        
        // 論理削除されたレコードを含めたプラン利用回数の合計を取得
        $total_plan = Plan::withTrashed()->where('customer_id', $customer->id)->count('id');

        // それぞれ値が0ならNo Dataを代入し、配列で保持     
        $total_data = [
            'payment' => $total_payment === 0 ? 'No Data' : $total_payment,
            'ave' => $total_people === 0 ? 'No Data' : floor($total_payment/$total_people),
            'visit' => $total_visit === 0 ? 'No Data' : $total_visit,
            'plan' => $total_plan === 0 ? 'No Data' : $total_plan,
        ];

        // Plan購入者の場合
        if($customer->plan === 1){

            // 期限日、残り日数を取得
            $start = $customer->plan_started_at;
            $due_date = date("Y-m-d", strtotime($start . " +31 day"));
            $end = Carbon::parse($due_date);
            $now = Carbon::now();
            $left = $now->diffIndays($end);

            // 残り日数に応じてメール送信
            // $leftでメールのviewを指定
            switch($left){
                case 30:
                    // Mail::to('owazo443@gmail.com')->send(new HelloEmail($customer, $left));
                break;

                case 7:
                    // Mail::to('owazo443@gmail.com')->send(new HelloEmail($customer, $left));
                break;

                case 0:
                    // Mail::to('owazo443@gmail.com')->send(new HelloEmail($customer, $left));
                    
                    // Plan、plan_started_atカラムを初期化
                    $customer->plan = 0;
                    $customer->plan_started_at = null;
                    $customer->save();

                    // Planテーブルのレコードを論理削除
                    Plan::find($customer->id)->delete();
                break;
            }
        // Plan購入者でない場合
        }else{
            $start = 'not planed';
            $due_date = 'not planed';
            $left = 'not planed';
        }

        // 年齢、誕生月を取得
        if(isset($customer->birth)){
            $age = floor((date("Ymd") - str_replace("-", "", $customer->birth))/10000);
            $birth_month = date("M", strtotime($customer->birth));
        }else{
            $age = "";
            $birth_month = "";
        }

        // 誕生日にメール送信
        if($customer->birth === Carbon::now()->format('Y-m-d')){
            Mail::to('owazo443@gmail.com')->send(new HelloEmail($customer, 'birthday'));
        }

        // Customerの誕生月に店舗に通知メール送信
        if($birth_month === Carbon::now()->format('M')){
            Mail::to(Auth::user()->email)->send(new HelloEmail($customer, 'birthdayAnnounce'));
        }


        // 加工したCustomer情報を配列で保持
        $formatted = [
            'start' => $start,
            'due_date' => $due_date,
            'left' => $left,
            'age' => $age,
            'birth_month' => $birth_month,
        ];

        return view('customer.detail', [
            'customer' => $customer,
            'formatted' => $formatted,
            'total_data' => $total_data,
        ]);
    }
}
