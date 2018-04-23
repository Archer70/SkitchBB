@extends('layouts.app')

@section('page_actions')
    <a class="btn btn-outline-primary btn-block" href="{{ route('users.edit', ['name' => $user->name]) }}">@lang('Modify Profile')</a>
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
                    <h4>Bio</h4>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection