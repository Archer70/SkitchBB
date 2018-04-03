@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">@lang('Profile Settings')</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('users.update', ['user' => $user->id]) }}">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="@lang('Username')" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email_address">@lang('Remember which email address you use, because you\'ll need it to log in!')</label>
                    <input id="email_address" class="form-control" type="text" name="email" placeholder="@lang('Email Address')" value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <input
                            class="form-control"
                            type="text" name="title"
                            placeholder="@lang('Title')"
                            @if (!empty($user->title)) value="{{ $user->title }}" @endif
                    >
                </div>
                <div class="form-group">
                    <input
                            class="form-control"
                            type="text"
                            name="avatar_url"
                            placeholder="@lang('Avatar URL')"
                            @if (!empty($user->avatarUrl())) value="{{ $user->avatarUrl() }}" @endif
                    >
                </div>
                @csrf
                <button type="submit" class="btn btn-primary">@lang('Save')</button>
            </form>
        </div>
    </div>
@endsection