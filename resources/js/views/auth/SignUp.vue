<template>
    <div class="white-text">
         <div class="row">

    <form class="col s12 white-text" @submit.prevent="register">
         <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" name="email" class="validate" v-model="email">
          <label for="email">Email</label>
          <div v-if="has_error && !success" class="text-danger">{{ errors.email[0] }}</div>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" name="first_name" class="validate" v-model="first_name">
          <label for="first_name">First Name</label>
          <div v-if="has_error && !success" class="text-danger">{{ errors.first_name[0] }}</div>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" name="last_name" class="validate" v-model="last_name">
          <label for="last_name">Last Name</label>
          <div v-if="has_error && !success" class="text-danger">{{ errors.last_name[0] }}</div>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" name="password" class="validate" v-model="password">
          <label for="password">Password</label>
          <div v-if="has_error && !success" class="text-danger">{{ errors.password[0] }}</div>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password_confirmation" type="password" name="password_confirmation" class="validate" v-model="password_confirmation">
          <label for="password_confirmation">Confirm password</label>
          <div v-if="has_error && !success" class="text-danger">{{ errors.password_confirmation[0] }}</div>
        </div>
      </div>

      <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect cyan accent-3 black-text" type="submit">Sign up
             <i class="material-icons right">send</i>
            </button>
            </div>
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
        has_error: false,
        error: '',
        errors: {},
        success: false
      }
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
            password_confirmation: app.password_confirmation
          },
          success: function () {
            app.success = true
            this.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
          },
          error: function (res) {
            console.log(res.response.data.errors)
            app.has_error = true
            app.error = res.response.data.error
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

