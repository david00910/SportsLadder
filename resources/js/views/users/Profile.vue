<template>
    <div>
        <p>This is my ID: {{id}}</p>
    </div>
</template>

<script>

import api from '../api/users';

export default {
    
        data() {
            return {
                user: {
                id: null,
                first_name: "",
                last_name: "",
                email: "",
                ranking: "",
                }
            };
        },
        created() {
            api.find(this.$route.params.id).then((response) => {
                this.loaded = true;
                this.user = response.data.data;
            })
            .catch((err) => {
       this.$router.push({ name: '404' });
     });
        }
            
}
</script>