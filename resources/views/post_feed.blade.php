@extends('layouts.app')

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Post Feed')]
        ]
    ]) @endcomponent
    @foreach($posts as $count => $post)
        @component('components.post', ['count' => $count+1, 'post' => $post, 'showTitle' => true]) @endcomponent
    @endforeach
@endsection