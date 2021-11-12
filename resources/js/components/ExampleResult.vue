<template>
  <div class="container">
    <div class="card-deck"
      v-for='(booklist, index) in book_list' 
      :key='index'
      style="margin-bottom: 30px;"
    >
      <div class="row w-100">
        <div class="col-sm-4"
          v-for='book in booklist' 
          :key='book.id'
        >
          <div class="card h-100">
            <img class="card-img-top" :src="'/update/' + book.item_img" alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title">{{ book.item_name }}</h4>
              <p class="card-text">
                Some quick example text to build on the card title
                and make up the bulk of the card's content.
              </p>
              <a href="#!" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
      </div>
      <br>
    </div>
    <br>
    <PrevNext 
      :page="page"
      :totalpage="totalpage"
      @change="onPageChange"
    />
  </div>
</template>

<script>
import PrevNext from "../components/pagination/prev-next";
import { mapState } from 'vuex'
export default {
  components: { PrevNext },
  name:"ExampleResult",
  data() {
    return {
      items: [], // 表示するデータ
      page: 1,   // 現在のページ
      perpage: 4, // 1ページ毎の表示組数
      totalpage: 0, //総ページ数
      count: 0//itemsの総数
    }
  },
  beforeUpdate() {
    return this.totalpage = this.$store.state.searchbook.search_totalpage;
  },
  computed: {
    book_list() {
      const list = JSON.parse( JSON.stringify(this.$store.state.searchbook ));
      const list_all = list.search_book_date;

      // 配列を組み直し ３枚1組
      const SliceByNumber = ( array, number ) => {
        const counte = Math.ceil( array.length / number) ;
        return new Array( counte ).fill().map((_, i) =>
          array.slice(i * number, ( i + 1 ) * number)
        )
      };

      // 配列を４組で組み直す
      const FilterByNUmber = ( array )=>{
        return array.filter(
          (word, i) =>
          i >= (this.page - 1) * this.perpage && i < this.page * this.perpage
        );
      }
      const list_three = SliceByNumber( list_all, 3 );
      console.log(typeof list_three);
      return FilterByNUmber( list_three )
    },

    book_total() {
      return this.totalpage = this.$store.state.searchbook.search_totalpage;
    },

    book_count() {
      return this.count = this.$store.state.searchbook.search_count;
    }
},

    mounted() {

    },

    methods: {
      onPageChange(page) {
        this.page = page;
        window.history.replaceState(
          { page },
          `Page${page}`,
          `${window.location.pathname}?page=${page}`
        );
      },
    },
}
</script>

<style scoped>

</style>