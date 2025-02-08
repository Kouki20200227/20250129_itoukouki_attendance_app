@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/adminindex.css')}}">
@endsection

@section('content')
    <div class="index__content">
        <h1 class="index__content--ttl">2023年6月1日の勤怠</h1>
        <div class="index__group">
            <form action="/admin/attendance/list" class="form__day" method="post">
                @csrf
                    <a href="" class="form__day--day-before"><span>←</span> 前日</a>
                    <div class="day__input">
                        <input type="date" class="day__input--item" value="2023-06-01">
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
                    
                        <!-- <tr>
                            <td class="list__table--name"></td>
                            <td class="list__table--clockin"></td>
                            <td class="list__table--clockout"></td>
                            <td class="list__table--break"></td>
                            <td class="list__clock--total"></td>
                            <td class="list__clock--detail"></td>
                        </tr> -->
                    
                </table>
            </div>
        </div>
    </div>
@endsection