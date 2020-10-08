<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Subscription.local</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                /* padding: 30px; */
            }

            .title {
                font-size: 60px;
                margin: 0 auto;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 30px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links{
                display: flex;
                justify-content: space-around;
                margin-top: 10vh;
            }

            .box{
                display: flex;
                align-items: flex-end;
                height: 45vh;
            }

            .span{
                font-size: 17px;
            }

        </style>
    </head>
    <body>
        <div class="box">
            <h2 class="title ">サブスクリプション管理アプリ</h2>
        </div>
        <div class="links">
            @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}">ホーム</a>
            @else
                <a href="{{ route('login') }}">ログイン</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">ユーザー登録</a>
                @endif
            @endauth
            @endif
                <a href="/demo">使い方<span class="span">（テストログインはこちら）</span></a>
        </div>
    </body>
</html>
