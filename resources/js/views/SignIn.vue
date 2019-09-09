<!--<template>
    <div class="white-text">
         <div class="row">
    <form class="col s12 white-text" @submit.prevent="submit">
         <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" name="email" class="validate" v-model="fields.email">
          <label for="email">Email</label>
          <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" name="password" class="validate" v-model="fields.password">
          <label for="password">Password</label>
          <div v-if="errors && errors.password" class="text-danger">{{ errors.password[0] }}</div>
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

<script>
import axios from 'axios';

export default {  
  
  data() {
    return {
      fields: {},
      errors: {},
      success: false,
      loaded: true,
    }
  },
  methods: {
    submit() {
      if (this.loaded) {
        this.loaded = false;
        this.success = false;
        this.errors = {};
        axios.post('/api/auth/login', this.fields).then(response => {

          this.loaded = true;
          this.success = true;
          this.$router.push({ name: 'users.show/:id' });
        }).catch(error => {
          this.loaded = true;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        });
      }
    },
  }
}
</script>

<style scoped>
.row input, label {
    color: white !important;
    border-color: cyan !important;
}
</style>-->

<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Connexion</div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error">
                    <p>Erreur, impossible de se connecter avec ces identifiants.</p>
                </div>
                <form autocomplete="off" @submit.prevent="login" method="post">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" class="form-control" v-model="password" required>
                    </div>
                    <button type="submit" class="btn btn-default">Connexion</button>
                </form>
            </div>
        </div>
    </div>
</template>
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
            const redirectTo = redirect ? redirect.from.name : this.$auth.user().is_admin === 1 ? 'users' : '/';
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

