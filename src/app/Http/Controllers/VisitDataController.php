<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitData;
use App\Customer;
use App\Http\Requests\AddVisitData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VisitDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($id, AddVisitData $request)
    {
        $data = new VisitData();
        $data->fill($request->all());
        $data->user_id = Auth::id();
        $data->customer_id = $id;
        $data->save();

        return redirect()->route('data', [
            'customer' => $id,
        ]);
    }

    public function delete(VisitData $visitData)
    {
        if($visitData->user_id !== Auth::id()){
            abort('403');
        }

        VisitData::destroy($visitData->id);

        return redirect()->route('data', [
            'customer' => $visitData->customer_id,
        ]);
    }

    public function showEdit(VisitData $visitData)
    {
        if($visitData->user_id !== Auth::id()){
            abort('403');
        }

        return view('visitData.edit', [
            'visitData' => $visitData,
        ]);
    }

    public function edit(VisitData $visitData, AddVisitData $request)
    {
        if($visitData->user_id !== Auth::id()){
            abort('403');
        }

        $visitData = visitData::find($visitData->id);
        $visitData->update($request->all());

        return redirect()->route('data', [
            'customer' => $visitData->customer_id,
        ]);
    }

    public function check(Customer $customer)
    {
        if($customer->user_id !== Auth::id()){
            abort('403');
        }

        $visit_data = new VisitData();
        $visit_data->user_id = Auth::id();
        $visit_data->customer_id = $customer->id;
        $visit_data->date = Carbon::now()->format('Y-m-d');
        $visit_data->save();

        return redirect()->route('data', [
            'customer' => $customer->id,
        ]);
    }

}
