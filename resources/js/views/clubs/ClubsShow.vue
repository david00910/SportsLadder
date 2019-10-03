<template>
    <div class="clubsshow">

        <div class="preloader-background loading center" v-if="loading">
            <div class="preloader-wrapper active">
                <div class="spinner-layer spinner-cyan-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="col"><img :src="'../'+club.avatar_url" class="responsive-img"
                                      style="border: 2px solid whitesmoke !important; max-height: 300px !important;"
                                      alt=""></div>
                <div class="col">
                    <h3>{{club.name}}</h3>
                    <h5><i class="material-icons">gavel</i> Since {{club.foundation_date}}</h5>
                    <h5><i class="material-icons">stars</i> {{club.owner_user.first_name}} {{club.owner_user.last_name}}
                    </h5>
                    <h6><i class="material-icons">room</i> {{club.club_address.zipcode.city}},
                        {{club.club_address.country}}</h6>
                </div>

            </div>
        </div>
        <div class="divider accent-3"></div>
        <div class="row">
            <div class="center">
                <ul class="tabs tabs-transparent">
                    <li class="tab"><a class="active" href="#overview">Overview</a></li>
                    <li class="tab"><a href="#members">Members</a></li>
                    <li class="tab disabled"><a href="#">Club Events</a></li>
                    <li class="tab disabled"><a href="#">Statistics</a></li>
                </ul>
            </div>


            <div class="col s12" id="overview">
                <h5>OVERVIEW</h5>
                <p>{{club.about}}</p>
            </div>


            <div class="row">


                <div class="col s12 center-align " style="background-color: #080808 !important;" id="members">

                    <h5 style="margin-bottom: 20px;">MEMBERS</h5>

                    <div v-if="club.club_members.length">

                        <carousel :per-page="4">

                            <slide v-for="c in club.club_members" v-bind:key="c. id">
                                <div class="col">
                                    <img
                                        class="responsive-img z-depth-3"
                                        style=" background-repeat: no-repeat;
                                        background-position: 50%;
                                        border: 2px solid #0091ea;
                                        " :src="'../images/gsd.jpg'" alt="Club member profile picture">
                                    <h6>{{c.first_name}} {{c.last_name}}</h6>
                                    <small>Since {{c.pivot.doa}}</small>
                                    <br>
                                    <router-link :to="{ name: 'profile' }">
                                        <div class="btn grey darken-4">View</div>
                                    </router-link>
                                </div>

                            </slide>
                        </carousel>
                        <div class="btn btn-small grey darken-4" style="margin-top: 15px;"
                             v-if="$auth.user().role === 'administrator' || $auth.user().owner.id === club.id"><i
                            class="material-icons md-24">
                            person_add
                        </i></div>
                    </div>

                    <div v-else style="padding: 15px;">
                        <h6 style="margin-bottom: 15px;">There are no club members yet.</h6>
                        <div v-if="$auth.user().role === 'administrator' || $auth.user().owner.id === club.id"
                             class="addMember"><h6 class="center"><i class="material-icons md-48">
                            add
                        </i></h6></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import axios from 'axios';

    export default {

        data() {
            return {
                loading: false,
                club: '',
            };
        },

        methods: {
            getClub() {

                this.loading = true;

                axios.get('auth/club/' + this.$route.params.id)
                    .then(response => {
                        this.club = response.data;
                        this.loading = false;
                    }).catch(error => {
                    console.log('fasz');
                });
            },

        },

        mounted() {
            this.getClub();
        },

        created() {

            M.AutoInit();
        },


    }


</script>

<style scoped>
    .material-icons.md-24 {
        color: #0091ea;
        cursor: pointer;
        font-size: 40px;
    }

    .material-icons.md-24:hover {
        color: cyan !important;
    }

    .material-icons.md-48 {
        font-size: 60px;
        padding: 8px;
        color: #0091ea;
    }

    .material-icons.md-48:hover {
        color: cyan !important;
    }

    .addMember {
        border: 2px solid #0091ea;
        width: 100px;
        height: 100px;
        cursor: pointer;
        margin: 0 auto !important;
    }

    .addMember:hover {
        border: 2px solid cyan;
    }
</style>
