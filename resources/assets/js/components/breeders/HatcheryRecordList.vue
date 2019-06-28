<template>
    <div id="hatchery_div" class="row">
        <div class="col s12 m12 m12">
            <div class="card-panel blue-grey lighten-5">
                <!-- Hatchery List -->
                <div class="row valign-wrapper" v-show="hide_record==false">
                    <div class="col s8 l8">
                        <h5 v-if="breeder.breeder_code!==null">Hatchery Record | {{breeder.breeder_code}}</h5>
                        <h5 v-else>Hatchery Record | {{breeder.breeder_tag}}</h5>
                        <i>Generation: <strong>{{breeder.generation_number}}</strong> Line: <strong>{{breeder.line_number}}</strong> Family: <strong>{{breeder.family_number}}</strong> Pen: <strong>{{breeder.pen_number}}</strong></i>
                    </div>
                    <div class="col s2 l2">
                        <a @click="add_record=true; hide_record=true, update_record=false" class="waves-effect waves-green btn-flat tooltip green-text" data-tippy-content="Add Hatchery Record"><i class="fas fa-plus-circle left"></i> ADD</a>
                    </div>
                    <div class="col s2 l2">
                        <a v-on:click="closeHatcheryRecords" class="waves-effect waves-red btn-flat tooltip red-text" data-tippy-content="Close Hatchery Record"><i class="far fa-times-circle left"></i>CLOSE</a>
                    </div>
                </div>
                <div v-show="hide_record==false">
                    <div class="row" >
                        <div class="col s12 m12 l12">
                            <table class="responsive-table bordered highlight centered">
                                <thead>
                                    <tr>
                                        <th>Date Set</th>
                                        <th>Quantity</th>
                                        <th>Age in Weeks</th>
                                        <th>No. Fertile</th>
                                        <th>Date Hatched</th>
                                        <th>No. Hatched</th>
                                        <th>Update</th>
                                        <th class="tooltip" data-tippy-content="<p><strong>Force Delete Hatchery and Brooder Record</strong></p><p><i>Deletes Hatchery Record including created Brooder data</i></p>"><i class="fas fa-trash-alt"></i></th>
                                        <th class="tooltip" data-tippy-content="<p><strong>Force Delete Hatchery Record Only</strong></p><p><i>Only deletes hatchery record wihout affecting Brooder data</i></p>"><i class="fas fa-eraser"></i></th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr v-if="hatchery_records_length === 0">
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
                                    <tr v-else v-for="hatchery in hatchery_records.data" :key="hatchery.id">
                                        <td>{{hatchery.date_eggs_set}}</td>
                                        <td>{{hatchery.number_eggs_set}}</td>
                                        <td v-if="hatchery.week_of_lay==null">N/A</td>
                                        <td v-else>{{hatchery.week_of_lay}}</td>
                                        <td v-if="hatchery.number_fertile==null">N/A</td>
                                        <td v-else>{{hatchery.number_fertile}}</td>
                                        <td v-if="hatchery.date_hatched==null">N/A</td>
                                        <td v-else>{{hatchery.date_hatched}}</td>
                                        <td v-if="hatchery.number_hatched==null">N/A</td>
                                        <td v-else>{{hatchery.number_hatched}}</td>
                                        <td v-if="hatchery.number_hatched != null && hatchery.date_hatched!=null">-</td>
                                        <td v-else><a @click="selected_hatchery_record = hatchery; update_record=true; setEditForm(); add_record=false" href="#update_modal" class="modal-trigger"><i class="far fa-edit"></i></a></td>
                                        <td><a @click="selected_hatchery_record = hatchery" href="#delete_hatchery" class="modal-trigger"><i class="fas fa-trash-alt"></i></a></td>
                                        <td><a @click="selected_forcedel_record = hatchery" href="#force_delete_hatchery" class="modal-trigger"><i class="fas fa-eraser"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                            <pagination :data="hatchery_records" @pagination-change-page="fetchHatcheryRecord"></pagination>
                        </div>
                    </div>
                </div>

                <!-- Hatchery Form -->
                <div class="row" v-show="add_record!=false">
                    <div class="col s12 m12 l12">
                        <div class="row valign-wrapper">
                            <div class="col s9 m19 l9">
                                <h5 v-if="breeder.breeder_code!==null">Hatchery Record | {{breeder.breeder_code}}</h5>
                                <h5 v-else>Hatchery Record | {{breeder.breeder_tag}}</h5>
                                <i>Generation: <strong>{{breeder.generation_number}}</strong> Line: <strong>{{breeder.line_number}}</strong> Family: <strong>{{breeder.family_number}}</strong> Pen: <strong>{{breeder.pen_number}}</strong></i>
                            </div>
                            <div class="col s3 m3 l3 center-align">
                                <a @click="add_record=false; hide_record=false; selected_generation=null; selected_line=null; selected_family=null; include_brooder=false" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
                            </div>
                        </div>
                        <div class="row valign-wrapper orange lighten-4">
                            <div class="col s1 m1 l1 center-align">
                                <p><span><h5><i class="fas fa-exclamation-circle"></i></h5></span> </p>
                            </div>
                            <div class="col s11 m11 l11">
                                <p>You can submit this form without supplying all the data</p>
                                <p>You can edit this form. However, when the all the fields are complete and submitted, it cannot be edited anymore</p>
                                
                                <p>(Required Data to Submit Form: <strong>Date Eggs Set</strong>, <strong>Number of Eggs Set</strong>)</p>
                            </div>
                        </div>
                        <form v-on:submit.prevent="validateMainForm">
                            <div class="row">
                                <div class="col s6 m6 l6">
                                    <label for="date_set">Date Eggs Set <span v-if="check_date_eggs_set===false" class="red-text"><i><i class="fas fa-exclamation-circle"></i>Input is required</i></span></label>
                                    <datepicker placeholder="Date when eggs are set" id="date_set" :format="customFormatter" v-model="date_eggs_set"></datepicker>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6 m6 l6">
                                    <label class="active" for="eggs_set">Number of Eggs Set <span v-if="check_number_eggs_set===false" class="red-text"><i><i class="fas fa-exclamation-circle"></i>Input is required</i></span></label>
                                    <input placeholder="Number of eggs set" id="eggs_set" type="number" min=0 class="validate" v-model.number="number_eggs_set" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6 m6 l6">
                                    <label class="active" for="number_fertile">Number of Eggs Fertile</label>
                                    <input placeholder="Number of eggs that are fertile" id="number_fertile" type="number" min=0 class="validate" v-model.number="number_fertile" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6 m6 l6">
                                    <label class="active" for="number_hatched">Number of Eggs Hatched</label>
                                    <input placeholder="Number of eggs that hatched" id="number_hatched" type="number" min=0 class="validate" v-model.number="number_hatched" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6 m6 l6">
                                    <label for="date_hatched ">Date Eggs Hatched</label>
                                    <datepicker placeholder="Date when eggs hatched" id="date_hatched" :format="customFormatter(date_hatched)" v-model="date_hatched"></datepicker>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <label for="include">Include as Brooder in System</label>
                                    <div class="switch" id="include">
                                        <label>
                                            No
                                            <input v-model="include_brooder" type="checkbox">
                                            <span class="lever"></span>
                                            Yes
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div v-show="include_brooder==true && add_record==true">
                                <div class="row">
                                    <div class="input-field col s12 m6 l6">
                                        <label for="choose_generations" class="active">Generation</label>
                                        <v-select @input="selectLine" v-model="selected_generation" label="number" :options="generations" id="choose_generations">
                                            <i slot="spinner" class="icon icon-spinner"></i>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6 l6">
                                        <label for="choose_line" class="active">Line</label>
                                        <v-select @input="selectFamily" v-model="selected_line" resetOnOptionsChange label="number" :options="lines" id="choose_line">
                                            <i slot="spinner" class="icon icon-spinner"></i>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6 l6">
                                        <label for="choose_family" class="active">Family</label>
                                        <v-select v-model="selected_family" resetOnOptionsChange label="number" :options="families" id="choose_family">
                                            <i slot="spinner" class="icon icon-spinner"></i>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m6 l6">
                                        <label>Place to brooder pen</label>
                                        <select v-model="selected_brooder_pen" class="browser-default">
                                            <option v-if="brooder_pens_length == 0" value="" disabled selected>No brooder pens available</option>
                                            <option v-else value="" disabled selected>Choose your option</option>
                                            <option v-for="pen in brooder_pens" :key="pen.id" :value="pen.id">{{pen.number}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row center">
                                <div class="col s12 m12 l12">
                                    <button class="btn waves-effect waves-light blue-grey" type="submit" name="action">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="update_modal" class="modal modal-fixed-footer">
                    <form v-on:submit.prevent="updateHatcheryRecord">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h4>Update Hatchery Record | {{breeder_tag}}</h4>
                                </div>
                            </div>
                            <div class="row valign-wrapper orange lighten-4">
                                <div class="col s1 m1 l1 center-align">
                                    <p><span><h5><i class="fas fa-exclamation-circle"></i></h5></span> </p>
                                </div>
                                <div class="col s11 m11 l11">
                                    <p>You can submit this form without supplying all the data</p>
                                    <p>You can edit this form. However, when the all the fields are complete and submitted, it cannot be edited anymore</p>
                                    <p>(Required Data to Submit Form: <strong>Number of Fertile Eggs</strong>)</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="row">
                                        <div class="col s6 m6 l6">
                                            <label for="date_set">Date Eggs Set</label>
                                            <datepicker placeholder="Date when eggs are set" disabled id="date_set" :format="customFormatter(edit_date_eggs_set)" v-model="edit_date_eggs_set"></datepicker>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s6 m6 l6">
                                            <label class="active" for="eggs_set">Number of Eggs Set</label>
                                            <input placeholder="Number of eggs set" id="eggs_set" disabled type="number" min=0 class="validate" v-model.number="edit_number_eggs_set">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s6 m6 l6">
                                            <label class="active" for="number_fertile">Number of Eggs Fertile</label>
                                            <input placeholder="Number of eggs that are fertile" id="number_fertile" type="number" min=0 class="validate" v-model.number="edit_number_fertile" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s6 m6 l6">
                                            <label class="active" for="number_hatched">Number of Eggs Hatched</label>
                                            <input placeholder="Number of eggs that hatched" id="number_hatched" type="number" min=0 class="validate" v-model.number="edit_number_hatched" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s6 m6 l6">
                                            <label class="active" for="date_hatched ">Date Eggs Hatched</label>
                                            <datepicker placeholder="Date when eggs hatched" id="date_hatched" :format="customFormatter(edit_date_hatched)" v-model="edit_date_hatched"></datepicker>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <label for="include">Include as Brooder in System</label>
                                            <div class="switch" id="include">
                                                <label>
                                                    No
                                                    <input v-model="updateinclude_brooder" type="checkbox">
                                                    <span class="lever"></span>
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-show="updateinclude_brooder==true && update_record==true">
                                        <div class="row">
                                            <div class="input-field col s12 m6 l6">
                                                <label for="choose_generations" class="active">Generation</label>
                                                <v-select @input="selectLine" v-model="selected_generation" label="number" :options="generations" id="choose_generations">
                                                    <i slot="spinner" class="icon icon-spinner"></i>
                                                </v-select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12 m6 l6">
                                                <label for="choose_line" class="active">Line</label>
                                                <v-select @input="selectFamily" v-model="selected_line" resetOnOptionsChange label="number" :options="lines" id="choose_line">
                                                    <i slot="spinner" class="icon icon-spinner"></i>
                                                </v-select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12 m6 l6">
                                                <label for="choose_family" class="active">Family</label>
                                                <v-select v-model="selected_family" resetOnOptionsChange label="number" :options="families" id="choose_family">
                                                    <i slot="spinner" class="icon icon-spinner"></i>
                                                </v-select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Place to brooder pen</label>
                                                <select v-model="edit_selected_brooder_pen" class="browser-default">
                                                    <option v-if="brooder_pens_length == 0" value="" disabled selected>No brooder pens available</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="pen in brooder_pens" :key="pen.id" :value="pen.id">{{pen.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat" type="submit">Submit</button>
                            <a @click="selected_generation=null; selected_line=null; selected_family=null; update_record=false; updateinclude_brooder=false" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                        </div>
                    </form>
                </div>

                <div id="delete_hatchery" class="modal modal-fixed-footer">
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
                                <p>Are you sure you want to <strong>Delete</strong> this hatchery record?</p>
                                <blockquote>
                                    <span>Date Set : {{selected_hatchery_record.date_eggs_set}}</span><br>
                                    <span>Quantity : {{selected_hatchery_record.number_eggs_set}}</span><br>
                                    <span>Age in Weeks : {{selected_hatchery_record.week_of_lay}}</span><br>
                                    <span>No. Fertile : {{selected_hatchery_record.number_fertile}}</span><br>
                                    <span>Date Hatched : {{selected_hatchery_record.date_hatched}}</span><br>
                                    <span>No. Hatched : {{selected_hatchery_record.number_hatched}}</span>
                                </blockquote>
                                <p>This action is <strong>Irreversible</strong>.</p>
                                <p><i class="fas fa-asterisk"></i> <i>This will cause a change in your Brooder data</i></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a @click.prevent="deleteHatcheryRecord" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Yes</a>
                        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">No</a>
                    </div>
                </div>

                <div id="force_delete_hatchery" class="modal modal-fixed-footer">
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
                                <p>Are you sure you want to <strong>Delete</strong> this hatchery record?</p>
                                <blockquote>
                                    <span>Date Set : {{selected_forcedel_record.date_eggs_set}}</span><br>
                                    <span>Quantity : {{selected_forcedel_record.number_eggs_set}}</span><br>
                                    <span>Age in Weeks : {{selected_forcedel_record.week_of_lay}}</span><br>
                                    <span>No. Fertile : {{selected_forcedel_record.number_fertile}}</span><br>
                                    <span>Date Hatched : {{selected_forcedel_record.date_hatched}}</span><br>
                                    <span>No. Hatched : {{selected_forcedel_record.number_hatched}}</span>
                                </blockquote>
                                <p>This action is <strong>Irreversible</strong>.</p>
                                <p><i class="fas fa-asterisk"></i> <i>This will <strong>NOT</strong> cause a change in your Brooder data, if you want to change your Brooder Data, delete the Brooder record <strong>MANUALLY</strong></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a @click.prevent="forceDeleteHatcheryRecord" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Yes</a>
                        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">No</a>
                    </div>
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
        Datepicker,
    },
    props: [
        'breeder','breeder_tag', 'animal_type'
    ],
    data () {
        return {
            brooder_pens : [],
            brooder_pens_length : 0,
            hatchery_records : {},
            hatchery_records_length : 0,
            add_record : false,
            selected_record : null,
            hide_record : false,
            date_eggs_set : '',
            number_eggs_set : '',
            number_fertile : '',
            number_hatched : '',
            date_hatched : '',
            selected_brooder_pen : '',
            include_brooder : false,
            generations : [],
            lines : [],
            families : [],
            line_length : 0,
            selected_generation : null,
            selected_line : null,
            selected_family : null,
            
            update_record : false,
            selected_hatchery_record : '',
            edit_date_eggs_set : '',
            edit_number_eggs_set : '',
            edit_number_fertile : '',
            edit_number_hatched : '',
            edit_date_hatched : '',
            edit_selected_brooder_pen : '',
            updateinclude_brooder : false,
            
            check_date_eggs_set : true,
            check_number_eggs_set : true,

            selected_forcedel_record: '',
        }   
    },
    methods : {
        initialize () {
            this.fetchHatcheryRecord();
            this.fetchBrooderPen();
            if(this.add_record != null || this.update_record != false){
                this.fetchNewGeneration();
            }
            
        },
        fetchHatcheryRecord : function(page = 1) {
            axios.get('breeder_hatchery/'+this.breeder.inventory_id+'?page='+page)
            .then(response => {
                this.hatchery_records = response.data;
                this.hatchery_records_length = this.hatchery_records.data.length;
            })
            .catch(error => {
                console.log(error);
            });
        },
        fetchBrooderPen : function () {
            axios.get('breeder_fetch_brooder_pens')
            .then(response => {
                this.brooder_pens = response.data;
                this.brooder_pens_length = this.brooder_pens.length;
            })
            .catch(error => {
                console.log(error);
            });
        },
        fetchNewGeneration : function () {
            axios.get('breeder_hatchery_generation/' + this.breeder.inventory_id)
            .then(response => {
                this.generations = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        selectLine : function () {
            if(this.selected_generation != null){
                axios.get('breeder_fetch_line/'+this.selected_generation.id)
                .then(response => {
                    this.lines = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        selectFamily : function () {
            if(this.selected_line != null){
                axios.get('breeder_fetch_families/'+this.selected_line.id)
                .then(response => {
                    this.families = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        addHatcheryRecord : function () {
            var record = {};
            if(this.include_brooder){
                record = {
                    breeder_inventory_id : this.breeder.inventory_id,
                    date_eggs_set : this.customFormatter(this.date_eggs_set),
                    number_eggs_set : this.number_eggs_set,
                    number_fertile : this.number_fertile,
                    number_hatched : this.number_hatched,
                    date_hatched : this.customFormatter(this.date_hatched),
                    broodergrower_pen_id : this.selected_brooder_pen,
                    include : this.include_brooder,
                    family : this.selected_family.id,
                };
            }else{
                record = {
                    breeder_inventory_id : this.breeder.inventory_id,
                    date_eggs_set : this.customFormatter(this.date_eggs_set),
                    number_eggs_set : this.number_eggs_set,
                    number_fertile : this.number_fertile,
                    number_hatched : this.number_hatched,
                    date_hatched : this.customFormatter(this.date_hatched),
                    broodergrower_pen_id : this.selected_brooder_pen,
                    include : this.include_brooder,
                };
            }
            axios.post('breeder_add_hatchery', record)
            .then(response => {
                if(response.data.error == undefined){
                    this.date_eggs_set = '';
                    this.number_eggs_set = '';
                    this.number_fertile = '';
                    this.number_hatched = '';
                    this.date_hatched = '';
                    this.selected_brooder_pen = '';
                    this.include_brooder = false;
                    this.selected_family = '';
                    Materialize.toast('Successfully added hatchery record', 5000, 'green rounded');
                }else{
                    Materialize.toast(response.data.error, 5000, 'red rounded');
                }
            })
            .catch(error => {
                Materialize.toast('Failed to add hatchery record', 5000, 'red rounded');
            });
            this.fetchHatcheryRecord();
        },
        updateHatcheryRecord : function () {
            var record = {};
            if(this.updateinclude_brooder){
                record = {
                    selected_record_id : this.selected_hatchery_record.id,
                    date_eggs_set : this.customFormatter(this.edit_date_eggs_set),
                    number_eggs_set : this.edit_number_eggs_set,
                    number_fertile : this.edit_number_fertile,
                    number_hatched : this.edit_number_hatched,
                    date_hatched : this.customFormatter(this.edit_date_hatched),
                    broodergrower_pen_id : this.edit_selected_brooder_pen,
                    include : this.updateinclude_brooder,
                    family : this.selected_family.id,
                };
            }else{
                record = {
                    selected_record_id : this.selected_hatchery_record.id,
                    date_eggs_set : this.customFormatter(this.edit_date_eggs_set),
                    number_eggs_set : this.edit_number_eggs_set,
                    number_fertile : this.edit_number_fertile,
                    number_hatched : this.edit_number_hatched,
                    date_hatched : this.customFormatter(this.edit_date_hatched),
                    broodergrower_pen_id : this.edit_selected_brooder_pen,
                    include : this.updateinclude_brooder,
                };
            }
            axios.patch('breeder_edit_hatchery', record)
            .then(response => {
                if(response.data.error == undefined){
                    this.selected_hatchery_record = '';
                    this.edit_date_eggs_set = '';
                    this.edit_number_eggs_set = '';
                    this.edit_number_fertile = '';
                    this.edit_number_hatched = '';
                    this.edit_date_hatched = '';
                    this.edit_selected_brooder_pen = '';
                    this.updateinclude_brooder = false;
                    this.updateselected_family = '';
                    Materialize.toast('Successfully updated hatchery record', 5000, 'green rounded');
                }else{
                    Materialize.toast(response.data.error, 5000, 'red rounded');
                }
            })
            .catch(error => {
                Materialize.toast('Failed to update hatchery record', 5000, 'red rounded');
            });
            this.fetchHatcheryRecord();
        },
        deleteHatcheryRecord : function () {
            axios.post('breeder_delete_hatcheryrecord', {
                delete_record : this.selected_hatchery_record.id
            })
            .then(response => {
                Materialize.toast('Successfully deleted hatchery record', 5000, 'green rounded');
                this.selected_hatchery_record = '';
            })
            .catch(error => {
                Materialize.toast('Failed to delete hatchery record', 5000, 'red rounded');
            });
            this.fetchHatcheryRecord();
        },
        forceDeleteHatcheryRecord : function () {
            axios.post('force_breeder_delete_hatcheryrecord', {
                delete_record : this.selected_forcedel_record.id
            })
            .then(response => {
                Materialize.toast('Successfully deleted hatchery record', 5000, 'green rounded');
                this.selected_forcedel_record = '';
            })
            .catch(error => {
                Materialize.toast('Failed to delete hatchery record', 5000, 'red rounded');
            });
            this.fetchHatcheryRecord();
        },
        setEditForm : function () {
            this.edit_date_eggs_set = this.selected_hatchery_record.date_eggs_set;
            this.edit_number_eggs_set = this.selected_hatchery_record.number_eggs_set;
            this.edit_number_fertile = this.selected_hatchery_record.number_fertile;
            this.edit_number_hatched = this.selected_hatchery_record.number_hatched;
            this.edit_date_hatched = this.selected_hatchery_record.date_hatched;
            this.edit_selected_brooder_pen = this.selected_hatchery_record.selected_brooder_pen;
        },
        validateMainForm : function () {
            if(this.number_eggs_set === '' || this.date_eggs_set === ''){
                if(this.date_eggs_set === ''){
                    this.check_date_eggs_set = false;
                }else{
                    this.check_date_eggs_set = true;
                }
                if(this.number_eggs_set === ''){
                    this.check_number_eggs_set = false;
                }else{
                    this.check_number_eggs_set = true;
                }
                return;
            }else{
                this.check_date_eggs_set = true;
                this.check_number_eggs_set = true;
                this.addHatcheryRecord();
            }
        },
        customFormatter : function (date) {
            return moment(date).format('YYYY-MM-DD');
        },
        closeHatcheryRecords: function () {
            $('.tooltipped').tooltip('remove');
            this.$emit('close_record', null)
        }
    },
    mounted() {
        $('#delete_hatchery').modal({
            dismissible : false,
        });

        $('#update_modal').modal({
            dismissible : false,
        });
        $('#force_delete_hatchery').modal({
            dismissible : false,
        });
        tippy('#hatchery_div', {
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
