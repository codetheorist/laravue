<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
        <small>An overview of your user profile on the site.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              Dashboard
            </div>

            <div class="panel-body">
              You are logged in!
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
  import {mapState} from 'vuex';
  export default {
    name: 'profile',
    computed: {
      ...mapState({
          user: state => state.auth.user
      })
    }
  }
</script>
