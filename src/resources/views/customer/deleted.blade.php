@extends('layouts.app')

@section('content')

@include('share.nav')

@if(isset($msg))
<span class="err">{{ $msg }}</span>
@endif

<div class="container">
    <div class="row">
        <h2 class="col-6">非アクティブ顧客リスト</h2>
    </div>
</div>

<div class="container">
    <table class="table">

        <tr>
            <th>氏名</th>
            <th>登録日</th>
            <th>プランの有無</th>
            <th>顧客リストに戻す</th>
            <th>完全削除する</th>
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
                <button type="submit" class="btn btn-primary btn-sm">再登録</button>
            </td>
            </form>

            <form action="/customer/{{$customer->id}}/forceDelete" method="post">
            @csrf
            <td>
                <button id="alert" type="submit" class="btn btn-primary btn-sm">完全削除</button>
            </td>
            </form>

        </tr>
        
        @endforeach

    </table>

</div>
@endsection