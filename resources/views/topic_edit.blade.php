@extends('layouts.app')

@section('page_title', __('Edit Topic'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['href' => route('boards.show', ['board' => $board, 'slug' => $board->slug]), 'title' => $board->title],
            ['title' => __('Edit Topic')]
        ]
    ]) @endcomponent
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('topics.update', ['topic' => $topic]) }}">
                <div class="form-group">
                    <input class="form-control" type="text" name="title" value="{{ $topic->title }}" placeholder="@lang('Title')">
                </div>
                <div class="form-group">
                    <textarea
                            id="post-body"
                            name="body"
                            class="form-control"
                            aria-describedby="post-body"
                            placeholder="@lang('Post Body')"
                    >{{ $topic->firstPost->body }}</textarea>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">@lang('Edit Topic')</button>
            </form>
        </div>
    </div>
@endsection
