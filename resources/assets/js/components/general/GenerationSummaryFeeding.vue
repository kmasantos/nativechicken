<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align custom-title">
                                BREEDERS
                            </div>
                        </div>
                        <div class="row" v-if="Object.entries(breeder_feeding).length === 0 && breeder_feeding.constructor === Object">
                            <div class="col s12 m12 l12 center-align">
                                <strong>NO DATA</strong>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col s12 m12 l12">
                                <table class="bordered highlight centered responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Generation</th>
                                            <th>Total Fed</th>
                                            <th>Total Refused</th>
                                            <th>Total Consumption</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(item, index) in breeder_feeding" :key="index">
                                            <td>{{index}}</td>
                                            <td>{{getSum(item["offered"])}}</td>
                                            <td>{{getSum(item["refused"])}}</td>
                                            <td>{{(getSum(item["offered"]) - getSum(item["refused"])).toFixed(2)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align custom-title">
                                GROWERS & REPLACEMENTS
                            </div>
                        </div>
                        <div class="row" v-if="Object.entries(replacement_feeding).length === 0 && replacement_feeding.constructor === Object">
                            <div class="col s12 m12 l12 center-align">
                                <strong>NO DATA</strong>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col s12 m12 l12">
                                <table class="bordered highlight centered responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Generation</th>
                                            <th>Total Fed</th>
                                            <th>Total Refused</th>
                                            <th>Total Consumption</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(item, index) in replacement_feeding" :key="index">
                                            <td>{{index}}</td>
                                            <td>{{getSum(item["offered"])}}</td>
                                            <td>{{getSum(item["refused"])}}</td>
                                            <td>{{(getSum(item["offered"]) - getSum(item["refused"])).toFixed(2)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align custom-title">
                                BROODERS
                            </div>
                        </div>
                        <div class="row" v-if="Object.entries(brooder_feeding).length === 0 && brooder_feeding.constructor === Object">
                            <div class="col s12 m12 l12 center-align">
                                <strong>NO DATA</strong>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col s12 m12 l12">
                                <table class="bordered highlight centered responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Generation</th>
                                            <th>Total Fed</th>
                                            <th>Total Refused</th>
                                            <th>Total Consumption</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(item, index) in brooder_feeding" :key="index">
                                            <td>{{index}}</td>
                                            <td>{{getSum(item["offered"])}}</td>
                                            <td>{{getSum(item["refused"])}}</td>
                                            <td>{{(getSum(item["offered"]) - getSum(item["refused"])).toFixed(2)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const math = require('mathjs');
export default {
    data () {
        return {
            breeder_feeding_record : null,
            replacement_feeding_record : null,
            brooder_feeding_record : null,
            breeder_feeding : {},
            replacement_feeding : {},
            brooder_feeding : {},
            breeder_feeding_record_len : 0,
            replacement_feeding_record_len : 0,
            brooder_feeding_record_len : 0,
        }
    },
    methods : {
        init : function () {
            this.getGenerationBreederFeeding();
            this.getGenerationReplacementFeeding();
            this.getGenerationBrooderFeeding();
        },
        getGenerationBreederFeeding : function () {
            axios.get('generation_summary_breeder_feeding')
            .then(response => {
                this.breeder_feeding_record = response.data;
                this.breeder_feeding_record_len = this.breeder_feeding_record.length;
                this.breeder_feeding = {};
                this.breeder_feeding_record.forEach(element => {
                    if((typeof this.breeder_feeding[element.number] === 'undefined')){
                        this.breeder_feeding[element.number] = {};
                        this.breeder_feeding[element.number]['offered'] = [];
                        this.breeder_feeding[element.number]['refused'] = [];
                    }                    
                    this.breeder_feeding[element.number]['offered'].push(element.amount_offered);
                    this.breeder_feeding[element.number]['refused'].push(element.amount_refused);
                    
                });
                
            })
            .catch(error => {

            });
        },
        getGenerationReplacementFeeding : function () {
            axios.get('generation_summary_replacement_feeding')
            .then(response => {
                this.replacement_feeding_record = response.data;
                this.replacement_feeding_record_len = this.replacement_feeding_record.length;
                this.replacement_feeding = {};
                this.replacement_feeding_record.forEach(element => {
                    if((typeof this.replacement_feeding[element.number] === 'undefined')){
                        this.replacement_feeding[element.number] = {};
                        this.replacement_feeding[element.number]['offered'] = [];
                        this.replacement_feeding[element.number]['refused'] = [];
                    }                    
                    this.replacement_feeding[element.number]['offered'].push(element.amount_offered);
                    this.replacement_feeding[element.number]['refused'].push(element.amount_refused);
                    
                });
            })
            .catch(error => {

            });
        },
        getGenerationBrooderFeeding : function () {
            axios.get('generation_summary_brooder_feeding')
            .then(response => {
                this.brooder_feeding_record = response.data;
                this.brooder_feeding_record_len = this.brooder_feeding_record.length;
                this.brooder_feeding = {};
                this.brooder_feeding_record.forEach(element => {
                    if((typeof this.brooder_feeding[element.number] === 'undefined')){
                        this.brooder_feeding[element.number] = {};
                        this.brooder_feeding[element.number]['offered'] = [];
                        this.brooder_feeding[element.number]['refused'] = [];
                    }                    
                    this.brooder_feeding[element.number]['offered'].push(element.amount_offered);
                    this.brooder_feeding[element.number]['refused'].push(element.amount_refused);
                    
                });
            })
            .catch(error => {

            });
        },
        getSum : function (array) {
            return math.sum(array).toFixed(2);
        }
    },
    mounted () {
        this.init();
    }
}
</script>

<style scoped>
    tbody {
        display:block;
        max-height:700px;
        overflow:auto;
    }
    thead, tbody tr {
        display:table;
        width:100%;
        table-layout:fixed;
    }
    thead {
        width: calc( 100% - 1em )
    }
    table {
        width:100%;
    }
    .custom-title {
        font-size: 1.3em;
    }
</style>
