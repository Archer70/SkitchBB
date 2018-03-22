<template>
    <div class="card user-card float-left">
        <img class="card-img-top" :src="user.avatar_url" alt="avatar">
        <div class="card-body">
            <h5 class="card-title mb-0">{{ user.name }}</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <strong>Group: </strong> N/A
            </li>
            <li class="list-group-item">
                <strong>Title: </strong> {{ user.title }}
            </li>
            <li class="list-group-item">
                <strong>Posts: </strong> {{ user.post_count }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            user: Object,
        }
    }
</script>

<style type="scss">
    .user-card {
        max-width: 200px;
        position: relative;
        top: -100px;
        margin-right: 20px;
    }
</style>
