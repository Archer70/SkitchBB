    <div class="card mb-4 post">
        <div class="card-header">
            <form method="post" action="{{ route('posts.destroy', ['post' => $post]) }}">
                @csrf
                <div class="btn-group btn-group-sm justify-content-end float-right">
                    <a class="btn btn-secondary" href="{{ route('posts.edit', ['post' => $post]) }}">
                        <i class="far fa-edit"></i>
                    </a>
                    <button type="submit" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </form>
            @if($showTitle)
                <a href="{{  route('topics.show', ['topic' => $post->topic, 'slug' => $post->topic->slug]) }}">{{ $post->topic->title }}</a>
            @else
                <a href="{{  route('topics.show', ['topic' => $post->topic, 'slug' => $post->topic->slug]) }}">#{{ $count }}</a>
            @endif
            | <span>{{ $post->updated_at }}</span>
        </div>
        <div class="card-body post-area">
            <div class="row">
                <div class="col-3">
                    @component('components.user_card', ['user' => $post->user]) @endcomponent
                </div>
                <div class="col-9 py-3">
                    {!! Markdown::render($post->body) !!}
                </div>
            </div>
        </div>
    </div>
