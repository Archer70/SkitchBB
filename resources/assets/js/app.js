require('./bootstrap');

window.Vue = require('vue');

Vue.component('posts', require('../../views/dynamic_components/posts.vue'));
Vue.component('post', require('../../views/dynamic_components/post.vue'));
Vue.component('user-card', require('../../views/dynamic_components/user_card.vue'));

Vue.mixin({
    methods: {
        route: route
    }
});

const app = new Vue({
    el: '#app'
});