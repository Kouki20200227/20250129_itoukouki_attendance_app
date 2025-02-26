@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/request_list.css')}}">
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
        @foreach ($changes as $change)
            <tr>
                <td class="request__table--list">
                    <!-- 承認待ち:0 ,承認済み:1 -->
                    @if ($change->approval_flg === 0)
                        承認待ち
                    @else
                        承認済み
                    @endif
                </td>
                <td class="request__table--list">{{ $change->user->name }}</td>
                <td class="request__table--list">{{ \Carbon\Carbon::parse($change->change_work_in)->format('Y/m/d') }}</td>
                <td class="request__table--list">{{ $change->change_remarks }}</td>
                <td class="request__table--list">{{ \Carbon\Carbon::parse($change->created_at)->format('Y/m/d') }}</td>
                <td class="request__table--detail"><a href="/attendance/{{ $change->work_id }}" class="table__detail--link">詳細</a></td>
            </tr>
        @endforeach
    </table>
</div>
@endsection