<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="/images/default.png" alt="User profile picture">

              <h3 class="profile-username text-center">{{ user.first_name }} {{ user.last_name }}</h3>

              <p class="text-muted text-center">{{ user.occupation }}</p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#addresses" data-toggle="tab">Address<small>(es)</small></a></li>
              <li><a href="#profile" data-toggle="tab">Edit Profile</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="addresses">
                <div class="row">
                  <div class="col-sm-12">
                    <button class="btn" :class="addressForm === false ? 'btn-primary' : 'btn-secondary'" style="float: right; margin-bottom: 1rem;" @click.prevent="showForm(true)"><i class="fa fa-plus"></i></button>
                    <div v-if="addressForm !== false" class="address-form">
                      <address-form @form-saved="formSaved"></address-form>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div v-if="user.adresses !== []" v-for="(address, index) in user.addresses" class="col-sm-6 col-lg-4">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">{{ address.street }}</h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" @click.prevent="removeAddress(address.id)"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <p>
                          <span v-if="address.street" class="street">{{ address.street }} <br></span>
                          <span v-if="address.town" class="town">{{ address.town }} <br></span>
                          <span v-if="address.city" class="street">{{ address.city }} <br></span>
                          <span v-if="address.country" class="street">{{ address.country }} <br></span>
                          <span v-if="address.postcode" class="street">{{ address.postcode }} <br></span>
                        </p>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">Edit</button>
                      </div>
                      <!-- /.box-footer-->
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="profile">
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
                      <button type="cancel" @click.prevent="resetAuthUser()"class="btn btn-secondary">Cancel</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>
    <!-- /.content -->
</template>
<script>
  import {mapState} from 'vuex';
  import * as types from './../mutation-types';
  import AddressForm from './AddressForm.vue'
  import * as api from './../config';
  export default {
    name: 'profile',
    data () {
      return {
        addressId: null,
        addressForm: false
      }
    },
    components: {
      AddressForm
    },
    mounted () {
      this.$store.dispatch('setAuthUser');
      // you don't have to use props like I did with this.model, you could read from a vuex getter
      console.log('copied info from model prop to local formData')
    },
    computed: {
      first_name: {
          get() {
              return this.$store.state.auth.user.first_name;
          },
          set (value) {
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
          set (value) {
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
          set (value) {
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
          set (value) {
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
          set (value) {
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
      formSaved () {
        this.addressForm = false
      },
      showForm(value) {
        if(value === this.addressForm) {
          this.addressForm = false
        } else {
          this.addressForm = value
        }
      },
      removeAddress (id) {
        this.$store.dispatch('removeAddress', id)
        .then((response) => {
          // this.$router.push({name: 'profile'});
        })
        .catch((error) => {
        });
        let $this = this;
        setTimeout(function() {
          $this.$store.dispatch('setAuthUser');
        }, 250);
      },
      getAddressData: function (addressData, placeResultData) {
          this.address = addressData;
          this.place = placeResultData;
          let formattedPlace = {};
          console.log(placeResultData.address_components)
          for( var i = 0, iLen = placeResultData.address_components.length; i < iLen; i++) {
            formattedPlace[placeResultData.address_components[i].types[0]] = placeResultData.address_components[i].long_name
          }
          this.formattedPlace = formattedPlace

          if(formattedPlace.street_number && formattedPlace.route) {
            this.ItemAddress = formattedPlace.street_number + ' ' + formattedPlace.route
          }
          if(formattedPlace.administrative_area_level_2) {
            this.ItemCity = formattedPlace.administrative_area_level_2
          }
          if(formattedPlace.postal_code_prefix) {
            this.ItemZip = formattedPlace.postal_code_prefix
          }
          // this.ItemAddress = placeResultData.street_number + placeResultData.route
      },
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
              this.$router.push({name: 'profile'});
          })
          .catch(() => {});
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
