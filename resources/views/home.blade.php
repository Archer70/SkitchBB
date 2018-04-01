@extends('layouts.app')

@section('content')
    <div id="cat_container">
    @foreach($categories as $category)
        <div class="cat_header">
            <h3>{{ $category->title }}</h3>
                @if (!empty($category->description))
                    <span class="cat_desc">{{ $category->description }}</span>
                @endif
        </div>
        <div class="cat_container">
            @if ($category->boards)
                @foreach ($category->boards as $board)
                    @component('components.board_block', ['board' => $board])
                    @endcomponent
                @endforeach
            @endif
        </div>
    @endforeach
    </div>
@endsection
