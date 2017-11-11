<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Character Generator')
    </title>

    <meta charset='utf-8'>
    <link href="/css/main.css" type='text/css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative|Spectral+SC" rel="stylesheet">
    <script src="https://use.fontawesome.com/623053ff70.js"></script>
    @stack('head')

</head>
<body>
    <nav>
        <span class="nav-home @if(Route::currentRouteName() =='index') {{ 'nav-selected' }} @endif game-master">
            <a href="{{ route('index') }}"><img src="{{ asset('images/d20.png') }}"> GameMaster</a>
        </span>
        <span class="nav-link @if(Route::currentRouteName() =='createCharacter') {{ 'nav-selected' }} @endif">
            <a href="/character">New</a>
        </span>
        <span class="nav-link">
            <a href="">Characters</a>
        </span>
        <span class="nav-link nav-disabled right">
            Log In
        </span>
        <span class="nav-link nav-disabled right">
            Sign Up
        </span>
    </nav>
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