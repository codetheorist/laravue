<template>
  <div class="">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Restaurants
      <small>Administer restaurants on the system.</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <a href="#">
          <i class="fa fa-dashboard"></i> Admin</a>
      </li>
      <li>Restaurant</li>
      <li class="active">Settings</li>
    </ol>
  </section>

    <div class="row">
      <div :class="this.$route.params && this.$route.params.id ? 'col-md-9 col-md-push-3' : 'col-md-12'">
        <transition name="fade" mode="out-in">
          <router-view></router-view>
        </transition>

      </div>
      <div v-if="this.$route.params && this.$route.params.id" class="col-md-3 col-md-pull-9">
      </div>
    </div>
  </div>
</template>
<script>
import $ from 'jquery';
import { mapState } from 'vuex';
// $.AdminLTE = require('admin-lte');
export default {
  name: 'restaurant-settings-wrapper',
  mounted() {
    $(document).ready(function() {
      console.log('Ready');
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
