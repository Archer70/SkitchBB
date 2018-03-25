@extends('layouts.app')

@section('components')
    <script src="{{ asset('js/topic.js') }}"></script>
    <script src="{{ asset('js/post.js') }}"></script>
@endsection

@section('content')
    <topic v-bind:topic="{{ json_encode($topic) }}"></topic>
@endsection