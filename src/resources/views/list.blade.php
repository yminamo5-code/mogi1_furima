@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css')}}">
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
    <h1>商品の出品</h1>

    <form action="/change_profile" method="post">
        @csrf
            <p>商品画像</p>
            <!-- 画像アップロード-->
        <h2>商品の詳細</h2>
            <p>カテゴリー</p>
                <div class="categories">
                    @foreach($categories as $category)
                        <label class="category">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                            <span>{{ $category->category }}</span>
                        </label>
                    @endforeach
                </div>
            <p>商品の状態</p>
            <select name="condition">
                <option value="" disabled selected>選択してください　　　　　　　　▼</opution>
                <option value="良好">良好</opution>
                <option value="目立った傷や汚れなし">目立った傷や汚れなし</opution>
                <option value="やや傷や汚れあり">やや傷や汚れあり</opution>
                <option value="状態が悪い">状態が悪い</opution>
            </select>


        <h2>商品名と説明</h2>
            <p>商品名</p>
            <input type="text" name="itemname">
            <p>ブランド名</p>
            <input type="text" name="brand">
            <p>商品の説明</p>
            <textarea name="description"></textarea>
            <p>販売価格</p>
            <div class="price-wrapper">
                <input type="text" class="price" name="price" inputmode="numeric" pattern="[0-9]*">
            </div>
        <button class="button-submit" type="submit">出品する</button>
    </form>

</main>
@endsection