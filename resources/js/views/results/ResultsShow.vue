<template>
    <div>
        <ul>
            <li v-for="res in result">The ID of this match is {{res.id}}, the players are {{res.winners.first_name + ' and ' + res.losers.first_name}}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                result: []
            };
        },
        mounted() {
            this.getResult()

        },
        methods: {
            getResult () {
                //const params = {page};
                this.loading = true;

                this.$http.get('auth/result/'+this.$route.params.id)
                    .then(response => {
                        this.result = response.data;
                        this.loading = false;
                    }) .catch(error => {
                    console.log(error.response.data);
                });
            },
        },

    }

</script>
