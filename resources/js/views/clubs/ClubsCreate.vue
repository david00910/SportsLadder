<template>

    <div class="white-text">

        <div class="row">

            <form class="col s12 white-text" @submit.prevent="store">




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
                <h6 class="cyan-text" v-if="output">{{output.msg}}</h6>
                <h6 class="red-text" v-if="err">Error: {{err}}</h6>
            </form>
        </div>
    </div>
</template>


<script>

    export default {
        data() {
            return {
                users: {},
                selectedWinner: '',
                selectedLoser: '',
                selectedResult: '',
                output: '',
                loading: false,
                err: ''
            }
        },

        created() {
            this.getUsers();
        },

        mounted() {
            M.AutoInit();
        },


        methods: {
            store() {

                this.loading = true;

                this.$http.post('auth/club/store', {
                    winner_id: this.selectedWinner.wid,
                    loser_id: this.selectedLoser.lid,
                    result: this.selectedResult.result

                })

                    .then(response => {
                        this.output = response.data;
                        this.err = response.data.err;
                        this.loading = false;
                    })
                    .catch(error => {
                        this.output = error;
                        this.loading = false;
                    })


            },

        },


    }
</script>


<style scoped>
    .row input, label {
        color: white !important;
        border-color: cyan !important;
    }
</style>
