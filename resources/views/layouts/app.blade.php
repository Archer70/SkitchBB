<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}{{ View::hasSection('page_title') ? ' - ' : '' }}@yield('page_title')</title>

    <script>
        window.csrf_token = '{!! csrf_token() !!}';
        window.asset_url = '{{ asset('') }}';
    </script>

    @if (env('RECAPTCHA_SITEKEY'))
        <!-- Docs say it has to be in <head> :| -->
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif

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
                        @if (isset($button['type']) && $button['type'] == 'form')
                            <li class="nav-item {{$button['current'] ? 'active border-bottom border-primary' : ''}}">
                                <form method="post" action="{{ $button['href'] }}" id="{{ $id }}">
                                    @csrf
                                    <a class="nav-link" onclick="document.getElementById('{{ $id }}').submit()" href="#">{{ $button['title'] }}</a>
                                </form>
                            </li>
                        @elseif (isset($button['type']) && $button['type'] == 'dropdown')
                            <li class="nav-item dropdown {{$button['current'] ? 'active border-bottom border-primary' : ''}}">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">{{ $button['title'] }}</a>
                                <div class="dropdown-menu">
                                    @foreach ($button['sub_buttons'] as $subButton)
                                        <a class="dropdown-item" href="{{ $subButton['href'] }}">{{ $subButton['title'] }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="nav-item {{$button['current'] ? 'active border-bottom border-primary' : ''}}">
                                <a class="nav-link" href="{{ $button['href'] }}">{{ $button['title'] }}</a>
                            </li>
                         @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <form id="search-form" method="post" action="{{ route('searches.create') }}" class="form-inline justify-content-end">
                <div class="input-group">
                    <input name="search" class="form-control" type="search" placeholder="@lang('Search')" aria-label="search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                @csrf
            </form>
        </div>

        <div class="container">
            <div class="row mt-4">
                <div class="col-md-9">@yield('content')</div>
                <div class="col-md-3">@component('components.sidebar') @endcomponent</div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    @routes
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
