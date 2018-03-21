<template>
    <div class="card m-4">
        <div class="card-header" v-if="post.topic">
            <div class="justify-content-end float-right">
                <span>{{ post.updated_at }}</span>
            </div>
            <a href="route('topic.show', {slug: post.topic.slug})">{{ post.topic.title }}</a>
        </div>
        <div class="card-body">
            {{ post.body }}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['post'],
    }
</script>
