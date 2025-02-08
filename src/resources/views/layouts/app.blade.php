<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    @yield('link')
    <title>勤怠管理アプリ</title>
</head>
<body>
    <header>
        <div class="header__group">
            <div class="header__logo">
                <img src="{{asset('img/logo.svg')}}" class="header__logo--img">
            </div>
            <div class="header__link">
                <nav class="link__nav">
                    <ul>
                        <li><a href="">勤怠一覧</a></li>
                        <li><a href="">スタッフ一覧</a></li>
                        <li><a href="">申請一覧</a></li>
                        @if (Auth::check())
                            <li>
                                <form action="/logout" class="logout__form" method="post">
                                    @csrf
                                    <button class="logout__btn--submit" type="submit">ログアウト</button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>