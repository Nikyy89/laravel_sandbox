<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Anime Fan Page</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v15.0" nonce="DY5K8qwk">
    </script>
    @stack('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>
    <main>
        @include('sidebar_menu')
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>
</body>
</html>
