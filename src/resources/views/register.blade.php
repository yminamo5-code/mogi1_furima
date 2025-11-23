@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('content')
<main>
    <form action="/profile" method="post">
        @csrf
        <div class="information">
            <h1>会員登録</h1>

            <div class=label>ユーザー名</div>
            <input type="text" name="username">
            <div class=label>メールアドレス</div>
            <input type="text" name="email">
            <div class=label>パスワード</div>
            <input type="password" name="password">
            <div class=label>確認用パスワード</div>
            <input type="password" name="password_confirmation">
        </div>

        <button class="button-admin" type="submit">登録する</button>
    </form>
    <a class="login" href="/login">ログインはこちら</a>


</main>
@endsection