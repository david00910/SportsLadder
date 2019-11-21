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

        <h6 class="cyan-text" v-if="output">{{output.msg}}</h6>
        <h6 class="red-text" v-if="err">Error: {{err}}</h6>

        <div class="col">
            <h5>CLUB MANAGER<span class="badge cyan white-text">BETA</span></h5>
        </div>


        <div class="row">
            <tabs class="tabs-component" style="display:inline !important;" :options="{ useUrlFragment: false }">
                <tab name="Change general information">
                    <div class="divider cyan accent-3"></div>

                    <section id="information"  style="margin-top: 15px;" v-if="club" class="col s12">

                        <p class="yellow-text right">Modify the field(s) you want to update.</p>

                        <form  class="white-text" @submit.prevent="storeInformation">

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="name" type="text" name="name" v-model="club.name"
                                           class="validate white-text" required>
                                    <label class="active" for="name">Name</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                <textarea id="about" name="about" class="white-text"
                                          v-model="club.about"></textarea>
                                    <label class="active" for="about">About</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <input  id="foundation_date" type="number" min="1830" :max="currentY"
                                           name="foundation_date" class="validate white-text"
                                           v-model="club.foundation_date" required>

                                    <label class="active" for="foundation_date">Year of Establishment <small>(Between
                                        1830-{{currentY}})</small></label>

                                </div>

                            </div>

                            <h5 class="center cyan-text">Address</h5>

                            <div class="row">
                                <div class="input-field col s6">
                                    <input  id="street" type="text" name="street" class="validate white-text"
                                           v-model="club.club_address.street" required>
                                    <label class="active" for="street">Street</label>
                                </div>

                                <div class="input-field col s6">
                                    <input  id="zip" type="text" name="zip" class="validate white-text"
                                           v-model="club.club_address.pCode" required>
                                    <label class="active" for="zip">Postal Code</label>
                                </div>
                            </div>


                            <div class="row">
                                <div class="input-field col s6">
                                    <input  id="city" type="text" name="city" class="validate white-text"
                                           v-model="club.club_address.zipcode.city" required>
                                    <label class="active" for="city">City</label>
                                </div>

                                <div class="input-field col s6">
                                    <input  id="country" type="text" name="country" class="validate white-text"
                                           v-model="club.club_address.country"
                                           required>
                                    <label class="active" for="country">Country</label>
                                </div>
                            </div>

                            <div class="row">
                                <div v-if="club" class="input-field col s12">
                                    <button class="btn waves-effect cyan accent-3 black-text" type="submit">
                                        Update
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>


                            <h6  class="cyan-text" v-if="output">{{output.msg}}</h6>
                            <h6  class="red-text" v-if="err">Error: {{err}}</h6>
                        </form>
                    </section>
                </tab>
                <tab name="Change avatar">
                    <div class="col s12">
                        <h6>Change the avatar/logo of this club</h6>
                        <form @submit.prevent="storeImage" enctype="multipart/form-data">
                            <br>
                            <i class="material-icons md-36">photo</i>
                            <span>Logo/Avatar</span>
                            <input type="file" name="image" accept="image/*" v-on:change="onFileChange">

                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect cyan accent-3 black-text" type="submit">
                                        Upload
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                            <h6 class="cyan-text" v-if="output">{{output.msg}}</h6>
                            <h6 class="red-text" v-if="err">Error: {{err}}</h6>
                        </form>

                    </div>
                </tab>

                <tab name="Manage members">
                    <div class="col s12">

                        <div class="row">
                        <h6 class="center">Manage club members</h6>
                        <p class="center">On this tab you can view, add and remove players to/from your club.</p>
                        </div>
                        <a class="waves-effect waves-cyan btn" style="border-radius: 0 !important;" v-on:click="addNew"><i class="material-icons left">add</i>MEMBER</a>
                        <transition name="fade">
                            <div v-if="addMember">
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
                                        <td><img id="avatar1" v-if="user.avatar_url" :src="'/'+user.avatar_url"
                                                 class="circle responsive-img" alt="">
                                            <img class="circle responsive-img" id="defaultAvatar1" v-else :src="'/images/defaultClub.png'"
                                                 alt="Default club avatar"></td>
                                        <td>{{ user.id }}</td>
                                        <td>{{ user.first_name }} {{ user.last_name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.ranking }}</td>
                                        <td>
                                            <!-- Only if logged in user is admin-->

                                            <router-link class="btn btn blue-grey" :to="{ name: 'users.show', params: {id: user.id} }">Info</router-link>

                                            <div style="cursor:pointer;" class="btn" @click="inviteMember(user.id)" v-if="$auth.user().role === 'administrator' || $auth.user().owner.id === club.id">Invite</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5"
                                            @paginate="getUsers()"></pagination>

                                <a class="waves-effect waves-cyan btn" @click="addNewClose">Close</a>
                            </div>
                        </transition>

                        <div class="divider cyan accent-3"></div>

                        <table v-if="club.club_members.length" class="responsive-table highlight">
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
                            <tr v-for="c in club.club_members" v-bind:key="c. id">
                                <td><img id="avatar" v-if="c.avatar_url" :src="'/'+c.avatar_url" class="circle responsive-img" alt="">
                                    <img class="circe responsive-img" id="defaultAvatar" v-else :src="'/images/defaultClub.png'"
                                         alt="Default club avatar"></td>
                                <td>{{ c.id }}</td>
                                <td>{{ c.first_name }} {{ c.last_name }}</td>
                                <td>{{  c.email }}</td>
                                <td>{{  c.ranking }}</td>
                                <td>
                                    <!-- Only if logged in user is admin-->
                                    <div style="cursor:pointer;" v-if="$auth.user().role === 'administrator' || $auth.user().owner.id === club.id" v-on:click="deleteConfirm = true" ><i class="small red-text material-icons">delete_forever</i></div>
                                    <div v-show="deleteConfirm">
                                    <button class="btn-small red" @click="deleteMember(c.id)">Confirm</button>
                                    <button class="btn-small grey" @click="deleteConfirm = false">Cancel</button>
                                    </div>
                                        <router-link :to="{ name: 'users.show', params: {id: c.id} }"><i class="small material-icons">info</i></router-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h5 class="center" v-else>There are no members yet.</h5>

                    </div>
                </tab>

                <tab name="Manage club events">
                    <div class="col s12">

                    </div>
                </tab>
            </tabs>
        </div>
    </div>

