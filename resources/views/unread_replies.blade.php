@extends('layouts.app')

@section('page_title', __('Unread Replies'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Unread Replies')]
        ]
    ]) @endcomponent

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">
                @lang('Unread Replies')
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">@lang('Topics you\'re subscibed to that have new posts.')</h6>
        </div>

        {{ $topics->links() }}
        <ul class="list-group list-group-flush">
            @foreach ($topics as $topic)
                <li class="list-group-item">
                    <a href="{{ route('topics.show', ['topic' => $topic->id, 'slug' => $topic->slug]) }}">{{ $topic->title }}</a>
                </li>
            @endforeach

            @if(count($topics) == 0)
                <li class="list-group-item text-secondary">@lang('No topics to show!')</li>
            @endif
        </ul>
        {{ $topics->links() }}
    </div>
@endsection
