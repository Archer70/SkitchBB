@extends('layouts.app')

@section('page_title', __('Search Results'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Search Results')]
        ]
    ]) @endcomponent
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">@lang('Search Results')</h5>

            @if (count($posts) != 0)
                {{ $posts->links() }}
                <h4>@lang('Posts')</h4>
                <ul>
                    @foreach ($posts as $post)
                        <li>
                            <a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->topic->title }}</a>
                            <blockquote>{{ $post->body }}</blockquote>
                        </li>
                    @endforeach
                </ul>
                {{ $posts->links() }}
            @else
                <span>@lang('No results for that query.')</span>
            @endif
        </div>
    </div>
@endsection
