<template>
    <div id="brooder_feeding_page_template" class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel blue-grey lighten-5">
                <div class="row valign-wrapper">
                    <div class="col s6 m6 l7">
                        <h5>Pen {{feed_pen_number}} | Feeding Records</h5>
                    </div>
                    <div class="col s3 m3 l3 right-align">
                        <a href="#feeding" class="waves-effect waves-green btn-flat green-text modal-trigger"><i class="fas fa-plus-circle left"></i>Add</a>
                    </div>
                    <div class="col s3 m3 l3 center-align">
                        <a v-on:click="closeFeeding" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="responsive-table bordered highlight centered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Tag</th>
                                    <th>Family</th>
                                    <th>Line</th>
                                    <th>Generation</th>
                                    <th>Offered(g)</th>
                                    <th>Refused(g)</th>
                                    <th>Remarks</th>
                                    <th class="tooltip" data-tippy-content="Edit"><i class="fas fa-edit"></i></th>
                                    <th class="tooltip" data-tippy-content="Delete"><i class="far fa-trash-alt"></i></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-if="feedings_length == 0">
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
                                <tr v-for="feeding in feedings.data" :key="feeding.record_id">
                                    <td>{{feeding.date_collected}}</td>
                                    <td>{{feeding.broodergrower_tag}}</td>
                                    <td>{{feeding.family_number}}</td>
                                    <td>{{feeding.line_number}}</td>
                                    <td>{{feeding.generation_number}}</td>
                                    <td>{{feeding.amount_offered}}</td>
                                    <td>{{feeding.amount_refused}}</td>
                                    <td v-if="feeding.remarks == null">None</td>
                                    <td v-else>{{feeding.remarks}}</td>
                                    <td class="tooltip" data-tippy-content="Edit this record"><a @click="initializeFeedEdit(feeding)" href="#edit_feeding" class="modal-trigger"><i class="fas fa-edit"></i></a></td>
                                    <td class="tooltip" data-tippy-content="Delete this record"><a @click.prevent="selected_feeding_record = feeding.record_id" href="#delete_feeding" class="modal-trigger"><i class="far fa-trash-alt"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row center">
                    <div class="col s12 m12 l12">
                        <pagination :data="feedings" @pagination-change-page="fetchFeedingRecord"></pagination>
                    </div>
                </div>
                <div id="feeding" class="modal modal-fixed-footer">
                    <form v-on:submit.prevent="addFeedingRecord" method="post">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h4>Pen {{feed_pen_number}} | Add Feeding Record</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <label for="multiple_label">Add Feeding Record for Multiple Days?</label>
                                    <div id="multiple_label" class="row">
                                        <div class="col s12 m12 l6">
                                            <input class="with-gap" name="multiple" v-model="multiple" type="radio" id="multiple_no" :value="false" />
                                            <label for="multiple_no">No</label>

                                            <input class="with-gap" name="multiple" v-model="multiple" type="radio" id="multiple_yes" :value="true" />
                                            <label for="multiple_yes">Yes</label>
                                        </div>
                                    </div>
                                    <div class="row" v-if="multiple===false">
                                        <div class="col s12 m6 l6">
                                            <label for="date_added">Date Collected</label>
                                            <datepicker id="date_added" :format="customFormatter" v-model="feed_record_collected"></datepicker>
                                        </div>
                                    </div>
                                    <div class="row" v-if="multiple===true">
                                        <div class="col s12 m6 l6">
                                            <label for="date_added">Date Start</label>
                                            <datepicker id="date_added" :format="customFormatter" v-model="feed_record_start"></datepicker>
                                        </div>
                                    </div>
                                    <div class="row" v-if="multiple===true">
                                        <div class="col s12 m6 l6">
                                            <label for="date_added">Date End</label>
                                            <datepicker id="date_added" :format="customFormatter" v-model="feed_record_end"></datepicker>
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
                                        <div class="col s12 s6 m6 input-field">
                                            <input v-model.number="offered" class="validate" placeholder="Amount of Feed Offered (g)" id="feed_offered" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$" validate>
                                            <label for="feed_offered" class="active">Feed Offered</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 s6 m6 input-field">
                                            <input v-model.number="refused" class="validate" placeholder="Amount of Feed Refused (g)" id="feed_refused" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="feed_refused" class="active">Feed Refused</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 s6 m6 input-field">
                                            <input v-model="remarks" placeholder="Add remarks" id="remarks" type="text">
                                            <label for="remarks" class="active">Remarks</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button href="#!" class="modal-action waves-effect waves-green btn-flat" type="submit">Submit</button>
                            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                        </div>
                    </form>
                </div>

                <div id="edit_feeding" class="modal modal-fixed-footer">
                    <form v-on:submit.prevent="editFeedingRecord" method="post">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h4>Pen {{feed_pen_number}} | Edit Feeding Record</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="row">
                                        <div class="col s12 m6 l6">
                                            <label for="edit_date_added">Date Collected</label>
                                            <datepicker id="edit_date_added" :format="customFormatter" v-model="edit_feed_record_collected"></datepicker>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 s6 m6 input-field">
                                            <input v-model.number="edit_offered" class="validate" placeholder="Amount of Feed Offered (g)" id="edit_feed_offered" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$" validate>
                                            <label for="edit_feed_offered" class="active">Feed Offered</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 s6 m6 input-field">
                                            <input v-model.number="edit_refused" class="validate" placeholder="Amount of Feed Refused (g)" id="edit_feed_refused" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="edit_feed_refused" class="active">Feed Refused</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 s6 m6 input-field">
                                            <input v-model="edit_remarks" placeholder="Add remarks" id="edit_remarks" type="text">
                                            <label for="edit_remarks" class="active">Remarks</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button href="#!" class="modal-action waves-effect waves-green btn-flat" type="submit">Submit</button>
                            <a @click="resetFeedEdit" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                        </div>
                    </form>
                </div>

                <div id="delete_feeding" class="modal modal-fixed-footer">
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
                                <p>Are you sure you want to <strong>Delete</strong> this feeding records?</p>
                                <p>This action is <strong>Irreversible</strong>.</p>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <a @click.prevent="deleteFeedingRecord" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Yes</a>
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">No</a>
                </div>
            </div>

            </div>
        </div>
    </div>
