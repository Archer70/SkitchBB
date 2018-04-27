@extends('layouts.app')

@section('page_title', __('Edit Profile'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Edit Profile')]
        ]
    ]) @endcomponent
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
                    <label for="username">@lang('Username')</label>
                    <input
                            id="username"
                            class="form-control"
                            type="text" name="name"
                            placeholder="@lang('Username')"
                            value="{{ $user->name }}"
                            required
                    >
                </div>
                <div class="form-group">
                    <label for="email_address">@lang('Email Address')</label>
                    <input
                            id="email_address"
                            class="form-control"
                            type="text"
                            name="email"
                            placeholder="@lang('Email Address')"
                            value="{{ $user->email }}"
                            required
                    >
                    <small class="form-text text-muted">@lang('Remember which email address you use; you\'ll need it to log in!')</small>
                </div>
                <div class="form-group">
                    <label for="title">@lang('Title')</label>
                    <input
                            id="title"
                            class="form-control"
                            type="text" name="title"
                            placeholder="@lang('Title')"
                            @if (!empty($user->title)) value="{{ $user->title }}" @endif
                    >
                </div>
                <div class="form-group">
                    <label for="avatar-url">@lang('Avatar URL')</label>
                    <input
                            id="avatar-url"
                            class="form-control"
                            type="text"
                            name="avatar_url"
                            placeholder="@lang('Avatar URL')"
                            @if (!empty($user->avatarUrl()) && strpos($user->avatarUrl(), 'data:image') === false) value="{{ $user->avatarUrl() }}" @endif
                    >
                </div>
                <div class="form-group">
                    <label for="bio">@lang('Bio')</label>
                    <textarea
                            id="bio"
                            class="form-control"
                            name="bio"
                            placeholder="@lang('Bio')"
                            rows="5"
                            @if (!empty($user->bio)) value="{{ $user->bio }}" @endif
                    ></textarea>
                </div>
                @csrf
                <button type="submit" class="btn btn-primary">@lang('Save')</button>
            </form>
        </div>
    </div>
@endsection