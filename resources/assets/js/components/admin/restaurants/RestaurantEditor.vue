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
        <li>Restaurants</li>
        <li class="active" v-text="this.$props.restaurant ? 'Edit Restaurant' : 'New Restaurant'"></li>
      </ol>
      <restaurant-editor v-if="isEditing === true" @close-modal="closeModal"></restaurant-editor>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title" v-text="this.$props.restaurant ? 'Edit Restaurant' : 'New Restaurant'"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form @submit.prevent="updateRestaurant($event)">
                <div class="form-group">
                  <label class="control-label" for="display_name">Title</label>
                  <input type="text" id="display_name" class="form-control" name="display_name" v-model="display_name" required>
                  <p class="help-block">{{ name }}</p>
                </div>
                <div class="form-group">
                  <label class="control-label" for="description">Description</label>
                  <textarea id="description" class="form-control" name="description" rows="5" v-model="description" required></textarea>
                </div>
                <div class="form-group">
                  <button @click.prevent="closeModal()" class="btn btn-cancel">Cancel</button>
                  <button type="submit" class="btn btn-primary">Update Menu Category</button>
                </div>
              </form>
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
  var slug = require('slug');
  slug.defaults.mode = 'rfc3986';
  import {mapState} from 'vuex'
  export default {
    name: 'restaurant-editor',
    data() {
      return {
        id: this.$props.restaurant ? this.$props.restaurant.id : '',
        display_name: this.$props.restaurant ? this.$props.restaurant.display_name : '',
        name: this.$props.restaurant ? this.$props.restaurant.name : '',
        description: this.$props.restaurant ? this.$props.restaurant.description : '',
        isEditing: 0
      }
    },
    mounted () {
      var tag = this.$props.restaurant ? 'edit-' + this.$props.restaurant.id : 'new-restaurant'
      console.log(this.$route)
      if (this.$route.params && this.$route.params.id) {
        this.getRestaurant(this.$route.params.id)
      }
    },
    watch: {
      display_name: function (value) {
        this.name = slug(value)
      }
    },
    props: {
      restaurant: {
        type: Object,
        default: () => null
      }
    },
    methods: {
      getRestaurant(id) {
        axios.get(route('api.restaurants.show', id))
          .then(response => {
            console.log(response)
          }).then(data => {
            this.data = data;
          })
      },
      updateRestaurant(event) {
        var tag = this.$props.restaurant ? 'edit-' + this.$props.restaurant.id : 'new-restaurant'
        const formData = {
          display_name: this.display_name,
          name: this.name,
          description: this.description
        };
        if(!this.$props.restaurant) {
          axios.post(route('api.restaurants.store'), formData)
            .then(response => {
              console.log('Done')
              this.closeModal()
              // dispatch('loadUsers')
              // dispatch('deleteMenuItemSuccess', response.data);
            })
            .catch(error => {
              console.log('Error')
              // dispatch('deleteMenuItemFailure', error.response.data);
            });
          console.log(formData)
        } else {
          console.log(formData)
          axios.post(route('api.restaurants.update', this.$props.restaurant.id), formData)
            .then(response => {
              console.log('Done')
              this.closeModal()
              // dispatch('loadUsers')
              // dispatch('deleteMenuItemSuccess', response.data);
            })
            .catch(error => {
              console.log('Error')
              // dispatch('deleteMenuItemFailure', error.response.data);
            });
        }
      },
      closeModal() {
        // var tag = this.$props.restaurant ? 'edit-' + this.$props.restaurant.id : 'new-restaurant'
        // $('#' + tag).modal('hide')
        this.$router.push({ name: 'admin.restaurants.index' })
        // this.$emit('close-modal', 'edit', this.$props.restaurant.id)
      }
    }
  }
</script>
<style lang="scss">

</style>
