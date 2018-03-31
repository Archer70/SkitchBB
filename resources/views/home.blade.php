@extends('layouts.app')

@section('content')
    @foreach($categories as $category)
        <div class="card mb-4">
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