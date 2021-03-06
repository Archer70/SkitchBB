@extends('layouts.app')

@section('page_title', __('Create Category'))

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => __('Edit Category')]
        ]
    ]) @endcomponent
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">@lang('Create Category')</h4>
            <form method="post" action="{{ route('categories.update', ['category' => $category]) }}">
                <div class="form-group">
                    <input class="form-control" type="text" name="title" placeholder="@lang('Title')" value="{{ $category->title }}" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="description" placeholder="@lang('Description')" value="{{ $category->description }}">
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">@lang('Create Category')</button>
            </form>
        </div>
    </div>
@endsection
