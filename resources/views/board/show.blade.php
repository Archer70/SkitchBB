@extends('layouts.app')

@section('components')
    <script src="{{ asset('js/board.js') }}"></script>
@endsection

@section('content')
    <board-listing
            :board="{{ json_encode($board) }}"
            :user="{{ json_encode(Auth::user()) }}"
    ></board-listing>
@endsection