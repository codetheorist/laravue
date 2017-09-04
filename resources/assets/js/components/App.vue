<template>
    <div>
        <transition name="fade" mode="out-in">
            <mini-top-bar v-if="!showTopBar()"></mini-top-bar>
            <top-bar v-else-if="showTopBar()"></top-bar>
        </transition>
        <notification></notification>
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>
<script>
    import jwtToken from './../helpers/jwt-token'
    import TopBar from './TopBar.vue'
    import MiniTopBar from './MiniTopBar.vue'
    import Notification from './Notification.vue'
    export default {
        name: 'app',
        mounted() {
            this.$store.dispatch('setAuthUser');
        },
        components: {
            TopBar,
            MiniTopBar,
            Notification
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
