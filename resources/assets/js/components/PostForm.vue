<template>
    <div class="card m-4">
        <div class="card-body">
            <form method="post" :action="route('posts.store')" v-on:submit="newPostEvent">
                <div class="form-group">
                    <textarea
                            id="post-body"
                            name="body"
                            class="form-control"
                            aria-describedby="post-body"
                            v-model="body"
                            :placeholder="$t('New Post')"
                    ></textarea>
                </div>
                <input type="hidden" name="topic_id" :value="topic.id">
                <input type="hidden" name="_token" :value="window.csrf_token">
                <button type="submit" class="btn btn-primary">{{ $t('Reply') }}</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['topic'],
        data() {
            return {
                'window': window,
                'body': ''
            }
        },
        methods: {
            newPostEvent(event) {
                event.preventDefault();

                axios.post(route('posts.store'), {
                    'body': this.body,
                    'topic_id': this.topic.id
                }).then((response) => {
                    this.$emit('new-post', response.data)
                });
            }
        }
    }
</script>
