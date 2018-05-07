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
    @foreach($categories as $category)
        <div class="card mb-4">
            <div class="card-header">
                @can('create', App\Board::class)
                    <a class="btn btn-primary btn-sm float-right" href="{{ route('boards.create', ['category' => $category]) }}">
                        @lang('Create Board')
                    </a>
                @endcan
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
