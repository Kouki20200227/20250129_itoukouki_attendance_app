@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/admindetail.css')}}">
@endsection

@section('content')
@php
    $workStart = \Carbon\Carbon::parse($work->work_in);
    $workEnd = \Carbon\Carbon::parse($work->work_out);
    $count = 0;
@endphp
<div class="detail__content">
    <h1 class="detail__content--ttl">勤怠詳細</h1>
    <form action="/attendance/{{ $work->id }}" class="detail__form" method="post">
        @csrf
            <table class="detail__table">
                <tr>
                    <th><label>名前</label></th>
                    <td>{{ $work->user->name }}</td>
                </tr>
                <tr>
                    <th><label>日付</label></th>
                    <td>
                        <div class="input__group">
                            <label class="input__group--lbl">{{ $workStart->year }}年</label>
                            <!-- 擬似要素 -->
                            <div class="wave"></div>
                            <label class="input__group--lbl">{{ $workStart->month . '月' . $workStart->day . '日' }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><label>出勤・退勤</label></th>
                    <td>
                        <div class="input__group">
                            <input type="text" class="input__group--item" name="work_in" value="{{ $workStart->hour . ':' . $workStart->minute }}">
                            <div class="wave">~</div>
                            <input type="text" class="input__group--item" name="work_out" value="{{ $workEnd->hour . ':' . $workEnd->minute }}">
                        </div>
                        <div class="form__group--error">
                            @error('work_in || work_out')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
                @foreach ($work->break_times as $break_time)
                @php
                    $count++;
                @endphp
                    <tr>
                        @if ($count < 2)
                            <th><label>休憩</label></th>
                        @else
                            <th><label>休憩{{ $count }}</label></th>
                        @endif
                        <td>
                            <div class="input__group">
                                <input type="text" class="input__group--item" name="break_in{{ $count }}" value="{{    \Carbon\Carbon::parse($break_time->break_in)->translatedFormat('H:i') }}">
                                <div class="wave">~</div>
                                <input type="text" class="input__group--item" name="break_out{{ $count }}" value="{{ \Carbon\Carbon::parse($break_time->break_out)->translatedFormat('H:i') }}">
                            </div>
                            <div class="form__group--error">
                                @error('break_in || break_out')
                                    {{ $message }}
                                @enderror
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th><label>備考</label></th>
                    <td>
                        <div class="text__group">
                            <textarea class="text__group--item" name="remarks"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
        <div class="detail__btn">
            <button class="detail__btn--submit">修正</button>
        </div>
    </form>
</div>
@endsection