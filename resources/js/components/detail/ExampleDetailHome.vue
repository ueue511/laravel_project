<template>
  <div class="home-container">
    <div class="home-title">Stacked with BooKs
            <div class="home-selling-group">
        <p class="home-selling-complaint">
          - 詳細 -
        </p>
      </div>
    </div>
      <img class="home-img" :src="'/images/stacker_with_books_detail.png'" alt="home">
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

</style>