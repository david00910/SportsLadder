<template>
    <div class="clubs">
        <div class="preloader-background loading" v-if="loading">
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

        <div class="text-cyan text-accent-3">

            <div class="row">
                <div class="col s12 m6">
                <router-link v-if="$auth.check()" :to="{ name: 'clubs.create' }"><a class="waves-effect  blue accent-4 btn"><i
                    class="material-icons left">add</i>Create</a>
                </router-link>
                </div>
            </div>

            <div class="row">

                <div class="col s12 m6" v-for="club in clubs" v-bind:key="club.id">

                    <router-link class="hover" :to="{ name: 'clubs.show', params: {id: club.id}}">
                    <div id="cardId" class="card blue accent-4  darken-2">

                            <div class="card-image">
                                <img class="responsive-img" v-if="club.avatar_url" :src="club.avatar_url" alt="Club image">
                                <img class="responsive-img" v-else :src="'../images/defaultClub.png'" alt="Default club avatar">
                            </div>
                        <div class="card-content white-text">
                            <span class="card-title">{{club.name}}</span>
                            <p><i class="material-icons">
                                history
                            </i> Established in {{club.foundation_date}} by {{club.owner.first_name + ' ' + club.owner.last_name}}</p>

                            <h6><i class="material-icons">
                                room
                            </i> {{club.address_id.zipcode.city}}, {{club.address_id.country}}</h6>
                        </div>
                        <div v-if="$auth.user().owner" class="card-action">
                            <a v-if="$auth.user().role === 'administrator'" href="#">Manage</a>
                            <a v-else-if="$auth.user().owner.id === club.id" href="#">Manage my club</a>
                        </div>
                    </div>
                    </router-link>

                </div>
            </div>


        </div>
        <div class="divider cyan accent-3"></div>

        <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5"
                    @paginate="getClubs()"></pagination>

    </div>


</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                loading: false,
                clubs: '',
                pagination: {
                    'current_page': 1
                }
            };
        },


        methods: {
            getClubs() {
                //const params = {page};
                this.loading = true;

                axios.get('auth/clubs?page=' + this.pagination.current_page)
                    .then(response => {
                        this.clubs = response.data.data;
                        this.pagination = response.data.pagination;
                        this.loading = false;
                    }).catch(error => {
                    console.log(error.response.data);
                });
            },

        },
        mounted() {
            this.getClubs()

        },
    }

</script>

<style scoped>

    #cardId:hover {
        -webkit-transform: scale(1.01);
        transform: scale(1.01);

    }

    .preloader-background {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(20, 20, 20, 0.692);

        position: absolute;
        z-index: 2;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }


</style>

