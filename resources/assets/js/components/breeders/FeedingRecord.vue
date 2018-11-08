<template>
    <div class="row">
        <div class="col s12 m12 m12">
            <div class="card-panel">
                <div class="row valign-wrapper">
                    <div class="col s6 m6 l7">
                        <h5>{{breeder_tag}} Feeding Records</h5>
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
                                    <td>{{feeding.breeder_tag}}</td>
                                    <td>{{feeding.amount_offered}}</td>
                                    <td>{{feeding.amount_refused}}</td>
                                    <td v-if="feeding.remarks == null">None</td>
                                    <td v-else>{{feeding.remarks}}</td>
                                    <td>-</td>
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
                                    <h4>{{breeder_tag}} Feeding Records</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="row">
                                        <div class="col s12 m6 l6">
                                            <label for="date_added">Date Collected</label>
                                            <datepicker id="date_added" :format="customFormatter" v-model="date_collected"></datepicker>
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
            'breeder', 'breeder_tag'
        ],
        data()  {
            return {
                feedings : {},
                feedings_length : 0,
                date_collected : '',
                offered : '',
                refused : '',
                remarks : '',
            }
        },
        methods : {
            initialize : function () {
                this.fetchFeedingRecord();
            },
            fetchFeedingRecord : function (page = 1) {
                axios.get('breeder_feeding/'+this.breeder+'?page='+page)
                .then(response => {
                    this.feedings = response.data;
                    this.feedings_length = this.feedings.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addFeedingRecord : function () {
                axios.post('breeder_feeding', {
                    breeder_id : this.breeder,
                    date_collected : this.customFormatter(this.date_collected),
                    offered : this.offered,
                    refused : this.refused,
                    remarks : this.remarks,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.date_collected = '';
                        this.offered = '';
                        this.refused = '';
                        this.remarks = '';
                        Materialize.toast('Successfully added feeding record', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast('Failed to add feeding record', 3000, 'red rounded');
                });
                this.initialize();
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
        },
        created() {
            this.initialize();
        },
        destroyed () {
            $('.tooltipped').tooltip({delay: 50});
        },
    }
</script>
