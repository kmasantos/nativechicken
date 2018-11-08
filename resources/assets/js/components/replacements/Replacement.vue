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

            <div v-if="inventory_pen==null&&feeding_pen==null&&phenomorpho_pen==null">
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
                                            <a v-if="replacement_pen.current_capacity>0" @click="inventory_pen=replacement_pen.id; inventory_number=replacement_pen.number" href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Pen information">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a href="#add_modal" v-if="replacement_pen.total_capacity > replacement_pen.current_capacity" @click="selected_pen=replacement_pen.id;selected_pen_number=replacement_pen.number" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Add replacement">
                                                <i class="far fa-plus-square"></i>
                                            </a>
                                            <a v-if="replacement_pen.current_capacity>0" @click="feeding_pen=replacement_pen.id; feeding_number=replacement_pen.number" href="javascript:void(0)" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Feeding records">
                                                <i class="fas fa-utensils"></i>
                                            </a>
                                            <a v-if="replacement_pen.current_capacity>0" @click="phenomorpho_pen=replacement_pen.id; phenomorpho_number=replacement_pen.number" href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Open Pheno/Morpho Records"><i class="fas fa-eye"></i></a>
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
            </div>

            <div v-if="inventory_pen!=null">
                <inventory-replacement :inv_pen_id="inventory_pen" :inv_pen_number="inventory_number" v-on:close_inventory="inventory_pen=null;inventory_number=null"></inventory-replacement>
            </div>
            <div v-if="feeding_pen!=null">
                <feeding-replacement :feed_pen_id="feeding_pen" :feed_pen_number="feeding_number" v-on:close_feeding="feeding_pen=null;feeding_number=null"></feeding-replacement>
            </div>
            <div v-if="phenomorpho_pen!=null">
                <phenomorpho-replacement :phenomorpho_pen_id="phenomorpho_pen" :phenomorpho_pen_number="phenomorpho_number" v-on:close_phenomorpho="phenomorpho_pen=null;phenomorpho_number=null"></phenomorpho-replacement>
            </div>
            <!-- Modals -->
            <div id="add_modal" class="modal modal-fixed-footer">
                <form v-on:submit.prevent="addReplacements" method="post">
                    <div class="modal-content">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h4>Add Replacement to Pen {{selected_pen_number}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <p><i class="fas fa-exclamation-circle"></i> Choose <strong>Within System</strong> tab if you wish to add replacements from brooder & grower stocks.</p>
                                            <p><i class="fas fa-exclamation-circle"> </i> Choose <strong>Outside System</strong> if you wish to add replacements from outside sources.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <span>
                                                <input v-model="external" class="with-gap" name="external" type="radio" id="within" :value="false"/>
                                                <label for="within">Within System</label>
                                            </span>
                                            <span>
                                                <input v-model="external" class="with-gap" name="external" type="radio" id="outside" :value="true"/>
                                                <label for="outside">Outside Systemm</label>
                                            </span>
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
                                            <select @change="getBrooderPens" class="browser-default" v-model="selected_family">
                                                <option value="" disabled v-if="families_loaded==false">Loading Options...</option>
                                                <option value="" disabled selected v-else>Select Family</option>
                                                <option value="" disabled selected v-if="families.length==0">No Families</option>
                                                <option v-for="family in families" :key="family.id" v-bind:value="family.id">{{family.number}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" v-if="external==false">
                                        <div class="col s12 m6 l6">
                                            <label>Transfer from Brooders</label>
                                            <select class="browser-default" v-model="selected_brooder">
                                                <option value="" disabled selected>Select Brooder</option>
                                                <option value="" disabled v-if="brooders_length==0">No Families</option>
                                                <option v-else v-for="brooder in brooders" :key="brooder.inv_id" v-bind:value="brooder.inv_id">Brooder: {{brooder.broodergrower_tag}} | Pen: {{brooder.number}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m6 l6 input-field">
                                            <input v-model.number="males" id="number_male" type="number" min=0 placeholder="Number of male to transfer or add">
                                            <label for="number_male">Number Male</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m6 l6 input-field">
                                            <input v-model.number="females" id="number_female" type="number" min=0 placeholder="Number of female to transfer or add">
                                            <label for="number_female">Number Female</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m6 l6 input-field">
                                            <input v-model="replacement_tag" id="replacement_tag" type="text" placeholder="Replacement's System ID">
                                            <label for="replacement_tag">Replacement Tag</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m6 l6">
                                            <label for="date_added">Date Added</label>
                                            <datepicker id="date_added" :format="customFormatter" v-model="date_added" placeholder="Date when the replacement is transferred"></datepicker>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                        <button href="javascript:void(0)" type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    var moment = require('moment');
    Vue.component('pagination', require('laravel-vue-pagination'));
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
                brooders : [],
                brooders_length : 0,
                selected_pen : '',
                selected_pen_number : '',
                selected_brooder : '',

                // form variables
                external : false,
                selected_generation : '',
                selected_line : '',
                selected_family : '',
                date_added : '',
                males : '',
                females : '',
                replacement_tag : '',

                generations : [],
                lines : [],
                families : [],
                generations_loaded : false,
                lines_loaded : false,
                families_loaded : false,

                inventory_pen : null,
                inventory_number : null,
                feeding_pen : null,
                feeding_number : null,
                phenomorpho_pen : null,
                phenomorpho_number : null
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
            getBrooderPens : function () {
                axios.get('replacement_fetch_brooderpens/'+this.selected_family)
                .then(response => {
                    this.brooders = response.data;
                    this.brooders_length = this.brooders.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
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
                    external : this.external,
                    replacement_tag : this.replacement_tag,
                    brooder_inventory : this.selected_brooder
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.selected_generation = '';
                        this.selected_line = '';
                        this.selected_family = '';
                        this.selected_pen = '';
                        this.males = '';
                        this.females = '';
                        this.date_added = '';
                        this.external = false;
                        this.replacement_tag = '';
                        this.selected_brooder = '';
                        Materialize.toast('Successfully added replacements', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast(error, 3000, 'red rounded');
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
