<template>
  <div class="">
      <transition name="fade" mode="out-in">
          <router-view></router-view>
      </transition>
  </div>

</template>
<script>
  import $ from 'jquery';
  import { mapState } from 'vuex';
  // $.AdminLTE = require('admin-lte');
  export default {
    name: 'restaurant-wrapper',
    mounted () {
      $(document).ready(function() {
        console.log('Ready');
        $.AdminLTE.layout.activate();
      })
    },
    computed: {
      ...mapState({
          user: state => state.auth.user
      })
    },
    methods: {
    }
  }
</script>
<style lang="scss" scoped>
  @import "~admin-lte/dist/css/skins/skin-blue.min.css";

</style>
