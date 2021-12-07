// 検索結果を保持
const state = {
  reload_comment: null
};

const getters = {
  GetComment( state ) {
    return state.reload_comment;
  }
};

const mutations = {
  VuexMutations_CommentSave(state, payload) {
    state.reload_comment = payload;
  },

  VuexMutations_CommentErr( payload ) {
    console.log( payload );
  },
};

const actions = {
  VuexAction_CommentSave( context, data ) {
    var url = '/detail/{book_id}/ajax/comment';
    axios.post(url, data).then(function ( response ) {
      // console.log(response)
      context.commit( 'VuexMutations_CommentSave', response)
    })
      .catch( function ( err ) {
      context.commit( 'VuexMutations_CommentErr', err )
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