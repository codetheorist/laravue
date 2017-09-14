<template>
  <div id="restaurant-form">
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title" v-text="id !== null ? 'General Settings' : 'New Restaurant'"></h3>
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
                  <button type="submit" class="btn btn-primary" v-text="id ? 'Update Restaurant' : 'Create Restaurant'"></button>
                </div>
              </form>
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
  import {mapState, mapGetter} from 'vuex'
  export default {
    name: 'restaurant-form',
    watch: {
      display_name: function (value) {
        this.name = slug(value)
      }
    },
    mounted () {
      console.log(this.$route)
      if (this.$route.params && this.$route.params.id) {
        this.getRestaurant(this.$route.params.id)
      }

    },
    methods: {
      getRestaurant(id) {
        axios.get(route('api.restaurants.show', id))
          .then(response => {
            this.display_name = response.data.display_name ? response.data.display_name : ''
            this.name = response.data.name ? response.data.name : ''
            this.description = response.data.description ? response.data.description : ''
            console.log(response)
          }).then(data => {
            this.data = data;
          })
      },
      updateRestaurant(event) {
        const formData = {
          display_name: this.display_name,
          name: this.name,
          description: this.description
        };
        if(this.$route.params && this.$route.params.id) {
          console.log(formData)
          axios.post(route('api.restaurants.update', this.$route.params.id), formData)
            .then(response => {
              console.log('Done')
              this.$router.push({ name: 'admin.restaurants' })
              // this.closeModal()
              // dispatch('loadUsers')
              // dispatch('deleteMenuItemSuccess', response.data);
            })
            .catch(error => {
              console.log('Error')
              // dispatch('deleteMenuItemFailure', error.response.data);
            });
        } else {
          console.log(formData)
          axios.post(route('api.restaurants.store'), formData)
            .then(response => {
              console.log('Done')
              this.$router.push({ name: 'admin.restaurants' })
              // this.closeModal()
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
        this.$router.push({ name: 'admin.restaurants' })
        // this.$emit('close-modal', 'edit', this.$props.restaurant.id)
      }
    },
    data () {
      return {
        id: this.$route.params.id ? this.$route.params.id : null,
        // display_name: this.$props.restaurant ? this.$props.restaurant.display_name : '',
        // name: this.$props.restaurant ? this.$props.restaurant.name : '',
        // description: this.$props.restaurant ? this.$props.restaurant.description : '',
        display_name: '',
        name: '',
        description: ''
      }
    }
  }
</script>
