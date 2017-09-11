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
        created () {
            this.$store.dispatch('setAuthUser');
            this.$store.dispatch('loadRestaurants');
        },
        mounted() {

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
