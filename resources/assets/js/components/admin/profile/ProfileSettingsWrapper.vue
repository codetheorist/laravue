<template>
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="#">
            <i class="fa fa-dashboard"></i> Admin</a>
        </li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row">
        <div :class="'col-md-9'">
          <transition name="fade" mode="out-in">
            <router-view></router-view>
          </transition>

        </div>
        <div class="col-md-3">
          <profile-sidebar></profile-sidebar>
        </div>
      </div>
    </section>
  </div>

</template>
<script>
import ProfileSidebar from './ProfileSidebar.vue'
export default {
  name: 'profile-settings-wrapper',
  components: {
    ProfileSidebar
  }
}
</script>
