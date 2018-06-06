<template>
    <div id="posts">
        <post
            v-for="post in this.$store.state.posts"
            :key="post.id"
            :topic="topic"
            :post="post"
            :show_title="false"
        ></post>
    </div>
</template>

<script>
    export default {
        props: {
            topic: {
                type: Object,
                default: null
            },
            posts: {
                type: Array,
            },
            is_last_page: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            checkForNewPosts: function() {
                setTimeout(() => {
                    if (this.$store.getters.newPostCheckBlocked) {
                        this.checkForNewPosts(); // Try again in 10 seconds.
                        return;
                    }
                    axios.get(
                        route('posts.newer-than', {lastPost: this.$store.getters.lastPost.id})
                    ).then(response => {
                        if (response.data.length > 0) {
                            this.$store.commit('addPosts', response.data);
                        }
                        this.checkForNewPosts();
                    }).catch(response => {
                        // Don't keep going.
                    })
                }, 10000) // Every ten seconds.
            }
        },
        mounted: function() {
            this.$store.commit('addPosts', this.posts);
            if (this.is_last_page) {
                this.checkForNewPosts()
            }
        }
    }
</script>