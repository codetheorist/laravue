import Vue from 'vue';
import VueRouter from 'vue-router';
import Store from './store';
import jwtToken from './helpers/jwt-token';
Vue.use(VueRouter);

const Dashboard = () => import('./components/admin/Dashboard.vue')
const Welcome = () => import('./components/frontend/Welcome.vue')
const Login = () => import('./components/frontend/auth/Login.vue')
const Profile = () => import('./components/admin/users/Profile.vue')
const RestaurantList = () => import('./components/admin/restaurants/RestaurantList.vue')
const RestaurantWrapper = () => import('./components/admin/restaurants/RestaurantWrapper.vue')
const RestaurantSettingsWrapper = () => import('./components/admin/restaurants/RestaurantSettingsWrapper.vue')
const RestaurantForm = () => import('./components/admin/restaurants/RestaurantForm.vue')
const UserList = () => import('./components/admin/users/UserList.vue')
const Register = () => import('./components/frontend/auth/Register.vue')
const Permissions = () => import('./components/admin/users/Permissions.vue')
const AdminWrapper = () => import('./components/admin/AdminWrapper.vue')
const FrontendWrapper = () => import('./components/frontend/FrontendWrapper.vue')

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
                    name: 'admin.dashboard',
                    component: Dashboard,
                    meta: {
                        requiresPermission: 'view_admin_dashboard',
                        requiresAuth: true
                    }
                },
                {
                    path: 'profile',
                    name: 'admin.profile',
                    component: Profile,
                    meta: {
                        title: 'Profile',
                        requiresAuth: true
                    }
                },
                {
                    path: 'user-list',
                    name: 'admin.user-list',
                    component: UserList,
                    meta: {
                        requiresPermission: 'manage_users',
                        requiresAuth: true
                    }
                },
                {
                    path: 'restaurants',
                    component: RestaurantWrapper,
                    meta: {
                        requiresAuth: true
                    },
                    children: [
                        {
                            path: '',
                            name: 'admin.restaurants',
                            component: RestaurantList,
                            meta: {
                                requiresPermission: 'manage_restaurants',
                                requiresAuth: true
                            },
                        },
                        {
                            path: 'new',
                            name: 'admin.restaurants.new',
                            component: RestaurantForm,
                            meta: {
                                requiresAuth: true
                            },
                        },
                        {
                            path: ':id',
                            component: RestaurantSettingsWrapper,
                            meta: {
                                requiresAuth: true
                            },
                            children: [
                                {
                                    path: 'edit',
                                    name: 'admin.restaurants.edit',
                                    component: RestaurantForm,
                                    meta: {
                                        requiresAuth: true
                                    }
                                },
                            ]
                        }
                    ]
                },
                {
                    path: 'roles',
                    name: 'admin.roles',
                    component: Permissions,
                    meta: {
                        requiresPermission: 'manage_roles',
                        requiresAuth: true
                    }
                },
                {
                    path: 'permissions',
                    name: 'admin.permissions',
                    component: Permissions,
                    meta: {
                        requiresPermission: 'manage_permissions',
                        requiresAuth: true
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
                    return next({name: 'admin.profile'});
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
