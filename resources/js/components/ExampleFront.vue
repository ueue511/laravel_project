<template>
  <ul id="example-1">
    <li v-for="(book, key) in books" :key="key">
    {{ book }}
    </li>
  </ul>
</template>

<script>
    export default {
    name: "ExampleFront",
    date() {
      return {

      }
    },
    props: {
      books: {
        type: String,
        required: true
      }
    },
    computed() {
      //
    },
    mounted() {
      //
      }
    }
</script>