<div class="card m-4">
    <div class="card-header">
        <div class="justify-content-end float-right">
            <span>{{ $post->updated_at }}</span>
        </div>
        @if($showTitle)
            <a href="{{  route('topic.show', ['slug' => $post->topic->slug]) }}">{{ $post->topic->title }}</a>
        @else
            <a href="{{  route('topic.show', ['slug' => $post->topic->slug]) }}">#{{ $count }}</a>
        @endif
    </div>
    <div class="card-body">
        {{ $post->body }}
    </div>
</div>