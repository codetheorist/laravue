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
    <section v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="1" class="content container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Admin Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-responsive">
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
        </div>
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">All Users</h3>
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
                      Username
                    </th>
                    <th>
                      Name
                    </th>
                    <th>
                      Email
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in items">
                    <td>{{ user.id }}</td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.first_name }} {{ user.last_name }}</td>
                    <td>{{ user.email }}</td>
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
    <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</template>
<script>
  import {mapState} from 'vuex'
  export default {
    name: 'user-list',
    data () {
      return {
        // users: []
        page: 1,
        items: [],
        busy: false,
        isEditing: false
      }
    },
    computed: {
      ...mapState({
        users: state => state.users.users
      })
    },
    mounted () {
      this.$store.dispatch('loadUsers')
    },
    methods: {
      loadMore: function() {
        this.busy = true;
        var url = '/api/users' + (this.page > 1 ? '?page=' + this.page : '');
        axios.get(url)
        .then(response => {
          var data = response.data;
          // Push the response data into items
          for (var i = 0, j = data.length; i < j; i++) {
            this.items.push(data[i]);
          }
          console.log(this.items);
          // If the response data is empty,
          // disable the infinite-scroll
          this.busy = (j < 1);
          // Increase the page number
          this.page++;
        });
      }
    }
  }
</script>
