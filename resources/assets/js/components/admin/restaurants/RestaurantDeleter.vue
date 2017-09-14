<template>
  <div class="modal fade" :id="'delete-' + restaurant.id" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal()"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Restaurant</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete {{ restaurant.display_name }}?</p>
          <form @submit.prevent="deleteRestaurant(restaurant.id)">
            <div class="form-group">
              <button @click.prevent="closeModal()" class="btn btn-cancel">Cancel</button>
              <button type="submit" class="btn btn-danger">Delete Restaurant</button>
            </div>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</template>
<script>
  // var slug = require('slug');
  // slug.defaults.mode = 'rfc3986';
  // import {mapState} from 'vuex'
  export default {
    name: 'restaurant-deleter',
    data() {
      return {
        id: this.$props.restaurant.id,
        display_name: this.$props.restaurant.display_name,
        isDeleting: 0
      }
    },
    mounted () {
      // When the modal window is hidden, remove the restaurant from the 'isEditing' data paramter
      // Bind this to ensure the view state gets updated properly
      $('#delete-' + this.$props.restaurant.id).modal('show')
      $('#delete-' + this.$props.restaurant.id).on('hidden.bs.modal', function (event) {
        this.$emit('close-modal', 'delete')
      }.bind(this))
    },
    props: {
      restaurant: {
        type: Object,
        default: () => null
      }
    },
    methods: {
      deleteRestaurant(id) {
          axios.delete(route('api.restaurants.destroy', id))
            .then(response => {
              console.log('Done')
              // dispatch('loadUsers')
              // dispatch('deleteMenuItemSuccess', response.data);
            })
            .catch(error => {
              console.log('Error')
              // dispatch('deleteMenuItemFailure', error.response.data);
            });
          this.closeModal()
      },
      closeModal() {
        $('#delete-' + this.$props.restaurant.id).modal('hide')
        // this.$emit('close-modal', 'delete')
      }
    }
  }
</script>
<style lang="scss">

</style>
