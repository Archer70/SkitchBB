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
            quote: {
                type: Object,
                default: ''
            }
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
                this.blockPosts(true);

                axios.post(
                    route('posts.store'),
                    {
                        body: this.reply,
                        topic_id: this.topicId
                    }
                ).then(response => {
                    this.$emit('add-posts', response.data);
                    this.blockPosts(false);
                    this.reply = '';
                }).catch(response => {
                    // he ded. rip
                })
            },
            blockPosts: function(shouldBlock) {
                // Don't check for new posts while we're submitting,
                // and also don't keep SMASHING that reply button
                this.$emit('block-posts', shouldBlock)
                this.replyDisabled = shouldBlock;
            },
        },
        watch: {
            quote: function(quote) {
                let body = '';
                for (let line of quote.body.split('\n')) {
                    body += `>${line}\n`;
                }
                this.reply = `${this.reply}\n ${body}> %cite:${quote.post_id}|${quote.poster}%`;
            }
        }
    }
</script>