<template>
  <div class="home-container">
    <div class="home-title">Stacked with BooKs
      <div class="home-selling-group">
        <p class="home-selling-complaint">
          - 記憶の中の本、山積みになっていませんか？ -
        </p>
        <p class="home-selling-complaint">
          記憶に残る本を言葉で繋いでいき、
        </p>
        <p class="home-selling-complaint">
          人々と共有していくサイト
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
}

.home-title {
  width: 50%;
  top: 28%;
  left: 5%;
  font-size: 5em;
  position: absolute;
  text-align: center;
}

.home-selling-group {
  margin-top: 0.4em;
}

.home-selling-complaint {
  font-size: 0.3em;
  padding-bottom: 1em;
  text-align: center;
}

.home-img {
  width: 100vw;
  aspect-ratio: 16 / 6;
}

</style>