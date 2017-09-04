<template>
    <div>
        <form @submit.prevent="register()" class="form-horizontal">

            <div class="form-group">
                <label for="first_name" class="col-md-4 control-label">First Name</label>

                <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control" name="first_name" v-model="first_name" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="last_name" class="col-md-4 control-label">Last Name</label>

                <div class="col-md-6">
                    <input type="last_name" class="form-control" id="last_name" v-model="last_name" required>
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="col-md-4 control-label">Username</label>

                <div class="col-md-6">
                    <input type="username" class="form-control" id="username" v-model="username" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" v-model="email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input type="email" class="form-control" id="email" v-model="email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        name: 'register-form',
        data() {
            return {
                first_name: '',
                last_name: '',
                username: '',
                email: '',
                password: ''
            }
        },
        methods: {
            register() {
                const registerData = {
                  first_name: this.first_name,
                  last_name: this.last_name,
                  username: this.username,
                  email: this.email,
                  password: this.password,
                  password_confirm: this.password_confirm
                };
                console.log(registerData);
                this.$store.dispatch('registerRequest', registerData)
                .then((response) => {
                  this.$router.push({name: 'home'});
                })
                .catch((error) => {});
            }
        }
    }
</script>
