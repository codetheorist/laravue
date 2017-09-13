<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>Overview of users on the site.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">All Users</h3>
              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" v-model="userFilter" placeholder="Search...">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div><!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table rwd-table">
                <thead>
                  <tr>
                    <th>
                      Username
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in data.data" :class="user.enabled !== 1 ? 'danger' : 'success'">
                    <td data-head="Username">{{ user.username }}</td>
                    <td data-head="Email">{{ user.email }}</td>
                    <td data-head="Actions" class="actions-column">

                      <span class="actions-button">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action
                          <span class="fa fa-caret-down"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#" data-toggle="modal" data-target="#modal-default"><span class="fa fa-pencil"></span> Edit</a></li>
                          <li><a href="#" @click="enabledToggle(user.id, user.enabled ? 0 : 1)">
                            <span :class="['fa', user.enabled !== 1 ? 'fa-check' : 'fa-close']"></span>
                            <span v-text="user.enabled !== 1 ? 'Enable' : 'Disable'">

                            </span></a></li>
                          <li class="divider"></li>
                          <li><a href="#" data-toggle="modal" data-target="#modal-danger"><span class="fa fa-trash"></span> Delete</a></li>
                        </ul>
                      </span>
                      <div class="modal fade" id="modal-default" style="display: none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                              <h4 class="modal-title">Default Modal</h4>
                            </div>
                            <div class="modal-body">
                              <p>One fine body…</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      <div class="modal modal-danger fade" id="modal-danger" style="display: none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                              <h4 class="modal-title">Delete {{ user.username }}</h4>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure you would like to delete {{ user.first_name }} {{ user.last_name }}'s user profile?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
                              <button type="button" class="btn btn-primary">Yes</button>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                    </td>
                  </tr>
                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <pagination :data="data" :limit="1" v-on:pagination-change-page="computedResults"></pagination>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-md-pull-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Admin Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table rwd-table">
                <thead>
                  <td>
                    #
                  </td>
                  <td>
                    Task
                  </td>
                  <td>
                    Progress
                  </td>
                  <td>
                    Label
                  </td>
                </thead>
                <tbody>
                  <tr>
                    <td>1.</td>
                    <td>Update software</td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-red">55%</span></td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>Clean database</td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-yellow">70%</span></td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td>Cron job running</td>
                    <td>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-light-blue">30%</span></td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td>Fix and squish bugs</td>
                    <td>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-green">90%</span></td>
                  </tr>
                </tbody>

              </table>
            </div>
          </div>
        </div>        <!-- /.col -->
      </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</template>
<script>
  import {mapState} from 'vuex'
  import FooTable from 'footable'

  export default {
    name: 'user-list',
    created() {
      // Fetch initial results
      this.getResults();
    },
    data () {
      return {
        userFilter: null,
        // users: []
        page: 1,
        data: {},
        busy: false,
        isEditing: false
      }
    },
    watch: {
      userFilter: function (val) {
        this.computedResults(1);
      }
    },
    methods: {
      enabledToggle(id, enabled) {
        let data = {
          enabled: enabled
        }
        axios.post(route('api.users.toggle', id), data)
          .then(response => {
            this.getResults(this.page)
          })

      },
      // Our method to GET results from a Laravel endpoint
      getResults(page) {
        if (typeof page === 'undefined') {
          page = 1;
        }
        // Using axios as an example
        axios.get('/api/users?page=' + page)
          .then(response => {
            return response.data;
          }).then(data => {
            this.data = data;
          });
      },
      computedResults(page) {
        let filter = this.userFilter;
        if (this.userFilter !== null) {
          if (typeof page === 'undefined') {
            page = 1;
          }
          // Using axios as an example
          axios.get('/api/users?page=' + page + '&name=' + this.userFilter)
            .then(response => {
              return response.data;
            }).then(data => {
              this.data = data;
            });
        } else {
          this.getResults(page)
        }

      }
    }
  }
</script>
<style scoped>
  .email-column {
    word-wrap: break-word;
  }
  .actions-button {
    position: relative;
  }
</style>
