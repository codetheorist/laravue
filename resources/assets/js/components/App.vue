<template>
    <div>
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>
<script>
    import jwtToken from './../helpers/jwt-token'
    export default {
        name: 'app',
        mounted() {
            this.$store.dispatch('setAuthUser');
        },
        methods: {
          showTopBar() {
            return this.$route.name !== 'home'
          },
          showNav() {
            return
          }
        }
    }
</script>
<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .2s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
body > div > .container {
    padding: 1.25rem;
}
</style>
