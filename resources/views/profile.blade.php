@extends('layouts.app')

@section('components')
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection

@section('content')
    <profile :user="{{ json_encode($user) }}" asset-url="{{ asset('') }}"></profile>
@endsection