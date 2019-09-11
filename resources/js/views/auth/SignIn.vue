<template>
    <div class="white-text">
         <div class="row">
         <div class="alert alert-danger" v-if="has_error">
                    <p>Incorrect e-mail/password.</p>
                </div>
    <form class="col s12 white-text" @submit.prevent="login">
         <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" name="email" class="validate" v-model="email">
          <label for="email">Email</label>

        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" name="password" class="validate" v-model="password">
          <label for="password">Password</label>
        </div>
      </div>

      <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect cyan accent-3 black-text" type="submit">Sign in
             <i class="material-icons right">send</i>
            </button>
            </div>
      </div>
     
    </form>
  </div>
    </div>
     
</template>


<style scoped>
.row input, label {
    color: white !important;
    border-color: cyan !important;
}
</style>


<script>
  export default {
    data() {
      return {
        email: null,
        password: null,
        has_error: false
      }
    },
    mounted() {
      //
    },
    methods: {
      login() {
        // get the redirect object
        var redirect = this.$auth.redirect();
        var app = this;
        this.$auth.login({
          params: {
            email: app.email,
            password: app.password
          },
          success: function() {
            // handle redirection
            const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 'administrator' ? 'Dashboard' : '/';
            this.$router.push({name: redirectTo})
          },
          error: function() {
            app.has_error = true
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>

