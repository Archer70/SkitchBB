@extends('layouts.app')

@section('content')
    <h2>{{ $topic->title }}</h2>
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