<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Carbon\Carbon;

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
        $customers = Customer::all();

        foreach($customers as $customer){
            if(date("n", strtotime($customer->birth)) == Carbon::now()->format('n')){
                $this->customers_on_birth[] = $customer;
            }
        }

        return view('home', [
            'customers' => $this->customers_on_birth,
        ]);
    }
}
