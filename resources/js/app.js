require('./bootstrap');
import Vue from 'vue'
import 'es6-promise/auto'
import VueRouter from 'vue-router'
import 'materialize-css/dist/css/materialize.min.css';
import 'materialize-css';
import 'material-icons';
import router from './router'
import axios from 'axios';
import auth from './auth'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import App from './views/layout/App';
import Navigation from './components/Navigation';
import Pagination from './components/Pagination';

// Set Vue globally
window.Vue = Vue;

import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import {Tabs, Tab} from 'vue-tabs-component';

Vue.component('tabs', Tabs);
Vue.component('tab', Tab);
Vue.component('v-select', vSelect);
Vue.component('pagination', Pagination);

Vue.router = router;
Vue.use(VueRouter);

// Set Vue authentication
Vue.use(VueAxios, axios);
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/v1`;


Vue.use(VueAuth, auth);

const app = new Vue({
    el: '#app',
    components: {
        App,
        Navigation,
        Pagination,


    },

    router,
});
