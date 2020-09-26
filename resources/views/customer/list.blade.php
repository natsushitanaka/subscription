@extends('layouts.app')

@section('content')

<h2>Customer List</h2>

<form action="" method="get">
    <label for="2">all</label>
    <input type="radio" id="2" name="plan" value="2">
    <label for="1">planed</label>
    <input type="radio" id="1" name="plan" value="1">
    <label for="0">not planed</label>
    <input type="radio" id="0" name="plan" value="0">
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<table class="table">

    <tr>
        <th>Name</th>
        <th>Created at</th>
        <th>Plan</th>
        <th>Data</th>
        <th>Delete</th>
    </tr>

    @foreach($customers as $customer)

    <tr>
        <td><a href="/customer/{{$customer->id}}">{{ $customer->name }}</a></td>

        <td>{{ date("Y/m/d", strtotime($customer->created_at)) }}</td>

        @if($customer->plan === 0)
        <td>×</td>
        @else
        <td>◯</td>
        @endif

        <td><a href="/customer/{{$customer->id}}/data">=></a></td>

        <form action="/customer/{{$customer->id}}/delete" method="post">
        @csrf
        <td>
            <button type="submit" class="btn btn-primary btn-sm">×</button>
        </td>
        </form>

    </tr>
    
    @endforeach

</table>

@endsection