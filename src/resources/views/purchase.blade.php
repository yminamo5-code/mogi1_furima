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
        <form id="payform" action="{{ route('payment.store') }}" method="post">
        @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">

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
                <h2 class=row2-title>支払い方法</h2>
                <select name="paymethod" id="paymethod">
                    <option value="" disabled selected>選択してください　　　　　　　　▼</option>
                    <option value="コンビニ払い">コンビニ払い</option>
                    <option value="カード払い">カード払い</option>
                </select>
                @error('paymethod')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="row3">
                <div class="row3-1">
                    <h2>配送先</h2>
                    <a href="{{route('address.edit', ['id' => $item->id])}}">変更する</a>
                </div>
                <div class="postcode">〒{{$user->postcode}}</div>
                <input type="hidden" name="postcode" value="{{ $user->postcode }}">
                <div name="address" class="address">{{$user->address}}　{{$user->building}}</div>
                <input type="hidden" name="address" value="{{ $user->address }}">
                @if ($errors->has('postcode') || $errors->has('address'))
                    <div class="error">配送先を選択してください</div>
                @endif
            </div>
        </form>
    </div>

    <div class="right">
        <div class="price">
            <div class="cell">商品代金</div>
            <div class="cell">&yen;{{number_format($item->price) }}</div>
            <div class="cell">支払い方法</div>
            <div class="cell" id="paymethod-display">コンビニ払い</div>
        </div>
        <button class="purchase" type="submit" form="payform">購入する</button>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded',function(){
        const select = document.getElementById('paymethod');
        const display = document.getElementById('paymethod-display');

        select.addEventListener('change',function(){
            display.textContent = select.value;
        });
    });
</script>
@endsection