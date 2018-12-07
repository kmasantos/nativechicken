<template>
    <div>
        <div class="row valign-wrapper">
            <div class="col s12 m8 l8 input-field">
                <input v-model="search" id="search" type="text">
                <label for="search">Search Brooder Pens</label>
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
                <div class="col s12 m12 l12" v-if="inventory_pen==null&&feeding_pen==null&&growth_pen==null">
                    <div class="row">
                        <div class="col s12 m6 l6" v-for="pen in broodergrower_pens.data" :key="pen.id">
                            <div class="card blue-grey lighten-4">
                                <div class="card-content">
                                    <div class="card-title">Pen {{pen.number}}</div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">Content : {{pen.current_capacity}}</div>
                                        <div class="col s12 m12 l12">Free : {{pen.total_capacity-pen.current_capacity}}</div>
                                    </div>
                                </div>
                                <div class="card-action right-align">
                                    <a v-if="pen.current_capacity>0" @click="inventory_pen=pen.id; inventory_number=pen.number" href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Pen information">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a v-if="pen.total_capacity > pen.current_capacity" @click="selectedpen=pen.id" href="#broodergrowermodal" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Add brooder & grower">
                                        <i class="far fa-plus-square"></i>
                                    </a>
                                    <a v-if="pen.current_capacity>0" @click="feeding_pen=pen.id; feeding_number=pen.number"  href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Feeding records">
                                        <i class="fas fa-utensils"></i>
                                    </a>
                                    <a v-if="pen.current_capacity>0" @click="growth_pen=pen.id; growth_number=pen.number" class="black-text tooltipped" href="javascript:void(0)" data-position="bottom" data-delay="50" data-tooltip="Growth records">
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
                <div class="col s12 m12 l12" v-if="inventory_pen!=null">
                    <inventory-broodergrower  :inv_pen_id="inventory_pen" :inv_pen_number="inventory_number" v-on:close_inventory="inventory_pen=null;inventory_number=null;initialize()"></inventory-broodergrower>
                </div>
                <div class="col s12 m12 l12" v-if="feeding_pen!=null">
                    <feedingrecord-broodergrower :feed_pen_id="feeding_pen" :feed_pen_number="feeding_number" v-on:close_feeding="feeding_pen=null;feeding_number=null"></feedingrecord-broodergrower>
                </div>
                <div class="col s12 m12 l12" v-if="growth_pen!=null">
                    <growthrecord-broodergrower :growth_pen_id="growth_pen" :growth_pen_number="growth_number" v-on:close_growth="growth_pen=null;growth_number=null"></growthrecord-broodergrower  >
                </div>
            </div>
        </div>

        <!-- Modals -->
        <div id="broodergrowermodal" class="modal modal-fixed-footer">
            <form v-on:submit.prevent="addBrooderGrower" method="post">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Add Brooder & Grower from Outside Source</h4>
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
                            <label for="estimate_date_hatch">Estimated Date of Hatch</label>
                            <datepicker id="estimate_date_hatch" :format="customFormatter" v-model="estimate_date_hatch"></datepicker>
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
                    <button class="modal-action modal-close waves-effect waves-grey btn-flat" type="submit">Submit</button>
                </div>
            </form>
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

                selectedgeneration : '',
                selectedline : '',
                selectedfamily : '',
                selectedpen : '',
                estimate_date_hatch : '',
                total : '',
                date_added : '',

                broodergrowerloaded : false,
                broodergrower_pen_len : 0,
                generationloaded : false,
                linesloaded : false,
                familiesloaded : false,
                pensloaded : false,
                info_loaded : false,

                // child component data
                inventory_pen : null,
                inventory_number : null,
                feeding_pen : null,
                feeding_number : null,
                growth_pen : null,
                growth_number : null,
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
                    broodergrower_tag : this.broodergrower_tag,
                    family_id : this.selectedfamily,
                    pen_id : this.selectedpen,
                    date_added : this.customFormatter(this.date_added),
                    batching_date : this.customFormatter(this.estimate_date_hatch),
                    total : this.total,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.selectedgeneration = '';
                        this.selectedline = '';
                        this.selectedfamily = '';
                        this.selectedpen = '';
                        this.broodergrower_tag = '';
                        this.total = '';
                        this.date_added = '';
                        this.estimate_date_hatch = '';
                        Materialize.toast('Successfully added brooders and growers', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast('Failed to add brooders and growers', 3000, 'red rounded');
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
        },
        created() {
            this.initialize();
        }
    }
</script>
