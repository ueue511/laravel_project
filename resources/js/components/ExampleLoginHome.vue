<template>
  <div class="home-container">
    <div class="home-title">Stacked with BooKs
            <div class="home-selling-group">
        <p class="home-selling-complaint">
          - My page -
        </p>
      </div>
    </div>
      <img class="home-img" :src="'/images/stacker_with_books_home.jpg'" alt="home">
  </div>
</template>

<script>
    export default {
      name: "ExampleHome",
      data() {
        return {

        }
      },
      mounted() {
        //
        },
    }
</script>

<style scoped>

.home-container {
  position: relative;
  margin-bottom: 3em;
  width: 100%;
  height: auto;
}

.home-title {
  width: 50%;
  top: 40%;
  left: 25%;
  font-size: 3.5em;
  position: absolute;
  text-align: center;
  color:rgb(253, 252, 244);
  text-shadow: -1px 2px 0 rgba(0,0,0,0.3);
}

.home-selling-complaint {
  font-size: 0.7em;
  padding-bottom: 1em;
  text-align: center;
  color:rgb(253, 252, 244);
}

.home-img {
  width: 100%;
  height: 50%;
}

@media screen and ( max-width: 959px ) {
  .home-title {
    width: 100%;
    top: 35%;
    left: 0%;
  }

  .home-container {
    margin-bottom: 2em;
  }
}

@media screen and ( max-width: 669px ) {
  .home-title {
    font-size: 3em;
    top: 30%;
  }
}

@media screen and ( max-width: 575px ) {
  .home-title {
    font-size: 2.5em;
  }
}

@media screen and ( max-width: 481px ) {
  .home-title {
    font-size: 2em;
    top: 25%
  }
}



</style>