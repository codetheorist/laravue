import jwtToken from './../../helpers/jwt-token';
import * as types from './../../mutation-types';
// initial state
// shape: [{ id, quantity }]
const state = {
  signups_display: 'week',
  signups: [],
  logins_display: 'week',
  logins: [],
  sales_display: 'week',
  sales: []
}
// getters
const getters = {
}
// actions
const actions = {
  loadAllStats ({commit, dispatch}) {
    axios.get(route('api.stats.index'))
    .then(response => {
      console.log(response)
      commit('loadAllStats', response.data)
    })
    .catch(error => {
    })
  }
}
// mutations
const mutations = {
  [types.LOAD_ALL_STATS] (state, payload) {
    console.log(payload);
    state.signups = payload.signups;
  },
  loadAllStats(state, stats) {
    console.log(stats)
    state.signups = stats.signups
  }
}
export default {
  state,
  getters,
  actions,
  mutations
}
