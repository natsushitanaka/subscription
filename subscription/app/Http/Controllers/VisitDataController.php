<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitData;
use App\Http\Requests\AddVisitData;

class VisitDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(VisitData $visitData, AddVisitData $request)
    {
        $data = new VisitData();

        $data->customer_id = $visitData->customer_id;
        $data->date = $request->date;
        $data->pay = $request->pay;
        $data->person = $request->person;
        $data->comment = $request->comment;

        $data->save();

        return redirect()->route('detail', [
            'id' => $visitData->customer_id,
        ]);
    }

    public function delete(VisitData $visitData)
    {
        VisitData::destroy($visitData->id);

        return redirect()->route('detail', [
            'id' => $visitData->customer_id,
        ]);
    }
}
