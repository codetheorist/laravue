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
    },
    actions: {
    }
}
