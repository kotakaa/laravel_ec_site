<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @if (Auth::guard('admin')->check())
                        <a class="navbar-brand" href="{{ url('/admin/products') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    @else
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('user.products.top') }}">商品一覧</a></li>
                            <li><a href="{{ route('login') }}">ログイン</a></li>
                            <li><a href="{{ route('register') }}">新規登録</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    @if (Auth::guard('user')->check())
                                        {{ Auth::user()->name }}
                                    @else
                                        {{ Auth::user()->email }}
                                    @endif
                                    <span class="caret"></span>
                                </a> 

                                <ul class="dropdown-menu">
                                    @if (Auth::guard('user')->check())
                                        <li><a href="{{ route('user.home') }}">マイページ</a></li>
                                        <li><a href="{{ route('user.products.top') }}">商品一覧</a></li>
                                        <li><a href="{{ route('user.cart_items.index') }}">カート</a></li>
                                        <li><a href="{{ route('user.addresses.index') }}">配送先一覧/登録</a></li>
                                        <li><a href="{{ route('user.orders.index') }}">注文履歴一覧</a></li>
                                    @else
                                        <li><a href="{{ route('admin.products.index') }}">商品一覧</a></li>
                                        <li><a href="{{ route('admin.products.create') }}">商品の新規登録</a></li>
                                        <li><a href="{{ route('admin.users.index') }}">会員一覧</a></li>
                                        <li><a href="{{ route('admin.orders.index') }}">注文履歴一覧</a></li>
                                        <li><a href="{{ route('admin.genres.index') }}">ジャンル一覧</a></li>
                                    @endif
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                ログアウト
                                            </a>
                                            
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
