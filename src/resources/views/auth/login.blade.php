@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')
<div class="login__content">
    @if (Request::routeIs('adminlogin'))
    <div class="content__ttl">
        <h1 class="content__ttl--txt">管理者ログイン</h1>
    </div>
    <form action="/admin/login" class="login__form" method="post">
        @csrf
        <div class="form__group">
            <label class="form__group--lbl">メールアドレス</label>
            <input type="email" class="form__group--item" name="email" value="{{old('email')}}">
            <div class="form__group--error">
                @error('email')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <label class="form__group--lbl">パスワード</label>
            <input type="password" class="form__group--item" name="password" value="{{old('password')}}">
            <div class="form__group--error">
                @error('password')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="form__btn">
            <button class="form__btn--submit" type="submit">管理者ログインする</button>
            <div class="form__group--error">
                @error('login')
                    {{$message}}
                @enderror
            </div>
        </div>
    </form>
    @elseif(Request::routeIs('login'))
    <div class="content__ttl">
        <h1 class="content__ttl--txt">ログイン</h1>
    </div>
    <form action="/login" class="login__form" method="post">
        @csrf
            <div class="form__group">
                <label class="form__group--lbl">メールアドレス</label>
                <input type="email" class="form__group--item" name="email" value="{{old('email')}}">
                <div class="form__group--error">
                    @error('email')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <label class="form__group--lbl">パスワード</label>
                <input type="password" class="form__group--item"    name="password" value="{{old('password')}}">
                <div class="form__group--error">
                    @error('password')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form__btn">
                <button class="form__btn--submit" type="submit">ログインする</button>
                <div class="form__group--error">
                    @error('login')
                        {{$message}}
                    @enderror
                </div>
            </div>
    </form>
    <div class="register__link">
        <a href="/register" class="register__link--txt">会員登録はこちら</a>
    </div>
    @endif
</div>
@endsection