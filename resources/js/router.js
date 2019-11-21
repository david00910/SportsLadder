import VueRouter from 'vue-router'


import Register from './views/auth/SignUp';
import Login from './views/auth/SignIn';
import Dashboard from './views/admin/Dashboard';
import Home from './views/Home';
import Profile from './views/auth/Profile'
import UsersIndex from './views/users/UsersIndex';
import UsersShow from './views/users/UsersShow';
import UsersEdit from './views/users/UsersEdit';
import NotFound from './views/layout/NotFound';
import ResultsIndex from './views/results/ResultsIndex';
import ResultsShow from './views/results/ResultsShow';
import ResultsCreate from './views/results/ResultsCreate';
import ClubsIndex from "./views/clubs/ClubsIndex";
import ClubsCreate from "./views/clubs/ClubsCreate";
import ClubsShow from "./views/clubs/ClubsShow";
import ClubsManager from "./views/clubs/ClubsManager";
import NoPermission from './views/layout/NoPermission';
import Notifications from './views/auth/Notifications';



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



        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                auth: undefined
            }
        },

        // USERS

        {
          path:'/profile',
          name: 'profile',
          component: Profile,
          meta: {
              auth: true
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


        {
            path: '/users/:id/edit',
            name: 'users.edit',
            component: UsersEdit,
            meta: {
                auth: true
            }
        },

        //RESULTS
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
            path: '/results/create',
            name: 'results.create',
            component: ResultsCreate,
            meta: {
                auth: true
            }
        },

        // CLUBS

        {
          path: '/clubs',
          name: 'clubs.index',
          component: ClubsIndex,
          meta: {
              auth: true
          }
        },
        {
            path: '/clubs/create',
            name: 'clubs.create',
            component: ClubsCreate,
            meta: {
                auth: true
            }
        },
        {
            path: '/clubs/:id',
            name: 'clubs.show',
            component: ClubsShow,
            meta: {
                auth: true
            }
        },
        {
            path: '/clubs/manager/:id',
            name: 'clubs.manager',
            component: ClubsManager,
            meta: {
                auth: true
            }
        },

        //MISC
        {
            path: '/403',
            name: '403',
            component: NoPermission,
        },
        {
            path: '/notifications',
            name: 'notifications',
            component: Notifications,
        },

        { path: '/404', name: '404', component: NotFound },
        { path: '*', redirect: '/404' },
    ],
});
  export default router
