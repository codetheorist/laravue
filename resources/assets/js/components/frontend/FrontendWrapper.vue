<template>
  <div class="wrapper">
      <transition name="fade" mode="out-in">
        <mini-top-bar v-if="!showTopBar()"></mini-top-bar>
        <top-bar v-else-if="showTopBar()"></top-bar>
      </transition>
      <notification></notification>
      <transition name="fade" mode="out-in">
          <router-view></router-view>
      </transition>
    </div>
  </div>
</template>
<script>
  import TopBar from './TopBar.vue'
  import MiniTopBar from './MiniTopBar.vue'
  import Notification from './../shared/Notification.vue'

  export default {
    name: 'frontend-wrapper',
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
<style lang="scss">
</style>
