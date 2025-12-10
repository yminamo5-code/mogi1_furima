@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css')}}">
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
    <div class="left">
        <div class="row1">
            <div>
                <img src="{{ asset('storage/images/' . $item->image) }}" alt="商品画像">
            </div>
            <div>
                <h1 class="itemname">{{$item->itemname}}</h1>
                <p class="price">&yen;{{number_format($item->price) }}</p>
            </div> 
        </div>

    <div class="row2">
        <h2 class=row2-title>支払いの方法</h2>
            <select name="method">
                <option value="" disabled selected>選択してください　　　　　　　　▼</opution>
                <option value="コンビニ払い">コンビニ払い</opution>
                <option value="カード払い<">カード払い</opution>
            </select>
    </div>
    <div class="row3">
        <div>
            <h2>配送先</h2>
        </div>
        
        <p class="postcode">〒{{$user->postcode}}</p>
        <p class="address">{{$user->address}}　{{$user->building}}</p>
    </div>



</main>
@endsection