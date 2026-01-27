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
        <div class="header_left">
            <img src="{{ asset('images/COACHTECHヘッダーロゴ.png')}}" alt="ロゴ">
        </div>

        @hasSection('search')
            <div class=header_center>
                @if (Route::currentRouteName() === 'index')
                    <form method="get"  action="{{route('index')}}">
                        <input type="hidden" name="tab" value="{{ request('tab', 'recommend') }}">
                        <input 
                            class="search"
                            type="text"
                            name="keyword"
                            placeholder="　なにをお探しですか？"
                            value="{{ session('keyword', request('keyword', '')) }}"
                        >
                    </form>
                @elseif (Route::currentRouteName() === 'mypage')
                    <form method="get"  action="{{route('mypage')}}">
                        <input type="hidden" name="page" value="{{ request('page', 'sell') }}">
                        <input 
                            class="search"
                            type="text"
                            name="keyword"
                            placeholder="　なにをお探しですか？"
                            value="{{ session('keyword', request('keyword', '')) }}"
                        >
                    </form>
                @else
                    <input 
                        class="search"
                        type="text"
                        name="keyword"
                        placeholder="　なにをお探しですか？"
                        value="{{ request('keyword', '') }}"
                    >
                @endif
            </div>
        @endif
        

        <div class="header_right">
            @hasSection('in_out')
                <!-- ログイン／ログアウト切り替え -->
                @if (Auth::check())
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="in_out">ログアウト</button>
                    </form>

                @else
                    <!-- 未ログイン時：ログインボタン -->
                    <a href="/login" class="in_out">ログイン</a>
                @endif
            @endif

            @hasSection('mypage')
                <a href="{{ route('mypage', ['keyword' => request('keyword')]) }}" class="mypage">マイページ</a>
            @endif

            @hasSection('sell')
                <a href="{{ route('sell') }}" class="sell">出品</a>
            @endif
        </div>   
    </header>
    
    <main class="content">
      @yield('content')
    </main>    
</body>
</html>