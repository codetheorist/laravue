<template>
  <form v-if="street === null" class="form-horizontal">
    <div class="form-group">
      <label for="finder" class="col-sm-3 control-label">Search</label>

      <div class="col-sm-9">
        <vue-google-autocomplete :enable-geolocation="true" id="finder" classname="form-control" placeholder="Start typing" v-on:placechanged="getAddressData"></vue-google-autocomplete>
      </div>
    </div>
  </form>
  <form v-else class="form-horizontal" @submit.prevent="saveAddress()">
    <div class="form-group">
      <label for="street" class="col-sm-3 control-label">Street</label>

      <div class="col-sm-9">
        <input type="text" name="street" class="form-control" id="street" placeholder="Street" v-model="street">
      </div>
    </div>
    <div class="form-group">
      <label for="town" class="col-sm-3 control-label">Town</label>

      <div class="col-sm-9">
        <input type="text" name="town" class="form-control" id="town" placeholder="Town" v-model="town">
      </div>
    </div>
    <div class="form-group">
      <label for="city" class="col-sm-3 control-label">City</label>

      <div class="col-sm-9">
        <input type="text" name="city" class="form-control" id="city" placeholder="City" v-model="city">
      </div>
    </div>
    <div class="form-group">
      <label for="country" class="col-sm-3 control-label">Country</label>

      <div class="col-sm-9">
        <input type="text" name="country" class="form-control" id="country" placeholder="Country" v-model="country">
      </div>
    </div>
    <div class="form-group">
      <label for="postcode" class="col-sm-3 control-label">Post Code</label>

      <div class="col-sm-9">
        <input type="text" name="postcode" class="form-control" id="postcode" placeholder="Post Code" v-model="postcode">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-9">
        <button type="submit" @click="closeForm()" class="btn btn-danger">Save</button>
        <button type="cancel" @click.prevent="closeForm()"class="btn btn-secondary">Cancel</button>
      </div>
    </div>
  </form>

</template>
<script>
  import VueGoogleAutocomplete from 'vue-google-autocomplete'
  //This function is exactly the same as your data function for the component originally was



  export default {
    name: 'address-form',
    data () {
      return {
        street: null,
        town: '',
        city: '',
        country: '',
        postcode: '',
        address: {},
        place: {},
        formattedPlace: null
      }
    },
    components: {
      VueGoogleAutocomplete
    },
    methods: {
      closeForm () {
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
            this.street = formattedPlace.street_number + ' ' + formattedPlace.route
          }
          if(formattedPlace.postal_town) {
            this.town = formattedPlace.postal_town
          }
          if(formattedPlace.administrative_area_level_2) {
            this.city = formattedPlace.administrative_area_level_2
          }
          if(formattedPlace.country) {
            this.country = formattedPlace.country
          }
          if(formattedPlace.postal_code_prefix) {
            this.postcode = formattedPlace.postal_code_prefix
          }
          // this.ItemAddress = placeResultData.street_number + placeResultData.route
      },
      resetAuthUser() {
        this.$store.dispatch('setAuthUser')
      },
      saveAddress() {
        const formData = {
            street: this.street,
            town: this.town,
            city: this.city,
            country: this.country,
            postcode: this.postcode
        };

        this.$store.dispatch('createAddress', formData)
        .then((response) => {
          this.$emit('form-saved');
            //this.$router.push({name: 'admin.profile'});
        })
        .catch(() => {});
        if(this.formattedPlace) {
        }

        // this.$data = defaultData();
      }
    }
  }
</script>
