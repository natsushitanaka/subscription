<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $customers_on_birth = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $customers = Customer::all();

        // foreach($customers as $customer){
        //     if(date("n", strtotime($customer->birth)) == Carbon::now()->format('n')){
        //         $this->customers_on_birth[] = $customer;
        //     }
        // }

        $user = Auth::user();

        return view('home', [
            'user' => $user,
        ]);
    }

    public function showSet()
    {
        $user = Auth::user();

        return view('setting.set', [
            'user' => $user,
        ]);
    }

    public function set(Request $request)
    {
        $user = Auth::user();

        $user->expiring_date = $request->expiring_date;
        $user->what_time_mail = $request->what_time_mail;
        $user->how_days_mail = $request->how_days_mail;
        $user->update();

        return redirect()->route('home');
    }
}
