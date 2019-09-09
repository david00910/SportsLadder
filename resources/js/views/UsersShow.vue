<template>
    <div>
        <ul>
        <li v-for="us in user"> My profile is fun, my ID is {{us.id}} {{us.first_name}}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
    return {
      user: []
    };
  },
  mounted() {
         this.getUser()
        
        },       
 methods: {
            getUser (id) {
            //const params = {page};
            this.loading = true;

            this.$http.get('auth/user/'+this.$route.params.id)
                .then(response => {
                    this.user = response.data;
                    this.loading = false;
                }) .catch(error => {
                    console.log(error.response.data);
                });
            },
    },
    
    }

</script>