@if (!Auth::check())
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">@lang('Login')</h5>
            <form method="post" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
                <div clas="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('Remember Me')
                        </label>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary">
                        @lang('Login')
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif

@if (View::hasSection('page_actions'))
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">@lang('Page Actions')</h5>
            @yield('page_actions')
        </div>
    </div>
@endif

@if (Auth::check())
    @component('components.user_card', ['user' => Auth::user()]) @endcomponent
@endif

@yield('sidebar')
