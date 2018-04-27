@extends('layouts.app')

@section('page_title', __('Create Board'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Create Board')]
        ]
    ]) @endcomponent
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">@lang('Create Board')</h4>
            <form method="post" action="{{ route('boards.store', ['category' => $category]) }}">
                <div class="form-group">
                    <input class="form-control" type="text" name="title" placeholder="@lang('Title')" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="description" placeholder="@lang('Description')">
                </div>
                @csrf
                <button type="submit" class="btn btn-primary">@lang('Create Board')</button>
            </form>
        </div>
    </div>
@endsection