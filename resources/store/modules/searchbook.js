const getters = {
  // book_list: function (state, getters) {
  //   return JSON.parse(JSON.stringify(state.search_book_date))
  // }
};

const state = {
  search_book_date: '', // dbから受け取ったデータ
  search_count: 0 ,// 受け取ったデータの総数
  search_totalpage: 0, // 1ページ12枚でのページ数
};

const mutations = {
  VuexMutations_SearchBook( state, payload ) {
    state.search_book_date = payload
    state.search_count = payload.length
    state.search_totalpage = Math.ceil( payload.length / 12)
  }
};

const actions = {
  VuexAction_SearchBook( context, data ) {
    var url = '/ajax/search';
    axios.post( url, data ).then(function ( response ) {
      const search_book = response.data;
      context.commit( 'VuexMutations_SearchBook', search_book )
    })
    .catch(function ( err ) {
      context.commit( 'VuexMutations_SearchBook', err )
    })
  }
};

export default {
  namespaced: true,
  getters,
  state,
  mutations,
  actions
};