<template>
  <div class="container">
    <div class="result_container text-center">
      <p class="result_title">検索結果</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ExampleResut',
  data() {
    return {

    }
  },
  mounted() {
    //
  }
}
</script>

<style scoped>
.result_container {
  border: rgb(192, 192, 192) 1px solid;
  background-color: #ffffff;
  margin-bottom: 30px;
}

.result_title {
  color: rgb(78, 78, 78);
  font-size: 24px;
  margin: 15px
}
</style>