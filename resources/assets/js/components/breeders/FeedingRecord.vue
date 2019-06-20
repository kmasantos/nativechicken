<template>
    <div class="row">
        <div class="col s12 m12 m12">
            <div class="card-panel blue-grey lighten-5">
                <div class="row valign-wrapper">
                    <div class="col s6 m6 l7">
                        <h5 v-if="breeder.breeder_code!==null">Feeding Records | {{breeder.breeder_code}}</h5>
                        <h5 v-else>Feeding Records | {{breeder.breeder_tag}}</h5>
                        <i>Generation: <strong>{{breeder.generation_number}}</strong> Line: <strong>{{breeder.line_number}}</strong> Family: <strong>{{breeder.family_number}}</strong></i>
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
                                    <th>Edit</th>
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
                                    <td>-</td>
                                </tr>
                                <tr v-for="feeding in feedings.data" :key="feeding.feeding_id">
                                    <td>{{feeding.date_collected}}</td>
                                    <td>{{feeding.breeder_tag}}</td>
                                    <td>{{feeding.amount_offered}}</td>
                                    <td>{{feeding.amount_refused}}</td>
                                    <td v-if="feeding.remarks == null">None</td>
                                    <td v-else>{{feeding.remarks}}</td>
                                    <td><a @click="edit_feeding_record = feeding.feeding_id;
                                    edit_date_collected=feeding.date_collected;edit_offered=feeding.amount_offered;edit_refused=feeding.amount_refused;edit_remarks=feeding.remarks " 
                                    href="#edit_feeding_modal" class="modal-trigger"><i class="fas fa-edit"></i></a></td>
                                    <td><a @click="selected_feeding_record = feeding" href="#delete_feeding" class="modal-trigger"><i class="far fa-trash-alt"></i></a></td>
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
                    <form v-on:submit.prevent="validateInput" method="post">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h4 v-if="breeder.breeder_code!==null">Feeding Records | {{breeder.breeder_code}}</h4>
                                    <h4 v-else>Feeding Records | {{breeder.breeder_tag}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <label for="input_type_label">Multiple Day Input? <i class="orange-text">(Multiple day input will work if you want to add equal values to Feed Offered & Feed Refused for more than one day)</i></label>
                                    <div class="row" id="input_type_label">
                                        <div class="col s12 l6">
                                            <input @change="date_start='';date_end='';" class="with-gap" :value="false" v-model="multiple" type="radio" id="period1"  />
                                            <label for="period1">No</label>
                                            <input @change="date_collected=''" class="with-gap" :value="true" v-model="multiple" type="radio" id="period2"  />
                                            <label for="period2">Yes</label>
                                        </div>
                                    </div>
                                    <div class="row" v-if="multiple==false">
                                        <div class="col s12 m12 l6">
                                            <label for="date_added">Date Collected</label>
                                            <datepicker id="date_added" placeholder="Date of feeding" :format="customFormatter" v-model="date_collected"></datepicker>
                                            <label class="red-text" v-if="check_date_collected==false"><i><i class="fas fa-exclamation-circle"></i> Date collected cannot be null</i></label>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div class="row">
                                            <div class="col s12 l6">
                                                <label for="date_start">Collection Date Start</label>
                                                <datepicker id="date_start" placeholder="Date of first input to be recorded" :format="customFormatter" v-model="date_start"></datepicker>
                                                <label class="red-text" v-if="check_date_start==false"><i><i class="fas fa-exclamation-circle"></i> Date start cannot be null</i></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 l6">
                                                <label for="date_end">Collection Date End</label>
                                                <datepicker id="date_end" placeholder="Date of last input to be recorded" :format="customFormatter" v-model="date_end"></datepicker>
                                                <label class="red-text" v-if="check_date_end==false"><i><i class="fas fa-exclamation-circle"></i> Date end cannot be null</i></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 l6">
                                            <label for="feed_offered" class="active">Feed Offered (g)</label>
                                            <input v-model.number="offered" class="validate" placeholder="Amount of Feed Offered (g)" id="feed_offered" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$" validate>
                                            <label class="red-text" v-if="check_feeding_input==false"><i><i class="fas fa-exclamation-circle"></i> Input for feed offered is required and cannot be equal to 0</i></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 l6">
                                            <label for="feed_refused" class="active">Feed Refused (g)</label>
                                            <input v-model.number="refused" class="validate" placeholder="Amount of Feed Refused (g)" id="feed_refused" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label class="red-text" v-if="check_refused_input==false"><i><i class="fas fa-exclamation-circle"></i> Input for feed refused is required</i></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 l6 input-field">
                                            <input v-model="remarks" placeholder="Add remarks" id="remarks" type="text">
                                            <label for="remarks" class="active">Remarks</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="modal-action waves-effect waves-gray btn-flat" type="submit">Submit</button>
                            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                        </div>
                    </form>
                </div>

                <div id="edit_feeding_modal" class="modal modal-fixed-footer">
                    <form v-on:submit.prevent="editFeedingRecord" method="post">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h4>Edit Feeding Entry</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="row">
                                        <div class="col s12 m12 l6">
                                            <label for="edit_date_added">Date Collected</label>
                                            <datepicker id="edit_date_added" placeholder="Date of feeding" :format="customFormatter" v-model="edit_date_collected"></datepicker>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l6">
                                            <label class="active">Feed Offered (g)</label>
                                            <input v-model.number="edit_offered" class="validate" placeholder="Amount of Feed Offered (g)" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$" validate>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l6">
                                            <label class="active">Feed Refused (g)</label>
                                            <input v-model.number="edit_refused" class="validate" placeholder="Amount of Feed Refused (g)" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$" validate>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l6 input-field">
                                            <input v-model="edit_remarks" placeholder="Edit remarks" id="edit_remarks" type="text">
                                            <label for="edit_remarks" class="active">Remarks</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="modal-action waves-effect waves-gray btn-flat modal-close" type="submit">Submit</button>
                            <a @click="edit_feeding_record=null;edit_date_collected='';edit_offered='';edit_refused='';edit_remarks=''" href="#!" class="modal-action modal-close waves-effect waves-grey btn-flat">Close</a>
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
                                <blockquote>
                                    <span>Date : {{selected_feeding_record.date_collected}}</span><br>
                                    <span>Tag : {{selected_feeding_record.breeder_tag}}</span><br>
                                    <span>Offered(g) : {{selected_feeding_record.amount_offered}}</span><br>
                                    <span>Refused(g) : {{selected_feeding_record.amount_refused}}</span><br>
                                    <span>Remarks : {{selected_feeding_record.remarks}}</span><br>
                                </blockquote>
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
    import Datepicker from 'vuejs-datepicker';
    Vue.component('pagination', require('laravel-vue-pagination'));
    var moment = require('moment');
    export default {
        components : {
            Datepicker
        },
        props: [
            'breeder', 'animal_type'
        ],
        data()  {
            return {
                feedings : {},
                feedings_length : 0,
                date_collected : '',
                offered : '',
                refused : '',
                remarks : '',
                selected_feeding_record : '',
                date_start: '',
                date_end: '',
                multiple: false,

                check_feeding_input : true,
                check_refused_input : true,
                check_date_collected : true,
                check_date_start : true,
                check_date_end : true,

                edit_feeding_record : null,
                edit_date_collected : '',
                edit_offered : '',
                edit_refused : '',
                edit_remarks : '',
            }   
        },
        methods : {
            initialize : function () {
                this.fetchFeedingRecord();
            },
            fetchFeedingRecord : function (page = 1) {
                axios.get('breeder_feeding/'+this.breeder.inventory_id+'?page='+page)
                .then(response => {
                    this.feedings = response.data;
                    this.feedings_length = this.feedings.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addFeedingRecord : function () {
                var input = null;
                if(this.multiple){
                    input = {
                        multiple : this.multiple,
                        breeder_id : this.breeder,
                        date_start : this.customFormatter(this.date_start),
                        date_end : this.customFormatter(this.date_end),
                        offered : this.offered,
                        refused : this.refused,
                        remarks : this.remarks,
                    };
                }else{
                    input = {
                        multiple : this.multiple,
                        breeder_id : this.breeder,
                        date_collected : this.customFormatter(this.date_collected),
                        offered : this.offered,
                        refused : this.refused,
                        remarks : this.remarks,
                    };
                }
                axios.post('breeder_feeding', input)
                .then(response => {
                    if(response.data.error == undefined){
                        this.date_collected = '';
                        this.date_start = '';
                        this.date_end = '';
                        this.offered = '';
                        this.refused = '';
                        this.remarks = '';
                        Materialize.toast('Successfully added feeding record', 5000, 'green rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast('Failed to add feeding record', 5000, 'red rounded');
                });
                this.initialize();
            },
            editFeedingRecord : function () {
                axios.post('edit_breeder_feeding', {
                    feeding_record : this.edit_feeding_record,
                    date_collected : this.customFormatter(this.edit_date_collected),
                    feed_offered : this.edit_offered,
                    feed_refused: this.edit_refused,
                    remarks: this.edit_remarks,
                })
                .then(response => {
                    this.edit_feeding_record = null;
                    this.edit_date_collected = '';
                    this.edit_offered = '';
                    this.edit_refused = '';
                    this.edit_remarks = '';
                    Materialize.toast('Successfully edited feeding record', 5000, 'green rounded');
                });
                this.initialize();
            },
            deleteFeedingRecord : function () {
                axios.delete('breeder_delete_feeding/' + this.selected_feeding_record.feeding_id)
                .then(response => {
                    this.selected_feeding_record = '';
                    Materialize.toast('Successfully deleted feeding record', 5000, 'green rounded');
                })
                .catch(error => {
                    Materialize.toast('Failed to delete feeding record', 5000, 'red rounded');
                });
                this.fetchFeedingRecord();
            },
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            },
            validateInput : function () {
                if(this.multiple){
                    if(this.date_start == "") {this.check_date_start = false} else {this.check_date_start = true}  
                    if(this.date_end == "") {this.check_date_end = false}  else {this.check_date_end = true} 
                    if(this.offered == "" || this.offered < 0) {this.check_feeding_input = false} else {this.check_feeding_input = true}
                    if(this.refused === "") {this.check_refused_input = false} else {this.check_refused_input = true}
                    if(this.check_date_start === false || this.check_date_end === false || this.check_feeding_input === false || this.check_refused_input === false) {return}
                }else{
                    if(this.date_collected == ""){this.check_date_collected = false} else{this.check_date_collected = true} 
                    if(this.offered == "" || this.offered < 0) {this.check_feeding_input = false} else {this.check_feeding_input = true}
                    if(this.refused === "") {this.check_refused_input = false} else {this.check_refused_input = true}
                    if(this.check_date_collected === false || this.check_feeding_input === false || this.check_refused_input === false) {return} 
                }
                this.addFeedingRecord();
            },
            closeFeeding : function () {
                this.$emit('close_feeding', null)
            },
        },
        mounted() {
            $('#feeding').modal({
                dismissible : false,
            });
            $('#delete_feeding').modal({
                dismissible : false,
            });
            $('#edit_feeding_modal').modal({
                dismissible : false,
            });
            this.initialize();
        },
    }
</script>
