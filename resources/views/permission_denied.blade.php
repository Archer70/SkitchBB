@extends('layouts.app')

@section('page_title', __('Create Topic'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Permission Denied')]
        ]
    ]) @endcomponent
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">@lang('Permission Denied')</h4>
            <span class="card-subtitle">@lang('Sorry, but you don\'t seem to have permission to access this.')</span>
        </div>
    </div>
@endsection