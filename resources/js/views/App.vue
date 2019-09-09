<template>

    <div class="container-fluid" id="main">

      <div class="container">

        <div class="card-panel black white-text">
            <router-view></router-view>
        </div>
          <div class="container center-align" id="footer">
          <small class="grey-text lighten-3">© 2019 All Rights Reserved | Powered by Main Solution ApS</small>
          </div>
          </div>
    </div>


</template>

<style>

#main {
    padding-left: 300px;
    border-radius: 2px;
  }
  
  @media only screen and (max-width : 992px) {
    #main {
      padding-left: 0;
    }
  }


</style>

<script>
    export default {}

</script>



