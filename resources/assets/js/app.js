import Vuex from 'vuex'
import vuexI18n from 'vuex-i18n'
import langStrings from './vue-i18n-locales.generated.js'


require('./bootstrap');

window.Vue = require('vue');

const store = new Vuex.Store();
Vue.use(vuexI18n.plugin, store);

Vue.i18n.add('en', langStrings.en);
Vue.i18n.set('en');

Vue.mixin({
    methods: {
        "route": route
    }
});

Vue.component('global-menu', require('./components/GlobalMenu.vue'));
