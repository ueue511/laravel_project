<template>
  <div class="home-container">
    <div class="home-title"><span class="home-title-font">Stacked with BooKs</span>
      <div class="home-selling-group">
        <p class="home-selling-complaint">
          - 記憶の中の本、山積みになっていませんか？ -
        </p>
      </div>
    </div>
      <img class="home-img" :src="'/images/stacked_with_books_1920.jpg'" alt="home">
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
  left: 5%;
  font-size: 3.5em;
  position: absolute;
  text-align: center;
}

.home-selling-group {
  margin-top: 0.6em;
}

.home-selling-complaint {
  font-size: 0.3em;
  padding-bottom: 1em;
  text-align: center;
  color: rgb(78, 78, 78);
}

.home-img {
  width: 100%;
  height: auto;
  aspect-ratio: 16 / 6;
}

@media screen and ( max-width: 959px ) {
  .home-title {
    top: 30%;
    font-size: 2.5em;
  }

  .home-selling-group {
    margin-top: 0.3em;
  }

  .home-container {
    margin-bottom: 0em;
  }
}

@media screen and ( max-width: 669px ) {
  .home-title {
    top: 35%;
    font-size: 2em;
   }
}

@media screen and ( max-width: 575px ) {

  .home-title-font {
    text-shadow: -1px 2px 0 rgba(0,0,0,0.3);
  }

  .home-title {
    width: 100%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
   }
}

@media screen and ( max-width: 481px ) {

  .home-img {
    width: 100%;
    height: auto;
    aspect-ratio: 16 / 8;
  }

  .home-title {
    width: 100%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
   }
}

</style>