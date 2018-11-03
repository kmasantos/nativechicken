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
        <div class="row center" v-if="broodergrowerloaded==false">
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
            <div class="row center" v-if="Array.isArray(broodergrowers.data) == false">
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
                                    <a href="#broodergrowermodal" @click="selected_broodergrower=broodergrower.id" class="tooltipped black-text modal-trigger" data-position="top" data-delay="50" data-tooltip="Add growth records"><i class="fas fa-plus-circle"></i></a>
                                    <a href="javascript:void(0)" @click="selected_broodergrower=broodergrower.id; fetchGrowthRecords();" class="tooltipped black-text" data-position="top" data-delay="50" data-tooltip="Show growth records"><i class="fas fa-info-circle"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                            <pagination :data="broodergrowers" @pagination-change-page="fetchBrooderFamilies"></pagination>
                        </div>
                    </div>
                    <div class="row" v-if="growthdetails">
                        <div class="col s12 m12 l12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row card-title valign-wrapper">
                                        <div class="col s10 m10 l10">
                                            Growth Performance
                                        </div>
                                        <div class="col s2 m2 l2 center-align">
                                            <a href="javascript:void(0)" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Close" @click="growthdetails=false"><i class="fas fa-window-close red-text"></i></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <div v-if="Array.isArray(growthrecords.data) == false" class="center"><h5>No data</h5></div>
                                            <table v-else class="responsive-table highlight bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Date Collected</th>
                                                        <th>Collection Day</th>
                                                        <th>Male Quantity</th>
                                                        <th>Male Weight</th>
                                                        <th>Female Quantity</th>
                                                        <th>Female Weight</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Weight</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="growthrecord in growthrecords.data" :key="growthrecord.id">
                                                        <td>{{growthrecord.date_collected}}</td>
                                                        <td>{{growthrecord.collection_day}}</td>
                                                        <td v-if="growthrecord.male_quantity==null">N/A</td>
                                                        <td v-else>{{growthrecord.male_quantity}}</td>
                                                        <td v-if="growthrecord.male_weight==null">N/A</td>
                                                        <td v-else>{{growthrecord.male_weight}}</td>
                                                        <td v-if="growthrecord.female_quantity==null">N/A</td>
                                                        <td v-else>{{growthrecord.female_quantity}}</td>
                                                        <td v-if="growthrecord.female_weight==null">N/A</td>
                                                        <td v-else>{{growthrecord.female_weight}}</td>
                                                        <td>{{growthrecord.total_quantity}}</td>
                                                        <td>{{growthrecord.total_weight}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12 center">
                                            <pagination :data="growthrecords" @pagination-change-page="fetchGrowthRecords"></pagination>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modals -->
        <div id="broodergrowermodal" class="modal modal-fixed-footer">
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
                            <input v-model.number="total_number" placeholder="Total number of animals" id="total_quantity" type="number" min="0">
                            <label class="active" for="total_quantity">Total Quantity</label>
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
                                <input v-model.number="male_number" placeholder="Number of male" id="male_quantity" type="number" min="0">
                                <label class="active" for="male_quantity">Male Quantity</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model.number="male_weight" class="validate" placeholder="Total weight of all males (kg)" id="male_weight" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                <label class="active" for="male_weight">Male Weight</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model.number="female_number" placeholder="Number of female" id="female_quantity" type="number" min="0">
                                <label class="active" for="female_quantity">Female Quantity</label>
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
        data()  {
            return {
                search : '',
                broodergrowerloaded : false,
                broodergrowers : {},
                growthdetails : false,
                growthdetailsloaded : false,
                growthrecords : {},
                selected_broodergrower : '',
                date_added : '',
                collection_day : '',
                male_number : '',
                female_number : '',
                male_weight : '',
                female_weight : '',
                total_number : '',
                total_weight: '',
                sexing : false,
                others : false,
            }
        },
        methods : {
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            },
            initialize : function () {
                this.fetchBrooderFamilies();
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
            fetchGrowthRecords : function (page = 1) {
                this.growthdetails = false;
                this.growthdetailsloaded = false;
                axios.get('broodergrower_growth_records/'+this.selected_broodergrower+'?page='+page)
                .then(response => this.growthrecords = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.growthdetails = true;
                this.growthdetailsloaded = true;
            },
            addGrowthRecords : function () {
                axios.post('add_broodergrower_growth', {
                    broodergrower_id : this.selected_broodergrower,
                    date_added : this.customFormatter(this.date_added),
                    collection_day : this.collection_day,
                    male_number : this.male_number,
                    female_number : this.female_number,
                    male_weight : this.male_weight,
                    female_weight : this.female_weight,
                    total_number : this.total_number,
                    total_weight: this.total_weight,
                    sexing : this.sexing,
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.fetchGrowthRecords();
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
