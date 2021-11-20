import Vue from 'vue';
import Vuex from 'vuex';

import axios from 'axios';
import searchbook from '../store/modules/searchbook';
import booktags from '../store/modules/booktags';

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    searchbook,
    booktags,
  }
});