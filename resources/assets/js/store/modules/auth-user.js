import store from './../index';
import * as api from './../../config';
import * as types from './../../mutation-types';

export default {
    state: {
        authenticated: false,
        username: null,
        first_name: null,
        last_name: null,
        email: null,
        occupation: null,
        jwt: null,
        roles: [],
        permissions: [],
        addresses: []
    },
    getters: {
        getAuthUser: (state, getters) => {
            return state
        },
        getUserRoles: (state, getters) => {
            return state.roles
        },
        getUserPermissions: (state, getters) => {
            return state.permissions
        }
    },
    mutations: {
        [types.UPDATE_AUTH_USER_USERNAME] (state, payload) {
            state.username = payload.value;
        },
        [types.UPDATE_AUTH_USER_FIRST_NAME] (state, payload) {
            state.first_name = payload.value;
        },
        [types.UPDATE_AUTH_USER_LAST_NAME] (state, payload) {
            state.last_name = payload.value;
        },
        [types.UPDATE_AUTH_USER_EMAIL] (state, payload) {
            state.email = payload.value;
        },
        [types.UPDATE_AUTH_USER_OCCUPATION] (state, payload) {
            state.occupation = payload.value;
        },
        [types.SET_AUTH_USER] (state, payload) {
            state.authenticated = payload.user.user.id;
            state.username = payload.user.user.username;
            state.first_name = payload.user.user.first_name;
            state.last_name = payload.user.user.last_name;
            state.email = payload.user.user.email;
            state.occupation = payload.user.user.occupation;
            state.jwt = payload.user.jwt;
            state.addresses = payload.user.addresses;
            state.roles = payload.user.roles;
            state.permissions = payload.user.permissions;
        },
        [types.UNSET_AUTH_USER] (state, payload) {
            state.authenticated = false;
            state.username = null;
            state.first_name = null;
            state.last_name = null;
            state.email = null;
            state.occupation = null;
            state.jwt = null;
            state.addresses = [];
            state.roles = [];
            state.permissions = [];
        }
    },
    actions: {
        updateProfileRequest: ({dispatch}, formData) => {
            return new Promise((resolve, reject) => {
                axios.post(api.apiDomain + '/user', formData)
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
        },
        setAuthUser: ({state, commit, dispatch}) => {
            console.log('Set Auth User')
            axios.get(api.currentUser)
                .then(response => {
                    commit({
                        type: types.SET_AUTH_USER,
                        user: response.data
                    })
                })
                .catch(error => {
                    dispatch('logoutRequest');
                })
        },
        unsetAuthUser: ({commit}) => {
            commit({
                type: types.UNSET_AUTH_USER
            });
        }
    }
}
