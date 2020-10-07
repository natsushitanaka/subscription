<div class="container-fulid navi">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse justify-content-around">
            <ul class="nav navbar-nav">
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

