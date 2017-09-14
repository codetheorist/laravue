<template>
      <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="/images/default.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ user.first_name }} {{ user.last_name }}</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">ADMIN MENU</li>
        <router-link v-if="user.authenticated" :to="{name: 'admin.dashboard'}" tag="li" activeClass="active" exact>
          <a href="#"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
        </router-link>
        <router-link v-if="user.authenticated" :to="{name: 'admin.profile'}" tag="li" activeClass="active" exact>
          <a href="#"><i class="fa fa-user"></i> <span>Profile</span></a>
        </router-link>
        <li class="treeview">
          <a href="#"><i class="fa fa-cutlery"></i> <span>Restaurants</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
                <!-- Optionally, you can add icons to the links -->
            <router-link v-if="user.authenticated" :to="{name: 'admin.restaurants'}" tag="li" activeClass="active" exact>
              <a href="#"><i class="fa fa-search"></i> <span>Search Restaurants</span></a>
            </router-link>
            <router-link v-if="user.authenticated" :to="{name: 'admin.restaurants.new'}" tag="li" activeClass="active" exact>
              <a href="#"><i class="fa fa-pencil"></i> <span>New Restaurant</span></a>
            </router-link>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <!-- Optionally, you can add icons to the links -->
            <router-link v-if="user.authenticated" :to="{name: 'admin.user-list'}" tag="li" activeClass="active" exact>
              <a href="#"><i class="fa fa-search"></i> <span>Search Users</span></a>
            </router-link>
            <!-- Optionally, you can add icons to the links -->
            <router-link v-if="user.authenticated" :to="{name: 'admin.roles'}" tag="li" activeClass="active" exact>
              <a href="#"><i class="fa fa-id-card"></i> <span>Roles</span></a>
            </router-link>
            <!-- Optionally, you can add icons to the links -->
            <router-link v-if="user.authenticated" :to="{name: 'admin.permissions'}" tag="li" activeClass="active" exact>
              <a href="#"><i class="fa fa-lock"></i> <span>Permissions</span></a>
            </router-link>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
</template>
<script>
  import { mapState } from 'vuex';
  export default {
    name: 'main-sidebar',
    computed: {
      ...mapState({
          user: state => state.auth.user
      })
    }
  }
</script>
