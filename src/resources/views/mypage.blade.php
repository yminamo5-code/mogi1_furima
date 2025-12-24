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
        <img src="{{ asset('storage/images/' . $user->image) }}" alt="アイコン">
        <div class="user">{{ $user->name }}</div>
        <a href="{{route('profile')}}" class="edit">プロフィールを編集</a>
    </div>
    <div class="row2">
        <a href="{{ url('/mypage?page=sell') }}" class="{{$tab === 'sell' ? 'active-tab' : ''}}">出品した商品</a>
        <a href="{{ url('/mypage?page=buy') }}" class="{{$tab === 'buy' ? 'active-tab' : ''}}">購入した商品</a>
    </div>
    <div class="row3">
    @if($tab === 'sell')
        <div class="items">
            @foreach($items as $item)
                <div class="item">
                    <a href="{{ route('item.show', $item->id) }}">
                        <img src="{{ asset('storage/images/' . $item->image) }}" alt="商品画像">
                        <p>{{ $item->itemname }}</p>
                    </a>
                </div>
            @endforeach
        </div>

    @elseif($tab === 'buy')
        <div class="items">
            @foreach($items as $item)
                <div class="item">
                    <a href="{{ route('item.show', $item->id) }}">
                        <img src="{{ asset('storage/images' . $item->image) }}" alt="商品画像">
                        <p>{{ $item->itemname }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</main>
@endsection