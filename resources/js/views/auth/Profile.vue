<template>
    <div>
        <div class="row">

                <div class="col s3" style="padding: 0 !important;">
                    <div class="card" style="margin: 0 !important;">
                        <div class="card-image">
                            <img style="margin: 0 !important;" :src="'./images/gsd.jpg'">
                            <span class="card-title" style="letter-spacing: 2px !important;">First name Last name</span>
                        </div>
                        <div class="card-content grey-text">
                            <p>I am a very simple card. I am good at containing small bits of information.
                                I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action">
                            <a href="#">This is a link</a>
                        </div>
                    </div>

                </div>

                <div class="col s5 blue-grey">
                    <div class="">
                        <h6 style="letter-spacing: 2px !important;">STATISTICS</h6>

                    </div>
                </div>

                <div class="col s4 blue-grey">
                    <div class="">
                        <p style="letter-spacing: 2px !important;">MATCHES</p>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>

    export default {
        data: () => ({

            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            user: {},
        }),
        mounted() {

        },

        created() {

        },

        fetch() {

        },

    }
</script>
