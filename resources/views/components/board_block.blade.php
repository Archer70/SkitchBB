<div class="col mb-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('boards.show', ['board' => $board, 'slug' => $board->slug]) }}">{{ $board->title }}</a>
            </h5>
            <h6 class="card-subtitle">{{ $board->description }}</h6>
        </div>
        @if ($board->lastPost())
            <div class="card-footer">
                <div class="float-right justify-content-end">
                    <span>{{ $board->lastPost()->created_at }}</span>
                </div>
                <span>
                    @lang('Last post in')
                    <a href="{{ route('topics.show', ['topic' => $board->lastPost()->topic, 'slug' => $board->lastPost()->topic->slug]) }}">
                        {{ $board->lastPost()->topic->title }}
                    </a>
                </span>
            </div>
        @endif
    </div>
</div>