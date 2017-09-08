import jwtToken from './../../helpers/jwt-token';
import * as types from './../../mutation-types';
// initial state
// shape: [{ id, quantity }]
const state = {
  users: []
}
// getters
const getters = {
}
// actions
const actions = {
  deleteUserRequest: ({dispatch}, id) => {
    return new Promise((resolve, reject) => {
      axios.delete(route('api.users.delete', id))
        .then(response => {
          console.log('Done')
          dispatch('loadUsers')
          // dispatch('deleteMenuItemSuccess', response.data);
          resolve();
        })
        .catch(error => {
          console.log('Error')
          // dispatch('deleteMenuItemFailure', error.response.data);
          reject();
        });
      })
  },
  loadUsers ({commit, dispatch}) {
    axios.get(route('api.users.index'))
    .then(response => {
      commit('loadUsers', response.data)
    })
    .catch(error => {
    })
  }
}
// mutations
const mutations = {
  [types.LOAD_USERS] (state, payload) {
    state.users = payload.value;
  },
  loadUsers(state, users) {
    state.users = users
  }
}
export default {
  state,
  getters,
  actions,
  mutations
}
