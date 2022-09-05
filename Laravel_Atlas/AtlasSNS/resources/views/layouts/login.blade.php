<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">

    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="/top" sizes="16x16" type="image/png"/>
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <script src="https://kit.fontawesome.com/efaa61e14c.js" crossorigin="anonymous"></script>
    <!--fontawesome-->
</head>
<body>
    <header class = "header_color">
        <div class="header-menu">
            <h1 id="top"><a href="/top"><img class="top-menu" src="{{ asset('images/atlas.png') }}"></a></h1>
                <div id="menu">
                    <div class="hamburger"><p><?php $user = Auth::user(); ?>{{ $user->username }} さん</p></div>
                    <!-- トリガーの部分 -->
                    <div class="hamburger"><p class="accordion"></p></div>
                    <div class="hamburger">
                        @if($user->image == "/storage/images/icon1.png" )
                        <img class="icon" src="{{ $user->image }}">
                        @else
                        <img class="icon" src="{{ asset('/storage/images/' . $user->image) }}">
                        @endif
                    </div>
                    <!-- メニューの部分 -->
                </div>
        </div>
        <div class="accordion-menu">
            <nav class="sub_menu">
                <ul class="menu_text">
                    <li><a href="/top">ホーム</a></li>
                    <li><a class="accordion_profile" href="/edit">プロフィール編集</a></li>
                    <li><a href='/logout'>ログアウト</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p><?php $user = Auth::user(); ?>{{ $user->username }}さんの</p>
                    <div>
                    <p>フォロー数<span></span>{{ Auth::user()->follows()->get()->count() }}人</p>
                    </div>
                    <p class="btn"><a href="/followList">フォローリスト</a></p>
                    <div>
                    <p>フォロワー数<span></span>{{ Auth::user()->followers()->get()->count() }}人</p>
                    </div>
                <p class="btn"><a href="/followerList">フォロワーリスト</a></p>
            </div>
            <div class="search-bar">
            <p class="btn btn-search"><a href="/search">ユーザー検索</a></p>
            </div>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/script.js') }}" rel="stylesheet"></script>
</body>
</html>
