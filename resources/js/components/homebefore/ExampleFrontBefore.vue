<template>
<div class="front-container_before">
  <div class="container_line">
    <p class="fronttitle">最近、言葉が綴られた本</p>
    <div class="list-inline flex-nowrap img_scroll">
      <div v-for="list of booklist" 
      :key="list.id" class="showbook_img"
      >
      <a :href="'/detail/'+list.books[0].id ">
        <img 
          :src="list.books[0].item_img"
          alt="home" class="showbook_img_boby img-thumbnail"
        >
      </a>
      </div>
    </div>
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
      beforeCreate() {
        var self = this;
        async function comment() {
          var url = '/ajax/newcomment';
          self.booklist = await axios.get( url )
          .then( function( response ) {
            return response.data;
          })
        }
        comment()
      },

      computed: {
        Count() {
          return this.booklist.slice(0, 5)
        }
      }
    }
</script>

<style scoped>
.showbook_img_boby {
  width: 200px;
  height: 150px;
  object-fit: contain;
}

.list-inline {
  display: flex;
  overflow-x: scroll;
  text-align: center;
  padding-bottom: 20px;
}

.img_scroll {
  overflow-x: scroll;
}

.container_linell {
  overflow-x: scroll;
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

.front-container_before {
  margin-bottom: 50px;
  background-color: #ffffff;
}

@media screen and ( max-width: 959px ) {
  .img-thumbnail {
    max-width: none;
  }

  .showbook_img_boby {
    width: auto;
  }
}


</style>