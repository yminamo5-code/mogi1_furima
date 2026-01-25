@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css')}}">
@endsection

@section('content')
<main>
    <div class="message">
        <p>登録していただいたメールアドレスに認証メールを送付しました。</p>
        <p>メール認証を完了してください。</p>
    </div>

    <a href="https://mailtrap.io/inboxes" target="_blank" rel="noopener">
        <button type="button" class="button">認証はこちらから</button>
    </a>
    <a href="" class="resend">認証メールを再送する</a>
</main>
@endsection