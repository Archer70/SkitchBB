<template>
    <div id="posts">
        <post
            v-for="post in dataPosts"
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
        data: function() {
            return {
                dataPosts: this.posts,
            }
        },
        methods: {
            lastPost: function() {
                return this.dataPosts[this.dataPosts.length-1];
            },
            appendNewPosts: function(newPosts) {
                for (let post of newPosts) {
                    this.dataPosts.push(post);
                }
            },
            checkForNewPosts: function() {
                setTimeout(() => {
                    axios.get(
                        route('posts.newer-than', {lastPost: this.lastPost().id})
                    ).then(response => {
                        this.appendNewPosts(response.data);
                        this.checkForNewPosts();
                    }).catch(response => {
                        // Don't keep going.
                    })
                }, 10000) // Every ten seconds.
            }
        },
        mounted: function() {
            if (this.is_last_page) {
                this.checkForNewPosts()
            }
        }
    }
</script>