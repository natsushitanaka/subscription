@extends('layouts.app')

@section('content')

@include('share.nav')

<div class="container">
    <div class="row">
        <h2 class="col-6">今月、誕生日のお客様</h2>
    </div>
</div>

<div class="container">
    <table class="table">

        <tr>
            <th>氏名</th>
            <th>誕生日</th>
            <th>プランの有無</th>
            <th>来店データ</th>
            <th>削除する</th>
        </tr>

        @foreach($customers as $customer)

        <tr>
            <td><a href="/customer/{{$customer->id}}">{{ $customer->name }}</a></td>

            <td>{{ date("Y/m/d", strtotime($customer->birth)) }}</td>

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
</div>

<!-- {!! QrCode::format('png')->size(100)->generate('https://kakurebakitchengao.business.site/') !!} -->

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
