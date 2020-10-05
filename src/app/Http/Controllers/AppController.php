<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\VisitData;
use App\Plan;
use App\User;
use App\Http\Requests\AddCustomer;
use Carbon\Carbon;
use App\Mail\HelloEmail;
use Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    // ログイン認証
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Customer一覧
    public function list(Request $request)
    {
        // Planで検索
        if($request->plan === "0"){
            $customers = Customer::where('user_id', Auth::id())->where('plan', '0')->get();
        }elseif($request->plan === "1"){
            $customers = Customer::where('user_id', Auth::id())->where('plan', '1')->get();
        }else{
            $customers = Customer::where('user_id', Auth::id())->get();
        }

        // Customerが登録されていなかったら登録画面に
        if(is_null($customers->first())){
            return view('customer.add', [
                'msg' => 'まだ登録がありません。顧客登録をお願いします。',
            ]);    
        }

        return view('customer.list', [
            'customers' => $customers,
            'plan' => $request->plan,
        ]);
    }

    // 論理削除済Customer一覧
    public function deleted()
    {
        $customers = Customer::onlyTrashed()->where('user_id', Auth::id())->get(); 
 
        return view('customer.deleted',[
            'customers' => $customers,
        ]);
    }

    // 論理削除復元
    public function restore($id)
    {
        Customer::onlyTrashed()->where('user_id', Auth::id())->find($id)->restore(); 
 
        return redirect()->route('customer.list.deleted');
    }

    // 論理削除
    public function delete(Customer $customer)
    {
        Customer::where('user_id', Auth::id())->find($customer->id)->delete();

        return redirect()->route('customer.list');
    }
    
    // 物理削除
    public function forceDelete($id)
    {
        // Customer::onlyTrashed()->where('user_id', Auth::id())->find($id)->forceDelete(); 
        Customer::withTrashed()->where('user_id', Auth::id())->find($id)->forceDelete(); 
 
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
        if($customer->user_id !== Auth::id()){
            abort('403');
        }

        $customer = Customer::find($customer->id);

        return view('customer.edit', [
            'customer' => $customer,
        ]);
    }

    // Customer登録
    public function add(AddCustomer $request)
    {        
        DB::transaction(function() use($request){

            $customer = new Customer;
            $customer->fill($request->all());
            $customer->user_id = Auth::id();
            $customer->save();

            // プラン購入者は
            if($request->plan === "1"){
                $customer->plan = "1";
                // plan_started_atカラムに現在時刻追加
                $customer->plan_started_at = Carbon::now();
                // Planテーブルに追加、customer_idと紐付ける
                Plan::create([
                    'user_id' => Auth::id(),
                    'customer_id' => $customer->id,
                    ]);
                $this->startPlan($customer);
                $customer->save();
            }            
        });

        return redirect()->route('customer.add');
    }

    // Customer編集
    public function edit(Customer $customer, AddCustomer $request)
    {
        if($customer->user_id !== Auth::id()){
            abort('403');
        }

        $customer = Customer::find($customer->id);
        
        DB::transaction(function() use($customer, $request){
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
                Plan::create([
                    'user_id' => Auth::id(),
                    'customer_id' => $customer->id,
                    ]);
                $this->startPlan($customer);
            }
        });
    
        return redirect()->route('detail', [
            'customer' => $customer->id,
        ]);
    }

    public function data(Customer $customer)
    {
        if($customer->user_id !== Auth::id()){
            abort('403');
        }

        // VisitDataを日付降順で取得
        $visit_datas = VisitData::where('user_id', Auth::id())->where('customer_id', $customer->id)->orderByRaw('date desc')->get();

        return view('customer.data', [
            'customer' => $customer,
            'visit_datas' => $visit_datas,
        ]);

    }
    
    // Customer詳細
    public function detail(Customer $customer)
    {        
        if($customer->user_id !== Auth::id()){
            abort('403');
        }

        $user = User::where('id', $customer->user_id)->first();

        // VisitData、Planから金額、人数、来店回数の合計を取得
        $total_payment = VisitData::where('user_id', Auth::id())->where('customer_id', $customer->id)->sum('pay');
        $total_people = VisitData::where('user_id', Auth::id())->where('customer_id', $customer->id)->sum('person');
        $total_visit = VisitData::where('user_id', Auth::id())->where('customer_id', $customer->id)->count('id');
        
        // 論理削除されたレコードを含めたプラン利用回数の合計を取得
        $total_plan = Plan::withTrashed()->where('customer_id', $customer->id)->count('id');

        // それぞれ値が0なら'-'を代入し、配列で保持     
        $total_data = [
            'payment' => $total_payment === 0 ? '-' : $total_payment,
            'ave' => $total_people === 0 ? '-' : floor($total_payment/$total_people),
            'visit' => $total_visit === 0 ? '-' : $total_visit,
            'plan' => $total_plan === 0 ? '-' : $total_plan,
        ];

        // Plan購入者の場合
        if($customer->plan === 1){

            // 期限日、残り日数を取得
            $start = $customer->plan_started_at;
            $due_date = date("Y-m-d", strtotime($start . " +"  . $user->expiring_date . " day"));
            $end = Carbon::parse($due_date);
            $now = Carbon::now();
            $left = $now->diffIndays($end);

        // Plan購入者でない場合
        }else{
            $start = '-';
            $due_date = '-';
            $left = '-';
        }

        // 年齢、誕生月を取得
        if(isset($customer->birth)){
            $age = floor((date("Ymd") - str_replace("-", "", $customer->birth))/10000);
            $birth_month = date("M", strtotime($customer->birth));
        }else{
            $age = "";
            $birth_month = "";
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

    public function startPlan($customer)
    {
        // 来店時、本人認証用のQrcodeを作成、customer_id.pngで保存
        \QrCode::format('png')->size(150)->generate('https://natsushi.net/check/' . $customer->id, public_path('/qrcode/'. $customer->id . '.png'));
        
        // Qrcodeが記載されたメールを送信
        Mail::to($customer->email)->send(new HelloEmail($customer, Auth::user(), 'start'));        
    }
}
