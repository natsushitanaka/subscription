@extends('layouts.app')

@section('content')

@if(isset($msg))
<span class="err">{{ $msg }}</span>
@endif

<h2>Deleted Customer List</h2>

<table class="table">

    <tr>
        <th>Name</th>
        <th>Created at</th>
        <th>Plan</th>
        <th></th>
        <th></th>
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

        <form action="/customer/{{$customer->id}}/restore" method="post">
        @csrf
        <td>
            <button type="submit" class="btn btn-primary btn-sm">Resote</button>
        </td>
        </form>

        <form action="/customer/{{$customer->id}}/forceDelete" method="post">
        @csrf
        <td>
            <button type="submit" class="btn btn-primary btn-sm">Destroy</button>
        </td>
        </form>

    </tr>
    
    @endforeach

</table>

@endsection