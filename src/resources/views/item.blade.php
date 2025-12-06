@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css')}}">
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
        <!-- いいねとコメント数 -->

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