@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css')}}">
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
    <div class="left">
        <div class="row1">
            <img src="{{ asset('storage/images/' . $item->image) }}" alt="商品画像">
            <p class="itemname">{{$item->itemname}}</p>
            <p?>&yen;{{number_format($item->price) }}</p>
        </div>
    <div class="row2">
        <p class=row2-title>支払いの方法</p>
            <select name="method">
                <option value="" disabled selected>選択してください　　　　　　　　▼</opution>
                <option value="良好">良好</opution>
                <option value="目立った傷や汚れなし">目立った傷や汚れなし</opution>
                <option value="やや傷や汚れあり">やや傷や汚れあり</opution>
                <option value="状態が悪い">状態が悪い</opution>
            </select>
    </div>
    <div>



</main>
@endsection