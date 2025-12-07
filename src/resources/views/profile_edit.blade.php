@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_edit.css')}}">
@endsection

@section('search')
<!-- 空だと表示されないのでコメントを置いとく -->
@endsection
@section('in_out')
<!-- 空だと表示されないのでコメントを置いとく -->
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
    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="information">
            <div class=label>ユーザー名</div>
            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}">
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
            <div class=label>郵便番号</div>
            <input type="text" name="postcode" value="{{ old('postcode', $user->postcode ?? '') }}">
            @error('postcode')
            <div class="error">{{ $message }}</div>
            @enderror
            <div class=label>住所</div>
            <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}">
            @error('address')
            <div class="error">{{ $message }}</div>
            @enderror
            <div class=label>建物名</div>
            <input type="text" name="building" value="{{ old('building', $user->building ?? '') }}">
            @error('building')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button class="button-admin" type="submit">更新する</button>
    </form>


</main>
@endsection