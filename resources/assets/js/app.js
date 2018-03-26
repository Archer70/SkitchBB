require('./bootstrap');

window.Vue = require('vue');

Vue.mixin({
    methods: {
        "route": route
    }
});
