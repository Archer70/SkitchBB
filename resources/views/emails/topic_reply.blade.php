@component('mail::message')
# @lang('Topic Reply')

@lang('A new reply has been posted to a topic you\'re subscribed to by ' . $post->user->name . '!')

[{{ $topic->title }}]({{ route('posts.show', ['post' => $post]) }})
@component('mail::panel')
{{ $post->body }}
@endcomponent

@component('mail::button', ['url' => route('topics.show', ['topic' => $topic])])
@lang('Go To Topic')
@endcomponent

[@lang('Unsubscribe from email notifications')]({{ route('users.edit', ['user' => $user]) }})
@endcomponent
