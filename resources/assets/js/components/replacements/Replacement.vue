<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <!-- Title -->
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Replacements</h5>
                </div>
            </div>
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col s12 m12 l12">
                    <ul class="breadcrumb">
                        <li><a href="./">Home</a></li>
                        <li>Replacements</li>
                    </ul>
                </div>
            </div>
            <!-- Search -->
            <div class="row valign-wrapper">
                <div class="col s12 m9 l9 valign">
                    <label for="search">Search</label>
                    <input v-model="search" placeholder="Type family number" id="search" type="text">
                </div>
                <div class="col s12 m3 l3 valign">
                    <button @click="searchReplacements" class="btn waves-effect waves-light blue-grey darken-1" type="submit">Search<i class="fas fa-search right"></i></button>
                </div>
            </div>
            <!-- Data panel -->
            <div class="row" v-if="replacements_loaded">
                <transition name="fade">
                    <!-- Loading success | With data -->
                    <div class="col s12 m12 l12" v-if="replacement_pens_len > 0">
                        <div class="row">
                            <div class="col s12 m6 l6" v-for="replacement_pen in replacement_pens.data" :key="replacement_pen.id">
                                <div class="card blue-grey lighten-4">
                                    <div class="card-content black-text">
                                        <div class="card-title">Pen {{replacement_pen.number}}</div>
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                Content : {{replacement_pen.current_capacity}}
                                            </div>
                                            <div class="col s12 m12 l12">
                                                Free : {{replacement_pen.total_capacity - replacement_pen.current_capacity}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-action right-align">
                                        <a href="#info" @click="selected_pen=replacement_pen.id; fetchPenInfo()" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Pen information">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="#add_modal" v-if="replacement_pen.total_capacity > replacement_pen.current_capacity" @click="selected_pen=replacement_pen.id;selected_pen_number=replacement_pen.number" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Add replacement">
                                            <i class="far fa-plus-square"></i>
                                        </a>
                                        <a href="#feeding" @click="selected_pen=replacement_pen.id" v-if="replacement_pen.current_capacity>0" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Feeding records">
                                            <i class="fas fa-utensils"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row center">
                            <div class="col s12 m12 l12">
                                <pagination :data="replacement_pens" @pagination-change-page="getReplacementPens"></pagination>
                            </div>
                        </div>
                    </div>
                    <!-- Loading Success | Empty -->
                    <div class="col s12 m12 l12 center-align" v-else>
                        <h5>No Pens</h5>
                    </div>
                </transition>
            </div>
            <!-- Preloader -->
            <div class="row center" v-else>
                <div class="col s12 m12 l12">
                    <div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        Loading...
                    </div>
                </div>
            </div>
            <!-- Modals -->
            <div id="add_modal" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Add Replacement to Pen {{selected_pen_number}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="card">
                                <div class="card-content">
                                    <p><i class="fas fa-exclamation-circle"></i> Choose <strong>Within System</strong> tab if you wish to add replacements from brooder & grower stocks.</p>
                                    <p><i class="fas fa-exclamation-circle"> </i> Choose <strong>Outside System</strong> if you wish to add replacements from outside sources.</p>
                                </div>
                                <div class="card-tabs">
                                <ul class="tabs tabs-fixed-width">
                                    <li class="tab"><a href="#within">Within System</a></li>
                                    <li class="tab"><a href="#outside">Outside System</a></li>
                                </ul>
                                </div>
                                <div class="card-content grey lighten-4">
                                    <div id="within">
                                        <form action="">
                                            inside
                                        </form>
                                    </div>
                                    <div id="outside">
                                        <form action="">
                                            outside
                                        </form>
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

            <!-- <div id="add_modal" class="modal modal-fixed-footer">
                <form v-on:submit.prevent="addReplacements" method="POST">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Add Replacement</h4>
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
                                    <select class="browser-default" v-model="selected_generation" @change="fetchLines">
                                        <option value="" disabled selected v-if="generations_loaded==false">Loading Options...</option>
                                        <option value="" disabled selected v-else>Select Generation</option>
                                        <option value="" disabled selected v-if="generations.length==0">No Generations</option>
                                        <option v-for="generation in generations" :key="generation.id" v-bind:value="generation.id">{{generation.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Line</label>
                                    <select class="browser-default" v-model="selected_line" @change="fetchFamilies">
                                        <option value="" disabled selected v-if="lines_loaded==false">Loading Options...</option>
                                        <option value="" disabled selected v-else>Select Line</option>
                                        <option value="" disabled selected v-if="lines.length==0">No Lines</option>
                                        <option v-for="line in lines" :key="line.id" v-bind:value="line.id">{{line.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Family</label>
                                    <select class="browser-default" v-model="selected_family">
                                        <option value="" disabled v-if="families_loaded==false">Loading Options...</option>
                                        <option value="" disabled selected v-else>Select Family</option>
                                        <option value="" disabled selected v-if="families.length==0">No Families</option>
                                        <option v-for="family in families" :key="family.id" v-bind:value="family.id">{{family.number}}</option>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                    <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</button>
                </div>
                </form>
            </div> -->

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
        data () {
            return {
                search : '',
                replacements_loaded : false,
                replacement_pens : {},
                replacement_pens_len : 0,
                selected_pen : '',
                selected_pen_number : '',

                // form variables
                external : false,
                selected_generation : '',
                selected_line : '',
                selected_family : '',
                date_added : '',
                batching_date : '',
                males : '',
                females : '',

                generations : [],
                lines : [],
                families : [],
                generations_loaded : false,
                lines_loaded : false,
                families_loaded : false,

                pen_info : [],
                info_loaded : false,
                show_info : false,

                selected_pheno_morpho : '',

                gender : '',
                plummage_color : '',
                plummage_pattern : '',
                hackle_color : '',
                hackle_pattern : '',
                body_carriage : '',
                comb_type : '',
                comb_color : '',
                earlobe_color : '',
                iris_color : '',
                beak_color : '',
                shank_color : '',
                skin_color : '',
                other_features : '',

                plummage_color_others : false,
                plummage_pattern_others : false,
                hackle_color_others : false,
                hackle_pattern_others : false,
                body_carriage_others : false,
                comb_type_others : false,
                comb_color_others : false,
                earlobe_color_others : false,
                iris_color_others : false,
                beak_color_others : false,
                shank_color_others : false,
                skin_color_others : false,

                height : '',
                weight : '',
                body_length : '',
                chest_circumference : '',
                wing_span : '',
                shank_length : '',

                feed_record_collected : '',
                offered : '',
                refused : '',
                remarks : '',
            }
        },
        methods : {
            initialize : function () {
                this.getReplacementPens();
                this.fetchGenerations();
            },
            getReplacementPens : function (page = 1) {
                this.replacements_loaded = false;
                axios.get('replacement_pens?page='+page)
                .then(response => {
                    this.replacement_pens_len = response.data.data.length;
                    this.replacement_pens = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.replacements_loaded = true;
            },
            searchReplacements : function () {
                this.replacements_loaded = false;
                axios.get('search_replacement_pens/'+this.search)
                .then(response => this.replacement_pens = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.replacements_loaded = true;
            },
            fetchGenerations : function () {
                this.generations_loaded = false;
                axios.get('replacement_fetch_generations')
                .then(response => {
                    this.generations = response.data;
                    this.generations_loaded = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            fetchLines : function () {
                this.lines_loaded = false;
                axios.get('replacement_fetch_lines/'+this.selected_generation)
                .then(response => {
                    this.lines = response.data;
                    this.lines_loaded = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            fetchFamilies : function () {
                this.families_loaded = false;
                axios.get('replacement_fetch_families/'+this.selected_line)
                .then(response => {
                    this.families = response.data;
                    this.families_loaded = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addReplacements : function () {
                axios.post('add_replacements', {
                    family_id : this.selected_family,
                    pen_id : this.selected_pen,
                    males : this.males,
                    females : this.females,
                    date_added : this.customFormatter(this.date_added),
                    batching_date : this.customFormatter(this.batching_date),
                    external : this.external
                })
                .then(function (response) {
                    Materialize.toast('Successfully added replacements', 3000, 'rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to add replacements', 3000, 'rounded');
                });
                this.getReplacementPens();
            },
            fetchPenInfo : function (){
                this.info_loaded = false;
                axios.get('replacement_pen_info/'+this.selected_pen)
                .then(response => {
                    this.pen_info = response.data;
                    this.info_loaded = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            submitPhenoMorpho : function (){
                axios.post('add_phenomorpho', {
                    replacement_id : this.selected_pheno_morpho,
                    gender : this.gender,
                    plummage_color : this.plummage_color,
                    plummage_pattern : this.plummage_pattern,
                    hackle_color : this.hackle_color,
                    hackle_pattern : this.hackle_pattern,
                    body_carriage : this.body_carriage,
                    comb_type : this.comb_type,
                    comb_color : this.comb_color,
                    earlobe_color : this.earlobe_color,
                    iris_color : this.iris_color,
                    beak_color : this.beak_color,
                    shank_color : this.shank_color,
                    skin_color : this.skin_color,
                    other_features : this.other_features,
                    height : this.height,
                    weight : this.weight,
                    body_length : this.body_length,
                    chest_circumference : this.chest_circumference,
                    wing_span : this.wing_span,
                    shank_length : this.shank_length,
                })
                .then(function (response) {
                    Materialize.toast('Successfully added phenotypic and morphometric data', 3000, 'rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to add phenotypic and morphometric data', 3000, 'rounded');
                });
            },
            submitPenFeedingRecord : function () {
                axios.post('add_penfeeding', {
                    pen_id : this.selected_pen,
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
            closeInfoModal : function (){
                $('#info').modal('close');
            },
            customFormatter : function(date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            }
        },
        mounted () {

        },
        created () {
            this.initialize();

        }

    }
</script>

<style>
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
