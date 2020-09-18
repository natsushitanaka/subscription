@extends('layouts.app')

@section('content')

<table>

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
            <input type="submit" value="Restore">
        </td>
        </form>

        <form action="/customer/{{$customer->id}}/forceDelete" method="post">
        @csrf
        <td>
            <input type="submit" value="ForceDelete">
        </td>
        </form>

    </tr>
    
    @endforeach

</table>

@endsection