</template>

<script>
    import tippy from 'tippy.js';
    import Datepicker from 'vuejs-datepicker';
    Vue.component('pagination', require('laravel-vue-pagination'));
    var moment = require('moment');
    export default {
        components : {
            Datepicker
        },
        props: [
            'feed_pen_id', 'feed_pen_number'
        ],
        data()  {
            return {
                feedings : {},
                feedings_length : 0,
                feed_record_collected : '',
                feed_record_start : '',
                feed_record_end : '',
                offered : '',
                refused : '',
                remarks : '',
                inventories : '',
                selected_feeding_record : '',
                selected_records : {},
                brooder_inventory : '',
                multiple : false,

                edit_offered : '',
                edit_refused : '',
                edit_remarks : '',
                edit_feed_record_collected : '',
                selected_feeding_edit : '',
            }
        },
        methods : {
            initialize : function () {
                this.fetchFeedingRecord();
                this.fetchBrooderInventories();
            },
            fetchFeedingRecord : function (page = 1) {
                axios.get('broodergrower_feeding_records/'+this.feed_pen_id+'?page='+page)
                .then(response => {
                    this.feedings = response.data;
                    this.feedings_length = this.feedings.data.length;
                })
                .catch(function (error) {
                });
            },
            fetchBrooderInventories : function () {
                axios.get('brooder_inventories_feeding/'+this.feed_pen_id)
                .then(response => {
                    this.inventories = response.data;
                });
            },
            addFeedingRecord : function () {
                var param = null;
                if(this.multiple === true){
                    param = {
                        pen_id : this.feed_pen_id,
                        date_start : this.customFormatter(this.feed_record_start),
                        date_end : this.customFormatter(this.feed_record_end),
                        offered : this.offered,
                        refused : this.refused,
                        remarks : this.remarks,
                        multiple : this.multiple,
                        brooder_inventory : this.brooder_inventory,
                    }
                }else{  
                    param = {
                        pen_id : this.feed_pen_id,
                        date_collected : this.customFormatter(this.feed_record_collected),
                        offered : this.offered,
                        refused : this.refused,
                        remarks : this.remarks,
                        multiple : this.multiple,
                        brooder_inventory : this.brooder_inventory,
                    }
                }
                axios.post('add_broodergrower_feeding', param)
                .then(response => {
                    if(response.data.error == undefined){
                        this.feed_record_collected = '';
                        this.feed_record_start = '';
                        this.feed_record_end = '';
                        this.offered = '';
                        this.refused = '';
                        this.remarks = '';
                        this.multiple = false;
                        this.brooder_inventory = '';
                        Materialize.toast('Successfully added feeding record', 5000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 5000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast('Failed to add feeding record', 5000, 'red rounded');
                });
                this.initialize();
            },
            // selectFeedingRecords : function (page = 1) {
            //     axios.get('brooder_select_feedingrecords/'+this.selected_feeding_record+'?page='+page)
            //     .then(response => {
            //         this.selected_records = response.data;
            //     })
            //     .catch(function (error) {
            //     });
            // },
            initializeFeedEdit : function (record) {
                this.edit_offered = record.amount_offered;
                this.edit_refused = record.amount_refused;
                this.edit_remarks = record.remarks;
                this.edit_feed_record_collected = record.date_collected;
                this.selected_feeding_edit = record.record_id;
            },
            resetFeedEdit : function () {
                this.edit_offered = '';
                this.edit_offered = '';
                this.edit_refused = '';
                this.edit_remarks = '';
                this.edit_feed_record_collected = '';
                this.selected_feeding_edit = '';
            },
            editFeedingRecord : function () {
                axios.patch('edit_broodergrower_feeding', {
                    offered : this.edit_offered,
                    refused: this.edit_refused,
                    remarks : this.edit_remarks,
                    date_collected : this.edit_feed_record_collected,
                    record_id : this.selected_feeding_edit,
                })
                .then(response => {
                    Materialize.toast(response.data.message, 5000, 'green rounded');
                    this.fetchFeedingRecord();
                })
                .catch(error => {
                    Materialize.toast(error.response.data, 5000, 'red rounded');
                });
            },
            deleteFeedingRecord : function () {
                axios.delete('brooder_delete_feedingrecords/'+this.selected_feeding_record)
                .then(response => {
                    Materialize.toast('Successfully deleted feeding records', 5000, 'green rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to delete feeding records', 5000, 'red rounded');
                });
                this.initialize();
                this.selected_feeding_record = '';
            },
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            },
            closeFeeding : function () {
                this.$emit('close_feeding', null)
            }
        },
        mounted() {
            this.initialize();
            $('#feeding').modal({
                dismissible : false,
            });
            $('#edit_feeding').modal({
                dismissible : false,
            });
            $('#delete_feeding').modal({
                dismissible : false,
            });
            tippy('#brooder_feeding_page_template', {
                target : '.tooltip',
                arrow: true,
                arrowType: 'round',
                animation: 'scale',
                inertia: true,
            });
        },
    }
</script>

<style scoped>
    #delete_feeding{
        height: 300px;
    }
</style>

