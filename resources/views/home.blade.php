@extends('layouts.app')

@section('page_actions')
    @can('create', App\Category::class)
        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary btn-block">@lang('Create Category')</a>
    @endcan
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
                @can('create', App\Category::class)
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
                            @if ($category->id != $lastCategory->id)
                                <a class="btn btn-primary" href="{{ route('categories.move-down', ['category' => $category]) }}">
                                    <i class="fas fa-angle-down"></i>
                                </a>
                            @endif
                            <button type="submit" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </form>
                @endcan
                {{ $category->title }}
                @if (!empty($category->description))
                    - <span class="text-muted">{{ $category->description }}</span>
                @endif
            </div>
            <div class="card-body">
                @if ($category->boards)
                    @foreach ($category->boards as $board)
                        <div class="row">
                            @component('components.board_block', ['board' => $board, 'isLast' => $board->id == $category->boards->last()->id]) @endcomponent
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">@lang('Users Online')</h5>
            <h6 class="card-subtitle text-muted mb-2">@lang('Users active in the last 10 minutes')</h6>
            <p>{!! !empty($usersOnlineLinks) ? implode(', ', $usersOnlineLinks) : __('No users currently online.') !!}</p>
        </div>
    </div>
@endsection
