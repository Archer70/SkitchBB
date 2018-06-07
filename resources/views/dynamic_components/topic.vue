<template>
    <div id="posts">
        <div v-html="pagination.html"></div>
        <post
            v-for="post in dataPosts"
            :key="post.id"
            :topic="topic"
            :post="post"
            :show_title="false"
            v-on:quote-post="quotePost"
        ></post>
        <div v-html="pagination.html"></div>
        <topic-reply
            :topic="topic"
            :quote="quote"
            v-on:add-posts="addPosts"
            v-on:block-posts="blockPosts = $event"
        ></topic-reply>
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
            pagination: {
                type: Object,
                default: null
            },
            is_last_page: {
                type: Boolean,
                default: false
            },
            can_post: {
                type: Boolean,
                default: false
            }
        },
        data: function() {
            return {
                blockPosts: false,
                dataPosts: this.posts,
                quote: null
            }
        },
        methods: {
            addPosts: function(posts) {
                for (let post of posts) {
                    this.dataPosts.push(post);
                }
            },
            lastPostId: function() {
                return this.dataPosts[this.dataPosts.length-1].id;
            },
            quotePost: function(post) {
                this.quote = post;
            },
            checkForNewPosts: function() {
                setTimeout(() => {
                    if (this.blockPosts) {
                        this.checkForNewPosts(); // Try again in 10 seconds.
                        return;
                    }
                    axios.get(
                        route('posts.newer-than', {lastPost: this.lastPostId()})
                    ).then(response => {
                        if (response.data.length > 0) {
                            this.addPosts(response.data);
                        }
                        this.checkForNewPosts();
                    }).catch(response => {
                        // Don't keep going.
                    })
                }, 10000) // Every ten seconds.
            },
        },
        mounted: function() {
            if (this.is_last_page) {
                this.checkForNewPosts()
            }
        }
    }
</script>