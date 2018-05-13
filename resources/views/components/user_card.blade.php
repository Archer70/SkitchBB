<div class="card user-card">
    <div class="card-body">
        <img class="card-avatar{{ isset($responsive) ? ' responsive' : '' }}" src="{{ $user->avatarUrl() }}" alt="">
        @if (isset($responsive))
            <a class="sm-show" href="{{ route('users.show', ['user' => $user]) }}">
                {{ $user->name }}
            </a>
        @endif
    </div>
    <ul class="list-group list-group-flush{{ isset($responsive) ? ' sm-hide' : '' }}">
        <li class="list-group-item">
            <a href="{{ route('users.show', ['user' => $user]) }}">
                {{ $user->name }}
            </a>
        </li>
        <li class="list-group-item">
            {{ $user->group->name }}
        </li>
        @if ($user->title)
            <li class="list-group-item">
                {{ $user->title }}
            </li>
        @endif
        <li class="list-group-item">
            @lang('Posts:') {{ $user->post_count }}
        </li>
    </ul>
</div>