<template>
    <div class="card mb-4 post">
        <div class="card-header">
            <form method="post" :action="route('posts.destroy', post)">
                <input type="hidden" name="_token" :value="csrf">
                <div class="btn-group btn-group-sm justify-content-end float-right">
                    <button class="btn btn-primary" v-if="can_post" v-on:click="quote($event, {body: post.body, post_id: post.id, poster: post.user.name})">
                        <i class="fas fa-quote-right"></i>
                    </button>
                    <a v-if="post.can_update" class="btn btn-secondary" :href="route('posts.edit', post)">
                        <i class="far fa-edit"></i>
                    </a>
                    <button v-if="post.can_delete" type="submit" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </form>
            <a :name="post.id" :href="route('posts.show', post)">
                {{ show_title ? topic.title : '#'+post.id }} | {{ post.timeSincePosted }}
            </a>
        </div>
        <div class="card-body post-area">
            <div class="row">
                <div class="col-sm-3">
                    <user-card :user="post.user" :responsive="true"></user-card>
                </div>
                <div v-html="post.markdownBody" class="col-sm-9 py-3"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            topic: {
                type: Object
            },
            post: {
                type: Object
            },
            show_title: {
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
                csrf: window.csrf,
            }
        },
        methods: {
            quote: function(event, quote) {
                event.preventDefault();
                this.$emit('quote-post', quote)
            }
        }
    }
</script>