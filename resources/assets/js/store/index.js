import Vue from 'vue';
import Vuex from 'vuex';

import notification from "./modules/notification";
import auth from "./modules/auth"
import permissions from "./modules/permissions"
import users from "./modules/users"
import addresses from "./modules/addresses"
import restaurants from "./modules/restaurants"
Vue.use(Vuex);

const getters = {
}

const actions = {
}

export default new Vuex.Store({
  getters,
  actions,
  modules: {
    auth,
    addresses,
    notification,
    permissions,
    users,
    restaurants
  },
  strict: true
});
