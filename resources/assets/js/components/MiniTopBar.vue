<template>
    <div class="top-right links">
        <router-link v-if="!user.authenticated" :to="{name: 'login'}" activeClass="active" exact>Login</router-link>
        <router-link v-if="!user.authenticated" :to="{name: 'register'}" activeClass="active" exact>Register</router-link>
        <router-link v-if="user.authenticated" :to="{name: 'profile'}" activeClass="active" exact>Profile</router-link>
        <a v-if="user.authenticated" href="#" @click.prevent="logoutRequest()">Logout</a>
    </div>
</template>
<script>
    import {mapState} from 'vuex';
    export default {
        name: 'top-bar',
        computed: {
            ...mapState({
                user: state => state.auth.user
            })
        },
        methods: {
            logoutRequest() {
                this.$store.dispatch('logoutRequest')
                    .then((response) => {
                        console.log(response)
                        // this.$router.push({name: 'admin'});
                    })
                    .catch((error) => {});

                // console.log('Logout Request')
                // return true
            }
        }
    }
</script>
<style lang="scss">
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
        z-index: 1;
        &.links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    }
</style>
