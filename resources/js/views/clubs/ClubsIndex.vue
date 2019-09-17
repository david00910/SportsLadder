<template>
    <div class="results">
        <div class="preloader-background loading" v-if="loading">
            <div class="preloader-wrapper active">
                <div class="spinner-layer spinner-cyan-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>
            </div>
        </div>

        <div class="text-cyan text-accent-3">

            <div class="row">
                <div class="col s12 m6" v-for="club in clubs" v-bind:key="club.id">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">{{club.name}}</span>
                            <small>Founded in {{club.foundation_date}} by {{club.owner.first_name + ' ' + club.owner.last_name}}</small>
                            <p>{{club.address_id.country}}</p>
                        </div>
                        <div class="card-action">
                            <a href="#">Manage (Admin)</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="divider cyan accent-3"></div>
        </div>


        <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="getClubs()"></pagination>

    </div>


</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                loading: false,
                clubs: {},
                pagination: {
                    'current_page': 1
                }
            };
        },



        methods: {
            getClubs () {
                //const params = {page};
                this.loading = true;

                axios.get('auth/clubs?page=' + this.pagination.current_page)
                    .then(response => {
                        this.clubs = response.data.data;
                        this.pagination = response.data.pagination;
                        this.loading = false;
                    }) .catch(error => {
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

