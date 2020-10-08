<div class="container-fulid navi">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse justify-content-around">
            <ul class="nav navbar-nav">
                @auth
                    <li class="navbar-item">
                        <a href="{{ route('home') }}" class="nav-link">ホーム</a>
                    </li>
                    <li class="navbar-item">
                        <a href="/setting" class="nav-link">設定を変更する</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{ route('customer.add') }}" class="nav-link">顧客を登録する</a>
                    </li>
                    <li class="navbar-item">
                        <a href="/customer/list?plan=2" class="nav-link">顧客リスト</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{ route('customer.list.deleted') }}" class="nav-link">非アクティブ顧客リスト</a>
                    </li>
                @endauth
                    <li class="navbar-item">
                        <a href="/demo" class="nav-link">使い方を確認する</a>
                    </li>
                @guest
                    @if(url()->current() == "https://localhost/demo")
                        <li class="navbar-item">
                            <a class="nav-link" href="{{ route('login') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('demo_login').submit();">
                            ログイン（デモ用）
                            </a>

                            <form id="demo_login" action="{{ route('login') }}" method="POST" style="display: none;">
                                @csrf
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="TestUser" required autocomplete="name" autofocus>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="testtesttest" required autocomplete="current-password">
                            </form>
                        </li>
                    @endif
                @endguest
            </ul>

            <ul class="navbar-nav ml-auto navbar-right">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('ユーザー登録') }}</a>
                        </li>
                    @endif
                @else

                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('ログアウト') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                @endguest
            </ul>
        </div>
    </nav>
</div>

