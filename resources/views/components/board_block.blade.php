<div class="col mb-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                @can('create', App\Board::class)
                    <form method="post" action="{{ route('boards.destroy', ['board' => $board]) }}">
                        @csrf
                        <div class="btn-group btn-group-sm float-right" role="group">
                            <a class="btn btn-primary" href="{{ route('boards.edit', ['board' => $board]) }}">
                                <i class="far fa-edit"></i>
                            </a>
                            @if ($board->order > 1)
                                <a class="btn btn-primary" href="{{ route('boards.move-up', ['board' => $board]) }}">
                                    <i class="fas fa-angle-up"></i>
                                </a>
                            @endif
                            @if (!$isLast)
                                <a class="btn btn-primary" href="{{ route('boards.move-down', ['board' => $board]) }}">
                                    <i class="fas fa-angle-down"></i>
                                </a>
                            @endif
                            <button type="submit" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </form>
                @endcan
                <a href="{{ route('boards.show', ['board' => $board, 'slug' => $board->slug]) }}">{{ $board->title }}</a>
            </h5>
            <h6 class="card-subtitle">{{ $board->description }}</h6>
        </div>
        @if ($board->lastPost())
            <div class="card-footer">
                <div class="float-right justify-content-end">
                    <span>{{ $board->lastPost()->timeSincePosted }}</span>
                </div>
                <span>
                    @lang('Last post in')
                    <a href="{{ route('posts.show', ['post' => $board->lastPost()]) }}">
                        {{ $board->lastPost()->topic->title }}
                    </a>
                </span>
            </div>
        @endif
    </div>
</div>