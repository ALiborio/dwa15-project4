<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'GameMaster')
    </title>
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

    <meta charset='utf-8'>
    <link href="/css/main.css" type='text/css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative|Spectral+SC" rel="stylesheet">
    <script src="https://use.fontawesome.com/623053ff70.js"></script>
    @stack('head')

</head>
<body>
    <nav>
        <span class="nav-home @if(Route::currentRouteName() =='index') {{ 'nav-selected' }} @endif game-master">
            <a href="{{ route('home') }}"><img src="{{ asset('images/d20.png') }}"> GameMaster</a>
        </span>
        <span class="nav-link @if(Route::currentRouteName() =='createCharacter') {{ 'nav-selected' }} @endif">
            <a href="{{ route('createCharacter') }}">New</a>
        </span>
        <span class="nav-link @if(Route::currentRouteName() =='showCharacter' or Route::currentRouteName() == 'editCharacter') {{ 'nav-selected' }} @endif">
            <a href="/character/all">Characters</a>
        </span>

        <!-- Right Aligned Nav Bar Items -->
        <span class="nav-link nav-disabled right">
            Log In
        </span>
        <span class="nav-link nav-disabled right">
            Sign Up
        </span>
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