<template>

    <div id="navigation" style="z-index:9999;">

        <nav id="topnav" class="black">
            <div class="nav-wrapper ">
                <a href="#" class="brand-logo right">MyLadder Manager</a><span class="badge cyan white-text">BETA</span>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li><router-link :to="{ name: 'notifications'}"  style="cursor: pointer !important; padding: 0 7px 0 7px !important;"><i class="small material-icons cyan-text text-accent-3 shake">vibration</i></router-link>
                    </li>

                    <li><router-link :to="{ name: 'notifications'}"  style="cursor: pointer !important; padding: 0 7px 0 7px !important;"><i class="small material-icons cyan-text text-accent-4">vibration</i></router-link>
                    </li>
                </ul>

            </div>
        </nav>

        <div id="slide-out" class="sidenav sidenav-fixed black">

            <div class="container center-align" style="padding-top:15px;">

                <router-link :to="{ name: 'profile' }"><img class="responsive-img center-align z-depth-3"
                                                            style=" background-repeat: no-repeat;
                                        background-position: 50%;
                                        border-radius: 50%;
                                        width: 150px;
                                        height: 150px;" :src="'/images/gsd.jpg'"></router-link>

                <router-link :to="{ name: 'profile' }" v-if="$auth.check()"><h5 class="white-text center-align">Hi
                    {{$auth.user().user.first_name}}</h5>

                    <h6 class="white-text" v-if="$auth.user().role === 'club_owner'">Owner of <br>
                        <small>'{{$auth.user().owner.name}}'</small></h6>
                    <h6 class="white-text" v-else-if="$auth.user().role === 'administrator'">Administrator</h6>
                    <h6 v-else>{{$auth.user().role}}</h6>
                </router-link>


            </div>

            <ul>
                <li>
                    <div class="divider cyan accent-3"></div>

                    <router-link v-if="$auth.check()" id="resultButton"
                                 class="resultbtn cyan accent-3 black-text btn-large" style="border-radius: 10px;"
                                 :to="{ name: 'results.create' }"><i
                        class="material-icons black-text" style="font-size:40px;">play_circle_filled_white</i>New
                        Result
                    </router-link>
                </li>

                <li class="hoverover">

                    <router-link class="white-text" :to="{ name: 'home' }"><i class="material-icons white-text"
                                                                              style="font-size:36px;">home</i>Home
                    </router-link>
                </li>
                <li class="hoverover">
                    <router-link class="white-text" :to="{ name: 'results.index' }"><i class="material-icons white-text"
                                                                                       style="font-size:36px;">assignment</i>Match
                        results
                    </router-link>
                </li>
                <li class="hoverover">
                    <router-link v-if="$auth.check()" class="white-text" :to="{ name: 'users.index' }"><i
                        class="material-icons white-text"
                        style="font-size:36px;">supervised_user_circle</i>Leaderboard
                    </router-link>
                </li>
                <li class="hoverover">
                    <router-link v-if="$auth.check()" class="white-text" :to="{ name: 'clubs.index' }"><i
                        class="material-icons white-text"
                        style="font-size:36px;">group_work</i>Clubs
                    </router-link>
                </li>
                <li class="hoverover">
                    <router-link v-if="$auth.check()" class="white-text" :to="{ name: 'dashboard' }"><i
                        class="material-icons white-text"
                        style="font-size:36px;">event</i> Global events
                    </router-link>
                </li>
                <li class="hoverover">
                    <router-link class="white-text" :to="{ name: 'home' }"><i class="material-icons white-text"
                                                                              style="font-size:36px;">info</i>About
                    </router-link>
                </li>

            </ul>
            <div class="divider cyan accent-3"></div>
            <ul>

                <li class="hoverover" v-if="$auth.check() && $auth.user().role === 'administrator'">
                    <router-link class="white-text" :to="{ name: 'dashboard' }"><i class="material-icons white-text"
                                                                                   style="font-size:36px;">settings</i>ADMIN
                        DASHBOARD
                    </router-link>
                </li>

                <li class="hoverover" v-if="$auth.check() && $auth.user().role === 'administrator' || $auth.check() && $auth.user().role === 'club_owner'">
                    <router-link class="white-text" :to="{ name: 'clubs.manager', params: {id: $auth.user().owner.id} }"><i class="material-icons white-text"
                                                                                   style="font-size:36px;">star</i>CLUB MANAGER
                    </router-link>
                </li>


                <li class="hoverover" v-if="$auth.check()">
                    <a class="white-text" id="logout-link" href="#" @click.prevent="logOut"><i
                        class="material-icons white-text"
                        style="font-size:36px;">exit_to_app</i>Logout</a>
                </li>


                <li class="hoverover" v-if="!$auth.check()">
                    <router-link class="white-text" :to="{ name: 'login' }"><i class="material-icons white-text"
                                                                               style="font-size:36px;">person</i>Sign in
                    </router-link>
                </li>

                <li class="hoverover" v-if="!$auth.check()">
                    <router-link class="white-text" :to="{ name: 'signup' }"><i class="material-icons white-text"
                                                                                style="font-size:36px;">person</i>Sign
                        up
                    </router-link>
                </li>

            </ul>


        </div>
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>

