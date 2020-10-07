@extends('layouts.app')

@section('content')

@include('share.nav')

<div class="container">
    <ol>
        <li style="color: red;">
            リストに追加されていれば、ご登録のメールアドレスにQRコード付きメールが送信されていますのでご確認ください。
        </li>
        <li style="color: red;">
            QRコードを読み取って頂くと顧客情報を取得し、本人認証となります。また来店データに読み取った日付が追加されます。
        </li>
        <li style="color: red;">
            [設定を変更する]→[テスト用の設定に変更する]すると、すぐにプランを終了する処理が確認できます。
        </li>
    </ol>

    <div class="row">
        <h2 class="col-6">顧客リスト</h2>

        <div class="col-6">
            <form action="" method="get">
                <label for="2">全て</label>
                <input type="radio" id="2" name="plan" value="2">
                <label for="1">サブスク有</label>
                <input type="radio" id="1" name="plan" value="1">
                <label for="0">サブスク無</label>
                <input type="radio" id="0" name="plan" value="0">
                <button type="submit" class="btn btn-primary btn-sm">絞り込む</button>
            </form>
        </div>
    </div>
</div>

<div class="container">

    <table class="table">

        <tr>
            <th>氏名</th>
            <th>登録日</th>
            <th>プランの有無</th>
            <th>-</th>
            <th>非アクティブにする</th>
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

            <td><a href="/customer/{{$customer->id}}/data" class="btn btn-primary btn-sm">来店データを見る</a></td>

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

@endsection