<template>
    <div>
        <form @submit.prevent="login()" class="form-horizontal">
            <div class="form-group">
                <label for="username" class="col-md-4 control-label">Username</label>

                <div class="col-md-6">
                    <input id="username" type="username" class="form-control" name="username" v-model="username" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input type="password" class="form-control" id="password" v-model="password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'login-form',
        data() {
            return {
                username: null,
                password: null
            }
        },
        methods: {
            login() {
                const loginData = {
                    username: this.username,
                    password: this.password
                };

                this.$store.dispatch('loginRequest', loginData)
                    .then((response) => {
                        // console.log(response)
                        this.$router.push({name: 'profile'});
                    })
                    .catch((error) => {});


            }
        }
    }
</script>
