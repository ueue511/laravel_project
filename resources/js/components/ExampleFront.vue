<template>
<div class="front-container">
  <div class="container_line">
    <p class="fronttitle">あなたにおすすめの本</p>
    <ul class="list-inline flex-nowrap">
      <li>
        <div v-for="list in booklist" 
        :key="list.id" class="showbook_img"
      >
      <a href="http://(個別のコメント)">
      <img 
        :src="'/update/' + list.item_img"
        alt="home" class="showbook_img_boby img-thumbnail"
      >
      </a>
      </div>
      </li>
    </ul>
  </div>
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
.showbook_img_boby {
  object-fit: cover;
  width: 200px;
  height: 150px;
}

#showbooklist {
  margin: 0 10px 0px 10px;
}

.list-inline li{
  display: flex;
  overflow-x: scroll;
  justify-content: space-between;
}

.showbook_img {
  margin: 0 10px 0 10px; 
}

.fronttitle {
  color: rgb(78, 78, 78);
  font-size: 24px;
  text-align: center;
  background: linear-gradient(70deg, #fedab3 0%, #fedab3 8.5%, #fff7e4 8.5%, #fff7e4 25.1%,  #fedab3 25.1%, #fedab3 74.9%, #b0e1fa 74.9%, #b0e1fa 91.5%, #fedab3 91.5%, #fedab3 100%);
}

.container_line {
  border: rgb(192, 192, 192) 1px solid;
}

.front-container {
  margin-bottom: 50px;
  background-color: #ffffff;
}

</style>