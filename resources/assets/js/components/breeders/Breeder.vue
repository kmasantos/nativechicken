<template>
    <div>
        <div v-if="breeder_hatchery==null&&breeder_feeding==null&&breeder_eggprod==null&&breeder_eggquality==null&&breeder_phenomorpho==null&&breeder_mortality==null">
            <!-- No Breeder Inventory -->
            <div class="row center-align" v-if="breeders_length === 0">
                <div class="col s12 m12 l12">
                    <h5>No Available Breeders</h5>
                </div>
            </div>
            <!-- Search Bar -->
            <div class="row valign-wrapper" v-if="breeders_length > 0">
                <div class="col s12 m8 l8 input-field">
                    <input v-model="search" id="search" type="text">
                    <label for="search">Search Breeder Tag Number</label>
                </div>
                <div class="col s12 m4 l4">
                    <a class="waves-effect waves-light btn blue-grey">Search
                        <i class="material-icons right">search</i>
                    </a>
                </div>
            </div>
            <!-- Breeder Inventory List -->
            <div class="row" v-if="breeders_length > 0">
                <div class="col s12 m12 l12">
                    <div class="row">
                        <div class="col s12 m6 l6" v-for="breeder in breeders.data" :key="breeder.inventory_id">
                            <div class="card blue-grey lighten-2">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s8 m8 l8">
                                            <label class="white-label" for="tag_title white-text">Breeder Tag</label>
                                            <span id="tag_title" class="card-title white-text">{{breeder.breeder_tag}}</span>
                                        </div>
                                        <div class="col s4 m4 l4 center-align">
                                            <a @click="breeder_delete=breeder.inventory_id;selected_breeder_tag=breeder.breeder_tag;" href="#cull_modal" class="waves-effect waves-grey btn-flat red-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Cull"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <ul class="collection">
                                                <li class="collection-item blue-grey lighten-4 tooltipped" data-position="bottom" data-delay="50" :data-tooltip="'Family : ' + breeder.family_number">F: {{breeder.family_number}}</li>
                                                <li class="collection-item blue-grey lighten-4 tooltipped" data-position="bottom" data-delay="50" :data-tooltip="'Line : ' + breeder.line_number">L: {{breeder.line_number}}</li>
                                                <li class="collection-item blue-grey lighten-4 tooltipped" data-position="bottom" data-delay="50" :data-tooltip="'Generation : ' + breeder.generation_number">G: {{breeder.generation_number}}</li>
                                                <li class="collection-item blue-grey lighten-4 center-align">
                                                    <span>
                                                        <i class="fas fa-mars"></i> Male : {{breeder.number_male}}
                                                    </span> |
                                                    <span>
                                                        <i class="fas fa-venus"></i> Female : {{breeder.number_female}}
                                                    </span>
                                                </li>
                                                <li class="collection-item blue-grey lighten-4 tooltipped" data-position="bottom" data-delay="50" :data-tooltip="'Batching Date : ' + breeder.batching_date">B: {{breeder.batching_date}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action center-align">
                                    <a href="javascript:void(0)" @click="breeder_feeding = breeder.inventory_id; selected_breeder_tag=breeder.breeder_tag;" class="white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Open Feeding Records"><i class="fas fa-utensils"></i></a>
                                    <a href="javascript:void(0)" @click="breeder_eggprod = breeder.inventory_id; selected_breeder_tag=breeder.breeder_tag;" class="white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Open Egg Production Records"><i class="fas fa-chart-line"></i></a>
                                    <a href="javascript:void(0)" @click="breeder_hatchery = breeder.inventory_id;selected_breeder_tag=breeder.breeder_tag;" class="white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Open Hatchery Records"><i class="fas fa-ellipsis-v"></i></a>
                                    <a href="javascript:void(0)" @click="breeder_eggquality = breeder.inventory_id;selected_breeder_tag=breeder.breeder_tag;" class="white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Open Egg Quality Records"><i class="fas fa-th-list"></i></a>
                                    <a href="javascript:void(0)" @click="breeder_phenomorpho = breeder.inventory_id;selected_breeder_tag=breeder.breeder_tag;" class="white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Open Pheno/Morpho Records"><i class="fas fa-eye"></i></a>
                                    <a href="javascript:void(0)" @click="breeder_mortality = breeder.inventory_id;selected_breeder_tag=breeder.breeder_tag;" class="white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Open Mortality & Sales"><i class="fas fa-dollar-sign"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination -->
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                            <pagination :data="breeders" @pagination-change-page="getBreederList"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="breeder_hatchery!=null">
            <hatchery-record :breeder="breeder_hatchery" :breeder_tag="selected_breeder_tag" v-on:close_record="breeder_hatchery=null;selected_breeder_tag=null"></hatchery-record>
        </div>
        <div v-if="breeder_feeding!=null">
            <feedingrecord-breeder :breeder="breeder_feeding" :breeder_tag="selected_breeder_tag" v-on:close_feeding="breeder_feeding=null;selected_breeder_tag=null"></feedingrecord-breeder>
        </div>
        <div v-if="breeder_eggprod!=null">
            <egg-production :breeder="breeder_eggprod" :breeder_tag="selected_breeder_tag" v-on:close_eggprod="breeder_eggprod=null;selected_breeder_tag=null"></egg-production>
        </div>
        <div v-if="breeder_eggquality!=null">
            <eggquality-breeder :breeder="breeder_eggquality" :breeder_tag="selected_breeder_tag" v-on:close_eggqual="breeder_eggquality=null;selected_breeder_tag=null"></eggquality-breeder>
        </div>
        <div v-if="breeder_phenomorpho!=null">
            <phenomorpho-breeder :breeder="breeder_phenomorpho" :breeder_tag="selected_breeder_tag" v-on:close_phenomorpho="breeder_phenomorpho=null;selected_breeder_tag=null"></phenomorpho-breeder>
        </div>
        <div v-if="breeder_mortality!=null">
            <mortality-breeder :breeder="breeder_mortality" :breeder_tag="selected_breeder_tag" v-on:close_mortality="breeder_mortality=null;selected_breeder_tag=null"></mortality-breeder>
        </div>
        <!-- FAB -->
        <div class="fixed-action-btn">
            <a href="#add_breeder_modal" class="btn-floating btn-large blue-grey darken-1 modal-trigger tooltipped" data-position="left" data-delay="50" data-tooltip="Add Breeder Record"><i class="fas fa-plus"></i></a>
        </div>
        <!-- Add Breeder Modal -->
        <div id="add_breeder_modal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4>Add Breeder Record</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <p><i class="fas fa-exclamation-circle"></i> Choose <strong>Within System</strong> tab if you wish to add breeders from replacement stocks.</p>
                                <p><i class="fas fa-exclamation-circle"> </i> Choose <strong>Outside System</strong> if you wish to add breeders from outside sources.</p>
                            </div>
                            <div class="card-tabs">
                                <ul class="tabs tabs-fixed-width">
                                    <li @click="within=true" class="tab"><a href="#within">Within System</a></li>
                                    <li @click="within=false" class="tab"><a href="#outside">Outside System</a></li>
                                </ul>
                            </div>
                            <div class="card-content grey lighten-4">
                                <!-- Within System -->
                                <div id="within">
                                    <form v-on:submit.prevent="addBreeder" method="post">
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Male's Generation</label>
                                                <select @change="selectMaleLine" v-model="selected_male_gen" class="browser-default">
                                                    <option v-if="generations_length === 0" value="" disabled selected>No generation</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="generation in generations" :key="generation.id" :value="generation.id">{{generation.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Male's Line</label>
                                                <select @change="selectMaleFamily" v-model="selected_male_line" class="browser-default">
                                                    <option v-if="male_lines_length == 0" value="" disabled selected>No lines</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="line in male_lines" :key="line.id" :value="line.id">{{line.number}}</option>
                                                </select>
                                            </div>
                                            <div v-if="(selected_male_line != selected_female_line)" class="col s12 m12 l12 orange-text"><i class="fas fa-exclamation-triangle"></i> Male and Female lines does not match</div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Male's Family</label>
                                                <select @change="selectMaleInventory" v-model="selected_male_fam" class="browser-default">
                                                    <option v-if="male_families_length == 0" value="" disabled selected>No families</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="family in male_families" :key="family.id" :value="family.id">{{family.number}}</option>
                                                </select>
                                            </div>
                                            <div v-if="(selected_male_line != selected_female_line)" class="col s12 m12 l12 orange-text"><i class="fas fa-exclamation-triangle"></i> Male and Female families from different lines</div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Male's Replacement Inventory</label>
                                                <select v-model="selected_male_inv" class="browser-default">
                                                    <option v-if="male_inventories_length == 0" value="" disabled selected>No replacement inventory</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="inventories in male_inventories" :key="inventories.id" :value="inventories.id">{{inventories.replacement_tag}}</option>
                                                </select>
                                            </div>
                                            <div v-if="(selected_male_line != selected_female_line)" class="col s12 m12 l12 orange-text"><i class="fas fa-exclamation-triangle"></i> Male and Female families from different lines</div>
                                        </div>
                                        <div class="row">
                                            <div class="col input-field s12 m6 l6">
                                                <input v-model.number="number_male" placeholder="Number of male replacements to transfer" id="males" type="number" min=0 class="validate">
                                                <label for="males">Number of Male</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Female's Generation</label>
                                                <select @change="selectFemaleLine" v-model="selected_female_gen" class="browser-default">
                                                    <option v-if="generations_length === 0" value="" disabled selected>No generation</option>
                                                    <option v-else-if="generations_length > 0" value="" disabled selected>Choose your option</option>
                                                    <option v-for="generation in generations" :key="generation.id" :value="generation.id">{{generation.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Female's Line</label>
                                                <select @change="selectFemaleFamily" v-model="selected_female_line" class="browser-default">
                                                    <option v-if="female_lines_length == 0" value="" disabled selected>No lines</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="line in female_lines" :key="line.id" :value="line.id">{{line.number}}</option>
                                                </select>
                                            </div>
                                            <div v-if="selected_male_line != selected_female_line" class="col s12 m12 l12 orange-text"><i class="fas fa-exclamation-triangle"></i> Male and Female lines does not match</div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Female's Family</label>
                                                <select @change="selectFemaleInventory" v-model="selected_female_fam" class="browser-default">
                                                    <option v-if="female_families_length == 0" value="" disabled selected>No families</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="family in female_families" :key="family.id" :value="family.id">{{family.number}}</option>
                                                </select>
                                            </div>
                                            <div v-if="(selected_male_line != selected_female_line)" class="col s12 m12 l12 orange-text"><i class="fas fa-exclamation-triangle"></i> Male and Female families from different lines</div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Female's Replacement Inventory</label>
                                                <select v-model="selected_female_inv" class="browser-default">
                                                    <option v-if="female_inventories_length == 0" value="" disabled selected>No replacement inventory</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="inventories in female_inventories" :key="inventories.id" :value="inventories.id">{{inventories.replacement_tag}}</option>
                                                </select>
                                            </div>
                                            <div v-if="(selected_male_line != selected_female_line)" class="col s12 m12 l12 orange-text"><i class="fas fa-exclamation-triangle"></i> Male and Female families from different lines</div>
                                        </div>
                                        <div class="row">
                                            <div class="col input-field s12 m6 l6">
                                                <input v-model.number="number_female" placeholder="Number of female replacements to transfer" id="females" type="number" min=0 class="validate">
                                                <label for="females">Number of Female</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Place to pen</label>
                                                <select v-model="selected_pen" class="browser-default">
                                                    <option v-if="pens_length == 0" value="" disabled selected>No breeder pens available</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="pen in pens" :key="pen.id" :value="pen.id">{{pen.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label for="date_added">Date Transferred</label>
                                                <datepicker id="date_added" :format="customFormatter(date_added)" v-model="date_added"></datepicker>
                                            </div>
                                        </div>
                                        <div class="row center">
                                            <div class="col s12 m12 l12">
                                                <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action">Save
                                                    <i class="far fa-save"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Outside System -->
                                <div id="outside">
                                    <form v-on:submit.prevent="addBreeder" method="post">
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label class="active" for="estimated_batching_date">Estimated Date of Hatch</label>
                                                <datepicker id="estimated_batching_date" :format="customFormatter(estimated_batching_date)" v-model="estimated_batching_date"></datepicker>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Generation</label>
                                                <select @change="selectMaleLine" v-model="selected_male_gen" class="browser-default">
                                                    <option v-if="generations_length == 0" value="" disabled selected>No generation</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="generation in generations" :key="generation.id" :value="generation.id">{{generation.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Line</label>
                                                <select @change="selectMaleFamily" v-model="selected_male_line" class="browser-default">
                                                    <option v-if="male_lines_length == 0" value="" disabled selected>No lines</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="line in male_lines" :key="line.id" :value="line.id">{{line.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Family</label>
                                                <select v-model="selected_male_fam" class="browser-default">
                                                    <option v-if="male_families_length == 0" value="" disabled selected>No families</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="family in male_families" :key="family.id" :value="family.id">{{family.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col input-field s12 m6 l6">
                                                <input v-model.number="number_male" placeholder="Number of male replacements to add" id="males" type="number" min=0 class="validate">
                                                <label for="males">Number of Male</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col input-field s12 m6 l6">
                                                <input v-model.number="number_female" placeholder="Number of female replacements to add" id="females" type="number" min=0 class="validate">
                                                <label for="females">Number of Female</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Place to pen</label>
                                                <select v-model="selected_pen" class="browser-default">
                                                    <option v-if="pens_length == 0" value="" disabled selected>No breeder pens available</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="pen in pens" :key="pen.id" :value="pen.id">{{pen.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label for="date_added">Date Transferred</label>
                                                <datepicker id="date_added" :format="customFormatter(date_added)" v-model="date_added"></datepicker>
                                            </div>
                                        </div>
                                        <div class="row center">
                                            <div class="col s12 m12 l12">
                                                <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action">Save
                                                    <i class="far fa-save"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
            </div>
        </div>

        <div id="cull_modal" class="modal">
            <div class="modal-content">
                <h4 class="red-text"><i class="fas fa-exclamation-triangle"></i> Cull Breeder {{selected_breeder_tag}}?</h4>
                <p>Are you sure you want to <strong>Cull</strong> this breeder group?</p>
                <p>This action is <strong>irreversible</strong></p>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">No</a>
                <a @click="cullBreeder" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Yes</a>
            </div>
        </div>
    </div>

</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    Vue.component('pagination', require('laravel-vue-pagination'));
    var moment = require('moment');
    export default {
        components : {
            Datepicker
        },
        data() {
            return {
                search : '',
                breeders : {},
                breeders_length : 0,
                // form data
                within : true,

                generations : [],
                generations_length : 0,
                selected_male_gen : '',
                selected_female_gen : '',
                male_lines : [],
                male_lines_length : 0,
                selected_male_line : '',
                male_families : [],
                male_families_length : 0,
                selected_male_fam : '',
                male_inventories : [],
                male_inventories_length : 0,
                selected_male_inv : '',
                number_male : 0,
                female_lines : [],
                female_lines_length : 0,
                selected_female_line : '',
                female_families : [],
                female_families_length : 0,
                selected_female_fam : '',
                female_inventories : [],
                female_inventories_length : 0,
                selected_female_inv : '',
                number_female : 0,
                pens : [],
                pens_length : 0,
                selected_pen : '',
                date_added : '',
                estimated_batching_date : '',

                inventory_list : true,
                selected_breeder_tag : null,
                breeder_hatchery : null,
                breeder_eggprod : null,
                breeder_eggquality : null,
                breeder_feeding : null,
                breeder_mortality : null,
                breeder_phenomorpho : null,
                breeder_delete : null,
                breeder_mortality : null,
            }
        },
        methods : {
            initialize : function () {
                this.getBreederList();
                this.fetchGeneration();
                this.fetchPens();
            },
            getBreederList : function () {
                axios.get('breeder_list')
                .then(response => {
                    this.breeders = response.data;
                    this.breeders_length = this.breeders.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            fetchGeneration : function () {
                axios.get('breeder_fetch_generation')
                .then(response => {
                    this.generations_length = response.data.length;
                    this.generations = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectMaleLine : function () {
                axios.get('breeder_fetch_line/'+this.selected_male_gen)
                .then(response => {
                    this.male_lines_length = response.data.length;
                    this.male_lines = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectFemaleLine : function () {
                axios.get('breeder_fetch_line/'+this.selected_female_gen)
                .then(response => {
                    this.female_lines_length = response.data.length;
                    this.female_lines = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectMaleFamily : function () {
                axios.get('breeder_fetch_families/'+this.selected_male_line)
                .then(response => {
                    this.male_families_length = response.data.length;
                    this.male_families = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectFemaleFamily : function () {
                axios.get('breeder_fetch_families/'+this.selected_female_line)
                .then(response => {
                    this.female_families_length = response.data.length;
                    this.female_families = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectMaleInventory : function () {
                axios.get('breeder_fetch_inventories/'+this.selected_male_fam)
                .then(response => {
                    this.male_inventories_length = response.data.length;
                    this.male_inventories = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectFemaleInventory : function () {
                axios.get('breeder_fetch_inventories/'+this.selected_female_fam)
                .then(response => {
                    this.female_inventories_length = response.data.length;
                    this.female_inventories = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            fetchPens : function () {
                axios.get('breeder_fetch_pens')
                .then(response => {
                    this.pens_length = response.data.length;
                    this.pens = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addBreeder : function () {
                var param = {};
                if(this.within){
                    param = {
                        within : this.within,
                        male_family : this.selected_male_fam,
                        male_inventory : this.selected_male_inv,
                        number_male : this.number_male,
                        female_family : this.selected_female_fam,
                        female_inventory : this.selected_female_inv,
                        number_female : this.number_female,
                        pen_id : this.selected_pen,
                        date_added : this.customFormatter(this.date_added),
                    };
                }else{
                    param = {
                        within : this.within,
                        estimated_batching_date : this.customFormatter(this.estimated_batching_date),
                        family : this.selected_male_fam,
                        number_male : this.number_male,
                        number_female : this.number_female,
                        pen_id : this.selected_pen,
                        date_added : this.customFormatter(this.date_added),
                    };
                }
                axios.post('add_breeder', param)
                .then(response => {
                    if(response.data.error == undefined){
                        this.selected_male_gen = '';
                        this.selected_female_gen = '';
                        this.male_lines = [];
                        this.male_lines_length = 0;
                        this.selected_male_line = '';
                        this.male_families = [];
                        this.male_families_length = 0;
                        this.selected_male_fam = '';
                        this.male_inventories = [];
                        this.male_inventories_length = 0;
                        this.selected_male_inv = '';
                        this.number_male = 0;
                        this.female_lines = [];
                        this.female_lines_length = 0;
                        this.selected_female_line = '';
                        this.female_families = [];
                        this.female_families_length = 0;
                        this.selected_female_fam = '';
                        this.female_inventories = [];
                        this.female_inventories_length = 0;
                        this.selected_female_inv = '';
                        this.number_female = 0;
                        this.selected_pen = '';
                        this.date_added = '';
                        this.estimated_batching_date = '';
                        Materialize.toast('Successfully added breeders', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast('Failed to add breeders', 3000, 'red rounded');
                });
                this.initialize();
            },
            cullBreeder : function () {
                axios.delete('cull_breeder/'+this.breeder_delete)
                .then(response => {
                    if(response.data.error == undefined){
                        this.breeder_delete = '';
                        $('#cull_modal').modal('close')
                        Materialize.toast('Successfully culled breeder', 5000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 5000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast('Failed to cull breeder', 5000, 'red rounded');
                });
                this.initialize();
            },
            customFormatter : function (date) {
                var formatted = moment(date).format('YYYY-MM-DD')
                return formatted;
            },
        },
        created() {
            this.initialize();
            $('.tooltipped').tooltip({delay: 50});
        },
        beforeCreate() {

        },
        destroyed () {
            $('.tooltipped').tooltip('remove');
        },
    }
</script>
