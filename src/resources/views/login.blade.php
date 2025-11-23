@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css')}}">
@endsection

@section('content')
<main>
    <form action="/" method="post">
        @csrf
        <div class="information">
            <h1>ログイン</h1>

            <div class=label>メールアドレス</div>
            <input type="text" name="email">
            <div class=label>パスワード</div>
            <input type="password" name="password">
        </div>

        <button class="button-login" type="submit">ログインする</button>
    </form>
    <a class="register" href="/register">会員登録はこちら</a>


</main>
@endsection