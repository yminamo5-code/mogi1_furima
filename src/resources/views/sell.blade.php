@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css')}}">
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
    <h1>商品の出品</h1>

    <form action="{{route('sell.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div>商品画像</div>
        <div class="picture_input">
            <input type="file" name="image" accept="image/*">
            <div>画像を選択する</div>
        </div>
        @error('image')
        <div class="error">{{ $message }}</div>
        @enderror
            

        <h2>商品の詳細</h2>
            <div>カテゴリー</div>
                <div class="categories">
                    @foreach($categories as $category)
                        <label class="category">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                            <span>{{ $category->category }}</span>
                        </label>
                    @endforeach
                </div>
            @error('categories')
            <div class="error">{{ $message }}</div>
            @enderror

            <div>商品の状態</div>
            <select name="condition">
                <option value="" disabled selected>選択してください　　　　　　　　▼</opution>
                <option value="良好">良好</opution>
                <option value="目立った傷や汚れなし">目立った傷や汚れなし</opution>
                <option value="やや傷や汚れあり">やや傷や汚れあり</opution>
                <option value="状態が悪い">状態が悪い</opution>
            </select>
            @error('condition')
            <div class="error">{{ $message }}</div>
            @enderror

        <h2>商品名と説明</h2>
            <div>商品名</div>
            <input type="text" name="itemname">
            @error('itemname')
            <div class="error">{{ $message }}</div>
            @enderror

            <div>ブランド名</div>
            <input type="text" name="brand">

            <div>商品の説明</div>
            <textarea name="description"></textarea>
            @error('description')
            <div class="error">{{ $message }}</div>
            @enderror

            <div>販売価格</div>
            <div class="price-wrapper">
                <input type="text" class="price" name="price" inputmode="numeric" pattern="[0-9]*">
            </div>
            @error('price')
            <div class="error">{{ $message }}</div>
            @enderror

        <button class="button-submit" type="submit">出品する</button>
    </form>
</main>
@endsection