import store from './../index';
import * as api from './../../config';
import * as types from './../../mutation-types';

export default {
    state: {
        addresses: []
    },
    getters: {
        getUserAddresses: (state, getters) => {
            return state.addresses
        },
        getUserAddressById: (state, getters) => {
            return state.addresses
        }
    },
    mutations: {
        [types.UPDATE_ADDRESS] (state, payload) {
            state.addresses[payload.id] = payload;
        }
    },
    actions: {
        removeAddress: ({dispatch}, id) => {
          return new Promise((resolve, reject) => {
            axios.delete(api.apiDomain + '/addresses/' + id)
              .then(response => {
                // dispatch('deleteMenuItemSuccess', response.data);
                resolve();
              })
              .catch(error => {
                // dispatch('deleteMenuItemFailure', error.response.data);
                reject();
              });
            })
        },
        createAddress: ({dispatch}, formData) => {
            return new Promise((resolve, reject) => {
                axios.post(api.createAddress, formData)
                    .then(response => {
                        // dispatch('updateProfileSuccess', response.data);
                        dispatch('setAuthUser')
                        resolve();
                    })
                    .catch(error => {
                        // dispatch('updateProfileFailure', error.response.data);
                        reject();
                    });
            })
        }

    }
}
