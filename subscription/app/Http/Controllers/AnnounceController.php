<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class AnnounceController extends Controller
{
    public function index(Customer $customer)
    {
        return view('customer.check', [
            'customer' => $customer,
        ]);
    }
}
