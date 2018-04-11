<div class="card {{ isset($small) ? 'user-card-small' : 'user-card' }}">
    <img class="card-img-top" src="{{ $user->avatarUrl() }}" alt="avatar">
    <div class="card-body">
        <h5 class="card-title mb-0">
            <a href="{{ route('users.show', ['name' => $user->name]) }}">
                {{ $user->name }}
            </a>
        </h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            {{ $user->group->name }}
        </li>
        <li class="list-group-item">
            {{ $user->title }}
        </li>
        <li class="list-group-item">
            {{ __('Posts:') }} {{ $user->post_count }}
        </li>
    </ul>
</div>