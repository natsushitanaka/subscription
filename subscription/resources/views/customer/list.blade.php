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

        <form action="/customer/{{$customer->id}}/delete" method="post">
        @csrf
        <td>
            <input type="submit" value="Delete">
        </td>
        </form>

        <td><a href="/announce/{{$customer->id}}">Announce</a></td>

    </tr>
    
    @endforeach

</table>

@endsection