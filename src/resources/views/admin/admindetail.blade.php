@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/admindetail.css')}}">
@endsection

@section('content')
<div class="detail__content">
    <h1 class="detail__content--ttl">勤怠詳細</h1>
    @if ($list['request_flg'] === 0)
        <form action="/attendance/{{ $list['work_id'] }}" class="detail__form" method="post">
            @csrf
                <table class="detail__table">
                    <tr>
                        <th><label>名前</label></th>
                        <td>{{ $list['name'] }}</td>
                    </tr>
                    <tr>
                        <th><label>日付</label></th>
                        <td>
                            <div class="input__group">
                                <label class="input__group--lbl">{{ $list['year'] }}年</label>
                                <!-- 擬似要素 -->
                                <div class="wave"></div>
                                <label class="input__group--lbl">{{ $list['month'] . '月' . $list['day'] . '日' }}</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><label>出勤・退勤</label></th>
                        <td>
                            <div class="input__group">
                                <input type="time" class="input__group--item" name="work_in" value="{{ $list['work_in'] }}">
                                <div class="wave">~</div>
                                <input type="time" class="input__group--item" name="work_out" value="{{ $list['work_out'] }}">
                            </div>
                            <div class="form__group--error">
                                @error('work_in || work_out')
                                    {{ $message }}
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><label>休憩</label></th>
                        <td>
                            <div class="input__group">
                                <input type="time" class="input__group--item" name="break_in1" value="{{ $list['break_in1'] }}">
                                <div class="wave">~</div>
                                <input type="time" class="input__group--item" name="break_out1" value="{{ $list['break_out1'] }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><label>休憩2</label></th>
                        <td>
                            <div class="input__group">
                                <input type="time" class="input__group--item" name="break_in2" value="{{ $list['break_in2'] }}">
                                <div class="wave">~</div>
                                <input type="time" class="input__group--item" name="break_out2" value="{{ $list['break_out2'] }}">
                            </div>
                        </td>
                    </tr>
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
    @elseif($list['request_flg'] === 1)
        <div class="detail__form">
            <table class="detail__table">
                <tr>
                    <th><label>名前</label></th>
                    <td>{{ $list['name'] }}</td>
                </tr>
                <tr>
                    <th><label>日付</label></th>
                    <td>
                        <div class="input__group">
                            <label class="input__group--lbl">{{ $list['year'] }}年</label>
                            <!-- 擬似要素 -->
                            <div class="wave"></div>
                            <label class="input__group--lbl">{{ $list['month'] . '月' . $list['day'] . '日' }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><label>出勤・退勤</label></th>
                    <td>
                        <div class="input__group">
                            <input type="time" class="input__group--item" name="work_in" value="{{ $list['work_in'] }}" disabled>
                            <div class="wave">~</div>
                            <input type="time" class="input__group--item" name="work_out" value="{{ $list['work_out'] }}" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><label>休憩</label></th>
                    <td>
                        <div class="input__group">
                            <input type="time" class="input__group--item" name="break_in1" value="{{ $list['break_in1'] }}" disabled>
                            <div class="wave">~</div>
                            <input type="time" class="input__group--item" name="break_out1" value="{{ $list['break_out1'] }}" disabled>
                        </div>
                        <div class="form__group--error">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><label>休憩2</label></th>
                    <td>
                        <div class="input__group">
                            <input type="time" class="input__group--item" name="break_in2" value="{{ $list['break_in2'] }}" disabled>
                            <div class="wave">~</div>
                            <input type="time" class="input__group--item" name="break_out2" value="{{ $list['break_out2'] }}" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><label>備考</label></th>
                    <td>
                        <div class="text__group">{{ $list['remarks'] }}</div>
                    </td>
                </tr>
            </table>
            <div class="detail__message">※承認待ちのため修正はできません</div>
        </div>
    @endif
</div>
@endsection