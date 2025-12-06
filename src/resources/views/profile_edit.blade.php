@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_edit.css')}}">
@endsection

@section('search')
<!-- 空だと表示されないのでコメントを置いとく -->
@endsection
@section('in_out')
@endsection
@section('mypage')
<!-- 空だと表示されないのでコメントを置いとく -->
@endsection
@section('sell')
<!-- 空だと表示されないのでコメントを置いとく -->
@endsection

@section('content')
<main>
    <h1>プロフィール設定</h1>
    <div class="icon">
        <img src="" alt="アイコン">
        <div>画像を選択する</div>
    </div>
    <div class="input">
        <div class=label>ユーザー名</div>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>


</main>
@endsection