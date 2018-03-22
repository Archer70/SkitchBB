@extends('layouts.app')

@section('components')
    <script src="{{ asset('js/board.js') }}"></script>
@endsection

@section('content')
    <div class="container-fluid">
    @foreach($categories as $category)
        <div class="card my-4">
            <div class="card-header">
                {{ $category->title }}
                @if (!empty($category->description))
                    - <span class="text-secondary">{{ $category->description }}</span>
                @endif
            </div>
            <div class="card-body">
                @if ($category->boards)
                    <div class="row">
                    @foreach ($category->boards as $board)
                            <board-block
                                    link="{{ route('board.show', ['slug' => $board->slug]) }}"
                                    title="{{ $board->title }}"
                                    description="{{ $board->description }}"
                                    :last_post="{{ json_encode($board->lastPost()) }}"
                                    :last_topic="{{ json_encode($board->lastPost() ? $board->lastPost()->topic : null) }}"
                            ></board-block>
                    @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    </div>
@endsection
