<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Character Generator')
    </title>

    <meta charset='utf-8'>
    <link href="/css/main.css" type='text/css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative" rel="stylesheet">

    @stack('head')

</head>
<body>

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