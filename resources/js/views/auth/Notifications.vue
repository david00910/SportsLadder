<template>
    <div>
        <div class="row">
            <div class="col">
                <ul v-for="notification in notifications" :key="notification.id">
                    <li>{{notification.message}}
                        <br>
                        <small>Type: {{notification.type}}</small>
                    </li>

                </ul>

            </div>
        </div>
    </div>

</template>

<script>

    export default {
        data: () => ({

            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            notifications: {},
            err: null,
            loading: false,
            pagination: {}
        }),
        mounted() {

        },

        created() {
            this.indexNotification();

        },

        fetch() {

        },

        methods: {
            indexNotification() {

                this.$http.get('auth/notifications')

                    .then(response => {
                        console.log(response.data.data.data);
                        this.notifications = response.data.data.data;
                        this.err = response.data.err;
                        this.pagination = response.data.pagination;
                        this.loading = false;
                    })
                    .catch(error => {
                        console.log(error);
                        /*this.output = error;
                        this.loading = false;*/
                    })

            },
        }

    }
</script>
