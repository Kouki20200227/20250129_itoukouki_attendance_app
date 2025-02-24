@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/staffdetail.css')}}">
@endsection

@section('content')
<div class="detail__content">
    <h1 class="detail__content--ttl">{{ $user->name }}さんの勤怠</h1>
    <div class="detail__group">
        <form action="#" class="detail__form" method="get">
            @csrf
                <div class="form__group">
                    <a href="#" class="form__group--link">←前月</a>
                </div>
                <div class="form__input">
                    <input type="month" class="form__input--item" value="{{ $dateYm }}">
                </div>
                <div class="form__group">
                    <a href="#" class="form__group--link">翌月→</a>
                </div>
        </form>
        <table class="detail__table">
            <tr>
                <th class="detail__table--day">日付</th>
                <th class="detail__table--clockin">出勤</th>
                <th class="detail__table--clockout">退勤</th>
                <th class="detail__table--break">休憩</th>
                <th class="detail__table--total">合計</th>
                <th class="detail__table--detail">詳細</th>
            </tr>
            @foreach ($worklist as $work)
                @php
                    $totalBreaks = \Carbon\Carbon::createFromFormat('H:i', '00:00');
                    $workStart = \Carbon\Carbon::parse($work->work_in);
                    $workEnd = \Carbon\Carbon::parse($work->work_out);
                    $workdiff = $workStart->diff($workEnd);
                    $worktime = \Carbon\Carbon::createFromTime($workdiff->h, $workdiff->i);
                    foreach($work->break_times as $break_time){
                        $breakStart = \Carbon\Carbon::parse($break_time->break_in);
                        $breakEnd = \Carbon\Carbon::parse($break_time->break_out);
                        $difftimes = $breakStart->diff($breakEnd);                        $addtime = \Carbon\Carbon::createFromTime($difftimes->h, $difftimes->i);
                        $totalBreaks->addHours($addtime->hour)->addMinutes($addtime->minute);
                    }
                    $totalHours = $worktime->subHours($totalBreaks->hour)->subMinutes($totalBreaks->minute);
                @endphp
                <tr>
                    <td class="detail__table--day">{{ \Carbon\Carbon::parse($work->work_in)->translatedFormat('n/j (D)')}}</td>
                    <td class="detail__table--clockin tag">{{ \Carbon\Carbon::parse($work->work_in)->translatedFormat('H:i') }}</td>
                    <td class="detail__table--clockout tag">{{ \Carbon\Carbon::parse($work->work_out)->translatedFormat('H:i') }}</td>
                    <td class="detail__table--break tag">{{ \Carbon\Carbon::parse($totalBreaks)->translatedFormat('H:i') }}</td>
                    <td class="detail__table--total tag">{{ \Carbon\Carbon::parse($totalHours)->translatedFormat('H:i') }}</td>
                    <td class="detail__table--detail tag"><a href="/attendance/{{ $work->id }}" class="detail__table--link">詳細</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection