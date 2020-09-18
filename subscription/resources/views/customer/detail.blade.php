@extends('layouts.app')

@section('error')
    @include('share.showError')
@endsection

@section('content')

<h3>Add Visit Data</h3>

<form action="/visitdata/{{$customer->id}}/add" method="post">

    @csrf

    <label for="date">Visit Date:</label>
    <input type="date" name="date" id="date" value="{{ old('date') }}"><br>

    <label for="pay">Payment:</label>
    <input type="number" name="pay" id="pay" value="{{ old('pay') }}"><br>

    <label for="person">Num of people:</label>
    <input type="number" name="person" id="person" value="{{ old('person') }}"><br>

    <label for="comment">Comment:</label>
    <input type="text" name="comment" id="comment" value="{{ old('comment') }}"><br>

    <input type="submit" value="Add">

</form>

<h3>
    {{ $customer->name }}'s Data
    <a href="/customer/{{$customer->id}}/edit">[Edit]</a>
</h3>

<table>

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
        <th>start at</th>
        <td>{{ $customer->plan_started_at }}</td>
    </tr>

    <tr>
        <th>due date</th>
        <td>{{ $formatted['due_date'] }}</td>
    </tr>

    <tr>
        <th>days left</th>
        <td>{{ $formatted['left'] }}</td>
    </tr>

    <tr>
        <th>Record of Planed</th>
        <td>{{ $total_data['plan'] }}</td>
    </tr>

</table>

@if(!is_null($visit_datas))

<h3>Visit Datas</h3>

<table>

    <tr>
        <th>Date</th>
        <th>Payment</th>
        <th>Num of people</th>
        <th>Comment</th>
        <th></th>
    </tr>

    @foreach($visit_datas as $visit_data)

    <tr>
        <td>{{ $visit_data->date }}</td>
        <td>{{ $visit_data->pay }}</td>
        <td>{{ $visit_data->person }}</td>
        <td>{{ $visit_data->commnet ?: '-' }}</td>
        <form action="{{ route('visitdata.delete', ['id' => $visit_data->id]) }}" method="post">
        @csrf
        <td>
            <input type="submit" value="×">
        </td>
        </form>
    </tr>

    @endforeach
</table>

@endif

@endsection