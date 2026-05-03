<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="https://unpkg.com/sanitize.css">
    <!--<link rel="stylesheet" href="{{ asset('css/common.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/layouts/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">

            <div class="header__logo-wrapper">
                <div class="header__logo">
                    <a href="/">
                        <img src="{{ asset('images/COACHTECH-header_logo.png') }}" alt="logo">
                    </a>
                </div>
            </div>

            <div class="header__search-wrapper">
                <div class="header__search">
                    @if(request()->routeIs('items.mylist'))
                        <form action="{{ route('items.mylist') }}" method="GET">
                    @else
                        <form action="{{ route('items.index') }}" method="GET">
                    @endif

                        <input
                            type="text"
                            name="keyword"
                            value="{{ request('keyword') }}"
                            placeholder="なにをお探しですか？Enterで検索">
                    </form>
                </div>
            </div>

            <div class="header__nav-wrapper">
                <nav class="header__nav">
                    <ul>
                        @auth
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                ログアウト
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('login') }}">ログイン</a>
                        </li>
                        @endauth

                        <li><a href="{{ route('mypage') }}">マイページ</a></li>
                        <li><a href="{{ route('sell.store') }}">出品</a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </header>

    <main class="main">
        @yield('main')
    </main>

</body>
</html>