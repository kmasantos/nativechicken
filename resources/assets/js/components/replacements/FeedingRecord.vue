<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel blue-grey lighten-5">
                <div class="row valign-wrapper">
                    <div class="col s6 m6 l7">
                        <h5>Feeding Records | Pen {{feed_pen_number}}</h5>
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
                                    <th>Offered(g)</th>
                                    <th>Refused(g)</th>
                                    <th>Remarks</th>
                                    <th>Delete</th>
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
                                </tr>
                                <tr v-for="feeding in feedings.data" :key="feeding.feeding_id">
                                    <td>{{feeding.date_collected}}</td>
                                    <td>{{feeding.replacement_tag}}</td>
                                    <td>{{feeding.amount_offered.toFixed(3)}}</td>
                                    <td>{{feeding.amount_refused.toFixed(3)}}</td>
                                    <td v-if="feeding.remarks == null">None</td>
                                    <td v-else>{{feeding.remarks}}</td>
                                    <td><a @click.prevent="selected_feeding_record = feeding.feeding_id;selectFeedingRecords()" class="modal-trigger" href="#delete_feeding"><i class="far fa-trash-alt"></i></a></td>
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
                                    <h4>Feeding Records | {{feed_pen_number}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="row">
                                        <div class="col s12 m6 l6">
                                            <label for="date_added">Date Collected</label>
                                            <datepicker id="date_added" :format="customFormatter" v-model="feed_record_collected"></datepicker>
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
                            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                            <button class="modal-action modal-close waves-effect waves-green btn-flat" type="submit">Submit</button>
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
                                <p>Are you sure you want to <strong>Delete</strong> this feeding record?</p>
                                <table class="bordered responsive-table centered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Tag</th>
                                            <th>Offered(g)</th>
                                            <th>Refused(g)</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="selected_record in selected_records.data" :key="selected_record.record_id">
                                            <td>{{selected_record.date_collected}}</td>
                                            <td>{{selected_record.replacement_tag}}</td>
                                            <td>{{selected_record.amount_offered.toFixed(3)}}</td>
                                            <td>{{selected_record.amount_refused.toFixed(3)}}</td>
                                            <td v-if="selected_record.remarks == null">None</td>
                                            <td v-else>{{selected_record.remarks}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="center-align"><pagination :data="selected_records" @pagination-change-page="selectFeedingRecords"></pagination></p>
                                <p>This action is <strong>Irreversible</strong>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a @click.prevent="deleteFeedingRecords" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Yes</a>
                        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">No</a>
                    </div>
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
            'feed_pen_id', 'feed_pen_number'
        ],
        data()  {
            return {
                feedings : {},
                feedings_length : 0,
                feed_record_collected : '',
                offered : '',
                refused : '',
                remarks : '',
                selected_feeding_record : '',
                selected_records : {},
            }
        },
        methods : {
            initialize : function () {
                this.fetchFeedingRecord();
            },
            fetchFeedingRecord : function (page = 1) {
                axios.get('replacement_feeding_records/'+this.feed_pen_id+'?page='+page)
                .then(response => {
                    this.feedings = response.data;
                    this.feedings_length = this.feedings.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addFeedingRecord : function () {
                axios.post('add_replacement_feeding', {
                    pen_id : this.feed_pen_id,
                    date_collected : this.customFormatter(this.feed_record_collected),
                    offered : this.offered,
                    refused : this.refused,
                    remarks : this.remarks,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.feed_record_collected = '';
                        this.offered = '';
                        this.refused = '';
                        this.remarks = '';
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
            deleteFeedingRecords : function () {
                axios.delete('replacement_delete_feedrecords/'+this.selected_feeding_record)
                .then(response => {
                    Materialize.toast('Successfully deleted feeding record', 5000, 'green rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to delete feeding record', 5000, 'red rounded');
                });
                this.fetchFeedingRecord();
                this.selected_feeding_record = '';
            },
            selectFeedingRecords : function (page = 1) {
                axios.get('replacement_select_feedrecords/'+this.selected_feeding_record+'?page='+page)
                .then(response => {
                    this.selected_records = response.data;
                })
                .catch(function (error) {
                });
            },
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            },
            closeFeeding : function () {
                this.$emit('close_feeding', null)
            }
        },
        beforeCreate() {
            $('.tooltipped').tooltip('remove');
        },
        mounted() {
            $('#feeding').modal({
                dismissible : false,
            });
            $('#delete_feeding').modal({
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
