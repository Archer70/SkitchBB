@extends('layouts.app')

@section('components')
    <script src="{{ asset('js/topic.js') }}"></script>
    <script src="{{ asset('js/post.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <h2 class="m-4">@lang('Post Feed')</h2>
        <post v-for="post in {{ json_encode($posts) }}" :post="post" :key="post.id"></post>
    </div>
@endsection