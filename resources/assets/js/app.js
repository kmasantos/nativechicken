
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window.moment = require('moment');
import vSelect from 'vue-select';
import tippy from 'tippy.js';
import DataTable from 'vue-materialize-datatable';


Vue.component('v-select', vSelect);
Vue.component('datatable', DataTable);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// General Vue Components
Vue.component('dashboard-component', require('./components/general/Dashboard.vue'));
Vue.component('pen-component', require('./components/general/Pen.vue'));
Vue.component('generation-line', require('./components/general/GenerationLine.vue'));
Vue.component('family-record', require('./components/general/FamilyRecord.vue'));
Vue.component('farm-record', require('./components/general/FarmRecord.vue'));
Vue.component('generation-record', require('./components/general/GenerationRecord.vue'));
Vue.component('generation-phenomorpho', require('./components/general/GenPhenoMorpho.vue'));
Vue.component('generation-production', require('./components/general/GenProduction.vue'));
Vue.component('generation-inventory', require('./components/general/GenInventory.vue'));
Vue.component('farm-record-feeding', require('./components/general/FarmRecordFeeding.vue'));

/**
 ** Generation Summary 
**/
Vue.component('generation-summary-general', require('./components/general/GenerationSummaryGeneral.vue'));
Vue.component('generation-summary-phenotypic', require('./components/general/GenerationSummaryPhenotypic.vue'));
Vue.component('generation-summary-morphometric', require('./components/general/GenerationSummaryMorphometric.vue'));
Vue.component('generation-summary-feeding', require('./components/general/GenerationSummaryFeeding.vue'));
Vue.component('generation-summary-growth', require('./components/general/GenerationSummaryGrowth.vue'));

// Breeder Vue Components
Vue.component('add-breeder', require('./components/breeders/Breeder.vue'));
Vue.component('hatchery-record', require('./components/breeders/HatcheryRecordList.vue'));
Vue.component('egg-production', require('./components/breeders/EggProduction.vue'));
Vue.component('feedingrecord-breeder', require('./components/breeders/FeedingRecord.vue'));
Vue.component('eggquality-breeder', require('./components/breeders/EggQuality.vue'));
Vue.component('phenomorpho-breeder', require('./components/breeders/PhenoMorpho.vue'));
Vue.component('mortality-breeder', require('./components/breeders/MortalitySales.vue'));

// Replacement Vue Components
Vue.component('add-replacement', require('./components/replacements/Replacement.vue'));
Vue.component('inventory-replacement', require('./components/replacements/Inventory.vue'));
Vue.component('feeding-replacement', require('./components/replacements/FeedingRecord.vue'));
Vue.component('phenomorpho-replacement', require('./components/replacements/PhenoMorpho.vue'));
Vue.component('growthrecord-replacement', require('./components/replacements/GrowthRecord.vue'));

// Brooder & Grower Vue Components
Vue.component('add-broodergrower', require('./components/broodersgrowers/BrooderGrower.vue'));
Vue.component('inventory-broodergrower', require('./components/broodersgrowers/Inventory.vue'));
Vue.component('feedingrecord-broodergrower', require('./components/broodersgrowers/FeedingRecord.vue'));
Vue.component('growthrecord-broodergrower', require('./components/broodersgrowers/GrowthRecord.vue'));

// Admin Vue Components
Vue.component('user-management', require('./components/admin/UserManagement.vue'));

/**
 ** Others
 **/
Vue.component('pagination', require('laravel-vue-pagination'));
const app = new Vue({
    el: '#app',
});
