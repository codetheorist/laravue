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
        jwt: null,
        roles: null,
        permissions: null
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
        [types.SET_AUTH_USER] (state, payload) {
            state.authenticated = true;
            state.username = payload.user.user.username;
            state.first_name = payload.user.user.first_name;
            state.last_name = payload.user.user.last_name;
            state.email = payload.user.user.email;
            state.jwt = payload.user.jwt;
            state.roles = payload.user.roles;
            state.permissions = payload.user.permissions;
        },
        [types.UNSET_AUTH_USER] (state, payload) {
            state.authenticated = false;
            state.username = null;
            state.first_name = null;
            state.last_name = null;
            state.email = null;
            state.jwt = null;
            state.roles = null;
            state.permissions = null;
        }
    },
    actions: {
        setAuthUser: ({state, commit, dispatch}) => {
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
