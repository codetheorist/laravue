<template>
        <nav class="navbar navbar-default navbar-static-top" :class="front ? 'front' : ''">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <router-link :to="{name: 'home'}" class="navbar-brand" activeClass="escape" exact>
                        Takeaway Town
                    </router-link>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul v-if="this.$store.authUser === true" class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                               <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul v-else class="nav navbar-nav navbar-right">
                        <router-link v-if="!user.authenticated" :to="{name: 'login'}" tag="li" activeClass="active" exact>
                          <a>Login</a>
                        </router-link>
                        <router-link v-if="!user.authenticated" :to="{name: 'register'}" tag="li" activeClass="active" exact>
                          <a>Register</a>
                        </router-link>
                        <li v-if="user.authenticated" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ user.first_name }} {{ user.last_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <router-link :to="{name: 'profile'}" tag="li" activeClass="active" exact>
                                  <a>Profile</a>
                                </router-link>
                                <li><a href="#" @click.prevent="logoutRequest()">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
</template>
<script>
    import {mapState} from 'vuex';
    export default {
        name: 'top-bar',
        computed: {
            ...mapState({
                user: state => state.auth.user
            }),
            front () {
                return this.$route.fullPath === '/' ? true : false
            }
        },
        methods: {
            logoutRequest() {
                this.$store.dispatch('logoutRequest')
                    .then((response) => {
                        console.log(response)
                        this.$router.push({name: 'login'});
                    })
                    .catch((error) => {});
            }
        }
    }
</script>
<style>
    .navbar.front {
        display: none !important;
    }
</style>
