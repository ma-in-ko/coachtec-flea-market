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
                    <form action="" method="get">
                        <input type="text" name="keyword" placeholder="なにをお探しですか？">
                    </form>
                </div>
            </div>

            <div class="header__nav-wrapper">
                <nav class="header__nav">
                    <ul>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="header__logout">ログアウト</button>
                            </form>
                        </li>
                        <li><a href="#">マイページ</a></li>
                        <li><a href="#">出品</a></li>
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