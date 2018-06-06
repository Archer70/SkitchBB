@extends('layouts.app')

@section('page_title', $topic->title)

@section('page_actions')
    @auth
        @if ($topic->subscribed())
            <form action="{{ route('topics.unsubscribe', ['topic' => $topic]) }}" method="post">
                @csrf
                <input type="submit" class="btn btn-outline-primary btn-block mb-2" value="@lang('Unsubscribe')">
            </form>
        @else
            <form action="{{ route('topics.subscribe', ['topic' => $topic]) }}" method="post">
                @csrf
                <input type="submit" class="btn btn-outline-primary btn-block mb-2" value="@lang('Subscribe')">
            </form>
        @endif
    @endauth
    @can('update', $topic)
        <a class="btn btn-outline-primary btn-block mb-2" href="{{ route('topics.edit', ['topic' => $topic]) }}">@lang('Edit Topic')</a>
    @endcan
    @can('delete', $topic)
        <form action="{{ route('topics.destroy', ['topic' => $topic]) }}" method="post">
            @csrf
            <input type="submit" class="btn btn-outline-primary btn-block" value="@lang('Delete Topic')">
        </form>
    @endcan
@endsection

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['href' => route('boards.show', ['board' => $topic->board, 'slug' => $topic->board->slug]), 'title' => $topic->board->title],
            ['title' => $topic->title]
        ]
    ]) @endcomponent

    {{ $posts->links() }}
    <topic
        :topic="{{ json_encode($topic) }}"
        :posts="{{ json_encode($posts->items()) }}"
        :is_last_page={{ $posts->lastPage() == $posts->currentPage() ? 'true' : 'false' }}
    ></topic>
    {{ $posts->links() }}

    @can('create', \App\Post::class)
        <topic-reply :topic="{{ json_encode($topic) }}"></topic-reply>
    @endcan
@endsection

@section('js')
    <script src="{{ asset('js/topic_reply.js') }}"></script>
@endsection