</template>

<script>
    import axios from 'axios';

    export default {

        data() {
            return {

                addMember: false,
                deleteConfirm: false,
                loading: false,
                club:[ null,
                    {
                        name: null,
                        about: null,
                        foundation_date: null,
                        club_address: {
                            pCode: null,
                            street: null,
                            zipcode: {
                                zip: null,
                                city: null,
                            },
                            country: null,
                        }

                    }],
                currentY: new Date().getFullYear(),
                image: '',
                output: '',
                err: '',
                users: {},
                pagination: {
                    'current_page': 1
                }
            };
        },


        methods: {

            addNew() {

                this.loading = true;
                this.addMember = true;
                let id = this.club.id;

                    axios.get('auth/clubs/members/?page=' + this.pagination.current_page)
                        .then(response => {
                            this.users = response.data.data.data;
                            this.pagination = response.data.pagination;
                            this.loading = false;
                        }) .catch(error => {
                        console.log(error.response.data);
                    });
                    this.loading = false;

            },

            addNewClose() {
              this.addMember = false;
            },

            deleteMember(id) {
                //this.loading = true;

                this.$http.post('auth/clubs/member/delete/' + id, {
                    club: this.club.id
                })

                    .then(response => {
                        this.output = response.data;
                        this.err = response.data.err;
                        const cMemberIndex = this.club.club_members.findIndex(c => c.id === id);
                        this.club.club_members.splice(cMemberIndex, 1);
                        this.deleteConfirm = false;
                        this.loading = false;
                        var self = this;
                        setTimeout(function(){
                            self.output = false;
                        }, 4000);
                    })
                    .catch(error => {
                        this.output = error;
                        this.loading = false;
                        var self = this;
                        setTimeout(function(){
                            self.output = false;
                        }, 4000);
                    })

            },

            inviteMember(id) {
                //this.loading = true;

                this.$http.post('auth/clubs/member/invite/' + id, {
                    club: this.club.id
                })

                    .then(response => {
                        this.output = response.data;
                        this.err = response.data.err;
                        this.loading = false;

                        var self = this;
                        setTimeout(function(){
                            self.output = false;
                        }, 4000);
                    })
                    .catch(error => {
                        this.output = error;
                        this.loading = false;
                        var self = this;
                        setTimeout(function(){
                            self.output = false;
                        }, 4000);
                    })

            },

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
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            storeImage() {

                this.loading = true;

                this.$http.post('auth/clubs/edit/image/' + this.$route.params.id, {
                    image: this.image

                })

                    .then(response => {
                        this.output = response.data;
                        this.err = response.data.err;
                        this.loading = false;
                        var self = this;
                        setTimeout(function(){
                            self.output = false;
                        }, 4000);
                    })
                    .catch(error => {
                        this.output = error;
                        this.loading = false;
                    })


            },
            storeInformation() {

                this.loading = true;

                this.$http.post('auth/clubs/edit/general/' + this.$route.params.id, {
                    name: this.club.name,
                    about: this.club.about,
                    foundation_date: this.club.foundation_date,
                    street: this.club.club_address.street,
                    zip: this.club.club_address.pCode,
                    city: this.club.club_address.zipcode.city,
                    country: this.club.club_address.country,

                })

                    .then(response => {
                        this.output = response.data;
                        this.err = response.data.err;
                        this.loading = false;
                        var self = this;
                        setTimeout(function(){
                            self.output = false;
                        }, 4000);

                    })
                    .catch(error => {
                        this.output = error;
                        this.loading = false;
                        setTimeout(function(){
                            self.output = false;
                        }, 4000);
                    })


            },


        },

        mounted() {
            this.getClub();
            M.updateTextFields();
            M.AutoInit();
        },

        created() {

        },


    }


</script>

<style scoped>

    table.highlight>tbody>tr:hover {
        background-color: rgba(114, 171, 180, 0.158);
        /* whatever color you want */
    }
    table.highlight>tbody>tr {
        color: white;
        border-color: rgba(0, 110, 255, 0.13);
        font-weight:600;
    }

    #avatar {

        max-height: 70px !important;
    }

    #defaultAvatar {

        max-height: 70px !important;
    }

    .displayed {
        display: none;
    }

    .addBtn {
        border: 1px solid cyan;
        border-radius: 10px;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }

    #avatar1 {

        max-height: 70px !important;
    }

    #defaultAvatar1 {

        max-height: 70px !important;
    }
</style>
