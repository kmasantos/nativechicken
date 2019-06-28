<template>
    <div id="brooder_growth_template" class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel blue-grey lighten-5">
                <div class="row valign-wrapper">
                    <div class="col s6 m6 l7">
                        <h5>Pen {{growth_pen_number}} | Growth Records</h5>
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
                                    <th class="tooltip" data-tippy-content="Date Collected"><i class="far fa-calendar"></i></th>
                                    <th class="tooltip" data-tippy-content="Collection Day"><i class="far fa-clock"></i></th>
                                    <th class="tooltip" data-tippy-content="Inventory Code"><i class="fas fa-tag"></i></th>
                                    <th>Family</th>
                                    <th>Line</th>
                                    <th>Generation</th>
                                    <th class="tooltip" data-tippy-content="Total"><i class="fas fa-venus-mars"></i></th>
                                    <th class="tooltip" data-tippy-content="Total Weight"><i class="fas fa-venus-mars"></i> Weight</th>
                                    <th class="tooltip" data-tippy-content="Edit Record"><i class="fas fa-edit"></i></th>
                                    <th class="tooltip" data-tippy-content="Delete Record"><i class="far fa-trash-alt"></i></th>
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
                                    <td>{{growth.family_number}}</td>
                                    <td>{{growth.line_number}}</td>
                                    <td>{{growth.generation_number}}</td>
                                    <td>{{growth.total_quantity}}</td>
                                    <td>{{growth.total_weight.toFixed(3)}}</td>
                                    <td class="tooltip" data-tippy-content="Edit this record"><a @click="initializeEditGrowth(growth)" href="#edit_growth" class="modal-trigger"><i class="fas fa-edit"></i></a></td>
                                    <td class="tooltip" data-tippy-content="Delete this record"><a @click.prevent="selected_growth_record = growth.growth_id" href="#delete_growth" class="modal-trigger"><i class="far fa-trash-alt"></i></a></td>
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
                                <h4>Pen {{growth_pen_number}} | Growth Record</h4>
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
                            <div class="col s12 m12 l6">
                                <label>Select Brooder Inventory</label>
                                <select v-model="brooder_inventory" class="browser-default">
                                    <option value="" disabled selected>Choose a brooder inventory to add this record to</option>
                                    <option v-for="inventory in inventories" :key="inventory.id" :value="inventory.id">{{inventory.broodergrower_tag}} — F: {{inventory.family_number}} | L: {{inventory.line_number}} | G: {{inventory.generation_number}} | B: {{inventory.batching_date}}</option>
                                </select>
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
                                <input v-model.number="total_weight" class="validate" placeholder="Total weight of all animals (kg)" id="total_weight" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                <label class="active" for="total_weight">Total Weight</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="modal-action waves-effect waves-grey btn-flat" type="submit">Submit</button>
                        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Close</a>
                    </div>
                </form>
            </div>

            <div id="edit_growth" class="modal modal-fixed-footer">
                <form v-on:submit.prevent="editGrowthRecord" method="post">
                    <div class="modal-content">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h4>Edit Growth Record</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <label for="edit_date_added">Date Collected</label>
                                <datepicker id="edit_date_added" :format="customFormatter" v-model="edit_date_added"></datepicker>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 s6 m6 input-field">
                                <input v-model.number="edit_total_weight" class="validate" placeholder="Total weight of all animals (kg)" id="edit_total_weight" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                <label class="active" for="edit_total_weight">Total Weight</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="modal-action waves-effect waves-grey btn-flat" type="submit">Submit</button>
                        <a @click="resetEditGrowth" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Close</a>
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
import tippy from 'tippy.js';
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
            inventories : '',
            growth_records : {},
            growth_records_length : 0,
            others : false,
            collection_day : '',
            date_added : '',
            total_weight : '',
            brooder_inventory : '',
            selected_growth_record : '',
            selected_records : {},
            
            edit_record : '',
            edit_date_added : '',
            edit_total_weight : '',
        }
    },
    methods : {
        initialize : function () {
            this.fetchGrowthRecord();
            this.fetchBrooderInventories();
        },
        fetchGrowthRecord : function (page = 1) {
            axios.get('broodergrower_growth_records/'+this.growth_pen_id+'?page='+page)
            .then(response => {
                this.growth_records = response.data;
                this.growth_records_length = this.growth_records.data.length;
            })
            .catch(function (error) {
            });
        },
        fetchBrooderInventories : function () {
            axios.get('brooder_inventories_feeding/'+this.growth_pen_id)
            .then(response => {
                this.inventories = response.data;
            });
        },
        addGrowthRecords : function () {
            axios.post('add_broodergrower_growth', {
                pen_id : this.growth_pen_id,
                collection_day : this.collection_day,
                date_collected : this.customFormatter(this.date_added),
                inventory_id : this.brooder_inventory,
                total_weight : this.total_weight,
            })
            .then(response => {
                if(response.data.status === "success"){
                    this.others = false;
                    this.collection_day = '';
                    this.date_added  = '';
                    this.total_weight = '';
                    this.brooder_inventory = '';
                    Materialize.toast(response.data.message, 5000, 'green rounded');
                }
                if(response.data.status === "error"){
                    Materialize.toast(response.data.message, 5000, 'red rounded');
                }
            })
            .catch(error => {
                Materialize.toast(error.response.data, 5000, 'red rounded');
            });
            this.fetchGrowthRecord();
        },
        initializeEditGrowth : function (record) {
            this.edit_record = record.growth_id;
            this.edit_date_added = record.date_collected;
            this.edit_total_weight = record.total_weight;
        },
        resetEditGrowth : function () {
            this.edit_record = "";
            this.edit_date_added = "";
            this.edit_total_weight = "";
        },
        editGrowthRecord : function () {
            axios.patch('edit_broodergrower_growth', {
                record_id : this.edit_record ,
                date_collected : this.customFormatter(this.edit_date_added),
                total_weight : this.edit_total_weight,
            })
            .then(response => {
                if(response.data.status === "success"){
                    Materialize.toast(response.data.message, 5000, 'green rounded');
                }
                if(response.data.status === "error"){
                    Materialize.toast(response.data.message, 5000, 'red rounded');
                }
            })
            .catch(error => {
                Materialize.toast(error.response.data, 5000, 'red rounded');
            });
            this.fetchGrowthRecord();
        },

        // selectGrowthRecords : function (page = 1) {
        //     axios.get('brooder_select_growthrecords/'+this.selected_growth_record+'?page='+page)
        //     .then(response => {
        //         this.selected_records = response.data;
        //     })
        //     .catch(function (error) {
        //     });
        // },
        deleteGrowthRecord : function () {
            axios.delete('brooder_delete_growthrecords/'+this.selected_growth_record)
            .then(response => {
                Materialize.toast('Successfully deleted growth records', 5000, 'green rounded');
            })
            .catch(function (error) {
                Materialize.toast('Failed to delete growth records', 5000, 'red rounded');
            });
            this.fetchGrowthRecord();
            this.selected_growth_record = '';
        },
        customFormatter : function (date_added) {
        return moment(date_added).format('YYYY-MM-DD');
        },
        closeGrowth : function () {
            this.$emit('close_growth', null)
        }
    },
    mounted() {
        $('#growth').modal({
            dismissible : false,
        });
        $('#edit_growth').modal({
            dismissible : false,
        });
        $('#delete_growth').modal({
            dismissible : false,
        });
        tippy('#brooder_growth_template', {
            target : '.tooltip',
            arrow: true,
            arrowType: 'round',
            animation: 'scale',
            inertia: true,
        });
        this.initialize();
    },
}
</script>

<style scoped>
    #delete_growth {
        height: 300px;
    }
    #edit_growth {
        height: 400px;
    }
</style>
