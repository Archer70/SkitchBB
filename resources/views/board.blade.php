@extends('layouts.app')

@section('page_title', $board->title)

@if (Auth::user())
    @section('page_actions')
        <a class="btn btn-outline-primary btn-block" href="{{ route('topics.create', ['board' => $board, 'slug' => $board->slug]) }}">
            @lang('New Topic')
        </a>
    @endsection
@endif

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => $board->title]
        ]
    ]) @endcomponent
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ $board->title }}

            </h5>
            @if($board->description)
                <h6 class="card-subtitle">{{ $board->description }}</h6>
            @endif
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($board->topics as $topic)
                <li class="list-group-item">
                    <a href="{{ $topic->link }}">{{ $topic->title }}</a>
                </li>
            @endforeach

            @if(!$board->topics)
                <li class="list-group-item text-secondary">@lang('No topics to show!')</li>
            @endif
        </ul>
    </div>
@endsection

@section('sidebar')
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Special Board Block</h5>
            <h6 class="card-subtitle mb-2 text-muted">subtitle</h6>
            <p class="card-text">Some quick example text to build on the sidebar.</p>
        </div>
    </div>
@endsection