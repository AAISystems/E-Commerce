<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="{{ asset('img/lavandaResize.png') }}" type="image/png">
    <script defer src="{{ asset('js/cartQuantity.js') }}"></script>
    @yield('script')
    <!-- Bootstrap CSS v5.2.1 -->
    @vite(['resources/js/app.js', 'resources/css/app.scss', 'resources/css/app.css'])



</head>

<body>
    <header>
        @yield('navbar')
    </header>
    <main>
        @yield('content')
    </main>
    @yield('footer')

</body>

</html>
