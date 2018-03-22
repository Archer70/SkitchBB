<template>
    <div class="container">
        <div class="card m-4">
            <div class="card-body">
                <h5 class="card-title">
                    {{ board.title }}
                    <a v-if="user" class="btn btn-primary float-right" :href="route('topics.create', {'slug': board.slug})">{{ $t('New Topic') }}</a>
                </h5>
                <h6 v-if="board.description" class="card-subtitle">{{ board.description }}</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li v-for="topic in board.topics" class="list-group-item">
                    <a v-bind:href="topic.link">{{ topic.title }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['board', 'user'],
    }
</script>

<style type="scss">
    /* Component style. */
</style>
