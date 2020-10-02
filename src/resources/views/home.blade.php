@extends('layouts.app')

@section('content')

@include('share.nav')

<div class="container">
    <h2 class="">設定</h2>

    <table class="table">
        <tr>
            <th>サブスク有効期間</th>
            <td>{{ $user->expiring_date }}日</td>
        </tr>
        <tr>
            <th>メール配信時刻</th>
            <td>{{ $user->what_time_mail }}時</td>
        </tr>
        <tr>
            <th>失効日から</th>
            <td>{{ $user->how_days_mail }}日前に通知メール</td>
        </tr>
    </table>
</div>

@endsection
