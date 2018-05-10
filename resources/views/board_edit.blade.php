@extends('layouts.app')

@section('page_title', __('Update Board'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Edit Board')]
        ]
    ]) @endcomponent
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">@lang('Edit Board')</h4>
            <form method="post" action="{{ route('boards.update', ['board' => $board]) }}">
                <div class="form-group">
                    <input class="form-control" type="text" name="title" placeholder="@lang('Title')" value="{{ $board->title }}" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="description" placeholder="@lang('Description')" value="{{ $board->description }}">
                </div>
                @csrf
                <button type="submit" class="btn btn-primary">@lang('Update Board')</button>
            </form>
        </div>
    </div>
@endsection
