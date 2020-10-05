@extends('layouts.app')

@section('content')

@include('share.nav')

<div class="container">
    <div class="row">
        <h2 class="col-6"><a href="/customer/{{$customer->id}}/edit">{{ $customer->name }}のデータ【編集する】</a></h2>
    </div>
</div>

<div class="container">
    <table class="table">

        <tr>
            <th>年齢</th>
            <td>{{ $formatted['age'] ? : '-' }}</td>
        </tr>
        
        <tr>
            <th>誕生日</th>
            <td>{{ $customer->birth ? : '-' }}</td>
        </tr>

        <tr>
            <th>メールアドレス</th>
            <td>テストの為、表示しません</td>
        </tr>

        <tr>
            <th>電話番号</th>
            <td>テストの為、表示しません</td>
        </tr>
        
        <tr>
            <th>登録日</th>
            <td>{{ date("Y/m/d", strtotime($customer->created_at)) }}</td>
        </tr>

        <tr>
            <th>来店回数</th>
            <td>{{ $total_data['visit'] }}</td>
        </tr>

        <tr>
            <th>平均単価</th>
            <td>{{ $total_data['ave'] }}</td>
        </tr>

        <tr>
            <th>利用総額</th>
            <td>{{ $total_data['payment'] }}</td>
        </tr>

        <tr>
            <th>プラン開始日</th>
            <td>{{ $customer->plan_started_at ? : '-' }}</td>
        </tr>

        <tr>
            <th>プラン終了日</th>
            <td>{{ $formatted['due_date'] }}</td>
        </tr>

        <tr>
            <th>プラン残り日数</th>
            <td>{{ $formatted['left'] }}</td>
        </tr>

        <tr>
            <th>プラン利用回数</th>
            <td>{{ $total_data['plan'] }}</td>
        </tr>

    </table>
</div>

@endsection