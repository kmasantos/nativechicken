<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel blue-grey lighten-5">
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
                                    <th class="tooltipped" data-tooltip="Date Collected"><i class="far fa-calendar"></i></th>
                                    <th class="tooltipped" data-tooltip="Collection Day"><i class="far fa-clock"></i></th>
                                    <th class="tooltipped" data-tooltip="Inventory Code"><i class="fas fa-tag"></i></th>
                                    <th class="tooltipped" data-tooltip="Male"><i class="fas fa-mars"></i></th>
                                    <th class="tooltipped" data-tooltip="Male Weight"><i class="fas fa-mars"></i> Weight</th>
                                    <th class="tooltipped" data-tooltip="Female"><i class="fas fa-venus"></i></th>
                                    <th class="tooltipped" data-tooltip="Female Weight"><i class="fas fa-venus"></i> Weight</th>
                                    <th class="tooltipped" data-tooltip="Total"><i class="fas fa-venus-mars"></i></th>
                                    <th class="tooltipped" data-tooltip="Total Weight"><i class="fas fa-venus-mars"></i> Weight</th>
                                    <th class="tooltipped" data-tooltip="Delete Record"><i class="far fa-trash-alt"></i></th>
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
                                <tr v-else v-for="growth in growth_records.data" :key="growth.growth_id">
                                    <td>{{growth.date_collected}}</td>
                                    <td>{{growth.collection_day}}</td>
                                    <td>{{growth.broodergrower_tag}}</td>
                                    <td v-if="growth.male_quantity==null">-</td>
                                    <td v-else>{{growth.male_quantity}}</td>
                                    <td v-if="growth.male_weight==null">-</td>
                                    <td v-else>{{growth.male_weight.toFixed(3)}}</td>
                                    <td v-if="growth.female_quantity==null">-</td>
                                    <td v-else>{{growth.female_quantity}}</td>
                                    <td v-if="growth.female_weight==null">-</td>
                                    <td v-else>{{growth.female_weight.toFixed(3)}}</td>
                                    <td>{{growth.total_quantity}}</td>
                                    <td>{{growth.total_weight.toFixed(3)}}</td>
                                    <td><a @click.prevent="selected_growth_record = growth.growth_id;selectGrowthRecords()" href="#delete_growth" class="modal-trigger"><i class="far fa-trash-alt"></i></a></td>
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
                                <input v-model.number="collection_day" placeholder="Input collection day bwetween 0 and 21 days" class="validate" type="number" min=0 max=21 pattern="[0-21]">
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
            <div id="delete_growth" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Delete Record</h4>
                        </div>
                    </div>
                    <div class="row valign-wrapper">
                        <div class="col s2 m2 l2 red-text center-align">
                            <h4><i class="fas fa-exclamation-triangle"></i></h4>
                        </div>
                        <div class="col s10 m10 l10">
                            <p>Are you sure you want to <strong>Delete</strong> this growth records?</p>
                            <table class="bordered responsive-table centered">
                                <thead>
                                    <tr>
                                        <th class="tooltipped" data-tooltip="Date Collected"><i class="far fa-calendar"></i></th>
                                        <th class="tooltipped" data-tooltip="Collection Day"><i class="far fa-clock"></i></th>
                                        <th class="tooltipped" data-tooltip="Inventory Code"><i class="fas fa-tag"></i></th>
                                        <th class="tooltipped" data-tooltip="Male Quantity"><i class="fas fa-mars"></i> Q</th>
                                        <th class="tooltipped" data-tooltip="Male Weight"><i class="fas fa-mars"></i> W</th>
                                        <th class="tooltipped" data-tooltip="Female Quantity"><i class="fas fa-venus"></i> Q</th>
                                        <th class="tooltipped" data-tooltip="Female Weight"><i class="fas fa-venus"></i> W</th>
                                        <th class="tooltipped" data-tooltip="Total Quantity"><i class="fas fa-venus-mars"></i> Q</th>
                                        <th class="tooltipped" data-tooltip="Total Weight"><i class="fas fa-venus-mars"></i> W</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="selected_record in selected_records.data" :key="selected_record.sel_growth_id">
                                        <td>{{selected_record.date_collected}}</td>
                                        <td>{{selected_record.collection_day}}</td>
                                        <td>{{selected_record.broodergrower_tag}}</td>
                                        <td v-if="selected_record.male_quantity===null">-</td>
                                        <td v-else>{{selected_record.male_quantity}}</td>
                                        <td v-if="selected_record.male_weight===null">-</td>
                                        <td v-else>{{selected_record.male_weight.toFixed(3)}}</td>
                                        <td v-if="selected_record.female_quantity===null">-</td>
                                        <td v-else>{{selected_record.female_quantity}}</td>
                                        <td v-if="selected_record.female_weight===null">-</td>
                                        <td v-else>{{selected_record.female_weight.toFixed(3)}}</td>
                                        <td v-if="selected_record.total_quantity === null">-</td>
                                        <td v-else>{{selected_record.total_quantity}}</td>
                                        <td v-if="selected_record.total_weight === null">-</td>
                                        <td v-else>{{selected_record.total_weight.toFixed(3)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="center-align"><pagination :data="selected_records" @pagination-change-page="selectGrowthRecords"></pagination></p>
                            <p>This action is <strong>Irreversible</strong>.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a @click.prevent="deleteGrowthRecord" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Yes</a>
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">No</a>
                </div>
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

            selected_growth_record : '',
            selected_records : {}
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
        selectGrowthRecords : function (page = 1) {
            axios.get('brooder_select_growthrecords/'+this.selected_growth_record+'?page='+page)
            .then(response => {
                this.selected_records = response.data;
            })
            .catch(function (error) {
            });
        },
        deleteGrowthRecord : function () {
            axios.delete('brooder_delete_growthrecords/'+this.selected_growth_record)
            .then(response => {
                Materialize.toast('Successfully deleted growth records', 5000, 'green rounded');
            })
            .catch(function (error) {
                Materialize.toast('Failed to delete growth records', 5000, 'red rounded');
            });
            this.initialize();
            this.selected_growth_record = '';
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
        $('.tooltipped').tooltip({
            delay: 50,
            position:"top"
        });
        $('#delete_growth').modal({
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
