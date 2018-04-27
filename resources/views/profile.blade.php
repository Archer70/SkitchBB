@extends('layouts.app')

@section('page_title', $user->name)

@section('page_actions')
    <a class="btn btn-outline-primary btn-block" href="{{ route('users.edit', ['user' => $user]) }}">@lang('Modify Profile')</a>
@endsection

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Profile')]
        ]
    ]) @endcomponent
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    @component('components.user_card', ['user' => $user]) @endcomponent
                </div>
                <div class="col-9">
                    <h4>@lang('Bio')</h4>
                    {!! Markdown::render($user->bio) !!}
                </div>
            </div>
        </div>
    </div>
@endsection