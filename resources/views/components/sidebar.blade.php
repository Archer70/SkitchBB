@guest
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">@lang('Login')</h5>
            <form method="post" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" placeholder="Email Address">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password">
                </div>
                <div clas="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('Remember Me')
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
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
@endguest

@hassection('page_actions')
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">@lang('Page Actions')</h5>
            @yield('page_actions')
        </div>
    </div>
@endif

@auth
    <user-card :user="{{ json_encode(Auth::user()) }}" :responsive="false"></user-card>
@endauth

@yield('sidebar')
