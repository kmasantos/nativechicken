
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

Vue.component('pagination', require('laravel-vue-pagination'));

// General Vue Components
Vue.component('dashboard-component', require('./components/general_Dashboard.vue'));
Vue.component('pen-component', require('./components/general/Pen.vue'));
Vue.component('generation-line', require('./components/general/GenerationLine.vue'));
Vue.component('family-record', require('./components/general/FamilyRecord.vue'));

// Breeder Vue Components
Vue.component('add-family-record', require('./components/AddFamilyRecord.vue'));
Vue.component('line-list', require('./components/LineList.vue'));
Vue.component('add-breeder', require('./components/AddBreeder.vue'));
Vue.component('add-daily', require('./components/AddDailyRecord.vue'));
Vue.component('hatchery-record', require('./components/breeders/HatcheryRecordList.vue'));

// Replacement Vue Components
Vue.component('add-replacement', require('./components/replacement_Replacement.vue'));
Vue.component('phenomorpho-replacement', require('./components/replacement_PhenoMorpho.vue'));

// Brooder & Grower Vue Components
Vue.component('add-broodergrower', require('./components/AddBrooderGrower.vue'));
Vue.component('feedingrecord-broodergrower', require('./components/BrooderGrowerFeedingRecord.vue'));
Vue.component('growthrecord-broodergrower', require('./components/BrooderGrowerGrowthRecord.vue'));

const app = new Vue({
    el: '#app',
});
