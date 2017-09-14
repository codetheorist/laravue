<template>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Manage Addresses</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="active tab-pane" id="addresses">
              <div class="row">
                <div class="col-sm-12">
                  <button class="btn" :class="addressForm === false ? 'btn-primary' : 'btn-secondary'" style="float: right; margin-bottom: 1rem;" @click.prevent="showForm(true)">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="row">
                <div v-if="addressForm !== false" class="address-form col-lg-12">
                  <address-form @form-saved="formSaved"></address-form>
                </div>
              </div>
              <div v-if="user.adresses !== []" class="row">
                <div v-for="(address, index) in user.addresses" class="col-sm-6 col-lg-4" :key="index">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">{{ address.street }}</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" @click.prevent="removeAddress(address.id)">
                          <i class="fa fa-times"></i>
                        </button>
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

          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</template>
<script>
import {mapState} from 'vuex'
import AddressForm from './../../shared/AddressForm.vue'
export default {
  name: 'profile-addresses',
  data() {
    return {
      addressId: null,
      addressForm: false
    }
  },
  components: {
    AddressForm
  },
  computed: {
    ...mapState({
      user: state => state.auth.user
    })
  },
  methods: {
    formSaved() {
      this.addressForm = false
    },
    showForm(value) {
      if (value === this.addressForm) {
        this.addressForm = false
      } else {
        this.addressForm = value
      }
    },
    removeAddress(id) {
      this.$store.dispatch('removeAddress', id)
        .then((response) => {
          // this.$router.push({name: 'admin.profile'});
        })
        .catch((error) => {
        });
      let $this = this;
      setTimeout(function() {
        $this.$store.dispatch('setAuthUser');
      }, 250);
    },
    getAddressData: function(addressData, placeResultData) {
      this.address = addressData;
      this.place = placeResultData;
      let formattedPlace = {};
      console.log(placeResultData.address_components)
      for (var i = 0, iLen = placeResultData.address_components.length; i < iLen; i++) {
        formattedPlace[placeResultData.address_components[i].types[0]] = placeResultData.address_components[i].long_name
      }
      this.formattedPlace = formattedPlace

      if (formattedPlace.street_number && formattedPlace.route) {
        this.ItemAddress = formattedPlace.street_number + ' ' + formattedPlace.route
      }
      if (formattedPlace.administrative_area_level_2) {
        this.ItemCity = formattedPlace.administrative_area_level_2
      }
      if (formattedPlace.postal_code_prefix) {
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
