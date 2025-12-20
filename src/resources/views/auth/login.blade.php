@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css')}}">
@endsection

@section('content')
<main>
    <form action="{{route('login.post')}}" method="post">
        @csrf
        <div class="information">
            <h1>ログイン</h1>

            <div class=label>メールアドレス</div>
            <input type="text" name="email">
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror
            
            <div class=label>パスワード</div>
            <input type="password" name="password">
            @error('password')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button class="button-login" type="submit">ログインする</button>
    </form>
    <a class="register" href="/register">会員登録はこちら</a>


</main>
@endsection