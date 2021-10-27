<template>
  <div class="home-container">
    <div class="home-title">Stacked with BooKs
      <div class="home-selling-group">
        <p class="home-selling-complaint">- 記憶の中の本、山積みになっていませんか？ -</p>
        <p class="home-selling-complaint">記憶に残る本を登録して言葉で紡ぎ、</p>
        <p class="home-selling-complaint">人々と共有していくサイト</p>
      </div>
    </div>
    <img class="home-img" :src="'/images/stacked_with_books_1920.jpg'" alt="home">
    <BooksList />
  </div>
</template>

<script>
  import BooksList from './ExampleFront.vue'
    export default {
      name: "ExampleHome",
      data() {
        return {

        }
      },
      computed() {
        //
      },
      mounted() {
        //
        },
      components() {
        BooksList
      }
    }
</script>

<style >
.home-container {
 position: relative;
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

.home-img{
  width: 100vw;
  aspect-ratio: 16 / 6;
}

</style>