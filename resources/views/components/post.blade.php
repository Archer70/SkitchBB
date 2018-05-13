    <div class="card mb-4 post">
        <div class="card-header">
            <form method="post" action="{{ route('posts.destroy', ['post' => $post]) }}">
                @csrf
                <div class="btn-group btn-group-sm justify-content-end float-right">
                    @if($authUser->can('update', $post))
                        <a class="btn btn-secondary" href="{{ route('posts.edit', ['post' => $post]) }}">
                            <i class="far fa-edit"></i>
                        </a>
                    @endif
                    @if($authUser->can('delete', $post))
                        <button type="submit" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    @endif
                </div>
            </form>
            @if($showTitle)
                <a href="{{ route('topics.show', ['topic' => $topic, 'slug' => $topic->slug]) }}">{{ $topic->title }}</a>
            @else
                <a name="{{ $post->id }}" href="{{ route('topics.show', ['topic' => $topic, 'slug' => $topic->slug]) }}?page={{ $currentPage }}#{{ $post->id }}">#{{ $post->id }}</a>
            @endif
            | <span>{{ $post->updated_at }}</span>
        </div>
        <div class="card-body post-area">
            <div class="row">
                <div class="col-sm-3">
                    @component('components.user_card', ['user' => $post->user, 'responsive' => true]) @endcomponent
                </div>
                <div class="col-sm-9 py-3">
                    {!! Markdown::render($post->body) !!}
                </div>
            </div>
        </div>
    </div>
