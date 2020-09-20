@extends('layouts.app')

@section('content')

<h3>
    {{ $customer->name }}'s Data
    <a href="/customer/{{$customer->id}}/edit">[Edit]</a>
</h3>

<table class="table">

    <tr>
        <th>Age</th>
        <td>{{ $formatted['age'] }}</td>
    </tr>
    
    <tr>
        <th>Month of Birth</th>
        <td>{{ $formatted['birth_month'] }}</td>
    </tr>
    
    <tr>
        <th>Created at</th>
        <td>{{ date("Y/m/d", strtotime($customer->created_at)) }}</td>
    </tr>

    <tr>
        <th>Num of Visits</th>
        <td>{{ $total_data['visit'] }}</td>
    </tr>

    <tr>
        <th>Ave Payment</th>
        <td>{{ $total_data['ave'] }}</td>
    </tr>

    <tr>
        <th>total Payment</th>
        <td>{{ $total_data['payment'] }}</td>
    </tr>

    <tr>
        <th>started at (Plan)</th>
        <td>{{ $customer->plan_started_at }}</td>
    </tr>

    <tr>
        <th>due date (Plan)</th>
        <td>{{ $formatted['due_date'] }}</td>
    </tr>

    <tr>
        <th>days left (Plan)</th>
        <td>{{ $formatted['left'] }}</td>
    </tr>

    <tr>
        <th>Record of Planed</th>
        <td>{{ $total_data['plan'] }}</td>
    </tr>

</table>

@endsection