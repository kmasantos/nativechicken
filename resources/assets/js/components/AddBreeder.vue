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
        <div class="row center" v-if="Array.isArray(breeders.data)==false">
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
                                <a href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Daily Records"><i class="fas fa-calendar-alt"></i></a>
                                <a href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Hatchery Record"><i class="fas fa-ellipsis-v"></i></a>
                                <a href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Egg Quality"><i class="fas fa-th-list"></i></a>
                                <a href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Inventory"><i class="fas fa-home"></i></a>
                                <a href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Update"><i class="far fa-edit"></i></a>
                                <a href="javascript:void(0)" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cull"><i class="fas fa-window-close"></i></a>
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
        computed : {
            checkBreederAttached : function () {

            }
        },
        data() {
            return {
                breeders : [],
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
                .then(response => this.breeders = response.data)
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
            searchBreeder : function () {

            },
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            }
        },
        mounted() {

        },
        created() {
            this.initialize();
        }
    }
</script>
