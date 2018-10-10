'use strict';

require('./layout');

import Vue from 'vue';
import VueRouter from 'vue-router'
import VueGoodTablePlugin from 'vue-good-table';

import Toastr from 'vue-toastr';

import 'vue-toastr/src/vue-toastr.scss';
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(VueGoodTablePlugin);
Vue.use(Toastr);
Vue.use(VueRouter);

import store from '../store/store';
import routes from '../routes/router';

const router = new VueRouter(routes);

import Setting from '../components/user/Setting';
import Select2 from '../components/form_items/Select2';
import VocabularyAdd from '../components/vocabulary/VocabularyAdd';
import VocabularyList from '../components/vocabulary/VocabularyList';
import LeftNav from '../components/html/LeftNav';
import TopNav from '../components/html/TopNav';
import Quiz from '../components/quiz/Quiz';

import MoonLoader from 'vue-spinner/src/PulseLoader.vue';

import '../js/state-manager';
import '../js/custom';

new Vue({
    el: '#app-dashboard',
    router: router,
    store: store,
    components: {Setting, Select2, LeftNav, TopNav, MoonLoader, VocabularyAdd, VocabularyList, Quiz},
}).$mount('#app-dashboard');