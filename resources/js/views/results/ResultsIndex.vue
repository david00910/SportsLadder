<template>
    <div class="results">
        <div class="preloader-background loading" v-if="loading">
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

        <div class="text-cyan text-accent-3">
            <div class="divider cyan accent-3"></div>

         <table v-if="results" class="responsive-table highlight">
        <thead>
          <tr class="cyan-text text-accent-3">
              <th>ID</th>
              <th>Winner</th>
              <th>Loser</th>
              <th>Result</th>
              <th>Date</th>
              <th>Action</th>

          </tr>

        </thead>

        <tbody>
          <tr v-for="result in results" v-bind:key="result.id">
            <td>{{ result.id }}</td>
            <td>{{ result.winner_id.first_name }} {{ result.winner_id.last_name}}</td>
            <td>{{ result.loser_id.first_name }} {{ result.loser_id.last_name }}</td>
            <td>{{ result.result }}</td>
            <td>{{ result.updated_at }}</td>
            <td class="linkShow"><router-link  :to="{ name: 'results.show', params: {id: result.id} }"><i class="small material-icons">info</i></router-link></td>
          </tr>
        </tbody>

      </table>
        <div class="divider cyan accent-3"></div>
      </div>


        <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="getResults()"></pagination>

    </div>


</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                loading: false,
                results: {},
                pagination: {
                    'current_page': 1
                }
            };
        },



        methods: {
            getResults () {
                //const params = {page};
                this.loading = true;

                axios.get('auth/results?page=' + this.pagination.current_page)
                    .then(response => {
                        this.results = response.data.data;
                        this.pagination = response.data.pagination;
                        this.loading = false;
                    }) .catch(error => {
                    console.log(error.response.data);
                });
            },

        },
        mounted() {
            this.getResults()

        },
    }

    </script>

<style scoped>
table.highlight>tbody>tr:hover {
    background-color: rgba(0, 110, 255, 0.13);
        /* whatever color you want */
}
table.highlight>tbody>tr {
    color: white;
    border-color: rgba(0, 110, 255, 0.13);
    font-weight:600;

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

