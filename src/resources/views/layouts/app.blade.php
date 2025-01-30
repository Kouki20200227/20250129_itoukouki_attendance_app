<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <title>勤怠管理アプリ</title>
</head>
<body>
    <header>
        <div class="header__logo">
            <img src="{{asset('img/logo.svg')}}" class="header__logo--img">
        </div>
        <div class="header__group">
            <nav class="header__nav">
                <a href="" class="header__nav--link">勤怠一覧</a>
                <a href="" class="header__nav--link">スタッフ一覧</a>
                <a href="" class="header__nav--link">申請一覧</a>
                <form action="/logout" class="logout__form" method="post">
                    <button class="logout__btn--submit" type="submit">ログアウト</button>
                </form>
            </nav>
        </div>
    </header>
</body>
</html>