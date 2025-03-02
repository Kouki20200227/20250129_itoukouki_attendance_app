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
                @if (Auth::guard('admin'))
                    <a class="header__logo--link" href="/attendance"><img src="{{asset('img/logo.svg')}}"  class="header__logo--img"></a>
                @else
                <a class="header__logo--link" href="/admin/attendance/list"><img src="{{asset('img/logo.svg')}}" class="header__logo--img"></a>
                @endif
            </div>
            <div class="header__link">
                <nav class="link__nav">
                    <ul>
                        @if (Auth::check())
                            @if (Auth::guard('admin')->check())
                                <li><a href="/admin/attendance/list">勤怠一覧</a></li>
                                <li><a href="/admin/staff/list">スタッフ一覧</a></li>
                                <li><a href="/stamp_correction_request/list?tab=wait">申請一覧</a></li>
                                <li>
                                    <form action="/logout" class="logout__form" method="post">
                                        @csrf
                                            <button class="logout__btn--submit" type="submit">ログアウト</button>
                                    </form>
                                </li>
                            @elseif(Auth::guard('web')->check())
                                <li><a href="/attendance">勤怠</a></li>
                                <li><a href="/attendance/list">勤怠一覧</a></li>
                                <li><a href="/stamp_correction_request/list">申請</a></li>
                                <li>
                                    <form action="/logout" class="logout__form" method="post">
                                        @csrf
                                        <button class="logout__btn--submit" type="submit">ログアウト</button>
                                    </form>
                                </li>
                            @endif
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