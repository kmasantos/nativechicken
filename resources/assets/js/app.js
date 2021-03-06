
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window.moment = require('moment');
import vSelect from 'vue-select';

Vue.component('v-select', vSelect);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Public Homepage Components
Vue.component('chicken-breeds', require('./components/general/ChickenBreeds.vue'));
Vue.component('duck-breeds', require('./components/general/DuckBreeds.vue'));
Vue.component('chicken-breed', require('./components/general/ChickenBreed.vue'));
Vue.component('duck-breed', require('./components/general/DuckBreed.vue'));

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
Vue.component('generation-summary-hatchery', require('./components/general/GenerationSummaryHatchery.vue'));
Vue.component('generation-summary-mortality', require('./components/general/GenerationSummaryMortality.vue'));
Vue.component('generation-summary-egg', require('./components/general/GenerationSummaryEgg.vue'));
Vue.component('generation-summary-eggqual', require('./components/general/GenerationSummaryEggQual.vue'));

/**
 **  Family Summary 
**/
Vue.component('family-summary-general', require('./components/general/FamilySummaryGeneral.vue'));
Vue.component('family-summary-phenotypic', require('./components/general/FamilySummaryPhenotypic.vue'));
Vue.component('family-summary-morphometric', require('./components/general/FamilySummaryMorphometric.vue'));
Vue.component('family-summary-feeding', require('./components/general/FamilySummaryFeeding.vue'));
Vue.component('family-summary-growth', require('./components/general/FamilySummaryGrowth.vue'));
Vue.component('family-summary-hatchery', require('./components/general/FamilySummaryHatchery.vue'));
Vue.component('family-summary-mortality', require('./components/general/FamilySummaryMortality.vue'));
Vue.component('family-summary-eggprod', require('./components/general/FamilySummaryEggProd.vue'));
Vue.component('family-summary-eggqual', require('./components/general/FamilySummaryEggQual.vue'));

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
