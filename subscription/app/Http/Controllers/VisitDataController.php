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

    public function add($id, AddVisitData $request)
    {
        $data = new VisitData();
        $data->fill($request->all());
        $data->customer_id = $id;
        $data->save();

        return redirect()->route('detail', [
            'customer' => $id,
        ]);
    }

    public function delete(VisitData $visitData)
    {
        VisitData::destroy($visitData->id);

        return redirect()->route('detail', [
            'customer' => $visitData->customer_id,
        ]);
    }
}
