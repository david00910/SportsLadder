import VueRouter from 'vue-router'


import Register from './views/auth/SignUp';
import Login from './views/auth/SignIn';
import Dashboard from './views/admin/Dashboard';
import Home from './views/Home';
import UsersIndex from './views/users/UsersIndex';
import UsersShow from './views/users/UsersShow';
import UsersEdit from './views/users/UsersEdit';
import NotFound from './views/layout/NotFound';
import ResultsIndex from './views/results/ResultsIndex';
import ResultsShow from './views/results/ResultsShow';
import NoPermission from './views/layout/NoPermission';



const router = new VueRouter({
    mode: 'history',
    routes: [

        // PUBLIC ROUTES

        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                auth: undefined
            }
        },
        {
            path: '/signup',
            name: 'signup',
            component: Register,
            meta: {
                auth: false
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        },

        // USER ROUTES

        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                auth: undefined
            }
        },



        {
            path: '/users',
            name: 'users.index',
            component: UsersIndex,
            meta: {
                auth: true
            }

        },
        {
            path: '/user/:id',
            name: 'users.show',
            component: UsersShow,
            meta: {
                auth: true
            }
        },

        // ADMIN ROUTES
        {
            path: '/users/:id/edit',
            name: 'users.edit',
            component: UsersEdit,
            meta: {
                auth: true
            }
        },

        {
            path: '/results',
            name: 'results.index',
            component: ResultsIndex,
            meta: {
                auth: undefined
            }
        },
        {
            path: '/result/:id',
            name: 'results.show',
            component: ResultsShow,
            meta: {
                auth: true
            }
        },
        {
            path: '/403',
            name: '403',
            component: NoPermission,
        },

        { path: '/404', name: '404', component: NotFound },
        { path: '*', redirect: '/404' },
    ],
});
  export default router
