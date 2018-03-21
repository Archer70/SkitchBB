<template>
    <div class="container">
        <h2 class="m-4">{{ topic.title }}</h2>
        <post v-for="post in posts" :post="post" :key="post.id"></post>
        <post-form :topic="topic" @new-post="newPost"></post-form>
    </div>
</template>

<script>
    export default {
        props: ['topic'],
        data() {
            return {
                posts: this.topic.posts
            }
        },
        methods: {
            newPost(post) {
                this.posts.push(post);
                console.log(this.topic.posts);
            }
        },
    }
</script>

<style lang="scss">
</style>