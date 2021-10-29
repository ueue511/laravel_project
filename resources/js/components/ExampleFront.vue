<template>
<div id="showbooklist">
    <table>
      <tr 
        v-for="list in booklist" 
        :key="list.id">
        <td 
          v-text="list.item_name">
        </td>
      </tr>
    </table>
</div>
</template>

<script>
import axios from "axios";
    export default {
      name: 'ExampleFront',
      data() {
        return {
          booklist: [],
        };
      },
      mounted() {
        var self = this
        var url = '/ajax/booklist';
        axios.get(url).then(function(response) {
          self.booklist = response.data;
        });
      }
    }
</script>

<style scoped>

</style>