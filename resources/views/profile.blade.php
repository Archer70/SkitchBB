@extends('layouts.app')

@section('page_title', $user->name)

@section('page_actions')
    @can('update', $user)
        <a class="btn btn-outline-primary btn-block mb-2" href="{{ route('users.edit', ['user' => $user]) }}">@lang('Modify Profile')</a>
    @endcan

    @can('delete', $user)
        <form method="post" action="{{ route('users.destroy', ['user' => $user]) }}">
            <input type="submit" class="btn btn-outline-danger btn-block mb-2" value="@lang('Delete Profile')">
            @csrf
        </form>
    @endcan

    @can('ban', $user)
        @if (!$user->banned)
            <form method="post" action="{{ route('users.ban', ['user' => $user]) }}">
                <input type="submit" class="btn btn-outline-danger btn-block" value="@lang('Ban User')">
                @csrf
            </form>
        @else
            <form method="post" action="{{ route('users.unban', ['user' => $user]) }}">
                <input type="submit" class="btn btn-outline-danger btn-block" value="@lang('Unban User')">
                @csrf
            </form>
        @endif
    @endcan
@endsection

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Profile')]
        ]
    ]) @endcomponent
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    @component('components.user_card', ['user' => $user]) @endcomponent
                </div>
                <div class="col-sm-9">
                    @if ($user->bio)
                        <h4>@lang('Bio')</h4>
                        {!! Markdown::render($user->bio) !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
