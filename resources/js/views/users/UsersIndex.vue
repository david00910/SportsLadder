<template>

    <div class="users">

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
            <div class="divider cyan accent-3"></div>

            <table v-if="users" class="responsive-table highlight">
                <thead>
                <tr class="cyan-text text-accent-3">
                    <th>Avatar</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Ranking</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="user in users" v-bind:key="user.id">
                    <td><img id="avatar" v-if="user.avatar_url" :src="'./'+user.avatar_url"
                             class="circle responsive-img" alt="">
                        <img class="circle responsive-img" id="defaultAvatar" v-else :src="'./images/defaultClub.png'"
                             alt="Default club avatar"></td>
                    <td>{{ user.id }}</td>
                    <td>{{ user.first_name }} {{ user.last_name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.ranking }}</td>
                    <td>
                        <!-- Only if logged in user is admin-->
                        <router-link v-if="$auth.user().role === 'administrator'"
                                     :to="{ name: 'users.edit', params: {id: user.id} }"><i
                            class="small material-icons">settings </i></router-link>

                        <router-link :to="{ name: 'users.show', params: {id: user.id} }"><i
                            class="small material-icons">info</i></router-link>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="divider cyan accent-3"></div>
        </div>


        <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5"
                    @paginate="getUsers()"></pagination>


    </div>


</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                loading: false,
                /*users: null,
                meta: null,
                links: {
                    first: null,
                    last: null,
                    next: null,
                    prev: null,
                },
                error: null,
                has_error: false,*/
                users: {},
                pagination: {
                    'current_page': 1
                }
            };
        },


        methods: {
            getUsers() {
                //const params = {page};
                this.loading = true;

                axios.get('auth/users?page=' + this.pagination.current_page)
                    .then(response => {
                        this.users = response.data.data.data;
                        this.pagination = response.data.pagination;
                        this.loading = false;
                    }).catch(error => {
                    console.log(error.response.data);
                });
            },


        },
        mounted() {
            this.getUsers()

        },
    }

</script>


<style scoped>
    table.highlight > tbody > tr:hover {
        background-color: rgba(114, 171, 180, 0.158);
        /* whatever color you want */
    }

    table.highlight > tbody > tr {
        color: white;
        border-color: rgba(0, 110, 255, 0.13);
        font-weight: 600;
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

    #avatar {

        max-height: 70px !important;
    }

    #defaultAvatar {

        max-height: 70px !important;
    }
</style>
