<template>
       
    <div>
        <form id="sign_up" method="POST" @submit.prevent="handleSubmit">

            <div class="msg">Register a new membership</div>
            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="username" placeholder="User name" required
                           autofocus v-model="username">
                    <span>{{msg.username}}</span>
                </div>
            </div>
            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                <div class="form-line">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required
                           v-model="email">
                    <span>{{msg.email}}</span>
                </div>
            </div>
            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                <div class="form-line">
                    <input type="password" class="form-control" name="password" minlength="6" placeholder="Password"
                           required v-model="password">
                    <span>{{msg.password}}</span>
                </div>
            </div>
            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                <div class="form-line">
                    <input type="password" class="form-control" name="confirmPassword" minlength="6"
                           placeholder="Confirm Password"
                           required v-model="confirmPassword">
                    <span>{{msg.confirmPassword}}</span>
                </div>
            </div>

            <button class="btn btn-block btn-lg bg-pink waves-effect" :disabled="disableSubmitButton"
                    type="submit">SIGN
                UP
            </button>

            <div class="m-t-25 m-b--5 align-center">
                <router-link to="/login">You already have a membership?</router-link>
            </div>
        </form>
    </div>
</template>

<script>

    import axios from 'axios';
    import iziToast from 'izitoast';
    import _ from 'lodash';
    import 'izitoast/dist/css/iziToast.min.css'


    export default {
        name: "signup",
        data() {
            return {
                username: '',
                email: '',
                password: '',
                confirmPassword: '',
                disableSubmitButton: true,
                msg: []
            }
        },
        watch: {
            username(val) {
                this.username = val;
                this.name = 'username';
                this.checkUsername(this.username);
            },
            email(val) {
                this.email = val;
                this.name = 'email';
                this.checkEmail(this.email);
            },
            password(val) {
                this.password = val;
                this.name = 'password';
                this.checkPassword(this.password);
            },
            confirmPassword(val) {
                this.confirmPassword = val;
                this.name = 'confirmPassword';
                this.checkConfirmPassword(this.confirmPassword);
            }
        },
        methods: {
            checkUsername(val) {
                let remainingLength = 6 - val.length;
                if (val.length < 6) {
                    this.msg[this.name] = 'User name must contain 6 characters ' + remainingLength + ' to go...';
                    return false;
                } else {
                    this.msg[this.name] = '';
                    return true;
                }
            },

            checkEmail(val) {
                let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                this.email = val;
                if (!re.test(this.email)) {
                    this.msg[this.name] = 'Keep typing...We are waiting for correct Email!';
                    return false;
                } else {
                    this.msg[this.name] = '';
                    return true;
                }
            },

            checkPassword(val) {
                this.checkPasswordLength(val);
            },

            checkConfirmPassword(val) {
                if (this.checkPasswordLength(val)) {
                    if (val.length !== this.password.length) {
                        this.msg[this.name] = 'Passwords do not match, please try again...';
                        this.changeStateSubmitButton(true);
                        return false;
                    } else {
                        this.msg[this.name] = '';
                        this.changeStateSubmitButton(false);
                        return true;
                    }
                }
            },

            checkPasswordLength(val) {
                let remainingLength = 6 - val.length;
                if (val.length < 6) {
                    this.msg[this.name] = 'Password must contain 6 characters ' + remainingLength + ' to go...';
                    return false;
                } else {
                    this.msg[this.name] = '';
                    return true;
                }
            },

            changeStateSubmitButton(val) {
                this.disableSubmitButton = val;
            },

            handleSubmit() {
                let isNotError = true;
                isNotError = this.checkUsername(this.username);
                isNotError = this.checkEmail(this.email);
                isNotError = this.checkPassword(this.password);
                isNotError = this.checkConfirmPassword(this.confirmPassword);
                if (isNotError) {
                    this.sendParams(event.target);
                    return true;
                }
            },

            toastMessage(type, messages) {
                let messageData = '<ul>';
                for (let key in messages) {
                    messageData += '<li>' + messages[key] + '</li>';
                }
                messageData += '</ul>';

                if (type === 'success') {
                    iziToast.success({
                        title: 'Success',
                        message: messageData,
                    });
                } else if (type === 'error') {
                    iziToast.error({
                        title: 'Error',
                        message: messageData,
                    });
                }
            },

            sendParams(form) {
                /*this.loading = true;*/
                let formData = new FormData(form);

                axios.post('/signup', formData)
                    .then(r => {
                            this.toastMessage(r.data.type, r.data.messages);
                            if (r.data.type === 'success') {
                                this.$router.push({
                                    name: "Login"
                                });

                            }
                        }
                    )
                    .catch(e => {
                            if (!_.isEmpty(e)) {
                                this.toastMessage('error', ['ERROR!']);
                            }
                        }
                    );

            }
        }

    }
</script>

<style scoped>

</style>