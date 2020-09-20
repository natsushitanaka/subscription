<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitData;
use App\Customer;
use App\Http\Requests\AddVisitData;
use Carbon\Carbon;

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
        $data->customer_id = $id;
        $data->save();

        return redirect()->route('data', [
            'customer' => $id,
        ]);
    }

    public function delete(VisitData $visitData)
    {
        VisitData::destroy($visitData->id);

        return redirect()->route('data', [
            'customer' => $visitData->customer_id,
        ]);
    }

    public function showEdit(VisitData $visitData)
    {
        return view('visitData.edit', [
            'visitData' => $visitData,
        ]);
    }

    public function edit(VisitData $visitData, AddVisitData $request)
    {
        $visitData = visitData::find($visitData->id);
        $visitData->update($request->all());

        return redirect()->route('data', [
            'customer' => $visitData->customer_id,
        ]);
    }

    public function check(Customer $customer)
    {
        $visit_data = new VisitData();
        $visit_data->customer_id = $customer->id;
        $visit_data->date = date("Y-m-d", strtotime(Carbon::now()));
        $visit_data->save();

        return redirect()->route('data', [
            'customer' => $customer->id,
        ]);
    }

}
