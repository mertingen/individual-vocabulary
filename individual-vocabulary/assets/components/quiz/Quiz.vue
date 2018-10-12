<template>

    <div>
        <form method="POST" @submit.prevent="postNow">
            <div class="form-group col-6">
                <label>Foreign word: </label>
                <input type="text" v-model="foreignWord" class="form-control" placeholder="" readonly="readonly">
            </div>
            <div class="form-group col-6">
                <label>Your known: </label>
                <input type="text" v-model="yourKnown" class="form-control" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button v-on:click="getRandomWord" type="button" class="btn btn-primary">Get</button>
        </form>

        <div v-bind:style="styleObject" v-if="isWrong">*Translated: {{ mean }}</div>
    </div>
       
</template>

<script>
    import axios from 'axios';

    export default {
        name: "quiz",
        data() {
            return {
                foreignWord: '',
                yourKnown: '',
                mean: '',
                result: false,
                styleObject: {
                    color: 'red',
                    fontSize: '13px'
                },
                isWrong: false,
            }
        },
        created() {
            this.getRandomWord();
        },
        watch: {},
        methods: {
            postNow: function () {
                let formData = new FormData();
                formData.set('foreignWord', this.foreignWord);
                formData.set('yourKnown', this.yourKnown);
                let store = this.$store;
                let that = this;
                store.commit('setSpinLoading', true);
                axios.post('/quiz/check', formData, {
                    headers: {
                        'Content-type': 'application/x-www-form-urlencoded',
                    }
                }).then(function (response) {
                    store.commit('setSpinLoading', false);
                    if (response.data.status) {
                        if (response.data.data.result) {
                            that.$toastr.s(response.data.message + "<br>" + that.foreignWord + ": " + response.data.data.mean);
                            that.foreignWord = response.data.data.randomWord.foreignWord;
                            that.yourKnown = '';
                        } else {
                            that.mean = response.data.data.mean;
                            that.styleObject.color = 'red';
                            that.$toastr.e(response.data.message);
                            that.yourKnown = '';
                            that.isWrong = true;
                        }
                    } else {
                        that.$toastr.e(response.data.message);
                    }
                });
            },
            getRandomWord: function () {
                let store = this.$store;
                store.commit('setSpinLoading', true);
                axios.get('/quiz/respond-random-word')
                    .then(response => {
                        store.commit('setSpinLoading', false);
                        if (response.data.status) {
                            this.foreignWord = response.data.data.foreignWord;
                        }
                    })
                    .catch(e => {
                        this.errors.push(e)
                    });
            }
        },
    }
</script>

<style scoped>

</style>