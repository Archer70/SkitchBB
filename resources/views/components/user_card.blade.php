<div class="card user-card float-left">
    <img class="card-img-top" src="{{ $user->avatarUrl() }}" alt="avatar">
    <div class="card-body">
        <h5 class="card-title mb-0">{{ $user->name }}</h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <strong>{{ __('Group:') }} </strong> N/A
        </li>
        <li class="list-group-item">
            <strong>{{ __('Title:') }} </strong> {{ $user->title }}
        </li>
        <li class="list-group-item">
            <strong>{{ __('Posts:') }} </strong> {{ $user->post_count }}
        </li>
    </ul>
</div>