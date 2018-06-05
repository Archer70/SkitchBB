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
    <posts
        :topic="{{ json_encode($topic) }}"
        :posts="{{ json_encode($posts->items()) }}"
        :is_last_page={{ $posts->lastPage() == $posts->currentPage() ? 'true' : 'false' }}
    ></posts>
    {{ $posts->links() }}

    @can('create', \App\Post::class)
        <div class="card mb-4">
            <div class="card-body">
                <form id="new-post-form" method="post" action="{{ route('posts.store') }}">
                    <div class="form-group">
                    <textarea
                            id="post-body"
                            name="body"
                            class="form-control"
                            aria-describedby="post-body"
                            placeholder="@lang('New Post')"
                    ></textarea>
                    </div>
                    <input id="topic-id" type="hidden" name="topic_id" value="{{ $topic->id }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary">@lang('Reply')</button>
                </form>
            </div>
        </div>
    @endcan
@endsection

@section('js')
    <script src="{{ asset('js/topic_reply.js') }}"></script>
@endsection
