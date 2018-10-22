<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Replacements</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <ul class="breadcrumb">
                        <li><a href="./">Home</a></li>
                        <li>Replacements</li>
                    </ul>
                </div>
            </div>
            <form v-on:submit.prevent="searchReplacements" method="GET">
                <div class="row valign-wrapper">
                    <div class="col s12 m9 l9 valign">
                        <label for="search">Search</label>
                        <input v-model="search" placeholder="Type family number" id="search" type="text">
                    </div>
                    <div class="col s12 m3 l3 valign">
                        <button class="btn waves-effect waves-light blue-grey darken-1" type="submit">Search<i class="fas fa-search right"></i></button>
                    </div>
                </div>
            </form>
            <div class="row" v-if="Array.isArray(replacements.data) == false">
                <div class="col s12 m12 l12 center">
                    <h5>No Replacement Stocks</h5>
                </div>
            </div>
            <div class="row" v-else>
                <div class="col s12 m12 l12" v-if="replacements_loaded">
                    <div class="row">
                        <div class="col s12 m4 l4" v-for="replacement in replacements.data" :key="replacement.id">
                            <div class="card blue-grey lighten-5">
                                <div class="card-content black-text">
                                <div class="row card-title">
                                    <div class="col s5 m5 l5">Family</div>
                                    <div class="col s7 m7 l7"><strong>{{replacement.family_number}}</strong></div>
                                </div>
                                <div class="row">
                                    <div class="col s5 m5 l5">Line</div>
                                    <div class="col s7 m7 l7"><strong>{{replacement.line_number}}</strong></div>
                                </div>
                                <div class="row">
                                    <div class="col s5 m5 l5">Generation</div>
                                    <div class="col s7 m7 l7"><strong>{{replacement.generation_number}}</strong></div>
                                </div>
                                </div>
                                <div class="card-action right-align">
                                    <a v-bind:href="'add_pheno_morpho/'+replacement.family_id" class="tooltipped" data-position="top" data-delay="50" data-tooltip="Pheno/Morpho Details"><i class="fas fa-asterisk"></i></a>
                                    <a href="#update_modal" class="tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Update" @click="selected_replacement_family=replacement.family_number"><i class="far fa-edit"></i></a>
                                    <a href="#" class="tooltipped" data-position="top" data-delay="50" data-tooltip="Cull"><i class="far fa-minus-square"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                            <pagination :data="replacements" @pagination-change-page="getReplacementList"></pagination>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l12" v-else>
                    <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                        <div class="circle"></div>
                        </div><div class="gap-patch">
                        <div class="circle"></div>
                        </div><div class="circle-clipper right">
                        <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fixed-action-btn">
                <a href="#add_modal" class="btn-floating btn-large blue-grey darken-1 modal-trigger">
                    <i class="large material-icons">add</i>
                </a>
            </div>
            <div id="add_modal" class="modal modal-fixed-footer">
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
                                    <select class="browser-default" v-model="selected_generation" @click.prevent="fetchGenerations">
                                        <option value="" disabled selected v-if="generations_loaded==false">Loading Options...</option>
                                        <option value="" disabled selected v-else>Select Generation</option>
                                        <option v-for="generation in generations" :key="generation.id" v-bind:value="generation.id">{{generation.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Line</label>
                                    <select class="browser-default" v-model="selected_line" @click.prevent="fetchLines">
                                        <option value="" disabled selected v-if="lines_loaded==false">Loading Options...</option>
                                        <option value="" disabled selected v-else>Select Line</option>
                                        <option v-for="line in lines" :key="line.id" v-bind:value="line.id">{{line.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Family</label>
                                    <select class="browser-default" v-model="selected_family" @click="fetchFamilies">
                                        <option value="" disabled v-if="families_loaded==false">Loading Options...</option>
                                        <option value="" disabled selected v-else>Select Family</option>
                                        <option value="" disabled selected v-if="families.length==0">No Families</option>
                                        <option v-for="family in families" :key="family.id" v-bind:value="family.id">{{family.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Pen</label>
                                    <select class="browser-default" v-model="selected_pen" @click="fetchPens">
                                        <option value="" disabled v-if="pens_loaded==false">Loading Options...</option>
                                        <option value="" disabled selected v-else>Select Pen</option>
                                        <option value="" disabled selected v-if="pens.length==0">No Pens</option>
                                        <option v-for="pen in pens" :key="pen.id" v-bind:value="pen.id">{{pen.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <div class="input-field col s12 m6 l6">
                                        <input v-model="males" id="number_male" type="number" min=0>
                                        <label for="number_male">Number Male</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <div class="input-field col s12 m6 l6">
                                        <input v-model="females" id="number_female" type="number" min=0>
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
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</a>
                    <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</button>
                </div>
                </form>
            </div>

            <div id="update_modal" class="modal modal-fixed-footer">
                <form>
                    <div class="modal-content">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h4>Update {{selected_replacement_family}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="row">
                                    <div class="col s12 m6 l6">
                                        <label class="active" for="male">Update Number Male</label>
                                        <input value="1" id="male" type="number" min="0">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m6 l6">
                                        <label class="active" for="female">Update Number Female</label>
                                        <input value="1" id="female" type="number" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</a>
                    </div>
                </form>
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
                replacements : [],
                families : [],
                lines : [],
                generations : [],
                pens : [],
                selected_family : '',
                selected_line : '',
                selected_generation : '',
                selected_pen : '',
                selected_replacement_family : '',
                selected_replacement_id : '',
                males : '',
                females : '',
                external : false,
                date_added : '',
                generations_loaded : false,
                lines_loaded : false,
                families_loaded : false,
                replacements_loaded : false,
                pens_loaded : false,
                url : 'javascript:void(0)',
            }
        },

        mounted() {
            this.intitialize();
        },
        created () {

        },
        methods :{
            intitialize : function () {
                this.getReplacementList();
                this.fetchGenerations();
                this.fetchPens();
            },
            preloadLines : function () {
                this.lines_loaded = false;
                axios.get('replacement_fetch_lines/'+'%')
                .then(response => this.lines = response.data)
                .catch(error => console.log(error));
                this.lines_loaded = true;
            },
            getReplacementList : function (page = 1) {
                this.replacements_loaded = false;
                axios.get('replacement_list?page='+page)
                .then(response => this.replacements = response.data)
                .catch(error => console.log(error));
                this.replacements_loaded = true;
            },
            fetchGenerations :function () {
                this.generations_loaded = false;
                axios.get('replacement_fetch_generations')
                .then(response => this.generations = response.data)
                .catch(error => console.log(error));
                this.generations_loaded = true;
            },
            fetchLines : function () {
                this.lines_loaded = false;
                axios.get('replacement_fetch_lines/'+this.selected_generation)
                .then(response => this.lines = response.data)
                .catch(error => console.log(error));
                this.lines_loaded = true;
            },
            fetchFamilies : function () {
                this.families_loaded = false;
                axios.get('replacement_fetch_families/'+this.selected_line)
                .then(response => this.families = response.data)
                .catch(error => console.log(error));
                this.families_loaded = true;
            },
            fetchPens : function () {
                this.pens_loaded = false;
                axios.get('replacement_fetch_pens')
                .then(response => this.pens = response.data)
                .catch(error => console.log(error));
                this.pens_loaded = true;
            },
            addReplacements : function () {
                axios.post('add_replacements', {
                    family_id: this.selected_family,
                    date_added : this.customFormatter(this.date_added),
                    number_male : this.males,
                    number_female : this.females,
                    pen_id : this.selected_pen,
                    external : this.external
                })
                .then(function (response) {
                    Materialize.toast('Successfully added replacements', 3000, 'rounded');
                })
                .catch(function (error) {
                    console.log(error);
                    Materialize.toast('Failed to add replacements', 3000, 'rounded');
                });
                this.getReplacementList();
                this.fetchPens();
            },
            updateReplacement : function () {

            },
            cullReplacement : function () {

            },
            searchReplacements : function () {
                axios.get('search_replacements/'+this.search)
                .then(response => this.replacements = response.data)
                .catch(error => console.log(error));
            },
            customFormatter : function(date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            }
        }
    }
</script>
