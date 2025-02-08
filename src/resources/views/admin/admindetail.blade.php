@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/admindetail.css')}}">
@endsection

@section('content')
<div class="detail__content">
    <h1 class="detail__content--ttl">勤怠詳細</h1>
    <form action="/admin/attendance" class="detail__form" method="post">
        @csrf
            <table class="detail__table">
                <tr>
                    <th><label>名前</label></th>
                    <td>西  伶奈</td>
                </tr>
                <tr>
                    <th><label>日付</label></th>
                    <td>
                        <div class="input__group">
                            <input type="text" class="input__group--item" value="2023年">
                            <input type="text" class="input__group--item" value="6月1日">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><label>出勤・退勤</label></th>
                    <td>
                        <div class="input__group">
                            <input type="text" class="input__group--item" value="09:00">
                            <div class="wave">~</div>
                            <input type="text" class="input__group--item" value="20:00">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><label>休憩</label></th>
                    <td>
                        <div class="input__group">
                            <input type="text" class="input__group--item" value="12:00">
                            <div class="wave">~</div>
                            <input type="text" class="input__group--item" value="13:00">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><label>休憩２</label></th>
                    <td>
                        <div class="input__group">
                            <input type="text" class="input__group--item">
                            <div class="wave">~</div>
                            <input type="text" class="input__group--item">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><label>備考</label></th>
                    <td>
                        <div class="text__group">
                            <textarea class="text__group--item" name=""></textarea>
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