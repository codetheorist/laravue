<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Restaurants
        <small>Administer restaurants on the system.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Restaurants</li>
      </ol>
      <restaurant-editor v-if="isEditing === true" @close-modal="closeModal"></restaurant-editor>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Search Restaurants</h3>
              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" v-model="restaurantFilter" placeholder="Search...">
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
                      Display Name
                    </th>
                    <th>
                      Slug
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="restaurant in data.data" :class="restaurant.enabled !== 1 ? 'danger' : 'success'">
                    <td data-head="Display Name">{{ restaurant.display_name }}</td>
                    <td data-head="Slug">{{ restaurant.name }}</td>
                    <td data-head="Status">{{ restaurant.display_name }}</td>
                    <td data-head="Actions" class="actions-column">

                      <span class="actions-button">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action
                          <span class="fa fa-caret-down"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#" @click="modalMode('edit', restaurant.id)"><span class="fa fa-pencil"></span> Edit</a></li>
                          <li><a href="#" @click="enabledToggle(restaurant.id, restaurant.enabled ? 0 : 1)">
                            <span :class="['fa', restaurant.enabled !== 1 ? 'fa-check' : 'fa-close']"></span>
                            <span v-text="restaurant.enabled !== 1 ? 'Enable' : 'Disable'">

                            </span></a></li>
                          <li class="divider"></li>
                          <li><a href="#" @click="modalMode('delete', restaurant.id)"><span class="fa fa-trash"></span> Delete</a></li>
                        </ul>
                      </span>
                      <restaurant-editor @close-modal="closeModal" v-if="isEditing === restaurant.id" :restaurant="restaurant" class="restaurant-editor"></restaurant-editor>
                      <restaurant-deleter @close-modal="closeModal" v-if="isDeleting === restaurant.id" :restaurant="restaurant" class="restaurant-deleter"></restaurant-deleter>
                      <div class="modal modal-danger fade" id="modal-danger" style="display: none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                              <h4 class="modal-title">Delete {{ restaurant.name }}</h4>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure you would like to delete {{ restaurant.name }}?</p>
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
        <!-- /.col -->
      </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</template>
<script>
  import {mapState} from 'vuex'
  import FooTable from 'footable'
  const RestaurantEditor = () => import('./RestaurantEditor.vue')
  const RestaurantDeleter = () => import('./RestaurantDeleter.vue')
  export default {
    name: 'restaurant-list',
    created() {
      // Fetch initial results
      this.getResults();
    },
    components: {
      RestaurantEditor,
      RestaurantDeleter
    },
    data () {
      return {
        restaurantFilter: null,
        // users: []
        page: 1,
        data: {},
        busy: false,
        isEditing: false,
        isDeleting: false
      }
    },
    watch: {
      restaurantFilter: function (val) {
        this.computedResults(1);
      }
    },
    methods: {
      enabledToggle(id, enabled) {
        let data = {
          enabled: enabled
        }
        axios.post(route('api.restaurants.toggle', id), data)
          .then(response => {
            this.getResults(this.page)
          })
      },
      closeModal(mode) {
        if (mode === 'edit') {
          this.isEditing = false
          this.getResults()
        } else if (mode === 'delete') {
          this.isDeleting = false
          this.getResults()
        }
      },
      // Our method to GET results from a Laravel endpoint
      getResults(page) {
        if (typeof page === 'undefined') {
          page = 1;
        }
        // Using axios as an example
        axios.get('/api/restaurants?page=' + page)
          .then(response => {
            return response.data;
          }).then(data => {
            this.data = data;
          });
      },
      modalMode: function(mode, id) {
        if (mode === 'delete') {
          this.deleteMode(id)
        } else if (mode === 'edit') {
          this.editorMode(id)
        }
      },
      editorMode: function(value) {
        // If the editor is not already open for the selected category, open it
        // if (this.isEditing != value) {
        //   this.isEditing = value
        // }
        this.$router.push({ name: 'admin.restaurants.edit', params: { id: value }})
      },
      deleteMode: function(value) {
        // If the editor is not already open for the selected category, open it
        if (this.isDeleting != value) {
          this.isDeleting = value
        }

        // When the modal window is hidden, remove the category from the 'isEditing' data paramter
        // Bind this to ensure the view state gets updated properly
        $('#delete-' + value).on('hidden.bs.modal', function (event) {
          this.isDeleting = false;
        }.bind(this))

      },
      computedResults(page) {
        let filter = this.restaurantFilter;
        if (this.restaurantFilter !== null) {
          if (typeof page === 'undefined') {
            page = 1;
          }
          // Using axios as an example
          axios.get('/api/restaurants?page=' + page + '&name=' + this.restaurantFilter)
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
