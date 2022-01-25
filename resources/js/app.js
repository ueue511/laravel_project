/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import BootstrapVue from "bootstrap-vue";　// ★追加
import 'bootstrap/dist/css/bootstrap.css';　// ★追加
import 'bootstrap-vue/dist/bootstrap-vue.css';　// ★追加
import store from '../store/index';
// import router from '../router.js'

import Vue from 'vue';
// import VueRouter from 'vue-router';

require('./bootstrap');

//jQyer-ajax用
require('./')

window.Vue = require('vue');
// Vue.use(VueRouter)

const PerfectScrollbar = window['Vue2PerfectScrollbar'];
Vue.use(PerfectScrollbar);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-home', require('./components/ExampleHome.vue').default);
Vue.component('example-front', require('./components/ExampleFront.vue').default);
Vue.component('example-search', require('./components/ExampleSearch.vue').default);
Vue.component('example-resulttitle', require('./components/ExampleResulttitle.vue').default);
Vue.component('example-result', require('./components/ExampleResult.vue').default);
Vue.component('example-footer', require('./components/ExampleFooter.vue').default);
Vue.component('prev-next', require('./components/pagination/prev-next.vue').default);
Vue.component('example-detail-home', require('./components/detail/ExampleDetailHome.vue').default);
Vue.component('example-detail-result', require('./components/detail/ExampleDetailResult.vue').default);

Vue.component('example-home-before', require('./components/homebefore/ExampleHomeBefore.vue').default);
Vue.component('example-front-before', require('./components/homebefore/ExampleFrontBefore.vue').default);
Vue.component('example-login-home', require('./components/ExampleLoginHome.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    // router
});
