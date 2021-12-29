import Vue from 'vue'
import VueRouter from 'vue-router'

import Result from './js/components/ExampleResult.vue'

export default new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/prev',
      name: 'result',
      component: Result
    },
    
    {
      path: '/next',
      name: 'result',
      component: Result
    },
  ]
});