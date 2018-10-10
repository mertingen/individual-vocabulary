<template>

    <vue-good-table
            title="Demo Table"
            :columns="columns"
            :rows="rows"
            :paginate="true"
            :lineNumbers="true"
            :globalSearch="true"/>
       
</template>

<script>
    //import Datatable from '../form_items/Datatable';
    import axios from 'axios';
    import {VueGoodTable} from 'vue-good-table';

    export default {
        components: {
            VueGoodTable,
        },
        name: "vocabularyList",
        data(){
            return {
                columns: [
                    {
                        label: 'Name',
                        field: 'foreignWord',
                        filterable: true,
                    },
                    {
                        label: 'Mean',
                        field: 'knownMean',
                        filterable: true,
                    },
                    {
                        label: 'Action',
                        field: 'htmlContent',
                        html: true
                    },
                ],
                rows: [],
            };
        },
        computed: {},
        mounted: function () {

        },
        created() {
            let store = this.$store;
            let el = $(this.$el);
            store.commit('setSpinLoading', true);
            axios.get('/vocabulary/list-items')
                .then(response => {
                    if (response.data.status) {
                        this.rows = response.data.data;
                        store.commit('setSpinLoading', false);
                    }
                })
                .catch(e => {
                    this.errors.push(e)
                });
        },
        watch: {
            items: function (items) {

            }
        },
        methods: {
            say: function (message) {
                alert(message)
            }
        }
    }
</script>

<style scoped>

</style>