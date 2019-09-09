<template>
  <div>
       <div v-if="message" class="alert cyan accent-3">{{ message }}</div>
      <div v-if="!loaded"><div class="preloader-background loading">
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
        </div>
      <form @submit.prevent="onSubmit($event)">
        <div class="form-group white-text">
            <label for="first_name">First name</label>
            <input class="white-text" id="first_name" v-model="user.first_name" />
            <label for="last_name">Last name</label>
            <input class="white-text" id="last_name" v-model="user.last_name" />
        </div>
        <div class="form-group white-text">
            <label for="user_email">Email</label>
            <input class="white-text" id="user_email" type="email" v-model="user.email" />
        </div>
        <div class="form-group white-text">
            <label for="ranking">Ranking</label>
            <input class="white-text" id="ranking" type="number" v-model="user.ranking" />
        </div>
        <div class="form-group white-text">
          <router-link class="waves-effect cyan accent-3 black-text btn-small" v-if="done = true" :to="{ name: 'users.index' }">Back</router-link>
            <button class="waves-effect white black-text btn-small right-align" type="submit" :disabled="saving">Update</button>
             <button class="waves-effect red darken-3 white-text btn-small right-align" :disabled="saving" @click.prevent="onDelete($event)">Delete</button>
        </div>

    </form>
  </div>
</template>
<script>


export default {
  data() {
    return {
        message: null,
        loaded: false,
        saving: false,
      user: {
        id: null,
        first_name: "",
        last_name: "",
        email: "",
        ranking: "",
      }
    };
  },
  methods: {
      
        onDelete($event) {
        this.saving = true;
        api.delete(this.user.id)
            .then((response) => {
                this.message = 'User Deleted';
                setTimeout(() => this.$router.push({ name: 'users.index' }), 2000);
     });
},
            onSubmit(event) {
        this.saving = true;
        this.done = false;
        

        api.update(this.user.id, {
            first_name: this.user.first_name,
            last_name: this.user.last_name,
            email: this.user.email,
            ranking: this.user.ranking
        }).then((response, self) => {
            this.message = 'User updated';
            setTimeout(() => this.message = null, 2000);
            this.user = response.data.data;
            
        }).catch(error => {
            console.log(error)
        }).then(_ => this.saving = false, this.done = true);
        },
        },
        created() {
            api.find(this.$route.params.id).then((response) => {
                this.loaded = true;
                this.user = response.data.data;
            })
            .catch((err) => {
       this.$router.push({ name: '404' });
     });

        },

};
</script>

<style lang="scss" scoped>
$red: lighten(red, 30%);
$darkRed: darken($red, 50%);
.form-group label {
  display: block;
}
.alert {
    background: $red;
    color: $darkRed;
    padding: 1rem;
    margin-bottom: 1rem;
    width: 50%;
    border: 1px solid $darkRed;
    border-radius: 5px;
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
</style>
