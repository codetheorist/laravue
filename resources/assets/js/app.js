import $ from 'jquery';
import slick from 'slick-carousel';
import _ from 'lodash';
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import { sync } from 'vuex-router-sync'
import trumbowyg from 'vue-trumbowyg';
import 'trumbowyg/dist/ui/trumbowyg.css';
import router from './routes';
import store from './store/index';
import App from './components/App.vue';
import jwtToken from './helpers/jwt-token';
import VueNumeric from 'vue-numeric'
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.axios = axios;
window.slick = slick;
require('bootstrap-sass');
sync(store, router)
window.Vue = require('vue');

//Vue.component('example', require('./components/Example.vue'));
// sync(store, router)

Vue.use(trumbowyg);

Vue.use(VueNumeric)
axios.interceptors.request.use(config => {
    config.headers['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
    config.headers['X-Requested-With'] = 'XMLHttpRequest';

    if(jwtToken.getToken()) {
        config.headers['Authorization'] = 'Bearer '+ jwtToken.getToken();
    }

    return config;
}, error => {
    return Promise.reject(error);
});

axios.interceptors.response.use(response => {
    if (response.config.headers.Authorization) {
        response.data.jwt = response.config.headers.Authorization.replace('Bearer ', '');
    }

    return response;
}, error => {
    let errorResponseData = error.response.data;

    if(errorResponseData.error && (errorResponseData.error === "token_invalid" || errorResponseData.error === "token_expired" || errorResponseData.error === 'token_not_provided')) {
        store.dispatch('logoutRequest')
            .then(()=> {
                // router.push({name: 'login'});
            });
    }

    return Promise.reject(error);
});

Window.app = new Vue({
    el: '#app',
    router,
    store,
    data: {
        isLoaded: false
    },
    data () {
        return {
            frontpage: false
        }
    },
    mounted () {
        console.log(this.$route)
    },
    // components: {
    //     VueNumeric
    // },
    render: function(h) {
      return h(App)
    }
});
