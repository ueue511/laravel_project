import Vue from 'vue';
import Vuex from 'vuex';

import axios from 'axios';
import searchbook from '../store/modules/searchbook';
import booktags from '../store/modules/booktags';
import commentsave from '../store/modules/commentsave';
import goods from '../store/modules/goods';
import pets from '../store/modules/pets';

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    searchbook,
    booktags,
    commentsave,
    goods,
    pets,
  }
});