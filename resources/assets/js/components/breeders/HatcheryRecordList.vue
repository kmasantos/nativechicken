<template>
    <div class="row">
        <div class="col s12 m12 m12">
            <div class="card-panel">
                <!-- Hatchery List -->
                <div class="row valign-wrapper" v-show="hide_record==false">
                    <div class="col s6 m6 l6">
                        <h5>Hatchery Record | Family</h5>
                    </div>
                    <div class="col s3 m3 l3 right-align">
                        <a @click="add_record=true; hide_record=true" class="waves-effect waves-green btn-flat green-text"><i class="fas fa-plus-circle left"></i>Add</a>
                    </div>
                    <div class="col s3 m3 l3 center-align">
                        <a v-on:click="closeHatcheryRecords" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
                    </div>
                </div>
                <div class="row" v-show="hide_record==false">
                    <div class="col s12 m12 l12">
                        <table class="responsive-table bordered highlight centered">
                            <thead>
                                <tr>
                                    <th>Date Set</th>
                                    <th>Quantity</th>
                                    <th>Week of Lay</th>
                                    <th>No. Fertile</th>
                                    <th>No. Hatched</th>
                                    <th>Date Hatched</th>
                                    <th>Update Record</th>
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

                <!-- Hatchery Form -->
                <div class="row" v-show="add_record!=null">
                    <div class="col s12 m12 l12">
                        <div class="row valign-wrapper">
                            <div class="col s9 m19 l9">
                                <h5>Add Hatchery Record | Family</h5>
                            </div>
                            <div class="col s3 m3 l3 center-align">
                                <a @click="add_record=null; hide_record=false" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
                            </div>
                        </div>
                        <form action="">
                            <div class="row">
                                <div class="col s6 m6 l6">
                                    <label for="date_set">Date Eggs Set</label>
                                    <datepicker placeholder="Date when eggs are set" id="date_set" :format="customFormatter" v-model="date_eggs_set"></datepicker>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6 m6 l6">
                                    <label for="eggs_set">Number of Eggs Set</label>
                                    <input placeholder="Number of eggs set" id="eggs_set" type="number" min=0 class="validate" v-model="number_eggs_set" oninput="this.value = Math.abs(this.value)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6 m6 l6">
                                    <label for="number_fertile">Number of Eggs Fertile</label>
                                    <input placeholder="Number of eggs that are fertile" id="number_fertile" type="number" min=0 class="validate" v-model="number_fertile" oninput="this.value = Math.abs(this.value)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6 m6 l6">
                                    <label for="number_hatched">Number of Eggs Hatched</label>
                                    <input placeholder="Number of eggs that hatched" id="number_hatched" type="number" min=0 class="validate" v-model="number_hatched" oninput="this.value = Math.abs(this.value)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6 m6 l6">
                                    <label for="date_hatched ">Date Eggs Hatched</label>
                                    <datepicker placeholder="Date when eggs hatched" id="date_hatched" :format="customFormatter(date_hatched)" v-model="date_hatched "></datepicker>
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
            Datepicker,
        },
        props: {
            breeder : Number,
        },
        data () {
            return {
                hatchery_records : {},
                hatchery_records_length : 0,
                add_record : null,
                selected_record : null,
                hide_record : false,
                date_eggs_set : '',
                number_eggs_set : '',
                number_fertile : '',
                number_hatched : '',
                date_hatched : '',
            }
        },
        methods : {
            initialize () {
                this.fetchHatcheryRecord();
            },
            fetchHatcheryRecord : function(page = 1) {
                axios.get('breeder_hatchery/'+this.breeder+'?page='+page)
                .then(response => this.hatchery_records = response.data)
                .catch(function (error) {
                    console.log(error);
                });
            },
            addHatcheryRecord : function () {
                axios.post('breeder_add_hatchery', {
                    breeder_id : this.breeder,
                    date_eggs_set : this.customFormatter(this.date_eggs_set),
                    number_eggs_set : this.number_eggs_set,
                    number_fertile : this.number_fertile,
                    number_hatched : this.number_hatched,
                    date_hatched : this.customFormatter(this.date_hatched),
                })
                .then(function (response) {
                    Materialize.toast('Successfully added hatchery record', 3000, 'rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to add hatchery record', 3000, 'rounded');
                });
            },
            customFormatter : function (date) {
                return moment(date).format('YYYY-MM-DD');
            },
            closeHatcheryRecords: function () {
                this.$emit('close_record', null)
            }
        },
        created (){
            this.initialize();
        }
    }
</script>
