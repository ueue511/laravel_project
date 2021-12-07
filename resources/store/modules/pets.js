//本のジャンル別のタグを取得
const state = {
  book_goods:''
};

const getters = {

};

const mutations = {
  VuexMutations_Goods( state, payload ) {
    state.book_goods = payload;
  },

  VuexMutations_GoodsErr( payload ) {
    console.log(payload);
  },
};

const actions = {
  VuexAction_Pets(context, bookid_data) {
    let url = ''
    bookid_data[1] === 1 ? url = 'ajax/petup' : url = 'ajax/petdown';
    axios
      .post(url, bookid_data[0]).then(function (response) {
      // const tag = response.data;
      // context.commit( 'VuexMutations_Goods', tag ) 
    })
      .catch(function ( err ) {
        context.commit( 'VuexMutations_GoodsErr', err )
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