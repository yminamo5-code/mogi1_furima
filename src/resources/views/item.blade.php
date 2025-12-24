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
                    <p>{{ $likeCount }}</p>
            </div>

            <div class="comment_logo">
                <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="ふきだしロゴ">
                <p>{{ $commentCount }}</p>
            </div>
        </div>

        <form action="{{ route('item.purchase',['id'=>$item->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <button type="submit" class="purchase">購入手続きへ</button>
        </form>

        <h2>商品説明</h2>
        <p>{{ $item->description }}</p>

        <h2>商品の情報</h2>
        <div class="category">
            <div>カテゴリー</div>
            <div>あ</div>                                 <!--カテゴリー-->
        </div>
        <div class="condition">
            <div>商品の状態</div>
            <div>{{ $item->condition }}</div>
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

            <button type="submit">コメントを送信する</button>
        </form>


    </div>
    
</div>
@endsection