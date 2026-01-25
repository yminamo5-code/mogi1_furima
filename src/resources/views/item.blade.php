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

    <div class="spacer"></div>
    <div class="right">
        <h1>{{ $item->itemname }}</h1>
        <p class="brand">{{ $item->brand }}</p>
        <p class="price">&yen;{{number_format($item->price) }}(税込み)</p>

        <div class="like_comment">
            <div class="like">
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
                    <div>{{ $likeCount }}</div>
            </div>

            <div class="comment_logo">
                <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="ふきだしロゴ">
                <div>{{ $commentCount }}</div>
            </div>
        </div>

        <form action="{{ route('item.purchase',['id'=>$item->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <button type="submit" class="purchase">購入手続きへ</button>
        </form>

        <h2>商品説明</h2>
        <p class="description">{{ $item->description }}</p>

        <h2>商品の情報</h2>
        <div class="category_container">
            <div class="category_title">カテゴリー</div>
            <div class="category_items">
                @foreach($item->categories as $category)
                    <div class="category_item">{{$category->category}}</div>
                @endforeach
            </div>
        </div>
        <div class="condition_wrap">
            <div class="condition_title">商品の状態</div>
            <div class="condition">{{ $item->condition }}</div>
        </div>

        <div class="comment_title">コメント({{ $commentCount }})</div>
        @foreach($comments as $comment)
            <div class="comment_user">
                <div class="user">
                    <img src="{{ asset('storage/images/' . $comment->user->image)}}" alt="ユーザー画像">
                    <div class="comment_usernamae">{{ $comment->user->name}}</div>
                </div>
                <div class="comment">{{$comment->comment}}</div>
            </div>
        @endforeach

        <form action="{{ route('comment') }}" method="POST">
            @csrf

            <input type="hidden" name="item_id" value="{{$item->id}}">

            <p class="comment_form_title">商品へのコメント</p>
            <textarea name="comment"></textarea>

            @error('comment')
            <div class="error">{{ $message }}</div>
            @enderror

            <button class="comment_button" type="submit">コメントを送信する</button>
        </form>


    </div>
    
</div>
@endsection
