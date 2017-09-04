import Vue from 'vue';
import VueRouter from 'vue-router';
import Store from './store';
import jwtToken from './helpers/jwt-token';
Vue.use(VueRouter);

const Welcome = () => import('./components/Welcome.vue')
const Login = () => import('./components/Login.vue')
const Profile = () => import('./components/Profile.vue')
const Register = () => import('./components/Register.vue')

const scrollBehavior = (to, from, savedPosition) => {
  if (savedPosition) {
    return savedPosition
  } else {
    const position = {}
    if (to.hash) {
      position.selector = to.hash
      if (to.hash === '#anchor2') {
        position.offset = { y: 100 }
      }
    }
    if (to.matched.some(m => m.meta.scrollToTop)) {
        position.x = 0
        position.y = 0
    } else {
        position.x = 0
        position.y = 0
    }
    return position
  }
}

const router = new VueRouter({
    mode: 'history',
    //scrollBehavior,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Welcome,
            meta: {}
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                title: 'Register',
                requiresGuest: true
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                title: 'Login',
                requiresGuest: true
            }
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            meta: {
                title: 'Profile',
                requiresAuth: true
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    Store.dispatch('hideErrorNotification');

    if(to.meta.requiresAuth) {
        if(Store.state.auth.user.authenticated || jwtToken.getToken()){
            return next();

        }
        else {
            return next({name: 'login'});

        }
    }
    if(to.meta.requiresGuest) {
        if(Store.state.auth.user.authenticated || jwtToken.getToken()) {
            return next({name: 'profile'});
        }
        else {
            return next();

        }
    }
    return next();
});

export default router;
