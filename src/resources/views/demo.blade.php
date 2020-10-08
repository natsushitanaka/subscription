@extends('layouts.app')

@section('content')
@include('share.nav')

<h3>【アプリ運用の流れ】</h3>

<div class="container">
    <div class="row justify-content-around box">
        <img src="demo_photo/スクリーンショット 2020-10-07 17.19.57.png" alt="ユーザー登録画面" class="col-5 small">
        <div class="col-6">
            <p class="info">1.まずはユーザー（店舗）の登録をします。<br>各項目を入力し、登録します。</p>
        </div>
    </div>

    <div class="row justify-content-around box">
        <img src="demo_photo/スクリーンショット 2020-10-07 17.21.48.png" alt="ログイン画面" class="col-5 small">
        <div class="col-6">
            <p class="info">2.ログイン<br>登録した名前・パスワードでログインします。<br>【ログイン（デモ用）】<br>
            操作確認用のテストユーザーでのログインです。使用可能な機能は本番と変わりませんが、ログアウト時に設定の変更や顧客登録データは破棄されます。</p>
        </div>
    </div>

    <div class="row justify-content-around box">
        <img src="demo_photo/スクリーンショット 2020-10-07 13.16.16.png" alt="顧客登録" class="col-5">
        <div class="col-6">
            <p class="info">3.ログイン後、顧客登録します。<br>・氏名、メールアドレスは必須です。<br>・電話番号は店舗の必要に応じて登録します。<br>・誕生日を登録すると当日メール配信、毎月初日に店舗へ通知メールが配信されます。（誕生日のお客様への特別なサービスなど忘れずに実施するとこができます。）<br>・サブスク利用者にはプランにチェックを入れます。（サブスク利用者以外でも顧客管理としても活用できます。</p>
        </div>
    </div>

    <div class="row justify-content-around box">
        <img src="demo_photo/スクリーンショット 2020-10-07 13.18.08.png" alt="顧客リスト" class="col-5 small">
        <div class="col-6">
            <p class="info">4.顧客リストに追加されています。<br>顧客の「氏名」をクリックすると顧客情報を確認できます。<br>サブスク利用の有無で絞り込みができます。</p>
        </div>
    </div>

    <div class="row justify-content-around box">
        <img src="demo_photo/スクリーンショット 2020-10-07 13.18.54.png" alt="顧客情報" class="col-5">
        <div class="col-6">
            <p class="info">5.顧客の詳細情報を確認する。<br>登録した情報の他、来店データを分析しお客様の特徴などが把握できます。<br>登録した顧客情報の変更は「編集する」から可能です。</p>
        </div>
    </div>

    <div class="row justify-content-around box">
        <img src="demo_photo/スクリーンショット 2020-10-07 13.23.58.png" alt="登録完了メール" class="col-5">
        <div class="col-6">
            <p class="info">5.顧客登録が完了すると、店舗の登録メールアドレスに顧客登録完了メールが配信されます（サブスク利用者のみ）。<br>このQRコードを来店時に提示してもらいます。</p>
        </div>
    </div>

    <div class="row justify-content-around box">
        <img src="demo_photo/スクリーンショット 2020-10-07 16.03.45.png" alt="来店データ" class="col-5">
        <div class="col-6">
            <p class="info">6.QRコードを読み取り、来店データ画面が表示されると本人認証完了です。<br>下の表に来店日が自動で保存されます。<br>この画面では手動での来店データを追加することができます。</p>
        </div>
    </div>

    <div class="row justify-content-around box">
        <img src="demo_photo/スクリーンショット 2020-10-07 13.21.58.png" alt="設定画面" class="col-5">
        <div class="col-6">
        <p class="info">7.店舗の各種設定を変更します。<br>【デフォルト】<br>有効期限：３０日<br>メール配信時刻：１０：００<br>失効事前通知メール配信日：７日前。<br>【テストユーザー】<br>自動設定を押すとすぐに、<br>動作確認（失効事前メール・失効メール・サブスク利用解除処理）ができます。</p>
        </div>
    </div>

    <div class="row justify-content-around box">
        <img src="demo_photo/スクリーンショット 2020-10-07 16.23.22.png" alt="失効メール" class="col-5">
        <div class="col-6">
            <p class="info">8.有効期限になると失効メールを配信し、サブスク利用を解除します。<br>顧客情報のプランの項目が「×」に変わっているはずです。</p>
        </div>
    </div>

    <div class="row justify-content-around">
        <img src="demo_photo/スクリーンショット 2020-10-07 17.57.50.png" alt="非アクティブリスト" class="col-5 small">
        <div class="col-6">
            <p class="info">9.非アクティブ顧客リスト機能<br>登録したが、しばらく来店のないお客様などをこちらに移すことで<br>管理が楽になります。<br>「再登録」するとまた顧客リストに戻すことができます。<br>「完全削除」すると完全に削除され復元はできません。</p>
        </div>
    </div>
</div>

@endsection