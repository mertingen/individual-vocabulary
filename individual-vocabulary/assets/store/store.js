'use strict';

import Vue from "vue";
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        language: '',
        isChangeLanguageChecked: false,
        spinLoading: false
    },
    getters: {
        userLanguage: state => {
            return state.language
        },
        isChangeLanguageChecked: state => {
            return state.isChangeLanguageChecked
        }
    },
    mutations: {
        changeLanguage: (state, value) => {
            state.language = value
        },
        setChangeLanguageChecked: (state, value) => {
            state.isChangeLanguageChecked = value
        },
        setSpinLoading: (state, value) => {
            state.spinLoading = value
        },
    }
});

export default store;