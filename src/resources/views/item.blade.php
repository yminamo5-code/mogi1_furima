@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css')}}">
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
<div class="content">
    <div class="left">
        <img src="{{ asset('storage/images/' . $item->image) }}" alt="商品画像">
    </div>

    <div class="right">
        <h1>{{ $item->itemname }}</h1>
        <p>{{ $item->brand }}</p>
        <p>&yen;{{number_format($item->price) }}(税込み)</p>

        <form action="{{route('item.like',['item_id'=>$item->id])}}" method="POST">
            @csrf
            <button type="submit" class="like"> 
                @if($liked)
                    <img src="{{ asset('images/ハートロゴ_ピンク.png') }}" alt="ハートロゴ_ピンク">
                @else
                    <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" alt="ハートロゴ_デフォルト">
                @endif
            </button>
        </form>
            <p>{{ $likeCount }}</p>

            <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="ふきだしロゴ">
 

        <form action="{{ route('item.purchase') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <button type="submit" class="purchase">購入手続きへ</button>
        </form>
        <h2>商品説明</h2>
        <p>{{ $item->description }}</p>
        <h2>商品の情報</h2>
        <p>
            <div>カテゴリー</div>
            <div></div>                                 <!--カテゴリー-->
        </p>
        <p>
            <div>商品の状態</div>
            <div>{{ $item->condition }}</div>
        </p>

        
    </div>
    
</div>
@endsection