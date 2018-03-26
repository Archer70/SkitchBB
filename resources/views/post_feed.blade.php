@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="m-4">{{ __('Post Feed') }}</h2>
        @foreach($posts as $count => $post)
            @component('components.post', ['count' => $count+1, 'post' => $post, 'showTitle' => true]) @endcomponent
        @endforeach
    </div>
@endsection