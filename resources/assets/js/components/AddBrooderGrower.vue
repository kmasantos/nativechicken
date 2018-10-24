<template>
    <div>
        <div class="row valign-wrapper">
            <div class="col s12 m8 l8 input-field">
                <input v-model="search" id="search" type="text">
                <label for="search">Search Brooder & Grower Pen</label>
            </div>
            <div class="col s12 m4 l4">
                <a class="waves-effect waves-light btn blue-grey darken-1">Search<i class="material-icons right">search</i></a>
            </div>
        </div>
        <!-- Preloader -->
        <div class="row center" v-if="!broodergrowerloaded">
            <div class="col s12 m12 l12">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <!-- Empty Record -->
            <div class="row center" v-if="broodergrower_pen_len == 0">
                <div class="col s12 m12 l12">
                    <h5>No Brooder & Grower Pens</h5>
                </div>
            </div>
            <!-- Record not Empty -->
            <div class="row" v-else>
                <div class="col s12 m12 l12">
                    <div class="row">
                        <div class="col s12 m6 l6" v-for="pen in broodergrower_pens.data" :key="pen.id">
                            <div class="card blue-grey lighten-4">
                                <div class="card-content black-text">
                                    <div class="card-title">Pen {{pen.number}}</div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">Content : {{pen.current_capacity}}</div>
                                        <div class="col s12 m12 l12">Free : {{pen.total_capacity-pen.current_capacity}}</div>
                                    </div>
                                </div>
                                <div class="card-action right-align">
                                        <a @click="selectedpen=pen.id; fetchPenInfo()" href="#info" v-if="pen.current_capacity>0" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Pen information">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a @click="selectedpen=pen.id" href="#broodergrowermodal" v-if="pen.total_capacity > pen.current_capacity" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Add brooder & grower">
                                            <i class="far fa-plus-square"></i>
                                        </a>
                                        <a @click="selectedpen=pen.id" href="#feeding" v-if="pen.current_capacity>0" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Feeding records">
                                            <i class="fas fa-utensils"></i>
                                        </a>
                                        <a @click="selectedpen=pen.id" href="#growth" v-if="pen.current_capacity>0" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Growth records">
                                            <i class="fas fa-balance-scale"></i>
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                            <pagination :data="broodergrower_pens" @pagination-change-page="fetchBrooderPens"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAB -->
        <!-- <div class="fixed-action-btn">
            <a href="#broodergrowermodal" class="btn-floating btn-large blue-grey darken-1 modal-trigger"><i class="fas fa-plus"></i></a>
        </div> -->

        <!-- Modals -->
        <div id="broodergrowermodal" class="modal modal-fixed-footer">
            <form v-on:submit.prevent="addBrooderGrower" method="post">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Add Brooder & Grower</h4>
                        </div>
                    </div>
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
                            <select class="browser-default" disabled v-if="generations.length == 0"></select>
                            <select class="browser-default" v-model="selectedgeneration" @change="fetchLines" v-else>
                                <option value="" disabled selected v-if="generationsloaded==false">Loading Generations...</option>
                                <option value="" disabled selected v-else>Choose your option</option>
                                <option v-for="generation in generations" :key="generation.id" v-bind:value="generation.id">{{generation.number}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <label>Lines</label>
                            <select class="browser-default" disabled v-if="lines.length == 0"></select>
                            <select class="browser-default" v-model="selectedline" @change="fetchFamilies" v-else>
                                <option value="" disabled selected v-if="linesloaded==false">Loading Lines...</option>
                                <option value="" disabled selected v-else>Choose your option</option>
                                <option v-for="line in lines" :key="line.id" v-bind:value="line.id">{{line.number}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <label>Families</label>
                            <select class="browser-default" disabled v-if="families.length == 0"></select>
                            <select class="browser-default" v-model="selectedfamily" v-else>
                                <option value="" disabled selected v-if="familiesloaded==false">Families Loading...</option>
                                <option value="" disabled selected v-else>Choose your option</option>
                                <option v-for="family in families" :key="family.id" v-bind:value="family.id">{{family.number}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6 input-field">
                            <input v-model.number="total" id="total" type="number" min="0">
                            <label for="total">Total</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <label for="date_added">Batching Date</label>
                            <datepicker id="date_added" :format="customFormatter" v-model="batching_date"></datepicker>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <label for="date_added">Date Added</label>
                            <datepicker id="date_added" :format="customFormatter" v-model="date_added"></datepicker>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Close</a>
                    <button class="modal-action modal-close waves-effect waves-grey btn-flat">Submit</button>
                </div>
            </form>
        </div>

        <div id="feeding" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4>Feeding Records</h4>
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
                <a @click="submitPenFeedingRecord" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</a>
            </div>
        </div>

        <div id="growth" class="modal modal-fixed-footer">
            <form v-on:submit.prevent="addGrowthRecords" method="post">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Add Growth Record</h4>
                        </div>
                    </div>
                    <label for="collection_day">Collection Day</label>
                    <div class="row" id="collection_day">
                        <div class="col s12 m12 l12" v-if="others==false">
                            <input v-model.number="collection_day" class="with-gap" name="group1" type="radio" id="day0" value=0 />
                            <label for="day0">Day 0</label>
                            <input v-model.number="collection_day" class="with-gap" name="group1" type="radio" id="day21" value=21 />
                            <label for="day21">Day 21</label>
                            <input v-model.number="collection_day" class="with-gap" name="group1" type="radio" id="day45" value=45 />
                            <label for="day45">Day 45</label>
                            <input v-model.number="collection_day" class="with-gap" name="group1" type="radio" id="day75" value=75 />
                            <label for="day75">Day 75</label>
                            <input v-model.number="collection_day" class="with-gap" name="group1" type="radio" id="day100" value=100 />
                            <label for="day100">Day 100</label>
                        </div>
                        <div class="col s12 m12 l12">
                            <label for="others">Input Other Day</label>
                            <div id="others" class="switch">
                                <label>
                                    No
                                    <input type="checkbox" @click="others=!others">
                                    <span class="lever"></span>
                                    Yes
                                </label>
                            </div>
                        </div>
                        <div class="col s12 m6 l6" v-if="others==true">
                            <input v-model.number="collection_day" placeholder="Input collection day" type="number" min="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <label for="sexing">Sexing Done</label>
                            <div id="sexing" class="switch">
                                <label>
                                    No
                                    <input type="checkbox" @click="sexing=!sexing">
                                    <span class="lever"></span>
                                    Yes
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <label for="date_added">Date Collected</label>
                            <datepicker id="date_added" :format="customFormatter" v-model="date_added"></datepicker>
                        </div>
                    </div>
                    <div class="row" v-if="sexing==false">
                        <div class="col s12 s6 m6 input-field">
                            <input v-model.number="total_weight" class="validate" placeholder="Total weight of all animals (kg)" id="total_weight" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                            <label class="active" for="total_weight">Total Weight</label>
                        </div>
                    </div>
                    <div v-else>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model.number="male_weight" class="validate" placeholder="Total weight of all males (kg)" id="male_weight" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                <label class="active" for="male_weight">Male Weight</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model.number="female_weight" class="validate" placeholder="Total weight of all females (kg)" id="female_weight" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                <label class="active" for="female_weight">Female Weight</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Close</a>
                    <button class="modal-action modal-close waves-effect waves-grey btn-flat">Submit</button>
                </div>
            </form>
        </div>

        <div id="info" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Pen Info</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="responsive-table bordered highlight centered">
                                <thead>
                                    <tr>
                                        <th>Line</th>
                                        <th>Family</th>
                                        <th>Batching Date</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <th>Last Update</th>
                                        <th>Update Male/Female Count</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="info in pen_info" :key="info.fam_id">
                                        <td>{{info.line_number}}</td>
                                        <td>{{info.fam_number}}</td>
                                        <td>{{info.batching_date}}</td>
                                        <td v-if="info.number_male==null">-</td>
                                        <td v-else>{{info.number_male}}</td>
                                        <td v-if="info.number_female==null">-</td>
                                        <td v-else>{{info.number_female}}</td>
                                        <td>{{info.total}}</td>
                                        <td>{{info.last_update}}</td>
                                        <td><a v-if="(info.number_male==null&&info.number_female==null)" @click="update_brooder=info.bg_id;closeInfoModal();selected_broodergrower_total=info.total" class="modal-trigger" :href="'#update'"><i class="fas fa-sort-numeric-down"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                </div>
            </div>

            <div id="update" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Update Brooders and Growers</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 s6 m6 input-field">
                                    <input v-model.number="male" class="validate" placeholder="Update number of male" id="male" type="number" min="0">
                                    <label class="active" for="male">Male</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 s6 m6 input-field">
                                    <input v-model.number="female" class="validate" placeholder="Update number of female" id="female" type="number" min="0">
                                    <label class="active" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                    <a href="javascript:void(0)" @click="updateBrooderGrower()" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</a>
                </div>
            </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    var moment = require('moment');
    export default {
        components : {
            Datepicker
        },
        data() {
            return {
                search : '',
                broodergrowers_pens : {},
                generations : [],
                lines : [],
                families : [],
                pens : [],
                pen_info : [],

                external : false,
                selectedgeneration : '',
                selectedline : '',
                selectedfamily : '',
                selectedpen : '',
                total : '',
                date_added : '',
                batching_date : '',

                broodergrowerloaded : false,
                broodergrower_pen_len : 0,
                generationloaded : false,
                linesloaded : false,
                familiesloaded : false,
                pensloaded : false,
                info_loaded : false,

                clicked_family : '',
                update_brooder : '',

                male : 0,
                female : 0,
                date_updated : '',
                data_collected : '',
                selected_broodergrower : '',
                selected_broodergrower_total : '',

                feed_record_collected : '',
                offered : '',
                refused : '',
                remarks : '',

                date_added : '',
                collection_day : '',
                male_weight : '',
                female_weight : '',
                total_weight: '',

                sexing : false,
                others : false,

                male : '',
                female : '',
            }
        },
        methods : {
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            },
            initialize : function () {
                this.fetchGenerations();
                this.fetchBrooderPens();
            },
            fetchGenerations : function () {
                this.generationsloaded = false;
                axios.get('broodergrower_fetch_generation')
                .then(response => this.generations = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.generationsloaded = true;
            },
            fetchPens : function () {
                this.pensloaded = false;
                axios.get('broodergrower_fetch_pens')
                .then(response => this.pens = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.pensloaded = true;
            },
            fetchLines : function () {
                this.linesloaded = false;
                axios.get('broodergrower_fetch_lines/'+this.selectedgeneration)
                .then(response => this.lines = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.linesloaded = true;
            },
            fetchFamilies : function () {
                this.familiesloaded = false;
                axios.get('broodergrower_fetch_families/'+this.selectedline)
                .then(response => this.families = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.familiesloaded = true;
            },
            addBrooderGrower : function () {
                axios.post('add_broodergrower', {
                    family_id : this.selectedfamily,
                    pen_id : this.selectedpen,
                    batching_date : this.customFormatter(this.batching_date),
                    date_added : this.customFormatter(this.date_added),
                    total : this.total,
                    external : this.external,
                })
                .then(function (response) {
                    Materialize.toast('Successfully added brooders and growers', 3000, 'rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to add brooders and growers', 3000, 'rounded');
                });
                this.initialize();
            },
            fetchBrooderPens : function () {
                this.broodergrowerloaded = false;
                axios.get('broodergrower_pens')
                .then(response => {
                    this.broodergrower_pens = response.data;
                    this.broodergrower_pen_len = response.data.data.length;
                    this.broodergrowerloaded = true;
                })
                .catch(function(error){

                });
            },
            submitPenFeedingRecord : function () {
                axios.post('add_broodergrower_feeding', {
                    pen_id : this.selectedpen,
                    date_collected : this.customFormatter(this.feed_record_collected),
                    offered : this.offered,
                    refused : this.refused,
                    remark : this.remarks
                })
                .then(function (response) {
                    Materialize.toast('Successfully added feeding record', 3000, 'rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to add feeding record', 3000, 'rounded');
                });
            },
            fetchPenInfo : function (){
                this.info_loaded = false;
                axios.get('broodergrower_pen_info/'+this.selectedpen)
                .then(response => {
                    this.pen_info = response.data;
                    this.info_loaded = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            closeInfoModal : function (){
                $('#info').modal('close');
            },
            updateBrooderGrower : function () {
                if(this.selected_broodergrower_total != (this.male + this.female)){
                    Materialize.toast('Sum of male and female does not match to the total', 3000, 'rounded');
                }else{
                    axios.patch('update_broodergrower', {
                        broodergrower_id : this.update_brooder,
                        male : this.male,
                        female : this.female,
                    })
                    .then(function (response) {
                        Materialize.toast('Data updated', 3000, 'rounded');
                    })
                    .catch(function (error) {
                        Materialize.toast('Data failed to update', 3000, 'rounded');
                    });
                    this.initialize();
                }
            },
        },
        created() {
            this.initialize();
        }
    }
</script>
