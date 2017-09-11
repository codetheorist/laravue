import Vue from 'vue';
import VueRouter from 'vue-router';
import Store from './store';
import jwtToken from './helpers/jwt-token';
Vue.use(VueRouter);

const Dashboard = () => import('./components/Dashboard.vue')
const Welcome = () => import('./components/Welcome.vue')
const Login = () => import('./components/Login.vue')
const Profile = () => import('./components/Profile.vue')
const RestaurantList = () => import('./components/RestaurantList.vue')
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
                    component: Dashboard,
                    meta: {
                        requiresPermission: 'view_admin_dashboard'
                    }
                },
                {
                    path: 'profile',
                    name: 'profile',
                    component: Profile,
                    meta: {
                        title: 'Profile',
                        requiresAuth: true
                    }
                },
                {
                    path: 'user-list',
                    name: 'user-list',
                    component: UserList,
                    meta: {
                        requiresPermission: 'manage_users'
                    }
                },
                {
                    path: 'restaurants',
                    name: 'restaurants',
                    component: RestaurantList,
                    meta: {
                        requiresPermission: 'manage_restaurants'
                    }
                },
                {
                    path: 'roles',
                    name: 'roles',
                    component: Permissions,
                    meta: {
                        requiresPermission: 'manage_roles'
                    }
                },
                {
                    path: 'permissions',
                    name: 'permissions',
                    component: Permissions,
                    meta: {
                        requiresPermission: 'manage_permissions'
                    }
                }

            ]
        }
    ]
});

router.beforeEach((to, from, next) => {
    Store.dispatch('setAuthUser')

    function loginCheck(type, name = null) {
        Store.dispatch('setAuthUser')
        setTimeout(function() {
            let user = Store.state.auth.user

            if (type === 'auth' && (user.authenticated || jwtToken.getToken())) {
                return next();
            } else if (type === 'auth' && (!user.authenticated || !jwtToken.getToken())) {
                return next({name: 'login'});
            }

            if (type === 'guest' && (!user.authenticated &&  !jwtToken.getToken())) {
                return next();
            } else if (type === 'guest' && (user.authenticated || jwtToken.getToken())) {
                return next({name: 'login'});
            }

            if(user.authenticated || jwtToken.getToken()){

                if(Store.state.auth.user[type + 's'].indexOf('admin') !== -1){
                    return next();
                }

                if(user[type + 's'].indexOf(name) === -1) {
                    Store.dispatch('showErrorNotification', 'You don\'t have permission for that.' );
                    return next({name: 'profile'});
                }

                return next();
            } else {
                return next({name: 'login'});
            }
        }, 250)
    }

    if(to.meta.requiresAuth) {
        loginCheck('auth')
    }

    if(to.meta.requiresGuest) {
        loginCheck('guest')
    }

    if(to.meta.requiresRole !== undefined) {
        loginCheck('role', to.meta.requiresRole)
    }
    if(to.meta.requiresPermission !== undefined) {
        loginCheck('permission', to.meta.requiresPermission)
    }

    return next();
});

export default router;
