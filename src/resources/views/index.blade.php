@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')
<div class="index__content">
    <form action="#" class="index__form" method="get">
        @csrf
            <p class="index__form--sign">勤務外</p>
            <p class="index__form--date">2023年6月1日(木)</p>
            <strong class="index__form--clock">8:00</strong>
            <div class="form__btn">
                <button class="form__btn--submit">出勤</button>
            </div>
    </form>
</div>
@endsection