<template>

    <div class="white-text">

        <div class="row">

            <form class="col s12 white-text" @submit.prevent="store">
                <div class="row">

                    <div class="input-field col s12 m6">

                        <h6 class="red-text" v-if="err">Winner</h6>

                        <h6 v-else>Winner</h6>

                        <select v-model="selectedWinner" class="browser-default">

                            <option v-for="user in users" v-bind:value="{ wid: user.id}" value="">{{
                                'ID: ' + user.id + ' - ' +
                                user.first_name + ' ' + user.last_name

                                + ' - Ranking: ' + user.ranking


                                }}
                            </option>

                        </select>

                    </div>

                    <div class="input-field col s12 m6">
                        <h6 class="red-text" v-if="err">Loser</h6>

                        <h6 v-else>Loser</h6>
                        <select v-model="selectedLoser" class="browser-default">

                            <option v-bind:value="{ lid: user.id}" v-for="user in users" value="" class="left">{{
                                'ID: ' + user.id + ' - ' +
                                user.first_name + ' ' + user.last_name

                                + ' - Ranking: ' + user.ranking


                                }}
                            </option>

                        </select>

                </div>
                <div class="row">



                    </div>

                    <div class="input-field col s2">
                        <h6>Result</h6>
                        <select v-model="selectedResult" id="result" class="browser-default">
                            <option v-bind:value="{ result: '3-0'}" selected>3-0</option>
                            <option v-bind:value="{ result: '3-1'}">3-1</option>
                            <option v-bind:value="{ result: '3-2'}">3-2</option>
                        </select>
                    </div>

                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect cyan accent-3 black-text" type="submit">Create
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
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

                this.$http.post('auth/result/store', {
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

            getUsers() {

                this.loading = true;

                axios.get('auth/result/create/users')
                    .then(response => {
                        this.users = response.data;
                        this.loading = false;
                    }).catch(error => {
                    console.log(error.response.data);
                });
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
