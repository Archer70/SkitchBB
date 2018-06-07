require('./bootstrap');
import Vuex from 'vuex';

window.Vue = require('vue');

Vue.mixin({
    methods: {
        route: route
    }
});

Vue.component('topic-reply', require('../../views/dynamic_components/topic_reply.vue'));
Vue.component('topic', require('../../views/dynamic_components/topic.vue'));
Vue.component('post', require('../../views/dynamic_components/post.vue'));
Vue.component('user-card', require('../../views/dynamic_components/user_card.vue'));

const app = new Vue({
    el: '#app',
    store,
});