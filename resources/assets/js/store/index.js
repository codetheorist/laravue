import Vue from 'vue';
import Vuex from 'vuex';

import notification from "./modules/notification";
import auth from "./modules/auth"
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
    notification
  },
  strict: true
});
