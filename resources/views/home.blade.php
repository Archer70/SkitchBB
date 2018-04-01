@extends('layouts.app')

@section('content')
    <div id="cat_container">
    @foreach($categories as $category)
        <div id="cat_{{ $category->id }}" class="cat_header">
            <h3>{{ $category->title }}</h3>
                @if (!empty($category->description))
                    <span class="cat_desc">{{ $category->description }}</span>
                @endif
        </div>
        @if ($category->boards)
            @foreach ($category->boards as $board)
                <div id="board_{{ $board->id }}" class="cat_container">
                    @component('components.board_block', ['board' => $board])
                    @endcomponent
                </div>
                @endforeach
            @endif
        </div>
    @endforeach
    </div>
@endsection

@section('footer')
    test footer
@endsection