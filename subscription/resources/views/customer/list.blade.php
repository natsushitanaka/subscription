@extends('layouts.app')

@section('content')

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