import * as api from './../../config';
import jwtToken from './../../helpers/jwt-token';
import * as types from './../../mutation-types';
import Store from './../index';

export default {
    state: {
        error: ''
    },
    mutations: {
        [types.LOGIN_SUCCESS] (state, payload) {
            state.error = null;
        },
        [types.LOGIN_FAILURE] (state, payload) {
            state.error = payload.error ? payload.error : null;
        },
        [types.CLEAR_LOGIN_ERRORS] (state, payload) {
            state.error = null;
        }
    },
    actions: {
        loginRequest: ({dispatch}, formData) => {
            return new Promise((resolve, reject) => {
                axios.post(api.login, formData)
                    .then(response => {
                        dispatch('loginSuccess', response.data);
                        resolve();
                    })
                    .catch(error => {

                        console.log(error.response.data)
                        // if (error) {
                        //     console.log(error)
                        // }

                        dispatch('loginFailure', error.response.data);
                        reject();
                    });
            });
        },
        loginSuccess: ({commit, dispatch}, jwtTokenObj) => {
            jwtToken.setToken(jwtTokenObj.token);

            commit({
                type: types.LOGIN_SUCCESS
            });
            dispatch('showSuccessNotification', 'Login Successful!');
            dispatch('setAuthUser');
        },
        loginFailure: ({commit, dispatch}, body) => {
            commit({
                type: types.LOGIN_FAILURE,
                error: body.error
            });

            if(body) {
                dispatch('showErrorNotification', body.error);
            }
        },
        clearLoginErrors: ({commit}) => {
            commit({
                type: types.CLEAR_LOGIN_ERRORS
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
