import * as api from './../../config';
import jwtToken from './../../helpers/jwt-token';
import * as types from './../../mutation-types';
import login from './login';
import register from './register';
import user from './auth-user';
import profile from "./edit-profile";
import password from "./edit-password";

export default {
  modules: {
    login,
    password,
    // profile,
    register,
    user
  }
}
