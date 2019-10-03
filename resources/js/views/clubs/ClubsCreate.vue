<template>

    <div class="white-text">

        <div class="row">

            <form class="col s12 white-text" @submit.prevent="store" enctype="multipart/form-data">




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

                <h5 class="center cyan-text">Club Details</h5>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" type="text" name="name" class="validate" v-model="name" required>
                        <label for="name">Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="about" name="about" class="materialize-textarea white-text" v-model="about"></textarea>
                        <label for="about">About</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="foundation_date" type="number" min="1830" :max="currentY" name="foundation_date" class="validate" v-model="foundation_date" required>

                        <label for="foundation_date">Year of Establishment <small>(Between 1830-{{currentY}})</small></label>

                    </div>

                    <div class="file-field input-field col s6">
                        <i class="material-icons md-36">photo</i>
                        <span>Logo/Avatar</span>
                        <input type="file" name="image" accept="image/*"  v-on:change="onFileChange" id="image">
                    </div>


                </div>

                <h5 class="center cyan-text">Address</h5>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="street" type="text" name="street" class="validate" v-model="street" required>
                        <label for="street">Street</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="zip" type="text" name="zip" class="validate" v-model="zip" required>
                        <label for="zip">Postal Code</label>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s6">
                        <input id="city" type="text" name="city" class="validate" v-model="city" required>
                        <label for="city">City</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="country" type="text" name="country" class="validate" v-model="country" required>
                        <label for="country">Country</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect cyan accent-3 black-text" type="submit">Create
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>


                <h6 class="cyan-text" v-if="output">{{output.msg}}</h6>
                <h6 class="red-text" v-if="err">Error: {{err}}</h6>
            </form>
        </div>
    </div>
</template>


<script>

    export default {
        data() {
            return {
                name:'',
                about: '',
                foundation_date: '',
                street: '',
                zip:'',
                city:'',
                country:'',
                currentY: new Date().getFullYear(),
                image: '',
                output: '',
                loading: false,
                err: ''
            }
        },

        created() {
        },

        mounted() {
            M.AutoInit();
        },


        methods: {
            onFileChange(e){
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            store() {

                this.loading = true;

                this.$http.post('auth/clubs/store', {
                    name: this.name,
                    about: this.about,
                    foundation_date: this.foundation_date,
                    street: this.street,
                    zip: this.zip,
                    city: this.city,
                    country: this.country,
                    image: this.image

                })

                    .then(response => {
                        this.output = response.data;
                        this.err = response.data.err;
                        this.loading = false;
                    })
                    .catch(error => {
                        this.output = error;
                        this.loading = false;
                    })


            },

        },


    }
</script>


<style scoped>
    .row input, label {
        color: white !important;
        border-color: cyan !important;
    }
</style>
