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
        <div class="row center" v-if="!broodergrowerloaded">
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
                                    <a href="#broodergrowermodal" @click="selected_broodergrower=broodergrower.id" class="tooltipped black-text modal-trigger" data-position="top" data-delay="50" data-tooltip="Add feeding records"><i class="fas fa-plus-circle"></i></a>
                                    <a href="javascript:void(0)" @click="selected_broodergrower=broodergrower.id;fetchFeedingRecords();" class="tooltipped black-text" data-position="top" data-delay="50" data-tooltip="Show feeding records"><i class="fas fa-info-circle"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                            <pagination :data="broodergrowers" @pagination-change-page="fetchBrooderFamilies"></pagination>
                        </div>
                    </div>
                    <div class="row" v-if="feedingdetails">
                        <div class="col s12 m12 l12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row card-title valign-wrapper">
                                        <div class="col s10 m10 l10">
                                            Feeding Records
                                        </div>
                                        <div class="col s2 m2 l2 center-align">
                                            <a href="javascript:void(0)" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Close" @click="feedingdetails=false"><i class="fas fa-window-close red-text"></i></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="responsive-table highlight bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Offered</th>
                                                        <th>Refused</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr v-if="Array.isArray(feedingrecords.data) == false">
                                                        <td>-</td>
                                                        <td>No</td>
                                                        <td>Data</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr v-else v-for="feedingrecord in feedingrecords.data" :key="feedingrecord.id">
                                                        <td>{{feedingrecord.date_collected}}</td>
                                                        <td>{{feedingrecord.amount_offered}}</td>
                                                        <td>{{feedingrecord.amount_refused}}</td>
                                                        <td v-if="feedingrecord.remarks==null">None</td>
                                                        <td v-else>{{feedingrecord.remarks}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12 center">
                                            <pagination :data="feedingrecords" @pagination-change-page="fetchFeedingRecords"></pagination>
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
            <form v-on:submit.prevent="addFeedingRecords" method="post">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Add Feeding Record</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <label for="date_added">Date Collected</label>
                            <datepicker id="date_added" :format="customFormatter" v-model="date_collected"></datepicker>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 s6 m6 input-field">
                            <input v-model.number="offered" class="validate" placeholder="Amount of Feed Offered (g)" id="feed_offered" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$" validate>
                            <label for="feed_offered">Feed Offered</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 s6 m6 input-field">
                            <input v-model.number="refused" class="validate" placeholder="Amount of Feed Refused (g)" id="feed_refused" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                            <label for="feed_refused">Feed Refused</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 s6 m6 input-field">
                            <input v-model="remarks" placeholder="Add remarks" id="remarks" type="text">
                            <label for="remarks">Remarks</label>
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
                feedingdetails : false,
                feedingdetailsloaded : false,
                feedingrecords : {},
                selected_broodergrower : '',
                date_collected : '',
                offered : '',
                refused : '',
                remarks : ''
            }
        },
        methods : {
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            },
            initialize : function () {
                // this.fetchGenerations();
                // this.fetchPens();
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
            fetchFeedingRecords : function (page = 1) {
                this.feedingdetails = false;
                this.feedingdetailsloaded = false;
                axios.get('broodergrower_feeding_records/'+this.selected_broodergrower+'?page='+page)
                .then(response => this.feedingrecords = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.feedingdetailsloaded = true;
                this.feedingdetails = true;
            },
            addFeedingRecords : function () {
                axios.post('add_broodergrower_feeding', {
                    broodergrower_id : parseInt(this.selected_broodergrower),
                    date_collected : this.customFormatter(this.date_collected),
                    offered : parseFloat(this.offered),
                    refused : parseFloat(this.refused),
                    remarks : this.remarks,
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.fetchFeedingRecords();
            },
            searchBrooderFamilies : function () {

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
