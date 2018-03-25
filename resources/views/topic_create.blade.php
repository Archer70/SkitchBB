@extends('layouts.app')

@section('components')
    <script src="{{ asset('js/topic.js') }}"></script>
@endsection

@section('content')
    <topic-form :board="{{ json_encode($board) }}"></topic-form>
@endsection