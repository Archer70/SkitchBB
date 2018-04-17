@extends('layouts.app')

@section('content')
    <h2>@lang('Post Feed')</h2>
    @foreach($posts as $count => $post)
        @component('components.post', ['count' => $count+1, 'post' => $post, 'showTitle' => true]) @endcomponent
    @endforeach
@endsection