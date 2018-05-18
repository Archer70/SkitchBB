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
        <post :post="{{ json_encode($post) }}" :topic="{{ json_encode($post->topic) }}" :show_title="true"></post>
    @endforeach
    {{ $posts->links() }}

@endsection
