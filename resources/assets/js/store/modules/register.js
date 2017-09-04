import * as api from './../../config';
import jwtToken from './../../helpers/jwt-token';
import * as types from './../../mutation-types';

export default {
    state: {
        errors: {
            first_name: null,
            last_name: null,
            username: null,
            email: null,
            password: null
        }
    },
    mutations: {
        [types.REGISTER_SUCCESS] (state, payload) {
            state.errors.first_name = null;
            state.errors.last_name = null;
            state.errors.username = null;
            state.errors.email = null;
            state.errors.password = null;
        },
        [types.REGISTER_FAILURE] (state, payload) {
            state.errors.first_name = payload.errors.first_name ? payload.errors.first_name[0] : null;
            state.errors.last_name = payload.errors.last_name ? payload.errors.last_name[0] : null;
            state.errors.username = payload.errors.username ? payload.errors.username[0] : null;
            state.errors.email = payload.errors.email ? payload.errors.email[0] : null;
            state.errors.password = payload.errors.password ? payload.errors.password[0] : null;
        },
        [types.CLEAR_REGISTER_ERRORS] (state, payload) {
            state.errors.first_name = null;
            state.errors.last_name = null;
            state.errors.username = null;
            state.errors.email = null;
            state.errors.password = null;
        }
    },
    actions: {
        registerRequest: ({dispatch}, formData) => {
            return new Promise((resolve, reject) => {
                console.log(formData)
                axios.post(api.register, formData)
                    .then(response => {
                        console.log(response.data.token)
                        dispatch('registerSuccess', response.data);
                        resolve();
                    })
                    .catch(error => {
                        //dispatch('registerFailure', error.response.data);
                        reject();
                    });
            });
        },
        registerSuccess: ({commit, dispatch}, jwtTokenObj) => {
            jwtToken.setToken(jwtTokenObj.token);

            commit({
                type: types.REGISTER_SUCCESS
            });

            dispatch('setAuthUser');
        },
        registerFailure: ({commit, dispatch}, body) => {
            commit({
                type: types.REGISTER_FAILURE,
                errors: body
            });

            if(body.error) {
                dispatch('showErrorNotification', body.error);
            }
        },
        clearRegisterErrors: ({commit}) => {
            commit({
                type: types.CLEAR_REGISTER_ERRORS
            });
        },
        logoutRequest: ({dispatch}) => {
            jwtToken.removeToken();

            return new Promise((resolve, reject) => {
                dispatch('unsetAuthUser');
                resolve();
            });
        }
    }
}
