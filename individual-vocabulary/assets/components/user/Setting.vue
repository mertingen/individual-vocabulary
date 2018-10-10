<template>

    <form method="POST" @submit.prevent="postNow">
        <div class="form-group">
            <label>Target language: </label>
            <select2 :options="optns" :selected="selected" v-model="selected">
                <option disabled value="0">Select language</option>
            </select2>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
       
</template>

<script>
    import Select2 from '../form_items/Select2';
    import axios from 'axios';

    export default {
        components: {Select2},
        name: "setting",
        data() {
            return {
                optns: [],
                selected: ''
            }
        },
        // computed: {
        //     returnedLanguage: function () {
        //         console.log("RETURNED:" + this.$store.getters.userLanguage);
        //         return this.$store.getters.userLanguage;
        //     }
        // },
        watch: {
            'isChangeLanguageChecked': function (value) {
                if (!this.optns) {
                    let store = this.$store;
                    axios.get('/google/translate/api')
                        .then(response => {
                            this.optns = response.data.languages;
                            this.selected = store.getters.userLanguage;
                            store.commit('setSpinLoading', false);
                        })
                        .catch(e => {
                            this.errors.push(e)
                        });
                }
            }
        },
        computed: {
            isChangeLanguageChecked() {
                return this.$store.state.isChangeLanguageChecked;
            }
        },
        created() {

        },
        mounted() {
            let store = this.$store;
            this.$store.commit('setSpinLoading', true);
            axios.get('/google/translate/api')
                .then(response => {
                    this.optns = response.data.languages;
                    this.selected = store.getters.userLanguage;
                    store.commit('setSpinLoading', false);
                })
                .catch(e => {
                    this.errors.push(e)
                });
        },
        methods: {
            postNow: function () {
                let formData = new FormData();
                formData.set('language', this.selected);
                let store = this.$store;
                store.commit('setSpinLoading', true);
                axios.post('/user/postSetting', formData, {
                    headers: {
                        'Content-type': 'application/x-www-form-urlencoded',
                    }
                }).then(function (response) {
                    if (response.data.status) {
                        store.commit('changeLanguage', response.data.data.targetLanguage);
                        store.commit('setSpinLoading', false);
                    }
                });
            }
        },
    }
</script>

<style scoped>

</style>