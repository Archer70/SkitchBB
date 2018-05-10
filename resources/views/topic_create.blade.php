@extends('layouts.app')

@section('page_title', __('Create Topic'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['href' => route('boards.show', ['board' => $board, 'slug' => $board->slug]), 'title' => $board->title],
            ['title' => __('Create Topic')]
        ]
    ]) @endcomponent
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('topics.store', ['board' => $board]) }}">
                <div class="form-group">
                    <input class="form-control" type="text" name="title" placeholder="@lang('Title')">
                </div>
                <div class="form-group">
                    <textarea
                            id="post-body"
                            name="body"
                            class="form-control"
                            aria-describedby="post-body"
                            placeholder="@lang('New Post')"
                    ></textarea>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">@lang('Create Topic')</button>
            </form>
        </div>
    </div>
@endsection
