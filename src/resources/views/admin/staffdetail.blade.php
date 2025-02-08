@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/staffdetail.css')}}">
@endsection

@section('content')
<div class="detail__content">
    <h1 class="detail__content--ttl">西 伶奈さんの勤怠</h1>
    <div class="detail__group">
        <form action="#" class="detail__form" method="get">
            @csrf
                <div class="form__group">
                    <a href="#" class="form__group--link">←前月</a>
                </div>
                <div class="form__input">
                    <input type="month" class="form__input--item" value="2023-06">
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
            <!-- 繰り返しスタート -->
                <tr>
                    <td class="detail__table--day">mm/dd(w)</td>
                    <td class="detail__table--clockin tag">9:00</td>
                    <td class="detail__table--clockout tag">18:00</td>
                    <td class="detail__table--break tag">1:00</td>
                    <td class="detail__table--total tag">8:00</td>
                    <td class="detail__table--detail tag"><a href="#" class="detail__table--link">詳細</a></td>
                </tr>
                <tr>
                    <td class="detail__table--day">mm/dd(w)</td>
                    <td class="detail__table--clockin tag">9:00</td>
                    <td class="detail__table--clockout tag">18:00</td>
                    <td class="detail__table--break tag">1:00</td>
                    <td class="detail__table--total tag">8:00</td>
                    <td class="detail__table--detail tag"><a href="#" class="detail__table--link">詳細</a></td>
                </tr>
            <!-- 繰り返しエンド -->
        </table>
    </div>
</div>
@endsection