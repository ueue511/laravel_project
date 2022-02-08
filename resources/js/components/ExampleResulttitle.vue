<template>
  <div class="container">
    <div class="result_container text-center">
      <p 
        v-if = "ShowTitle === 'false'" 
        class="result_title"
      >
      検索結果を下記に表示します
      </p>
      <p 
      v-if = "ShowTitle === 'true'" 
      class="result_title"
      >
      検索結果 <span v-if = "ResultTag"> [ {{ ResultTag }} ]</span>
      <span v-if = "ResultTitle"> [ {{ ResultTitle }} ]</span>
      [ {{ ResultCount }} 冊 ]
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ExampleResut',
  data() {
    return {
      count: null //検索総数
    }
  },
  computed:{
    ResultCount() {
      return this.count = this.$store.state.searchbook.search_count;
    },

    ResultTag() {
      const tabnum = this.$store.state.searchbook.search_tag
      const tablist = this.$store.getters[ 'booktags/GetTag' ];
      const tab = typeof tabnum ? tablist[ tabnum ].tab : null;
      return tab;
    },

    ResultTitle() {
      return this.$store.state.searchbook.search_title;
    },

    ShowTitle() {
      return this.$store.state.searchbook.search_title_show;
    },
    
    SerachGetTag( list, tabid ) {
      const makelist = {}
      list.forEach( function element() {
        makelist[ element.id ] = element.tab
      })
    return makelist[ tabid ].tab
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