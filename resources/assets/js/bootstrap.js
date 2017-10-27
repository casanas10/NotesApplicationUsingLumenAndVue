import Vue from 'vue';
import Vuex from 'vuex';


import VueRouter from 'vue-router';
import axios from 'axios';

window.Vue = Vue;
Vue.use(Vuex);
Vue.use(VueRouter);

window.axios = axios;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};