<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Permissions
        <small>This is where you control which roles have which permissions.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Permissions</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Permissions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>
                      ID
                    </th>
                    <th>
                      Name
                    </th>
                    <th>
                      Display Name
                    </th>
                    <th>
                      Description
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="permission in permissions">
                    <td>{{ permission.id }}</td>
                    <td>{{ permission.name }}</td>
                    <td>{{ permission.display_name }}</td>
                    <td>{{ permission.description }}</td>
                  </tr>
                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
    </section>
  </div>
</template>
<script>
  import { mapState } from 'vuex';
  export default {
    name: 'permissions',
    data () {
      return {

      }
    },
    computed: {
      ...mapState ({
        permissions: state => state.permissions.permissions,
        roles: state => state.permissions.roles
      })
    },
    mounted () {
      this.$store.dispatch('loadPermissions')

      //console.log(this.allRoles())
      // this.init()
      // console.log(this.allRoles())

    }
  }
</script>
