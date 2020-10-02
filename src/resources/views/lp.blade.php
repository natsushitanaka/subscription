<h2>顧客管理アプリ</h2>

<p>【このアプリでできること】</p>
<p>サブスクサービス利用者の有効期限の管理・本人認証・来店データの集積</p>

<p>【使用した技術】</p>
<table>
    <tr>
        <td>フレームワーク</td><td>Laravel</td>
    </tr>
    <tr>
        <td>データベース</td><td>Mysql</td>
    </tr>
    <tr>
        <td>環境構築</td><td>Docker</td>
    </tr>
    <tr>
        <td>デプロイ</td><td>さくらVPS</td>
    </tr>
    <tr>
        <td>その他</td><td>Bootstrap, Nginx, smtpMailer, cron, simplesoftwareio/simple-qrcode, Git</td>
    </tr>
</table>

<p>【仕様】</p>
<p>店舗登録（名前・メール・パスワード）＊店舗への通知メール配信先になるアドレス</p>
<p>ログイン（メール・パスワード）</p>
<p>サブスク有効期間（３０日）・メール配信時刻（１０時）・何日前に通知メールを配信するかを設定（７日）*（）内はデフォルト</p>
<p>顧客登録（名前・メール・電話番号・誕生日・サブスク利用の有無・コメント）＊名前・メールは必須</p>
<p>登録後、顧客毎に独自のQRコードが添付されたメールを自動配信　＊サブスク利用者のみ</p>
<p>サブスク利用者は来店時、QRコードを提示→店舗が読み取り本人認証＋来店データ（日付のみ、他項目は手動入力）を保存</p>
<p>サブスク利用者に、期限７日前に通知メール配信</p>
<p>サブスク利用者に、期限当日に通知メール配信</p>
<p>誕生日登録者に、誕生日当日メール配信</p>
<p>毎月初日に、その月の誕生日の顧客情報を通知メール配信</p>

<p>【経緯】</p>
<p>知人の飲食店で月定額飲み放題のサブスクリプションサービスを実施</p>
<p>サブスクの有効期限の管理や本人認証が必要になり、現場のニーズをヒアリングしつつ開発</p>