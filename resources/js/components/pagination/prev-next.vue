<template>
  <div class=app>
    <div 
      class="pagination" 
      v-if="currentPage <= totalpage"
    >
      <a
        v-if="currentPage > 1" 
        class="prev" 
        @click='onPrev'
      >
      &lt; 前へ
      </a>
      <div class="total">　　{{ currentPage }}/{{ totalpage }}　　</div>
      <a 
        v-if="currentPage < totalpage" 
        class="next" 
        @click='onNext'
      >
      次へ &gt;
      </a>
    </div>
  </div>
</template>

<script>
export default {
    props: {
      page: {
        type: Number,
        require: true
      },
      totalpage: {
        type: Number,
        require: true
      }
    },
    
    data() {
      return {
        currentPage: this.page,
      }
    },


    computed: {
    prevPage() {
      return Math.max( this.page - 1, 1 );
    },
    nextPage() {
      return Math.min( this.page + 1, this.totalpage );
    },
    
    },

    methods: {
      onPrev() {
        this.currentPage = Math.max( this.currentPage-1, 1 );
        this.$emit( 'change', this.currentPage );
      },
      onNext() {
        this.currentPage = Math.min( this.currentPage +1, this.totalpage );
        this.$emit( 'change', this.currentPage );
      }
    }
  
}
</script>

<style scoped>
.pagination {
  justify-content: center;
}
.pagination * {
  display: inherit;
}
.prev .next {
  border: 0;
  background: none;
  font-size: initial;
  margin: 0 1rem;
}
</style>