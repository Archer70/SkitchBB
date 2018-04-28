    <div class="card mb-4 post">
        <div class="card-header">
            <div class="justify-content-end float-right">
                <span>{{ $post->updated_at }}</span>
            </div>
            @if($showTitle)
                <a href="{{  route('topics.show', ['topic' => $post->topic, 'slug' => $post->topic->slug]) }}">{{ $post->topic->title }}</a>
            @else
                <a href="{{  route('topics.show', ['topic' => $post->topic, 'slug' => $post->topic->slug]) }}">#{{ $count }}</a>
            @endif
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