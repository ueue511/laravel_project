<template>
  <div class="container">
    <div class="card-deck result_deck"
      v-for='booklist in book_list' 
      :key='booklist.id'
      style="margin-bottom: 30px;"
    >
      <div class="row w-100">
        <div class="col-md-4 col-sm-12 center-block bottom_size"
          v-for='(book) in booklist' 
          :key="book.id"
        >
          <div class="card h-100" heigth="500">
            <img 
              class="card-img-top" 
              :src="'/update/' + book.item_img" 
              alt="Card image cap"
            />
              <div class="card-img-overlay">
                  <img 
                    @click="BookMarkGood( book.id, 1 )" 
                    class="icon_img" 
                    :src="[ bookmarkid.includes( book.id )? '/images/bookmark_on.png': '/images/bookmark_off.png']" 
                    alt=""
                  />
                <span class="icon_area">
                  <img 
                    @click=" BookMarkGood( book.id, -1, book.petsusers.length) " class="icon_img" 
                    :src="[ goodid.includes( book.id )? '/images/good_on.png': '/images/good_off.png']" 
                    alt=""
                  />
                  <span class="good_count" v-if="!( book.id in goodlist )">{{ book.petsusers.length }}</span>

                  <span class="good_count" v-else> {{ goodlist[book.id][0] }}</span>
                </span>
              </div>
            <div class="card-body text-box bottonup">
              <h4 class="card-title result_title">{{ book.item_name }}</h4>
              <p class="card-text" 
                v-for='commentlist in CommentListSlice( book.comments )' 
                :key='commentlist.id'
              >
                {{ CommentSlice( commentlist.comment ) }}
              </p>
              <a v-bind:href="'/stackerwith/detail/'+book.id" class="btn btn-primary text-btn result_botton">詳細</a>
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
export default {
  components: { PrevNext },
  name:"ExampleResult",
  props: {
    good_id: {
      type: Array,
      required: true,
      default: 0
    },
    bookmark_id: {
      type: Array,
      required: true,
      default: 0
    },

  },

  data() {
    return {
      items: [], // 表示するデータ
      page: 1,   // 現在のページ
      perpage: 4, // 1ページ毎の表示組数
      totalpage: 0, //総ページ数
      count: 0, //itemsの総数

      bookmarkid: this.bookmark_id, //db: good
      goodid: this.good_id, //db: pet

      goodlist: {}, //goodされているローカルで判定
      goodcount_list: 0, //goodのカウント数
    }
  },
  beforeUpdate() {
    this.totalpage = this.$store.state.searchbook.search_totalpage;
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
      return FilterByNUmber( list_three )
    },

    book_total() {
      return this.totalpage = this.$store.state.searchbook.search_totalpage;
    },

    book_count() {
      return this.count = this.$store.state.searchbook.search_count;
    },
  },

    mounted() {

    },

    methods: {
      // なんちゃってページ表示(url表記)
      onPageChange( page ) {
        this.page = page;
        window.history.replaceState(
          { page },
          `Page${page}`,
          `${window.location.pathname}?page=${page}`
        );
      },

      // コメントリストの始めだけ表示
      CommentListSlice( list ) {
        for( let i in list)　{
          return list.slice( 0, 1 )
        }
        const addcomment = {
          id: 999,
          comment: 'あなたの言葉で、初コメントを入れてみましょう。'
        };
        list.push( addcomment );
        return list
        },

      // いいね　お気に入り
      BookMarkGood( index, type ,count){
        // お気に入りかいいねを判定
        let userlist = '';
        let storeurl = '';
        let bookid_data = {}
        
        let updown = '' //プラスかマイナスか

        if (type === 1) {
          userlist = this.bookmarkid;
          storeurl = 'goods/VuexAction_Goods';
        } else {
          userlist = this.goodid;
          storeurl = 'pets/VuexAction_Pets'
        };

        bookid_data = {
          'book_id': index
        }

        // 表示判定 a: 解除状態->登録 b: 登録状態->解除
        if ( !userlist.includes( index ) ) {
          userlist.push( index );

          this.goodcount = 1
          updown = 1

          if( type === -1 ) {
            if(index in this.goodlist) {
              this.goodlist[index][1] === 'a'? this.$set(this.goodlist, index, [count +1, 'a'] ): this.$set( this.goodlist, index, [count, 'b'])
            } else {
              this.$set( this.goodlist, index, [count +1, 'a'] ); //裏
            }
          }

          this.$store.dispatch( storeurl, [bookid_data, updown] );

        } else {
          const numlist = userlist.indexOf( index );
          userlist.splice( numlist, 1 );
          
          this.goodcount = -1
          updown = -1;

          if( type === -1 ) {
            if(index in this.goodlist) {
              this.goodlist[index][1] === 'b'? this.$set(this.goodlist, index, [count-1, 'b'] ): this.$set( this.goodlist, index, [count, 'a'])
            } else {
              this.$set( this.goodlist, index, [count -1, 'b'] ); //表
            }
          }

          this.$store.dispatch ( storeurl, [bookid_data, updown])

        }
      },

      //コメント25文字表示
      CommentSlice( value ) {
        if(typeof(value) === 'object') {
          if( value[0].length > 23 ) {
            return value[0].slice( 0, 23 ) + '...........'
          } else if( value[0].length <= 23 ) {
            return value[0];
          } else {
            return '';
          }
        }
        if( value.length > 23 ) {
          return value.slice( 0, 23 ) + '...........'
        } else if( value.length <= 23 ) {
          return value;
        } else {
          return '';
        }
      },
    },
  }
</script>

<style scoped>

.icon_img {
  width: 40px;
  cursor: pointer;
}

.bottonup {
  z-index: 999;
}

.icon_area {
  position: relative;
}

.good_count {
  position: absolute;
  left: 17px;
  top: 3px;
  pointer-events:none;
}

.card-deck {
  justify-content: space-around;
}

@media screen and ( max-width: 959px ) {
  .icon_img {
    width: 28px;
  }

  .good_count {
    left: 13px;
  }

}

@media screen and ( max-width: 768px ) {
  .result_deck {
    margin-left: 1px;
  }

  .bottom_size {
    margin-bottom: 15px;
  }

  .result_title {
    text-align: center;
  }

  .result_botton {
    margin-left: 70%;
  }

  .icon_img {
    width: 50px;
  }

  .good_count {
    left: 26px;
    top: 4px;
  }
}

@media screen and ( max-width: 575px ) {
  .result_deck {
    margin-left: 30px;
  }
}
</style>