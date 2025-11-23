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
        <input class="in_out">
        @endif
        @hasSection('mypage')
        <input class="mypage">
        @endif
        @hasSection('sell')
        <button class="sell">出品</button>
        @endif


    </header>
    <main class="content">
      @yield('content')
    </main>    
</body>
</html>