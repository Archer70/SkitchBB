@extends('layouts.app')

@section('page_title', __('Post Feed'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Post Feed')]
        ]
    ]) @endcomponent

    {{ $posts->links() }}
    @foreach($posts as $count => $post)
        @component('components.post', ['count' => $count+1, 'post' => $post, 'showTitle' => true]) @endcomponent
    @endforeach
    {{ $posts->links() }}

@endsection
