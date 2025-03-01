@extends('layouts.app')

@section('link')
<link rel="stylesheet" href="{{asset('css/stafflist.css')}}">
@endsection

@section('content')
<div class="stafflist__content">
    <h1 class="stafflist__content--ttl">スタッフ一覧</h1>
    <div class="content__group">
        <table class="group__table">
            <tr>
                <th class="group__table--name"><p>名前</p></th>
                <th class="group__table--email">メールアドレス</th>
                <th class="group__table--detail">月次勤怠</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td class="group__table--name"><p>{{ $user->name }}</p></td>
                    <td class="group__table--email">{{ $user->email }}</td>
                    <td class="group__table--detail"><a href="/admin/attendance/staff/{{$user->id}}" class="table__detail--link">詳細</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection