export default {
    setToken(token) {
        // this.$store.state.login.jwt = token;
        window.localStorage.setItem('jwt_token', token);
    },
    getToken() {
        return window.localStorage.getItem('jwt_token');
    },
    removeToken() {
        window.localStorage.removeItem('jwt_token');
    }
}
