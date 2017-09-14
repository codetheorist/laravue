import store from './../index';
import * as types from './../../mutation-types';

export default {
    state: {
        restaurants: []
    },
    getters: {
        getRestaurants: (state, getters) => {
            return state.restaurants
        }
    },
    mutations: {
      loadRestaurants(state, restaurants) {
        state.restaurants = restaurants
      }
    },
    actions: {
      loadRestaurants ({commit, dispatch}) {
        axios.get(route('api.restaurants.index'))
        .then(response => {
          commit('loadRestaurants', response.data)
        })
        .catch(error => {
        })
      }
    }
}
