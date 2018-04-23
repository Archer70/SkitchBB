@if (View::hasSection('page_actions'))
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">@lang('Page Actions')</h5>
            @yield('page_actions')
        </div>
    </div>
@endif

@if (Auth::user())
    @component('components.user_card', ['user' => Auth::user()]) @endcomponent
@endif

@yield('sidebar')