<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script>
        window.csrf_token = '{!! csrf_token() !!}';
    </script>

    <!-- Routes -->
    @routes()

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <global-menu
                homelink="{{ route('home') }}"
                title="{{ config('app.name') }}"
                :user="{{ json_encode(Auth::user()) }}"
                links=""
        ></global-menu>
        @yield('content')
    </div>
    <!-- Scripts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('components')
    <script>
        var app = new Vue({
            el: '#app',
        });
    </script>
</body>
</html>
