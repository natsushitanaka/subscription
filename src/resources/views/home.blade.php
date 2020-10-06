@extends('layouts.app')

@section('content')

@include('share.nav')

<div class="container">
    <p style="color: red;">＊まずは顧客登録してください！</p>
    <p style="color: red;">＊ログアウトすると設定の変更や顧客登録データは全て破棄されます。</p>

    <h2 class="">設定</h2>
    
    <table class="table">
        <tr>
            <th>サブスク有効期間</th>
            <td>{{ $user->expiring_date }}日</td>
        </tr>
        <tr>
            <th>メール配信時刻</th>
            <td>{{ $user->what_time_mail_hour }}：{{ $user->what_time_mail_minute }}</td>
        </tr>
        <tr>
            <th>失効日から</th>
            <td>{{ $user->how_days_mail }}日前に通知メール</td>
        </tr>
    </table>

</div>

@endsection
