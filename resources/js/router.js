import VueRouter from 'vue-router'


import Register from './views/SignUp';
import Login from './views/SignIn';
import Hello from './views/Hello';
import Home from './views/Home';
import UsersIndex from './views/UsersIndex';
import UsersShow from './views/UsersShow';
import UsersEdit from './views/UsersEdit';
import NotFound from './views/NotFound';
import ResultsIndex from './views/ResultsIndex';
import ResultsShow from './views/ResultsShow';
import NoPermission from './views/NoPermission';



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
            path: '/hello',
            name: 'hello',
            component: Hello,
            meta: {
                auth: true
            }
        },



        {
            path: '/users',
            name: 'users.index',
            component: UsersIndex,
            meta: {
                auth: undefined
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
                auth: true
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
