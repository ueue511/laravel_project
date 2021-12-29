//本のジャンル別のタグを取得
const state = {
  book_tag: []
};

const getters = {
  GetTag( state ) {
    return state.book_tag;
  }
};

const mutations = {
  VuexMutations_Tag( state, payload ) {
    state.book_tag = payload;
  },

  VuexMutations_SearchErr( payload ) {
    console.log(payload);
  },
};

const actions = {
  VuexAction_Tags( context ) {
    var url = '/ajax/tags';
    axios.get(url).then(function ( response ) {
      const tag = response.data;
      context.commit( 'VuexMutations_Tag', tag ) 
    })
      .catch(function ( err ) {
        context.commit( 'VuexMutations_SearchErr', err )
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