@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
<div class="register__content">
    <h1 class="register__content--ttl">会員登録</h1>
    <form action="/register" class="register__form" method="post">
        @csrf
            <div class="input__group">
                <label class="input__group--lbl">名前</label>
                <input type="text" name="name" class="input__group--txt">
                <div class="form__group--error">
                    @error('name')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="input__group">
                <label class="input__group--lbl">メールアドレス</label>
                <input type="email" name="email" class="input__group--txt">
                <div class="form__group--error">
                    @error('email')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="input__group">
                <label class="input__group--lbl">パスワード</label>
                <input type="password" name="password" class="input__group--txt">
                <div class="form__group--error">
                    @error('password')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="input__group">
                <label class="input__group--lbl">確認用パスワード</label>
                <input type="password" name="password_confirmation" class="input__group--txt">
            </div>
            <div class="button__group">
                <button type="submit" class="button__group--submit">登録する</button>
            </div>
            <div class="login__link">
                <a href="/login" class="login__link--txt">ログインはこちら</a>
            </div>
    </form>
</div>
@endsection