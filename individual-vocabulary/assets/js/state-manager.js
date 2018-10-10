'use strict';


import axios from 'axios';
import store from '../store/store';

let language = store.getters.userLanguage;
if (!language) {
    axios.get('/user/get')
        .then(response => {
            if (response.data.status) {
                store.commit('changeLanguage', response.data.data.targetLanguage);
                store.commit('setChangeLanguageChecked', true);
            }
        })
        .catch(e => {
            this.errors.push(e)
        });
}