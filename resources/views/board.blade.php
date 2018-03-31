@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ $board->title }}
                @if(Auth::user())
                    <a class="btn btn-primary float-right" href="{{ route('topics.create', ['slug' => $board->slug]) }}">
                        {{ __('New Topic') }}
                    </a>
                @endif
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
                <li class="list-group-item text-secondary">{{ __('No topics to show!') }}</li>
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