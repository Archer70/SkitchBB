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
        <div class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}"  style="max-height: 24px;"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @foreach (\App\Utils\Menu::buttons() as $id => $button)
                        <li class="nav-item {{$button['current'] ? 'active border-bottom border-primary' : ''}}">
                            @if (isset($button['type']) && $button['type'] == 'form')
                                <form method="post" action="{{ $button['href'] }}" id="{{ $id }}">
                                    <a class="nav-link" onclick="document.getElementById('{{ $id }}').submit()" href="#">{{ $button['title'] }}</a>
                                </form>
                            @else
                                <a class="nav-link" href="{{ $button['href'] }}">{{ $button['title'] }}</a>
                            @endif
                        </li>
                    @endforeach
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
                <div class="col-md-8">@yield('content')</div>
                <div class="col-md-4">@component('components.sidebar') @endcomponent</div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
