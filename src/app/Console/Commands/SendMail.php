<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\HelloEmail;
use Mail;
use App\Customer;
use App\Plan;
use Carbon\Carbon;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $customers = Customer::where('plan', '1')->get();

        foreach($customers as $customer){
            // Customerの誕生月初日に店舗に通知メール送信
            if(date('m-d', strtotime($customer->birth_month. '-1')) === date('m-d', strtotime('first day of this month'))){
                Mail::to(Auth::user()->email)->send(new HelloEmail($customer, 'birthdayAnnounce'));
            }
            
            // 誕生日にメール送信
            if($customer->birth === Carbon::now()->format('Y-m-d')){
                Mail::to($customer->email)->send(new HelloEmail($customer, 'birthday'));
            }
            
            // 期限日、残り日数を取得
            $start = $customer->plan_started_at;
            $due_date = date("Y-m-d", strtotime($start . " +31 day"));
            $end = Carbon::parse($due_date);
            $now = Carbon::now();
            $left = $now->diffIndays($end);

            // 残り日数に応じてメール送信
            // $leftでメールのviewを指定
            switch($left){

                // 失効７日前の通知
                case 7:
                    Mail::to($customer->email)->send(new HelloEmail($customer, $left));
                break;

                // 失効日の通知
                case 1:
                    Mail::to($customer->email)->send(new HelloEmail($customer, $left));
                    
                    // Plan、plan_started_atカラムを初期化
                    $customer->plan = 0;
                    $customer->plan_started_at = null;
                    $customer->save();

                    // Planテーブルのレコードを論理削除
                    Plan::find($customer->id)->delete();
                break;
            }
        }
    }
}
