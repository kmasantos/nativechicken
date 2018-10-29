<template>
    <div>
        <div class="row valign-wrapper">
            <div class="col s12 m8 l8 input-field">
                <input v-model="search" id="search" type="text">
                <label for="search">Search Breeder Family</label>
            </div>
            <div class="col s12 m4 l4">
                <a class="waves-effect waves-light btn blue-grey">Search
                    <i class="material-icons right">search</i>
                </a>
            </div>
        </div>
        <div class="row center" v-if="breeders_len == 0">
            <div class="col s12 m12 l12">
                <h5>No Breeder Families</h5>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col s12 m12 l12">
                <div class="row">
                    <div class="col s12 m6 l6" v-for="breeder in breeders.data" :key="breeder.id">
                        <div class="card blue-grey lighten-5">
                            <div class="card-content">
                                <span class="card-title">Family <strong>{{breeder.family_number}}</strong></span>
                                <div class="divider"></div>
                                <div class="row">
                                    <div class="col s12 m12 l12">Line <strong>{{breeder.line_number}}</strong></div>
                                    <div class="col s12 m12 l12">Generation <strong>{{breeder.generation_number}}</strong></div>
                                </div>
                            </div>
                            <div class="card-action right-align">
                                <a @click="selected_breeder=breeder.id; fetchFeedingRecords();" href="#feeding" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Feeding Record"><i class="fas fa-utensils"></i></a>
                                <a @click="selected_breeder=breeder.id; fetchEggProduction()" href="#egg_prod" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Egg Production"><i class="fas fa-chart-line"></i></a>
                                <a @click="hatchery_breeder=breeder.id" href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Hatchery Record"><i class="fas fa-ellipsis-v"></i></a>
                                <a @click="selected_breeder=breeder.id" href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Egg Quality"><i class="fas fa-th-list"></i></a>
                                <a @click="selected_breeder=breeder.id" href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Inventory"><i class="fas fa-home"></i></a>
                                <a @click="selected_breeder=breeder.id" href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Update"><i class="far fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12 center">
                        <pagination :data="breeders" @pagination-change-page="getBreederFamilies"></pagination>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed-action-btn horizontal tooltipped" data-position="left" data-delay="50" data-tooltip="Add Breeder">
            <a href="#add_breeder_modal" class="btn-floating btn-large blue-grey darken-1 modal-trigger"><i class="fas fa-plus"></i></a>
        </div>

        <!-- FOR NEW ADDING OF BREEDERS -->
        <div id="add_breeder_modal" class="modal modal-fixed-footer">
            <form v-on:submit.prevent="addBreeder" method="post">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Add Breeder</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label for="external">Add from External Sources</label>
                                    <div id="external" class="switch">
                                        <label>
                                            Off
                                            <input type="checkbox" @click="external=!external">
                                            <span class="lever"></span>
                                            On
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Generation</label>
                                    <select class="browser-default" v-model="selected_generation" @change="selectGeneration" >
                                        <option value="" disabled selected>Choose Generation</option>
                                        <option value="" v-if="!generations_loaded" disabled>Loading Generations...</option>
                                        <option value="" v-else-if="generations.length==0" disabled>No available generations</option>
                                        <option v-for="generation in generations" :key="generation.id" v-bind:value="generation.id">{{generation.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Line</label>
                                    <select class="browser-default" v-model="selected_line" v-if="selected_generation != ''" @change="selectLine">
                                        <option value="" disabled selected>Choose Line</option>
                                        <option value="" v-if="!lines_loaded" disabled>Loading Lines...</option>
                                        <option v-for="line in lines" :key="line.id" v-bind:value="line.id">{{line.number}}</option>
                                    </select>
                                    <select class="browser-default" disabled v-else></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Family</label>
                                    <select class="browser-default" v-model="selected_family" v-if="selected_line != ''">
                                        <option value="" disabled selected>Choose family</option>
                                        <option value="" v-if="!families_loaded" disabled>Loading Families...</option>
                                        <option v-for="family in families" :key="family.id" v-bind:value="family.id">{{family.number}}</option>
                                    </select>
                                    <select class="browser-default" disabled v-else></select>
                                </div>
                            </div>
                            <div class="row" v-if="!external">
                                <div class="col s12 m6 l6">
                                    <label>Female's Generation</label>
                                    <select class="browser-default" v-model="selected_female_generation" @change="selectFemaleGeneration">
                                        <option value="" disabled selected>Choose Generation</option>
                                        <option value="" v-if="!generations_loaded" disabled>Loading Generations...</option>
                                        <option value="" v-else-if="generations.length==0" disabled>No available generations</option>
                                        <option v-else v-for="generation in generations" :key="generation.id" v-bind:value="generation.id">{{generation.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" v-if="!external">
                                <div class="col s12 m6 l6">
                                    <label>Female's Line</label>
                                    <select class="browser-default" v-model="selected_female_line" v-if="selected_female_generation != '' && selected_family!= ''" @change="selectFemaleLine">
                                        <option value="" disabled selected>Choose Line</option>
                                        <option value="" v-if="!female_lines_loaded" disabled>Loading Lines...</option>
                                        <option v-for="fline in female_lines" :key="fline.id" v-bind:value="fline.id">{{fline.number}}</option>
                                    </select>
                                    <select class="browser-default" disabled v-else></select>
                                </div>
                            </div>
                            <div class="row" v-if="!external">
                                <div class="col s12 m6 l6">
                                    <label>Female's Family</label>
                                    <select class="browser-default" v-model="selected_female_family" v-if="selected_female_line != '' && selected_family!= ''" >
                                        <option value="" disabled selected>Choose family</option>
                                        <option value="" v-if="!female_families_loaded" disabled>Loading Families...</option>
                                        <option v-for="female_family in female_families" :key="female_family.id" v-bind:value="female_family.id">{{female_family.number}}</option>
                                    </select>
                                    <select class="browser-default" disabled v-else></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Move to Pen</label>
                                    <select class="browser-default" v-model="selected_pen">
                                        <option value="" disabled selected>Choose pen</option>
                                        <option value="" disabled v-if="!pens_loaded">Pens Loading...</option>
                                        <option value="" v-else-if="pens.length==0" disabled>No available pens</option>
                                        <option v-for="pen in pens" :key="pen.id" v-bind:value="pen.id">{{pen.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <div class="input-field col s12 m6 l6">
                                        <input v-model.number="males" id="number_male" type="number" min=0>
                                        <label for="number_male">Number Male</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <div class="input-field col s12 m6 l6">
                                        <input v-model.number="females" id="number_female" type="number" min=0>
                                        <label for="number_female">Number Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label for="date_added">Date Added</label>
                                    <datepicker id="date_added" :format="customFormatter" v-model="date_added"></datepicker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                    <button class="modal-action modal-close waves-effect waves-green btn-flat">Submit</button>
                </div>
            </form>
        </div>

        <div id="feeding" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row valign-wrapper">
                    <div class="col s12 m6 l6">
                        <h4>Feeding Record</h4>
                    </div>
                    <div class="col s12 m6 l6 right-align">
                        <a href="#feeding_form" @click="closeModal('#feeding')" class="btn-floating btn-large waves-effect waves-light blue-grey tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Add Record"><i class="material-icons">add</i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <span v-if="feeding_records_len == 0">No Records</span>
                        <div v-else>
                            <table >
                                <thead class="bordered responsive-table highlight">
                                <tr>
                                    <th>Date</th>
                                    <th>Offered</th>
                                    <th>Refused</th>
                                    <th>Remarks</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="feeding in feeding_records.data" :key="feeding.id">
                                        <td>{{feeding.date_collected}}</td>
                                        <td>{{feeding.amount_offered}}</td>
                                        <td>{{feeding.amount_refused}}</td>
                                        <td>{{feeding.remarks}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <pagination :data="feeding_records" @pagination-change-page="fetchFeedingRecords"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>

        <div id="feeding_form" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4>Feeding Record</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <label for="date_added">Date Collected</label>
                                <datepicker id="date_added" :format="customFormatter" v-model="feed_record_collected"></datepicker>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model.number="offered" class="validate" placeholder="Amount of Feed Offered (g)" id="feed_offered" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$" validate>
                                <label for="feed_offered">Feed Offered</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model.number="refused" class="validate" placeholder="Amount of Feed Refused (g)" id="feed_refused" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                <label for="feed_refused">Feed Refused</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model="remarks" placeholder="Add remarks" id="remarks" type="text">
                                <label for="remarks">Remarks</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                <a @click="addFeedingRecords()" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</a>
            </div>
        </div>

        <div id="egg_prod" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row valign-wrapper">
                    <div class="col s12 m6 l6">
                        <h4>Egg Production</h4>
                    </div>
                    <div class="col s12 m6 l6 right-align">
                        <a href="#egg_prod_form" @click="closeModal('#egg_prod')" class="btn-floating btn-large waves-effect waves-light blue-grey tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Add Record"><i class="material-icons">add</i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <span v-if="egg_prod_len == 0">No Records</span>
                        <div v-else>
                            <table >
                                <thead class="bordered responsive-table highlight">
                                <tr>
                                    <th>Date</th>
                                    <th>Total Intact</th>
                                    <th>Total Weight</th>
                                    <th>Broken</th>
                                    <th>Rejected</th>
                                    <th>Remarks</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="prod in egg_prod.data" :key="prod.id">
                                        <td>{{prod.date_collected}}</td>
                                        <td>{{prod.total_eggs_intact}}</td>
                                        <td>{{prod.total_egg_weight}}</td>
                                        <td>{{prod.total_broken}}</td>
                                        <td>{{prod.total_rejects}}</td>
                                        <td>{{prod.remarks}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <pagination :data="egg_prod" @pagination-change-page="fetchEggProduction"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>

        <div id="egg_prod_form" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4>Egg Production</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <label for="date_added">Date Collected</label>
                                <datepicker id="date_added" :format="customFormatter" v-model="date_eggprod_collected"></datepicker>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model.number="total_eggs_intact" class="validate" placeholder="Total Eggs that passes as good" id="intact" type="number" min="0" validate>
                                <label for="intact">Total Eggs Intact</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model.number="total_egg_weight" class="validate" placeholder="Totall egg weight of all intact eggs" id="total_weight" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                <label for="total_weight">Total Egg Weight</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model.number="total_broken" class="validate" placeholder="Total Eggs that were broken" id="total_broken" type="number" min="0" validate>
                                <label for="total_broken">Total Eggs Broken</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model.number="total_rejects" class="validate" placeholder="Total Eggs that doesn't pass as good condition" id="total_rejects" type="number" min="0" validate>
                                <label for="total_rejects">Total Eggs Rejected</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model="egg_prod_remarks" placeholder="Add remarks" id="egg_prod_remarks" type="text">
                                <label for="egg_prod_remarks">Remarks</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                <a @click="addEggProduction()" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</a>
            </div>
        </div>
        <hatchery-record v-if="hatchery_breeder!=null" :breeder="hatchery_breeder" v-on:close_record="hatchery_breeder=null"></hatchery-record>
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
                breeders : {},
                search : '',
                families : [],
                female_families : [],
                generations : [],
                lines : [],
                female_lines : [],
                pens : [],
                selected_family : '',
                selected_generation : '',
                selected_line : '',
                selected_female_generation : '',
                selected_female_line : '',
                selected_female_family : '',
                selected_pen : '',
                date_added : '',
                males : '',
                females : '',

                external : false,
                generations_loaded : false,
                lines_loaded : false,
                female_lines_loaded : false,
                families_loaded : false,
                female_families_loaded : false,
                pens_loaded : false,
                breeders_len : 0,
                selected_breeder : null,
                hatchery_breeder : null,

                feeding_records : {},
                feeding_records_len : 0,
                feed_record_collected : '',
                offered : '',
                refused : '',
                remarks : '',

                egg_prod : {},
                egg_prod_len : 0,
                date_eggprod_collected : '',
                total_eggs_intact : '',
                total_egg_weight : '',
                total_broken : '',
                total_rejects : '',
                egg_prod_remarks : '',

            }
        },
        methods : {
            initialize : function () {
                this.getBreederFamilies();
                this.fetchGenerations();
                this.generations_loaded = true;
                this.fetchAvailablePens();
                this.pens_loaded = true;
            },
            fetchGenerations : function () {
                axios.get('breeder_fetch_generation')
                .then(response => this.generations = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.lines_loaded = true;
            },
            selectGeneration : function () {
                this.fetchLines();
            },
            fetchLines : function () {
                this.lines_loaded = false;
                axios.get('breeder_fetch_line/'+this.selected_generation)
                .then(response => this.lines = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.lines_loaded = true;
            },
            selectLine : function () {
                this.fetchFamilies();
            },
            fetchFamilies : function () {
                this.families_loaded = false;
                axios.get('breeder_fetch_families/'+this.selected_line)
                .then(response => this.families = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.families_loaded = true;
            },
            selectFemaleGeneration : function () {
                this.fetchFemaleLines();
            },
            fetchFemaleLines : function () {
                this.female_lines_loaded = false;
                axios.get('breeder_fetch_line/'+this.selected_female_generation)
                .then(response => this.female_lines = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.female_lines_loaded = true;
            },
            selectFemaleLine : function () {
                this.fetchFemaleFamilies();
            },
            fetchFemaleFamilies : function () {
                this.female_families_loaded = false;
                axios.get('breeder_fetch_female_families/'+this.selected_female_line+'/'+this.selected_family)
                .then(response => this.female_families = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.female_families_loaded = true;
            },
            fetchAvailablePens : function () {
                axios.get('breeder_fetch_pens')
                .then(response => this.pens = response.data)
                .catch(function (error) {
                    console.log(error);
                });
            },
            getBreederFamilies (page = 1) {
                axios.get('breeder_list?page='+page)
                .then(response => {
                    this.breeders = response.data;
                    this.breeders_len = this.breeders.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addBreeder : function () {
                if(this.external==false){
                    axios.post('add_breeder', {
                        family_id: this.selected_family,
                        selected_female_family : this.selected_female_family,
                        date_added : this.customFormatter(this.date_added),
                        number_male : this.males,
                        number_female : this.females,
                        pen_id : this.selected_pen,
                        external : this.external
                    })
                    .then(function (response) {
                        Materialize.toast('Successfully added breeders', 3000, 'rounded');
                    })
                    .catch(function (error) {
                        console.log(error);
                        Materialize.toast('Failed to add breeders', 3000, 'rounded');
                    });
                    this.initialize();
                }else{
                    axios.post('add_breeder', {
                        family_id: this.selected_family,
                        date_added : this.customFormatter(this.date_added),
                        number_male : this.males,
                        number_female : this.females,
                        pen_id : this.selected_pen,
                        external : this.external
                    })
                    .then(function (response) {
                        Materialize.toast('Successfully added breeders', 3000, 'rounded');
                    })
                    .catch(function (error) {
                        console.log(error);
                        Materialize.toast('Failed to add breeders', 3000, 'rounded');
                    });
                    this.initialize();
                }

            },
            fetchFeedingRecords : function (page = 1) {
                axios.get('breeder_feeding/'+this.selected_breeder+"?page="+page)
                .then(response => {
                    this.feeding_records = response.data;
                    this.feeding_records_len = this.feeding_records.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addFeedingRecords : function () {
                axios.post('add_feeding', {
                    breeder_id: this.selected_breeder,
                    date_added : this.customFormatter(this.feed_record_collected),
                    offered : this.offered,
                    refused : this.refused,
                    remarks : this.remarks
                })
                .then(function (response) {
                    Materialize.toast('Successfully added feeding record', 3000, 'rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to add feeding record', 3000, 'rounded');
                });
            },
            fetchEggProduction : function (page = 1) {
                axios.get('egg_prod/'+this.selected_breeder+"?page="+page)
                .then(response => {
                    this.egg_prod = response.data;
                    this.egg_prod_len = this.egg_prod.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addEggProduction : function () {
                axios.post('add_egg_prod', {
                    breeder_id: this.selected_breeder,
                    date_added : this.customFormatter(this.date_eggprod_collected),
                    total_eggs_intact : this.total_eggs_intact,
                    total_egg_weight : this.total_egg_weight,
                    total_broken : this.total_broken,
                    total_rejects : this.total_rejects,
                    remarks : this.egg_prod_remarks,
                })
                .then(function (response) {
                    Materialize.toast('Successfully added egg production record', 3000, 'rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to add egg production record', 3000, 'rounded');
                });
            },
            searchBreeder : function () {

            },
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            },
            closeModal : function (modal_name) {
                $(modal_name).modal('close');
            },
        },
        events: {
            closeHatcheryRecord: function (argument) {
                // logic
            },
        },

        mounted() {

        },
        created() {
            this.initialize();
        }
    }
</script>
