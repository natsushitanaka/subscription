<h3>通知メール</h3>

<p>ご契約ありがとうございます。</p>
<p>このプランは{{ $user->expiring_date }}日間有効です。</p>
<p>来店時に下記QRコードをご提示ください。</p>

<h3>登録情報</h3>

<img src="{{ $message->embed('qrcode/'.$customer->id.'.png') }}" alt="">

<table class="table">

    <tr>
        <th>氏名</th>
        <td>{{ $customer->name }}</td>
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td>{{ $customer->email }}</td>
    </tr>
    <tr>
        <th>電話番号</th>
        <td>{{ $customer->tel }}</td>
    </tr>
    <tr>
        <th>誕生日</th>
        <td>{{ $customer->birth }}</td>
    </tr>
    <tr>
        <th>サブスク開始日</th>
        <td>{{ $customer->plan_started_at }}</td>
    </tr>
    <tr>
        <th>有効期限</th>
        <td>{{ date("Y-m-d", strtotime($customer->plan_started_at . " + " . $user->expiring_date ." day")) }}</td>
    </tr>

</table>

<P>
    <a href="https://kakurebakitchengao.business.site/">ホームページ</a>
</P>
