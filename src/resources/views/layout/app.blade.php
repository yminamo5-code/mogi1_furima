<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
</head>
<body>
    <header>
        <img src="{{ asset('images/COACHTECHヘッダーロゴ.png')}}" alt="ロゴ">
        @hasSection('search')
        <input class="search" type="text" placeholder="　なにをお探しですか？">
        @endif

        @hasSection('in_out')
        <!-- ログイン／ログアウト切り替え -->
        @if (Auth::check())
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="in_out">ログアウト</button>
            </form>

        @else
            <!-- 未ログイン時：ログインボタン -->
            <a href="{{ route('login') }}" class="in_out">ログイン</a>
        @endif
        @endif

        @hasSection('mypage')
        <a href="{{ route('profile') }}" class="mypage">マイページ</a>
        @endif
        @hasSection('sell')
        <a href="{{ route('list') }}" class="list">出品</a>
        @endif


    </header>
    <main class="content">
      @yield('content')
    </main>    
</body>
</html>