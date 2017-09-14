<template>
  <div>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Profile</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form @submit.prevent="updateProfile()" class="form-horizontal">
                <div class="form-group">
                  <label for="first_name" class="col-sm-2 control-label">First Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="first_name" placeholder="First Name" v-model="first_name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="last_name" class="col-sm-2 control-label">Last Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="last_name" placeholder="Last Name" v-model="last_name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="username" class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" placeholder="Username" disabled v-model="username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="Email" v-model="email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="occupation" class="col-sm-2 control-label">Occupation</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="occupation" placeholder="Occupation" v-model="occupation">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </div>



</template>
<script>
import { mapState } from 'vuex';
import * as types from './../../../mutation-types';
export default {
  name: 'profile-editor',
  mounted () {
    this.$store.dispatch('setAuthUser');
  },
  destroyed () {
    this.$store.dispatch('setAuthUser');
  },
  computed: {
    first_name: {
      get() {
        return this.$store.state.auth.user.first_name;
      },
      set(value) {
        this.$store.commit({
          type: types.UPDATE_AUTH_USER_FIRST_NAME,
          value
        });
      }
    },
    last_name: {
      get() {
        return this.$store.state.auth.user.last_name;
      },
      set(value) {
        this.$store.commit({
          type: types.UPDATE_AUTH_USER_NAME,
          value
        });
      }
    },
    username: {
      get() {
        return this.$store.state.auth.user.username;
      },
      set(value) {
        this.$store.commit({
          type: types.UPDATE_AUTH_USER_USERNAME,
          value
        });
      }
    },
    email: {
      get() {
        return this.$store.state.auth.user.email;
      },
      set(value) {
        this.$store.commit({
          type: types.UPDATE_AUTH_USER_EMAIL,
          value
        });
      }
    },
    occupation: {
      get() {
        return this.$store.state.auth.user.occupation;
      },
      set(value) {
        this.$store.commit({
          type: types.UPDATE_AUTH_USER_OCCUPATION,
          value
        });
      }
    },
    ...mapState({
      user: state => state.auth.user
    })
  },
  methods: {
    resetAuthUser() {
      this.$store.dispatch('setAuthUser')
    },
    updateProfile() {
      // uncomment the following 2 lines to enable edit profile
      // alert('Edit Profile is disabled for demo purpose');
      // return;

      const formData = {
        id: this.$store.state.auth.user.authenticated,
        first_name: this.first_name,
        last_name: this.last_name,
        username: this.username,
        occupation: this.occupation,
        email: this.email
      };

      this.$store.dispatch('updateProfileRequest', formData)
        .then(() => {
          console.log(formData)
          this.$router.push({ name: 'admin.profile' });
        })
        .catch(() => { });
    },
    save() {
      //dispatch to vuex or whatever you use to hold state
      console.log('Saving formData')
      this.$log('formData')
    },
    reset() {
      // reset the formData to the original values from model.
      console.log('resetting formdata')
      // this.formData  = this.$store.getters.getAuthUser()
      this.$log('formData')
    }
  }
}
</script>
