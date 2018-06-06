<template>
    <div class="card mb-4">
        <div class="card-body">
            <form id="new-post-form" method="post" :action="route('posts.store')" v-on:submit="sendReply">
                <div class="form-group">
                <textarea
                        id="post-body"
                        name="body"
                        class="form-control"
                        aria-describedby="post-body"
                        placeholder="New Post"
                        v-model="reply"
                        :disabled="replyDisabled"
                ></textarea>
                </div>
                <button id="post-reply" type="submit" class="btn btn-primary" :disabled="replyDisabled">Reply</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            topic: {
                type: Object,
                default: null
            },
        },
        data: function() {
            return {
                reply: '',
                topicId: this.topic.id,
                replyDisabled: false,
            }
        },
        methods: {
            sendReply: function(event) {
                event.preventDefault();

                // Don't check for new posts while we're submitting,
                // and also don't keep SMASHING that reply button
                vuexStore.commit('blockNewPostCheck');
                this.replyDisabled = true;

                axios.post(
                    route('posts.store'),
                    {
                        body: this.reply,
                        topic_id: this.topicId
                    }
                ).then(response => {
                    vuexStore.commit('addPosts', response.data);

                    // Okay, continue with your replying, if you must.
                    vuexStore.commit('unblockNewPostCheck');
                    this.reply = '';
                    this.replyDisabled = false;
                }).catch(response => {
                    // he ded. rip
                })
            }
        },
        mounted: function() {
            
        }
    }
</script>