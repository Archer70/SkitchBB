@extends('layouts.app')

@section('page_actions')
    <form action="{{ route('topics.destroy', ['topic' => $topic, 'slug' => $topic->slug]) }}" method="post">
        @csrf
        <input type="submit" class="btn btn-outline-primary btn-block" value="@lang('Delete Topic')">
    </form>
@endsection

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['href' => route('boards.show', ['board' => $topic->board, 'slug' => $topic->board->slug]), 'title' => $topic->board->title],
            ['title' => $topic->title]
        ]
    ]) @endcomponent

    @foreach($topic->posts as $count => $post)
        @component('components.post', ['count' => $count+1, 'post' => $post, 'showTitle' => false]) @endcomponent
    @endforeach

    <div class="card mb-4">
        <div class="card-body">
            <form method="post" action="{{ route('posts.store') }}">
                <div class="form-group">
                <textarea
                        id="post-body"
                        name="body"
                        class="form-control"
                        aria-describedby="post-body"
                        placeholder="@lang('New Post')"
                ></textarea>
                </div>
                <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">@lang('Reply')</button>
            </form>
        </div>
    </div>
@endsection