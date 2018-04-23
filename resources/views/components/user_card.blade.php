<div class="card">
    <div class="card-body">
        <img class="card-avatar" src="{{ $user->avatarUrl() }}" alt="">
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="{{ route('users.show', ['name' => $user->name]) }}">
                {{ $user->name }}
            </a>
        </li>
        <li class="list-group-item">
            {{ $user->group->name }}
        </li>
        <li class="list-group-item">
            {{ $user->title }}
        </li>
        <li class="list-group-item">
            @lang('Posts:') {{ $user->post_count }}
        </li>
    </ul>
</div>