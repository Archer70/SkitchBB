<template>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <a v-bind:href="link">{{ title }}</a>
                </h5>
                <h6 v-if="description" class="card-subtitle">{{ description }}</h6>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['link', 'title', 'description'],
    }
</script>
