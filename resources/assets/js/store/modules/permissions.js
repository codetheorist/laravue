import jwtToken from './../../helpers/jwt-token';
import * as types from './../../mutation-types';
// initial state
// shape: [{ id, quantity }]
const state = {
  roles: [],
  permissions: []
}
// getters
const getters = {
    roleById: (state, getters) => (id) => {
      return state.roles.filter(role => role.id == id)
    },
    allRoles: (state, getters) => (id) => {
      let rolenames = []
      state.roles.forEach(function(role) {
        rolenames.push(role.name)
      })

      return rolenames
    }
}
// actions
const actions = {
  loadPermissions ({commit, dispatch}) {
    axios.get(route('api.permissions.index'))
    .then(response => {
      commit('loadPermissions', response.data)
    })
    .catch(error => {
    })
  },
  loadRoles ({commit, dispatch}) {
    axios.get(route('api.roles.index'))
    .then(response => {
      commit('loadRoles', response.data)
    })
    .catch(error => {
    })
  },
  syncRole ({commit, dispatch}, data) {
    if (data.checked === true) {
      console.log(data)
      axios.post(api.attachPermission, data)
      .then(response => {
        dispatch('loadRoles')
      })
      .catch(error => {
        console.log(error)
      })
    } else {

    }
  }
}
// mutations
const mutations = {
  [types.LOAD_PERMISSIONS] (state, payload) {
    state.permissions = payload.value;
  },
  loadPermissions(state, permissions) {
    state.permissions = permissions
  },
  [types.LOAD_ROLES] (state, payload) {
    state.roles = payload.value;
  },
  loadRoles(state, roles) {
    state.roles = roles
  }
}
export default {
  state,
  getters,
  actions,
  mutations
}
