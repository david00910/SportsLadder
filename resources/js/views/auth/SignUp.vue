<template>
    <div class="white-text">
        <div class="row">

            <form class="col s12 white-text" @submit.prevent="register">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" name="email" class="validate" v-model="email" required>
                        <label for="email">Email</label>
                        <div v-if="has_error && !success" class="text-danger">{{ errors.email[0] }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="first_name" type="text" name="first_name" class="validate" v-model="first_name" required>
                        <label for="first_name">First Name</label>
                        <div v-if="has_error && !success" class="text-danger">{{ errors.first_name[0] }}</div>
                    </div>
                    <div class="input-field col s6">
                        <input id="last_name" type="text" name="last_name" class="validate" v-model="last_name" required>
                        <label for="last_name">Last Name</label>
                        <div v-if="has_error && !success" class="text-danger">{{ errors.last_name[0] }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="password" type="password" name="password" class="validate" v-model="password" required>
                        <label for="password">Password</label>
                        <div v-if="has_error && !success" class="text-danger">{{ errors.password[0] }}</div>
                    </div>

                    <div class="input-field col s6">
                        <input id="password_confirmation" type="password" name="password_confirmation" class="validate"
                               v-model="password_confirmation" required>
                        <label for="password_confirmation">Confirm password</label>
                        <div v-if="has_error && !success" class="text-danger">{{ errors.password_confirmation[0] }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <p>
                            <label>
                                <input name="gender" value="Male" v-model="gender" type="radio" required/>
                                <span>Male</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="gender" value="Female" v-model="gender" type="radio" required />
                                <span>Female</span>
                            </label>
                        </p>
                    </div>

                    <div class="input-field col s5">
                        <p>
                            <label>
                                <input name="user_type" value="Casual" v-model="user_type" type="radio" required />
                                <span>Casual</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="user_type" value="Ranked" v-model="user_type" type="radio" required />
                                <span>Ranked</span>
                            </label>
                        </p>

                        <i class="material-icons tooltipped" data-position="bottom" data-tooltip=
                            "Casual players will not receive a ranking on the leaderboard,
                            while ranked players do,
                            based on their overall results calculated by the system.">
                            info
                        </i>
                    </div>


                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect cyan accent-3 black-text" type="submit">Sign up
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                    <div><h6 class="red-text" v-if="has_error">{{errors}}</h6></div>
                </div>

            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                password_confirmation: '',
                gender: '',
                user_type: '',
                has_error: false,
                error: '',
                errors: {},
                success: false
            }
        },
        mounted() {
            M.AutoInit();
        },

        methods: {
            register() {
                var app = this
                this.$auth.register({
                    data: {
                        first_name: app.first_name,
                        last_name: app.last_name,
                        email: app.email,
                        password: app.password,
                        password_confirmation: app.password_confirmation,
                        user_type: app.user_type,
                        gender: app.gender
                    },
                    success: function () {
                        app.success = true;

                    },
                    error: function (res) {
                        console.log(res.response.data.errors);
                        app.has_error = true;
                        app.error = res.response.data.error;
                        app.errors = res.response.data.errors || {}
                    }
                })
            }
        }
    }
</script>

<style scoped>
    .row input, label {
        color: white !important;
        border-color: cyan !important;
    }
</style>

