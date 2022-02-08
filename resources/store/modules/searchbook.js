// 検索結果を保持
const state = {
  search_book_date: '', // dbから受け取ったデータ
  search_count: 0 ,// 受け取ったデータの総数
  search_totalpage: 0, // 1ページ12枚でのページ数

  search_title: '',
  search_tag: '',

  search_title_show: 'false'
};

const getters = {

};

const mutations = {
  VuexMutations_SearchBook(state, payload) {
    state.search_book_date = payload[0]
    state.search_count = payload[0].length
    state.search_totalpage = Math.ceil(payload[0].length / 12);
    
    state.search_tag = typeof payload[2] ? payload[2]:'';
    state.search_title = payload[1].titlebook? payload[1].titlebook:'';
    state.search_title_show = "true"
  },

  VuexMutations_SearchErr( payload ) {
    console.log( payload );
  },
};

const actions = {
  VuexAction_SearchBook( context, data ) {
    var url = '/ajax/search';
    axios.post(url, data[0]).then(function ( response ) {
      const search_book = [ response.data, data[0], data[1] ];
      context.commit( 'VuexMutations_SearchBook', search_book )
    })
      .catch(function ( err ) {
      context.commit( 'VuexMutations_SearchErr', err )
    })
  },
};

export default {
  namespaced: true,
  getters,
  state,
  mutations,
  actions
};