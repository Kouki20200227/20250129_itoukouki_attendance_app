@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')
<script src="{{asset('js/realTime.js')}}"></script>
<div class="index__content">
    <form action="/index" class="index__form" method="post">
        @csrf
            @switch($situation->situation)
                @case(0)
                    <p class="index__form--sign">勤務外</p>
                    @break
                @case(1)
                    <p class="index__form--sign">勤務中</p>
                    @break
                @case(2)
                    <p class="index__form--sign">休憩中</p>
                    @break
                @case(3)
                    <p class="index__form--sign">退勤済</p>
                    @break
                @default
            @endswitch
            <p class="index__form--date" id="current-date"></p>
            <strong class="index__form--clock" id="current-time"></strong>
            <div class="form__btn">
                @switch($situation->situation)
                    @case(0)
                        <button name="attendance" class="form__btn--submit black">出勤</button>
                        @break
                    @case(1)
                        <button name="leaving" class="form__btn--submit">退勤</button>
                        <button name="break_in" class="form__btn--submit white">休憩入</button>
                        @break
                    @case(2)
                        <button name="break_out" class="form__btn--submit white">休憩戻</button>
                        @break
                    @case(3)
                        <p class="form__tag--txt">お疲れ様でした。</p>
                        @break
                    @default
                @endswitch
            </div>
    </form>
</div>
@endsection