<template>
    <div>
        <div class="row valign-wrapper">
            <div class="col s9 m9 l9">
                <label for="date_select_prod">Select Year</label>
                <datepicker v-model="selected_year" :minimumView="'year'" :initialView="'year'" :format="'yyyy'"></datepicker>
            </div>
            <div class="col s3 m3 l3" v-if="selected_year==null">
                <a class="waves-effect waves-light btn blue-grey lighten-1 disabled"><i class="fas fa-calendar-day left"></i>Show</a>
            </div>
            <div class="col s3 m3 l3" v-else>
                <a class="waves-effect waves-light btn blue-grey lighten-1" @click="summary_year=dateFormatter(selected_year)"><i class="fas fa-calendar-day left"></i>Show</a>
            </div>
        </div>
        
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-tabs">
                        <ul class="tabs tabs-fixed-width">
                        <li class="tab"><a href="#genpheno">Phenotypic & Morphometric</a></li>
                        <li class="tab"><a href="#genprod">Production Indices</a></li>
                        <li class="tab"><a href="#geninv">Inventory</a></li>
                    </ul>
                    </div>
                        <div class="card-content grey lighten-4">
                            <div v-if="summary_year===null" id="genpheno">
                                <div class="row center">
                                    <div class="col s12 m12 l12">
                                        <h5>Select Year</h5>
                                    </div>
                                </div>
                            </div>
                            <div v-else id="genpheno">
                                <!-- Pheno and Morpho Component -->
                                <generation-phenomorpho :year="summary_year"></generation-phenomorpho>
                            </div>
                            <div v-if="summary_year===null" id="genprod">
                                <div class="row center">
                                    <div class="col s12 m12 l12">
                                        <h5>Select Year</h5>
                                    </div>
                                </div>
                            </div>
                            <div v-else id="genprod">
                                <!-- Production Component -->
                            </div>
                            <div v-if="summary_year===null" id="geninv">
                                <div class="row center">
                                    <div class="col s12 m12 l12">
                                        <h5>Select Year</h5>
                                    </div>
                                </div>
                            </div>
                            <div v-else id="geninv">
                                <!-- Inventory Component -->
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    var moment = require('moment');
    export default {
        components : {
            Datepicker
        },
        methods : {
            dateFormatter : function (date) {
                var formatted = moment(date).format('YYYY')
                return formatted;
            },
        },
        data () {
            return {
                selected_year : null,
                summary_year : null,
            }
        },
        created () {

        },
    }
</script>

<style>
    .col > .btn {
        width: 100%;
    }
</style>