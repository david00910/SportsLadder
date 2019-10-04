<template>
    <div class="clubsmanager">

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
            <div class="center">
                <div class="center">
                    <ul class="tabs cyan-text transparent ">
                        <li class="tab col"><a class="active" href="#test1"><i class="material-icons left">edit</i>information</a>
                        </li>
                        <li class="tab col"><a href="#test2"><i class="material-icons left">photo</i>avatar</a></li>
                        <li class="tab col"><a href="#test3"><i class="material-icons left">supervisor_account</i>members</a>
                        </li>
                        <li class="tab col"><a href="#test4"><i class="material-icons left">supervisor_account</i>club
                            events</a></li>
                    </ul>
                </div>
                <div class="section">
                    <h6 class="cyan-text">{{club.name}}</h6>
                </div>

                <div id="test1" class="col s12">
                    <h6>Change the avatar/logo of this club</h6>
                    <small class="red-text">Remember! <br> The old one will be deleted permanently.</small>
                </div>
                <div id="test2" class="col s12">Test 2</div>
                <div id="test3" class="col s12">Test 3</div>
                <div id="test4" class="col s12">Test 4</div>
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
                    console.log(error);
                });
            },


        },

        mounted() {
            this.getClub();
            M.AutoInit();
        },

        created() {
        },


    }


</script>

<style scoped>

</style>
