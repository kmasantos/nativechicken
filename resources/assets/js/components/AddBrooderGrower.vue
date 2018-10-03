<template>
    <div>
        <div class="row valign-wrapper">
            <div class="col s12 m8 l8 input-field">
                <input v-model="search" id="search" type="text">
                <label for="search">Search Brooder & Grower Family</label>
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
            <div class="row center" v-if="broodergrowers.data === undefined">
                <div class="col s12 m12 l12">
                    <h5>No Brooder & Grower Families</h5>
                </div>
            </div>
            <!-- Record not Empty -->
            <div class="row" v-else>
                <div class="col s12 m12 l12">
                    <div class="row">
                        <div class="col s12 m6 l6" v-for="broodergrower in broodergrowers.data" :key="broodergrower.id">
                            <div class="card blue-grey lighten-4">
                                <div class="card-content black-text">
                                    <div class="card-title">Family <strong>{{broodergrower.family_number}}</strong></div>
                                    <div class="divider"></div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">Generation : <strong>{{broodergrower.generation_number}}</strong></div>
                                        <div class="col s12 m12 l12">Line : <strong>{{broodergrower.line_number}}</strong></div>
                                        <div class="col s12 m12 l12">Male : <strong>{{broodergrower.number_male}}</strong></div>
                                        <div class="col s12 m12 l12">Female : <strong>{{broodergrower.number_female}}</strong></div>
                                        <div class="col s12 m12 l12">Total : <strong>{{broodergrower.total}}</strong></div>
                                        <div class="col s12 m12 l12">Batching Date : <strong>{{broodergrower.batching_date}}</strong></div>
                                    </div>
                                </div>
                                <div class="card-action right-align">
                                    <a href="javascript:void(0)" @click="feedingRecordPage(broodergrower.id)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Feeding Record"><i class="fas fa-lemon"></i></a>
                                    <a href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Growth Record"><i class="fas fa-balance-scale"></i></a>
                                    <a href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Update"><i class="fas fa-pen-square"></i></a>
                                    <a href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cull"><i class="fas fa-window-close"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                            <pagination :data="broodergrowers" @pagination-change-page="fetchBrooderFamilies"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- FAB -->
        <div class="fixed-action-btn">
            <a href="#broodergrowermodal" class="btn-floating btn-large blue-grey darken-1 modal-trigger"><i class="fas fa-plus"></i></a>
        </div>
        
        <!-- Modals -->
        <div id="broodergrowermodal" class="modal modal-fixed-footer">
            <form v-on:submit.prevent="addBrooderGrower" method="post">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Add Brooder & Grower Outside of System</h4>
                        </div>
                    </div>
                    <!-- <div class="row">
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
                    </div> -->
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
                        <div class="col s12 m6 l6">
                            <label>Pen</label>
                            <select class="browser-default" disabled v-if="pens.length == 0"></select>
                            <select class="browser-default" v-model="selectedpen" v-else>
                                <option value="" disabled selected v-if="pensloaded==false">Pens Loading...</option>
                                <option value="" disabled selected v-else>Choose your option</option>
                                <option v-for="pen in pens" :key="pen.id" v-bind:value="pen.id">{{pen.number}}</option>
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
                broodergrowers : [],
                generations : [],
                lines : [],
                families : [],
                pens : [],
                
                // external : false,
                selectedgeneration : '',
                selectedline : '',
                selectedfamily : '',
                selectedpen : '',
                total : '',
                date_added : '',
                batching_date : '',

                broodergrowerloaded : false,
                generationloaded : false,
                linesloaded : false,
                familiesloaded : false,
                pensloaded : false,

                clicked_family : '',
            }
        },
        methods : {
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            },
            initialize : function () {
                this.fetchGenerations();
                this.fetchPens();
                this.fetchBrooderFamilies();
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
                })
                .then(function (response) {
                    Materialize.toast('Successfully added brooders and growers', 3000, 'rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to add brooders and growers', 3000, 'rounded'); 
                });
                this.initialize();
            },
            fetchBrooderFamilies : function (page = 1) {
                this.broodergrowerloaded = false;
                axios.get('broodergrower_list?page='+page)
                .then(response => this.broodergrowers = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.broodergrowerloaded = true;
            },
            feedingRecordPage : function (id) {
                axios.get('broodergrower_feedingrecord/'+id)
                .then(response)
                .catch(function (error) {
                    console.log(error);
                });
                console.log(response);
            },
        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.initialize();
        }
    }
</script>
