@extends('layouts.app')

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

            @if (count($users) != 0)
                <h4>@lang('Users')</h4>
                <ul>
                    @foreach ($users as $user)
                        <li><a href="{{ route('users.show', ['user' => $user]) }}">{{ $user->name }}</a></li>
                    @endforeach
                </ul>
            @endif

            @if (count($topics) != 0)
                <h4>@lang('Topics')</h4>
                <ul>
                    @foreach ($topics as $topic)
                        <li><a href="{{ route('topics.show', ['topic' => $topic]) }}">{{ $topic->title }}</a></li>
                    @endforeach
                </ul>
            @endif

            @if (count($posts) != 0)
                <h4>@lang('Posts')</h4>
                <ul>
                    @foreach ($posts as $post)
                        <li>
                            <a href="{{ route('topics.show', ['topic' => $post->topic]) }}">{{ $post->topic->title }}</a>
                            <blockquote>{{ $post->body }}</blockquote>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection