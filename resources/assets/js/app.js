require('./bootstrap');
import Vuex from 'vuex';

window.Vue = require('vue');
Vue.config.devtools = true;
Vue.use(Vuex);

Vue.mixin({
    methods: {
        route: route
    }
});

const store = new Vuex.Store({
    state: {
        posts: [],
        newPostCheckBlock: false
    },
    getters: {
        lastPost: state => {
            return state.posts[state.posts.length-1];
        },
        newPostCheckBlocked: state => {
            return state.newPostCheckBlock;
        }
    },
    mutations: {
        addPosts: (store, posts) => {
            for (let post of posts) {
                store.posts.push(post);
            }
        },
        blockNewPostCheck: store => store.newPostCheckBlock = true,
        unblockNewPostCheck: store => store.newPostCheckBlock = false
    }
})
window.vuexStore = store;

Vue.component('posts', require('../../views/dynamic_components/posts.vue'));
Vue.component('post', require('../../views/dynamic_components/post.vue'));
Vue.component('user-card', require('../../views/dynamic_components/user_card.vue'));

const app = new Vue({
    el: '#app',
    store,
});