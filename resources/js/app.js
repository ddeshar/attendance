
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
window.Vuetify = require('vuetify');
import BootstrapVue from 'bootstrap-vue'

import axios from 'axios';


Vue.use(BootstrapVue)
Vue.use(Vuetify)
Vue.use(VueRouter);
// import StoreData from './store';
import store from './store';
import routes from './routes.js';
import Apisite from './Apisite';
import {initialize} from './helper/general';
window.axios = axios;
window.Apisite = Apisite;
import bar from './helper/progress'
import auth from './api/register';


Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import App from './views/App'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

if(store.state.loggedIn = true){
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + auth.getToken();
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

routes.beforeEach((to, from, next) => {
    bar.start()
    next()
})
// const store = new Vuex.Store(StoreData);
initialize(store, routes);
 
const app = new Vue({
    el: '#app',
    components: { App },
    
    router : routes,
    store: store,
    
    render: h => h(App),
});