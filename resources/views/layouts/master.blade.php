<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'GameMaster')
    </title>
    <meta charset='utf-8'>
    <!-- ****** faviconit.com favicons ****** -->
    <link rel="shortcut icon" href="{{ asset('/images/icons/favicon.ico') }}">
    <link rel="icon" sizes="16x16 32x32 64x64" href="{{ asset('/images/icons/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="196x196" href="{{ asset('/images/icons/favicon-192.png') }}">
    <link rel="icon" type="image/png" sizes="160x160" href="{{ asset('/images/icons/favicon-160.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/images/icons/favicon-96.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('/images/icons/favicon-64.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/images/icons/favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/icons/favicon-16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('/images/icons/favicon-57.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/images/icons/favicon-114.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/images/icons/favicon-72.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/images/icons/favicon-144.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/images/icons/favicon-60.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/images/icons/favicon-120.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/images/icons/favicon-76.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/images/icons/favicon-152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/images/icons/favicon-180.png') }}">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="{{ asset('/images/icons/favicon-144.png') }}">
    <meta name="msapplication-config" content="{{ asset('/images/icons/browserconfig.xml') }}">
    <!-- ****** faviconit.com favicons ****** -->

    <link href="/css/main.css" type='text/css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Cinzel+Decorative|Spectral+SC');
    </style>
    <script src="https://use.fontawesome.com/623053ff70.js"></script>
    @stack('head')

</head>
<body>
    <nav id="primary_nav_wrap">
        <ul class="left">
            <li class="game-master nav-home left @if(Route::currentRouteName() =='home') {{ 'current-menu-item' }} @endif">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/d20.png') }}" alt="GameMaster">
                    GameMaster
                </a>
            </li>
            <li class="left @if(substr(Route::currentRouteName(), 0, 9) =='character') {{ 'current-menu-item' }} @endif">
                <a href="#">Characters</a>
                <ul>
                    <li @if (!Auth::check()) class="nav-disabled" @endif>
                        <a href="@if (Auth::check()) {{ route('characterCreate') }} @else # @endif">New</a>
                        </li>
                    <li><a href="{{ route('characterIndex') }}">View</a></li>
                </ul>
            </li>
            <li class="left @if(substr(Route::currentRouteName(), 0, 4) =='race') {{ 'current-menu-item' }} @endif">
                <a href="#">Races</a>
                <ul>
                  <li @if(!Auth::check()) class="nav-disabled" @endif>
                    <a href="@if (Auth::check()) {{ route('raceCreate') }} @else # @endif">New</a></li>
                  <li><a href="{{ route('raceIndex') }}">View</a></li>
                </ul>
            </li>
            <li class="left @if(substr(Route::currentRouteName(), 0, 10) =='profession') {{ 'current-menu-item' }} @endif">
            <a href="#">Classes</a>
                <ul>
                    <li @if(!Auth::check()) class="nav-disabled" @endif>
                        <a href="@if (Auth::check()) {{ route('professionCreate') }} @else # @endif">New</a>
                    </li>
                    <li><a href="{{ route('professionIndex') }}">View</a></li>
                </ul>
            </li>
            <li class="left nav-disabled">
                <a href="#">Parties</a>
            </li>
        </ul>
        <ul class="right">
            @if (Auth::check())
                <li class="right">
                    <form method='POST' id='logout' action='/logout'>
                        {{ csrf_field() }}
                        <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                    </form>
                </li>
            @else
                <li class="right">
                    <a href="/login">Log In</a>
                </li>
                <li class="right">
                    <a href="/register">Sign Up</a>
                </li>
            @endif
        </ul>
    </nav>

    @if(session('alert'))
        <div class='alert'>
            <h5 class="no-top-margin">{{ session('alert') }}</h5>
        </div>
    @endif


    <header>
    </header>

    <section>
        @yield('content')
    </section>

    <footer>
        &copy; {{ date('Y') }}
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')

</body>
</html>