</template>

<script>
    import axios from 'axios';

    export default {
        data: () => ({

            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            user: {},
        }),
        mounted() {

        },

        created() {
            //return this.getMe();
        },

        fetch() {

        },

        methods: {

            /*getMe () {
                //const params = {page};
                this.loading = true;

                this.$http.get('auth/me/')
                    .then(response => {
                        this.user = response.data.user;
                        this.roles = response.data.roles;
                        this.loading = false;
                    }) .catch(error => {
                    console.log(error.response.data);
                });
            },*/


            logOut: function (event) {

                this.$auth.logout({

                    success: function () {
                        // handle redirection
                        localStorage.removeItem('token');
                        localStorage.removeItem('expiration');
                        this.$router.push({name: 'login'})
                    },
                    error: function () {
                        localStorage.removeItem('token');
                        app.has_error = true
                    }

                });

            },


        }

    }


    // Navbar collapse
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
    });
</script>


<style scoped>

    #topnav {

        padding-left: 300px;
        border-radius: 2px;
    }

    @media only screen and (max-width: 992px) {
        #main {
            padding-left: 0;
        }
    }

    .brand-logo {
        padding-left: 15px !important;
        padding-right: 15px !important;
        font-family: 'Montserrat', sans-serif !important;
    }

    #nav-mobile {
        padding-left: 15px !important;

    }

    #nav-mobile .hoverover:hover {
        background-color: rgba(0, 110, 255, 0.13);
    }

    .hoverover:hover {
        background-color: rgba(0, 110, 255, 0.13);
    }

    .resultbtn:hover {
        color: white !important;
        -webkit-transform: scale(1.01);
        transform: scale(1.01);
    }

    @-webkit-keyframes shake-bottom {
        0%,
        100% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
            -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
        }
        10% {
            -webkit-transform: rotate(2deg);
            transform: rotate(2deg);
        }
        20%,
        40%,
        60% {
            -webkit-transform: rotate(-4deg);
            transform: rotate(-4deg);
        }
        30%,
        50%,
        70% {
            -webkit-transform: rotate(4deg);
            transform: rotate(4deg);
        }
        80% {
            -webkit-transform: rotate(-2deg);
            transform: rotate(-2deg);
        }
        90% {
            -webkit-transform: rotate(2deg);
            transform: rotate(2deg);
        }
    }
    @keyframes shake-bottom {
        0%,
        100% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
            -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
        }
        10% {
            -webkit-transform: rotate(2deg);
            transform: rotate(2deg);
        }
        20%,
        40%,
        60% {
            -webkit-transform: rotate(-4deg);
            transform: rotate(-4deg);
        }
        30%,
        50%,
        70% {
            -webkit-transform: rotate(4deg);
            transform: rotate(4deg);
        }
        80% {
            -webkit-transform: rotate(-2deg);
            transform: rotate(-2deg);
        }
        90% {
            -webkit-transform: rotate(2deg);
            transform: rotate(2deg);
        }
    }
    .shake {
        -webkit-animation: shake-bottom 0.9s steps(5, end) infinite both;
        animation: shake-bottom 0.9s steps(5, end) infinite both;
    }

</style>
