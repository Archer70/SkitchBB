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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-comment"></i>
                {{ __('SkitchBB') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('feed') }}">{{ __('Post Feed') }}</a>
                    </li>
                    @if (Auth::user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.show', ['name' => Auth::user()->name]) }}">{{ __('Profile') }}</a>
                        </li>
                        <li class="nav-item">
                            <form id="logout" method="post" action="{{ route('logout') }}">
                                <a class="nav-link" onclick="document.getElementById('logout').submit()" href="#">{{ __('Logout') }}</a>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
            <form class="form-inline justify-content-end">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="{{ __('Search') }}" aria-label="{{ __('Search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="container">
            <div class="row mt-4">
                <div class="col">@yield('content')</div>
                <div class="col-4">@component('components.sidebar') @endcomponent</div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
