@extends('layouts.app')

@section('page_actions')
    @if($authUser->can('create', App\Category::class))
        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary btn-block">@lang('Create Category')</a>
    @endif
@endsection

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
        ]
    ]) @endcomponent
    @foreach($categories as $index => $category)
        <div class="card mb-4">
            <div class="card-header">
                @if($authUser->can('create', App\Category::class))
                    <form method="post" action="{{ route('categories.destroy', ['category' => $category]) }}">
                        @csrf
                        <div class="btn-group btn-group-sm float-right" role="group">
                            <a class="btn btn-success" href="{{ route('boards.create', ['category' => $category]) }}">
                                <i class="far fa-plus-square"></i> Board
                            </a>
                            <a class="btn btn-primary" href="{{ route('categories.edit', ['category' => $category]) }}">
                                <i class="far fa-edit"></i>
                            </a>
                            @if ($category->order > 1)
                                <a class="btn btn-primary" href="{{ route('categories.move-up', ['category' => $category]) }}">
                                    <i class="fas fa-angle-up"></i>
                                </a>
                            @endif
                            @if ($category->id != $lastCategoryId)
                                <a class="btn btn-primary" href="{{ route('categories.edit', ['category' => $category]) }}">
                                    <i class="fas fa-angle-down"></i>
                                </a>
                            @endif
                            <button type="submit" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </form>
                @endif
                {{ $category->title }}
                @if (!empty($category->description))
                    - <span class="text-muted">{{ $category->description }}</span>
                @endif
            </div>
            <div class="card-body">
                @if ($category->boards)
                    <div class="row">
                    @foreach ($category->boards as $board)
                            @component('components.board_block', ['board' => $board])
                            @endcomponent
                    @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach
@endsection

@section('footer')
    test footer
@endsection
