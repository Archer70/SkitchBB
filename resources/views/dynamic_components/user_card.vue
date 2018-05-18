<template>
    <div class="card user-card">
        <div class="card-body">
            <img :class="responsive ? 'card-avatar responsive' : 'card-avatar'" :src="user.avatarUrl" alt="">
            <a v-if="responsive" class="sm-show" :href="route('users.show', user)">
                {{ user.name }}
            </a>
        </div>
        <ul :class="'list-group list-group-flush' + (responsive ? ' sm-hide' : '')">
            <li class="list-group-item">
                <a :href="route('users.show', user)">
                    {{ user.name }}
                </a>
            </li>
            <li class="list-group-item">
                {{ user.group.name }}
            </li>
            <li v-if="user.title" class="list-group-item">
                {{ user.title }}
            </li>
            <li class="list-group-item">
                Posts: {{ user.post_count }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['user', 'responsive'],
    }
</script>