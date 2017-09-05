import Vue from 'vue';
import VueRouter from 'vue-router';
import Store from './store';
import jwtToken from './helpers/jwt-token';
Vue.use(VueRouter);

const Welcome = () => import('./components/Welcome.vue')
const Login = () => import('./components/Login.vue')
const Profile = () => import('./components/Profile.vue')
const UserList = () => import('./components/UserList.vue')
const Register = () => import('./components/Register.vue')
const Permissions = () => import('./components/Permissions.vue')
const AdminWrapper = () => import('./components/admin-wrapper/AdminWrapper.vue')
const FrontendWrapper = () => import('./components/frontend-wrapper/FrontendWrapper.vue')

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
            component: FrontendWrapper,
            meta: {},
            children: [
                {
                    path: '',
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
                }
            ]
        },
        {
            path: '/admin',
            component: AdminWrapper,
            children: [
                {
                    path: '',
                    name: 'dashboard',
                    component: Profile
                },
                {
                    path: 'profile',
                    name: 'profile',
                    component: Profile
                },
                {
                    path: 'user-list',
                    name: 'user-list',
                    component: UserList
                },
                {
                    path: 'roles',
                    name: 'roles',
                    component: Permissions
                },
                {
                    path: 'permissions',
                    name: 'permissions',
                    component: Permissions
                }

            ]
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
