<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\HelloEmail;
use Mail;
use App\Customer;
use App\Plan;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SendMail extends Command
{
    private $customers_on_birth = [];

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
        $customers = Customer::all();

        foreach($customers as $customer){
            $user = User::where('id', $customer->user_id)->first();

            // 誕生日にメール送信
            if($customer->birth === Carbon::now()->format('Y-m-d')){
                Mail::to($customer->email)->send(new HelloEmail($customer, $user, 'birthday'));
            }

            // 期限日、残り日数を取得
            $start = $customer->plan_started_at;
            $due_date = date("Y-m-d", strtotime($start . " + " . $user->expiring_date ." day"));
            $end = Carbon::parse($due_date);
            $now = Carbon::now();
            $left = $now->diffIndays($end);
                        
            // 残り日数に応じてメール送信
            // $leftでメールのviewを指定
            DB::transaction(function() use($customer, $user, $left){

                if($customer->plan === 1){
                    switch($left){
                        // 失効n日前の通知
                        case $user->how_days_mail:
                            Mail::to($customer->email)->send(new HelloEmail($customer, $user, 'premail'));

                        // 失効日の通知
                        case 0:
                            Mail::to($customer->email)->send(new HelloEmail($customer, $user, 'expired'));
                            
                            // Plan、plan_started_atカラムを初期化
                            $customer->plan = 0;
                            $customer->plan_started_at = null;
                            $customer->save();

                            // Planテーブルのレコードを論理削除
                            Plan::where('customer_id', $customer->id)->delete();
                        break;
                    }
                }
            });
            // Customerの誕生月初日に店舗に通知メール送信
            if(date("n", strtotime($customer->birth)) == Carbon::now()->format('n')){
                $this->customers_on_birth[] = $customer;

                if(date('m-d', strtotime($customer->birth_month. '-1')) === date('m-d', strtotime('first day of this month'))){
                    Mail::to($user->email)->send(new HelloEmail($this->customers_on_birth, $user, 'birthdayAnnounce'));
                }        
            }
        }        
    }
}
