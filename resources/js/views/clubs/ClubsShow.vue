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
                <div class="col"><img :src="'../images/gsd.jpg'" class="responsive-img"
                                      style="border: 2px solid whitesmoke !important;width:200px !important; height:200px !important;"
                                      alt=""></div>
                <div class="col">
                    <h5>{{club.name}}</h5>
                    <p>{{club.foundation_date}}</p>
                    <p>{{club.owner_user.first_name}} {{club.owner_user.last_name}}</p>
                    <p>{{club.club_address.zipcode.city}}, {{club.club_address.country}}</p>
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


                <div class="col s12 center-align" id="members" >
                    <div class="divider accent-3"></div>
                    <h5 style="margin-bottom: 20px;">MEMBERS</h5>

                    <carousel :per-page="4" v-if="club.club_members">
                        <slide v-for="c in club.club_members" v-bind:key="c. id">
                                <div class="col">
                                <img
                                    class="responsive-img z-depth-3"
                                    style=" background-repeat: no-repeat;
                                        background-position: 50%;
                                        border: 2px solid whitesmoke;
                                        " :src="'../images/gsd.jpg'">
                                    <h6>{{c.first_name}} {{c.last_name}}</h6>
                                    <small>Since {{c.pivot.doa}}</small>
                                    <br>
                            <router-link :to="{ name: 'profile' }">
                                <div class="btn">View</div>
                                </router-link>
                                </div>

                        </slide>
                    </carousel>

                    <h6 v-else>There are no members yet.</h6>

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
