@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css')}}">
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
    <h1>住所の変更</h1>
    <div class="input">
        <form action="{{route('address.update',['id' => $item->id])}}" method="post">
            @csrf
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
            <button class="update" type="submit">更新する</button>
        </form>
    </div>
@endsection