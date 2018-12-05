<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <div class="row valign-wrapper">
                    <div class="col s6 m6 l7">
                        <h5>Growth Records | Pen {{growth_pen_number}}</h5>
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
                                    <th class="tooltipped" data-tooltip="Male Quantity"><i class="fas fa-mars"></i> Q</th>
                                    <th class="tooltipped" data-tooltip="Male Weight"><i class="fas fa-mars"></i> W</th>
                                    <th class="tooltipped" data-tooltip="Female Quantity"><i class="fas fa-venus"></i> Q</th>
                                    <th class="tooltipped" data-tooltip="Female Weight"><i class="fas fa-venus"></i> W</th>
                                    <th class="tooltipped" data-tooltip="Total Quantity"><i class="fas fa-venus-mars"></i> Q</th>
                                    <th class="tooltipped" data-tooltip="Total Weight"><i class="fas fa-venus-mars"></i> W</th>
                                    <th class="tooltipped" data-tooltip="Delete"><i class="far fa-trash-alt"></i></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-if="growths_length == 0">
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
                                <tr v-for="growth in growths.data" :key="growth.growth_id">
                                    <td>{{growth.date_collected}}</td>
                                    <td>{{growth.collection_day}}</td>
                                    <td>{{growth.replacement_tag}}</td>
                                    <td>{{growth.male_quantity}}</td>
                                    <td v-if="growth.male_weight!==null">{{growth.male_weight.toFixed(3)}}</td>
                                    <td>{{growth.female_quantity}}</td>
                                    <td v-if="growth.female_weight!==null">{{growth.female_weight.toFixed(3)}}</td>
                                    <td>{{growth.total_quantity}}</td>
                                    <td v-if="growth.total_weight!==null">{{growth.total_weight.toFixed(3)}}</td>
                                    <td><a @click.prevent="selected_growth_record = growth.growth_id;selectGrowthRecords()" class="modal-trigger" href="#delete_growth"><i class="far fa-trash-alt"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row center">
                    <div class="col s12 m12 l12">
                        <pagination :data="growths" @pagination-change-page="fetchGrowthRecord"></pagination>
                    </div>
                </div>
            </div>
            <div id="growth" class="modal modal-fixed-footer">
                <form v-on:submit.prevent="addGrowthRecord" method="post">
                    <div class="modal-content">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h4>Growth Record | {{growth_pen_number}}</h4>
                            </div>
                        </div>
                        <label for="collection_day">Collection Day</label>
                        <div class="row" id="collection_day">
                            <div class="col s12 m12 l12">
                                <input @change="others=false" v-model.number="collection_day" class="with-gap" name="collection_day" type="radio" id="day45" value=45 />
                                <label for="day45">Day 45</label>
                                <input @change="others=false" v-model.number="collection_day" class="with-gap" name="collection_day" type="radio" id="day75" value=75 />
                                <label for="day75">Day 75</label>
                                <input @change="others=false" v-model.number="collection_day" class="with-gap" name="collection_day" type="radio" id="day100" value=100 />
                                <label for="day100">Day 100</label>
                                <input @change="others=true" v-model.number="collection_day" class="with-gap" name="collection_day" type="radio" id="dayothers" />
                                <label for="dayothers">Others</label>
                            </div>
                            <div class="col s12 m6 l6" v-if="others">
                                <label for="other_day"></label>
                                <input class="validate" id="other_day" v-model.number="collection_day" placeholder="Input collection day" type="number" min="21" pattern="[0-9]+">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <label for="date_added">Date Collected</label>
                                <datepicker id="date_added" :format="customFormatter" v-model="date_added"></datepicker>
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
                                <input v-model.number="female_weight" class="validate" placeholder="Total weight of all females (kg)" id="female_weight" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                <label class="active" for="female_weight">Female Weight</label>
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
                                        <td>{{selected_record.replacement_tag}}</td>
                                        <td>{{selected_record.male_quantity}}</td>
                                        <td v-if="selected_record.male_weight!==null">{{selected_record.male_weight.toFixed(3)}}</td>
                                        <td>{{selected_record.female_quantity}}</td>
                                        <td v-if="selected_record.female_weight!==null">{{selected_record.female_weight.toFixed(3)}}</td>
                                        <td>{{selected_record.total_quantity}}</td>
                                        <td v-if="selected_record.total_weight!==null">{{selected_record.total_weight.toFixed(3)}}</td>
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
    data()  {
        return {
            growths : {},
            growths_length : 0,
            others : false,
            collection_day : '',
            date_added : '',
            male_weight : '',
            female_weight : '',
            selected_growth_record : '',

            selected_records : {},

        }
    },
    methods : {
        fetchGrowthRecord : function (page = 1) {
            axios.get('replacement_fetch_growthrecord/'+this.growth_pen_id+'?page='+page)
            .then(response => {
                this.growths = response.data;
                this.growths_length = this.growths.data.length;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        addGrowthRecord : function () {
            axios.post('add_replacement_growth', {
                pen_id : this.growth_pen_id,
                collection_day : this.collection_day,
                date_collected : this.customFormatter(this.date_added),
                male_weight : this.male_weight,
                female_weight : this.female_weight,
            })
            .then(response => {
                if(response.data.error == undefined){
                    this.others = false;
                    this.collection_day = '';
                    this.date_added  = '';
                    this.male_weight = '';
                    this.female_weight = '';
                    Materialize.toast('Successfully added growth record', 5000, 'green rounded');
                }else{
                    Materialize.toast(response.data.error, 5000, 'red rounded');
                }
            })
            .catch(error => {
                Materialize.toast('Failed to add growth record', 5000, 'red rounded');
            });
            this.fetchGrowthRecord();
        },
        selectGrowthRecords : function (page = 1) {
            axios.get('replacement_select_growthrecords/'+this.selected_growth_record+'?page='+page)
            .then(response => {
                this.selected_records = response.data;
            })
            .catch(function (error) {
            });
        },
        deleteGrowthRecord : function () {
            axios.delete('replacement_delete_growthrecords/'+this.selected_growth_record)
            .then(response => {
                Materialize.toast('Successfully deleted growth records', 5000, 'green rounded');
            })
            .catch(function (error) {
                Materialize.toast('Failed to delete growth records', 5000, 'red rounded');
            });
            this.fetchGrowthRecord();
            this.selected_growth_record = '';
        },
        customFormatter : function (date) {
            return moment(date).format('YYYY-MM-DD');
        },
        closeGrowth : function () {
            this.$emit('close_growth', null)
        }
    },
    mounted () {

    },
    beforeCreate() {
        $('.tooltipped').tooltip('remove');
    },
    mounted () {
        $('.tooltipped').tooltip({
            delay: 50,
            position : "top"
        });
        $('#growth').modal({
            dismissible : false,
        });
        $('#delete_growth').modal({
            dismissible : false,
        });
    },
    created () {
        this.fetchGrowthRecord();
    },
    destroyed () {
        $('.tooltipped').tooltip({delay: 50});
    },
}
</script>
