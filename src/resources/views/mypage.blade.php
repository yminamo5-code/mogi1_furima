@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
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
    <div class="row1">
        <img src="{{ asset('storage/' . $user->image) }}" alt="アイコン">
        <div class="user">{{ $user->name }}</div>
        <a href="{{route('profile')}}" class="edit">プロフィールを編集</a>
    </div>
    <div class="row2">
        <a href="{{ url('/mypage?page=sell') }}" class="{{$tab === 'page=sell' ? 'active-tab' : ''}}">出品した商品</a>
        <a href="{{ url('/mypage?page=buy') }}" class="{{$tab === 'page=buy' ? 'active-tab' : ''}}">購入した商品</a>
    </div>
    <div class="row3">
        @foreach($items as $item)
            <img src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
            <p>{{ $item->itemname }}</p>
        @endforeach
    </div>



</main>
@endsection