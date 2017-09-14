<template>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Menu</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="list-group">
          <router-link v-if="user.authenticated" :to="{name: 'admin.profile'}" activeClass="active" exact class="list-group-item">
            <i class="fa fa-gears"></i>
            <span>Profile</span>
          </router-link>
          <router-link v-if="user.authenticated" :to="{name: 'admin.profile.addresses'}" activeClass="active" exact class="list-group-item">
            <i class="fa fa-map-marker"></i>
            <span>Addresses</span>
          </router-link>
        </div>
      </div>
    </div>
  </section>

</template>
<script>
import { mapState } from 'vuex'
export default {
  name: 'profile-sidebar',
  computed: {
    ...mapState({
      user: state => state.auth.user
    })
  }
}
</script>
