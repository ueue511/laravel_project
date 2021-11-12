import Vue from 'vue';
import Vuex from 'vuex';

import axios from 'axios';
import searchbook from '../store/modules/searchbook'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    searchbook,
  }
});