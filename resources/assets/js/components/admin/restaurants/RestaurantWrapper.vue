<template>
  <div class="">
      <transition name="fade" mode="out-in">
        <router-view></router-view>
      </transition>
    </div>
  </div>
</template>
<script>
  import $ from 'jquery';
  export default {
    name: 'restaurant-wrapper',
    mounted () {
      $(document).ready(function() {
        $.AdminLTE.layout.activate();
      })
    },
    methods: {
    }
  }
</script>
<style lang="scss" scoped>
  @import "~admin-lte/dist/css/skins/skin-blue.min.css";

</style>
