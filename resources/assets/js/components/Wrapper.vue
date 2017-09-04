<template>
  <div id="wrapper">
    <top-bar></top-bar>
    <notification></notification>
    <transition name="fade" mode="out-in">
      <router-view></router-view>
    </transition>
  </div>
</template>
<script>
  import TopBar from './TopBar.vue'
  import Notification from './Notification.vue'
  export default {
    name: 'wrapper',
    components: {
      TopBar,
      Notification
    }
  }
</script>
