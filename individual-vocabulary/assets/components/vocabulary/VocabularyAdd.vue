<template>

    <form method="POST" @submit.prevent="postNow">
        <div class="form-group col-6">
            <label>Foreign word: </label>
            <input type="text" v-model="foreignWord" class="form-control" placeholder="">
        </div>
        <div class="form-group col-6">
            <label>Known mean: </label>
            <input type="text" v-model="knownMean" class="form-control" placeholder="">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
       
</template>

<script>
    import axios from 'axios';

    export default {
        name: "vocabularyAdd",
        data() {
            return {
                foreignWord: '',
                knownMean: ''
            }
        },
        watch: {},
        methods: {
            postNow: function () {
                let formData = new FormData();
                formData.set('foreignWord', this.foreignWord);
                formData.set('knownMean', this.knownMean);
                let store = this.$store;
                let that = this;
                store.commit('setSpinLoading', true);
                axios.post('/vocabulary/add', formData, {
                    headers: {
                        'Content-type': 'application/x-www-form-urlencoded',
                    }
                }).then(function (response) {
                    if (response.data.status) {
                        store.commit('setSpinLoading', false);
                        that.foreignWord = '';
                        that.knownMean = '';
                        that.$toastr.s(response.data.message);
                    } else {
                        that.$toastr.e(response.data.message);
                    }
                });
            }
        },
    }
</script>

<style scoped>

</style>