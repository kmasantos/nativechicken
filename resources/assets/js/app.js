
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// General Vue Components
Vue.component('generation-line', require('./components/GenerationLine.vue'));
Vue.component('family-record', require('./components/FamilyRecord.vue'));

// Breeder Vue Components
Vue.component('add-family-record', require('./components/AddFamilyRecord.vue'));
Vue.component('line-list', require('./components/LineList.vue'));
Vue.component('add-breeder', require('./components/AddBreeder.vue'));

// Replacement Vue Components
Vue.component('add-replacement', require('./components/AddReplacement.vue'));


const app = new Vue({
    el: '#app'
});
