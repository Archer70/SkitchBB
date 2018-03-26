@extends('layouts.app')

@section('content')
    <div class="card m-4">
        <div class="card-body">
            <form method="post" action="{{ route('topics.store', ['slug' => $board->slug]) }}">
                <div class="form-group">
                    <input class="form-control" type="text" name="title" placeholder="{{ __('Title') }}">
                </div>
                <div class="form-group">
                    <textarea
                            id="post-body"
                            name="body"
                            class="form-control"
                            aria-describedby="post-body"
                            placeholder="{{ __('New Post') }}"
                    ></textarea>
                </div>
                <input type="hidden" name="board_id" :value="{{ $board->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">{{ __('Reply') }}</button>
            </form>
        </div>
    </div>
@endsection