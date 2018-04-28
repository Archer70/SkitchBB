@extends('layouts.app')

@section('page_title', __('Create Topic'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Banned')]
        ]
    ]) @endcomponent
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">@lang('You\'ve been banned.')</h4>
            <span class="card-subtitle">@lang('Sorry, the forum leadership has revoked your access to this forum.')</span>
        </div>
    </div>
@endsection