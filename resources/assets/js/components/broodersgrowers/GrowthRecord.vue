<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <div class="row valign-wrapper">
                    <div class="col s6 m6 l7">
                        <h5>{{growth_pen_number}} Growth Records</h5>
                    </div>
                    <div class="col s3 m3 l3 right-align">
                        <a href="#growth" class="waves-effect waves-green btn-flat green-text modal-trigger"><i class="fas fa-plus-circle left"></i>Add</a>
                    </div>
                    <div class="col s3 m3 l3 center-align">
                        <a v-on:click="closeGrowth" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="responsive-table bordered highlight centered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Collection Day</th>
                                    <th>Tag</th>
                                    <th>Male</th>
                                    <th>Male Weight</th>
                                    <th>Weight</th>
                                    <th>Female Weight</th>
                                    <th>Total</th>
                                    <th>Total Weight</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-if="growth_records_length == 0">
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr v-else v-for="growth in growth_records.data" :key="growth.id">
                                    <td>{{growth.date_collected}}</td>
                                    <td>{{growth.collection_day}}</td>
                                    <td>{{growth.broodergrower_tag}}</td>
                                    <td v-if="growth.male_quantity==null">-</td>
                                    <td v-else>{{growth.male_quantity}}</td>
                                    <td v-if="growth.male_weight==null">-</td>
                                    <td v-else>{{growth.male_weight}}</td>
                                    <td v-if="growth.female_quantity==null">-</td>
                                    <td v-else>{{growth.female_quantity}}</td>
                                    <td v-if="growth.female_weight==null">-</td>
                                    <td v-else>{{growth.female_weight}}</td>
                                    <td>{{growth.total_quantity}}</td>
                                    <td>{{growth.total_weight}}</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row center">
                    <div class="col s12 m12 l12">
                        <pagination :data="growth_records" @pagination-change-page="fetchGrowthRecord"></pagination>
                    </div>
                </div>
            </div>
            <div id="growth" class="modal modal-fixed-footer">
                <form v-on:submit.prevent="addGrowthRecords" method="post">
                    <div class="modal-content">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h4>{{growth_pen_number}} Growth Record</h4>
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
                                        <input type="checkbox" @click="others=!others; collection_day=''">
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
                        <button class="modal-action modal-close waves-effect waves-grey btn-flat" type="submit">Submit</button>
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
    props: [
        'growth_pen_id', 'growth_pen_number'
    ],
    data () {
        return {
            growth_records : {},
            growth_records_length : 0,
            others : false,
            collection_day : '',
            sexing : false,
            date_added : '',
            total_weight : '',
            male_weight : '',
            female_weight : '',
        }
    },
    methods : {
        initialize : function () {
            this.fetchGrowthRecord();
        },
        fetchGrowthRecord : function (page = 1) {
            axios.get('broodergrower_growth_records/'+this.growth_pen_id+'?page='+page)
            .then(response => {
                this.growth_records = response.data;
                this.growth_records_length = this.growth_records.data.length;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        addGrowthRecords : function () {
            axios.post('add_broodergrower_growth', {
                pen_id : this.growth_pen_id,
                sexing : this.sexing,
                collection_day : this.collection_day,
                date_collected : this.customFormatter(this.date_added),
                total_weight : this.total_weight,
                male_weight : this.male_weight,
                female_weight : this.female_weight,
                total_weight : this.total_weight
            })
            .then(response => {
                if(response.data.error == undefined){
                    this.others = false;
                    this.sexing = false;
                    this.collection_day = '';
                    this.date_added  = '';
                    this.total_weight = '';
                    this.male_weight = '';
                    this.female_weight = '';
                    Materialize.toast('Successfully added growth record', 3000, 'green rounded');
                }else{
                    Materialize.toast(response.data.error, 3000, 'red rounded');
                }
            })
            .catch(error => {
                Materialize.toast('Failed to add growth record', 3000, 'rounded');
            });
            this.initialize();
        },
        customFormatter : function (date_added) {
        return moment(date_added).format('YYYY-MM-DD');
        },
        closeGrowth : function () {
            this.$emit('close_growth', null)
        }
    },
    beforeCreate() {
        $('.tooltipped').tooltip('remove');
    },
    mounted() {
        $('#growth').modal({
            dismissible : false,
        });
    },
    created() {
        this.initialize();
    },
    destroyed () {
        $('.tooltipped').tooltip({delay: 50});
    },
}
</script>
