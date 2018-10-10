'use strict';

require('./layout');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import routes from '../routes/router';

const router = new VueRouter(routes);

import Login from '../components/user/Login'
import Signup from '../components/user/Signup'

new Vue({
    el: '#app-form',
    components: {Login, Signup},
    router
}).$mount('#app-form');