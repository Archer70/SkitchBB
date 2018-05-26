@extends('layouts.app')

@section('page_title', __('Unread Topics'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Unread Topics')]
        ]
    ]) @endcomponent

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">
                @lang('Unread Topics')
            </h5>
        </div>

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
    </div>
@endsection
