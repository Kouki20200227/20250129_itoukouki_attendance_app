@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/adminindex.css')}}">
@endsection

@section('content')
    <div class="index__content">
        <h1 class="index__content--ttl">{{ $date->format('Y年m月d日') }}の勤怠</h1>
        <div class="index__group">
            <form action="/admin/attendance/list" class="form__day" method="get">
                @csrf
                    <div class="form__group">
                        <button class="form__group--btn" name="date" value="back">←前日</button>
                    </div>
                    <div class="form__input">
                        <input type="date" class="day__input--item" name="dateYmd" value="{{ $date->format('Y-m-d') }}">
                    </div>
                    <div class="form__group">
                        <button class="form__group--btn" name="date" value="next">翌日→</button>
                    </div>
            </form>
            <div class="index__list">
                <table class="list__table">
                    <tr>
                        <th class="list__table--name"><p>名前</p></th>
                        <th class="list__table--clockin">出勤</th>
                        <th class="list__table--clockout">退勤</th>
                        <th class="list__table--break">休憩</th>
                        <th class="list__table--total">合計</th>
                        <th class="list__table--detail">詳細</th>
                    </tr>
                    @unless(is_null($works))
                        @foreach ($works as $work)
                            <tr>
                                <td class="list__table--name"><p>{{ $work['name'] }}</p></td>
                                <td class="list__table--clockin">{{ $work['work_in'] }}</td>
                                <td class="list__table--clockout">{{ $work['work_out'] }}</td>
                                <td class="list__table--break">{{ $work['break_total'] }}</td>
                                <td class="list__table--total">{{ $work['work_total'] }}</td>
                                <td class="list__table--detail"><a href="/attendance/{{ $work['work_id'] }}" class="list__table--link">詳細</a></td>
                            </tr>
                        @endforeach
                    @endunless
                </table>
            </div>
        </div>
    </div>
@endsection