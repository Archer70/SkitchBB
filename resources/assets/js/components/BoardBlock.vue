<template>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <a v-bind:href="link">{{ title }}</a>
                </h5>
                <h6 v-if="description" class="card-subtitle">{{ description }}</h6>
            </div>
            <div v-if="last_topic" class="card-footer">
                <div class="float-right justify-content-end">
                    <span>{{ last_post.created_at }}</span>
                </div>
                <span>
                    {{ $t('Last post in') }}
                    <a :href="route('topic.show', {'slug': last_topic.slug})">{{ last_topic.title }}</a>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['link', 'title', 'description', 'last_post', 'last_topic'],
    }
</script>
