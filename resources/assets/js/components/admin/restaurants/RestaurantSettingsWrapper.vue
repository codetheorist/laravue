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

  <section class="content container-fluid">
    <div class="row">
      <div :class="this.$route.params && this.$route.params.id ? 'col-md-9' : 'col-md-12'">
        <transition name="fade" mode="out-in">
          <router-view></router-view>
        </transition>

      </div>
      <div v-if="this.$route.params && this.$route.params.id" class="col-md-3">
        <restaurant-sidebar></restaurant-sidebar>
      </div>
    </div>
  </section>
  </div>

</template>
<script>
import $ from 'jquery';
const RestaurantSidebar = () => import('./RestaurantSidebar.vue')
// $.AdminLTE = require('admin-lte');
export default {
  name: 'restaurant-settings-wrapper',
  mounted() {
    $(document).ready(function() {
      console.log('Ready');
      $.AdminLTE.layout.activate();
    })
  },
  components: {
    RestaurantSidebar
  },
  methods: {
  }
}
</script>
<style lang="scss" scoped>
@import "~admin-lte/dist/css/skins/skin-blue.min.css";
</style>
