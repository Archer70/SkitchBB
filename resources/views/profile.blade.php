@extends('layouts.app')

@section('content')
    <div class="card">
        <img id="profile-header" class="card-img-top" src="{{ asset('images/default-profile-header.png') }}" alt="">
        <div class="card-body">
            @component('components.user_card', ['user' => $user]) @endcomponent
            <h4>
                <a class="btn btn-outline-primary float-right" href="{{ route('users.edit', ['name' => $user->name]) }}">Modify Profile</a>
                Bio
            </h4>
            <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
            </p>
        </div>
    </div>
@endsection