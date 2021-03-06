@extends('layouts.app')

@section('page_title', $board->title)

@if (Auth::check())
    @section('page_actions')
        @can('create', App\Topic::class)
            <a class="btn btn-outline-primary btn-block" href="{{ route('topics.create', ['board' => $board]) }}">
                @lang('New Topic')
            </a>
        @endcan
    @endsection
@endif

@section('content')
    @component('components.linktree', [
        'items' => [
            ['href' => route('home'), 'title' => __('Home')],
            ['title' => $board->title]
        ]
    ]) @endcomponent

    {{ $topics->links() }}
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">
                <form method="post" action="{{ route('boards.destroy', ['board' => $board]) }}">
                    @csrf
                    <div class="btn-group btn-group-sm justify-content-end float-right">
                        @can('update', $board)
                            <a class="btn btn-secondary" href="{{ route('boards.edit', ['board' => $board]) }}">
                                <i class="far fa-edit"></i>
                            </a>
                        @endcan
                        @can('delete', $board)
                            <button type="submit" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        @endcan
                    </div>
                </form>
                {{ $board->title }}
            </h5>
            @if($board->description)
                <h6 class="card-subtitle">{{ $board->description }}</h6>
            @endif
        </div>

        <ul class="list-group list-group-flush">
            @foreach ($topics as $topic)
                <li class="list-group-item">
                    <a href="{{ $topic->link }}">{{ $topic->title }}</a>
                </li>
            @endforeach

            @if(!$board->topics)
                <li class="list-group-item text-secondary">@lang('No topics to show!')</li>
            @endif
        </ul>
    </div>
    {{ $topics->links() }}
@endsection
