<template>
    <div class="container">
    <div class="card">
        <img id="profile-header" class="card-img-top" :src="assetUrl + 'images/default-profile-header.png'" alt="">
        <div class="card-body">
            <user-card :user="user"></user-card>
            <h4>Bio</h4>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: {
            user: Object,
            assetUrl: String
        }
    }
</script>

<style type="scss">
    #profile-header {
        max-height: 14rem;
    }
</style>
