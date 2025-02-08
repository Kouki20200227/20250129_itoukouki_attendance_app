@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/requestlist.css')}}">
@endsection

@section('content')
<div class="request__content">
    <h1 class="request__content--ttl">申請一覧</h1>
    <div class="request__select">
        <div class="select__group">
            <div class="select__tag">
                <a href="#" class="select__tag--link">承認待ち</a>
            </div>
            <div class="select__tag">
                <a href="#" class="select__tag--link">承認済み</a>
            </div>
        </div>
    </div>
    <table class="request__table">
        <tr>
            <th class="request__table--list">状態</th>
            <th class="request__table--list">名前</th>
            <th class="request__table--list">対象日時</th>
            <th class="request__table--list">申請理由</th>
            <th class="request__table--list">申請日時</th>
            <th class="request__table--detail">詳細</th>
        </tr>
        <!-- 繰り返しスタート -->
            <tr>
                <td class="request__table--list">承認待ち</td>
                <td class="request__table--list">西 伶奈</td>
                <td class="request__table--list">2022/06/01</td>
                <td class="request__table--list">遅延のため</td>
                <td class="request__table--list">2023/06/02</td>
                <td class="request__table--detail"><a href="#" class="table__detail--link">詳細</a></td>
            </tr>
        <!-- 繰り返しエンド -->
    </table>
</div>
@endsection