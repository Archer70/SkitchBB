@extends('layouts.app')

@section('page_title', __('Edit Post'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['href' => route('boards.show', ['board' => $post->board, 'slug' => $post->board->slug]), 'title' => $post->board->title],
            ['href' => route('topics.show', ['topic' => $post->topic, 'slug' => $post->topic->slug]), 'title' => $post->topic->title],
            ['title' => __('Edit Post')]
        ]
    ]) @endcomponent
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">@lang('Edit Post')</h4>
            <form method="post" action="{{ route('posts.update', ['post' => $post]) }}">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="body">{{ $post->body }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">@lang('Update Post')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
