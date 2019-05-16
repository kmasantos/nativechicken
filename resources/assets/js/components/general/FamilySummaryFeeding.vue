<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>{{title}} | Generation {{generation.number}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content center-align">
                            <p>Select a tab to show the desired feeding summary</p>
                        </div>
                        <div class="card-tabs">
                            <ul class="tabs tabs-fixed-width">
                            <li class="tab"><a href="#bred">BREEDERS</a></li>
                            <li class="tab"><a href="#grow">GROWERS</a></li>
                            <li class="tab"><a href="#brood">BROODERS</a></li>
                        </ul>
                        </div>
                        <div class="card-content grey lighten-4">
                            <div id="bred">
                                <div class="row" v-if="Object.entries(breeder_feeding_record).length === 0 && breeder_feeding_record.constructor === Object">
                                    <div class="col s12 m12 l12 center-align">
                                        NO DATA
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col s12 m12 l12">
                                        <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Line</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(line, index) in breeder_feeding" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Family</th>
                                                                    <th>Total Offered (g)</th>
                                                                    <th>Total Refused (g)</th>
                                                                    <th>Total Consumption (g)</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(fam, fam_index) in line" :key="fam_index">
                                                                    <td>{{fam_index}}</td>
                                                                    <td>{{getSum(fam.offered)}}</td>
                                                                    <td>{{getSum(fam.refused)}}</td>
                                                                    <td>{{(getSum(fam.offered)-getSum(fam.refused)).toFixed(2)}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="grow">
                                <div class="row" v-if="Object.entries(grower_feeding).length === 0 && grower_feeding.constructor === Object">
                                    <div class="col s12 m12 l12 center-align">
                                        NO DATA
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col s12 m12 l12">
                                        <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Line</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(line, index) in grower_feeding" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Family</th>
                                                                    <th>Total Offered (g)</th>
                                                                    <th>Total Refused (g)</th>
                                                                    <th>Total Consumption (g)</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(fam, fam_index) in line" :key="fam_index">
                                                                    <td>{{fam_index}}</td>
                                                                    <td>{{getSum(fam.offered)}}</td>
                                                                    <td>{{getSum(fam.refused)}}</td>
                                                                    <td>{{(getSum(fam.offered)-getSum(fam.refused)).toFixed(2)}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="brood">
                                <div class="row" v-if="Object.entries(brooder_feeding).length === 0 && brooder_feeding.constructor === Object">
                                    <div class="col s12 m12 l12 center-align">
                                        NO DATA
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col s12 m12 l12">
                                        <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Line</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(line, index) in brooder_feeding" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Family</th>
                                                                    <th>Total Offered (g)</th>
                                                                    <th>Total Refused (g)</th>
                                                                    <th>Total Consumption (g)</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(fam, fam_index) in line" :key="fam_index">
                                                                    <td>{{fam_index}}</td>
                                                                    <td>{{getSum(fam.offered)}}</td>
                                                                    <td>{{getSum(fam.refused)}}</td>
                                                                    <td>{{(getSum(fam.offered)-getSum(fam.refused)).toFixed(2)}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
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
        </div>
    </div>
</template>

<script>
const math = require('mathjs');
export default {
    props: [
        'animal_type',
        'title',
        'generation'
    ],
    data () {
        return {
            breeder_feeding_record : {},
            grower_feeding_record : {},
            brooder_feeding_record : {},
            breeder_feeding : {},
            grower_feeding : {},
            brooder_feeding : {},
        }
    },
    methods : {
        init : function () {
            this.getFamilyBreederFeeding();
            this.getFamilyReplacementFeeding();
            this.getFamilyBrooderFeeding();
        },
        getFamilyBreederFeeding : function () {
            axios.get('family_summary_breeder_feeding/'+this.generation.id)
            .then(response => {
                this.breeder_feeding_record = response.data;
                this.breeder_feeding = {};
                this.breeder_feeding_record.forEach(element => {
                    if((typeof this.breeder_feeding[element.line_number] === 'undefined')){
                        this.breeder_feeding[element.line_number] = {};
                    }          
                    if((typeof this.breeder_feeding[element.line_number][element.family_number] === 'undefined')){
                        this.breeder_feeding[element.line_number][element.family_number] = {};
                        this.breeder_feeding[element.line_number][element.family_number]['offered'] = [];
                        this.breeder_feeding[element.line_number][element.family_number]['refused'] = [];
                    }
                    this.breeder_feeding[element.line_number][element.family_number]['offered'].push(element.amount_offered);
                    this.breeder_feeding[element.line_number][element.family_number]['refused'].push(element.amount_refused);
                });
            })
            .catch(error => {});
        },
        getFamilyReplacementFeeding : function (){
            axios.get('family_summary_replacement_feeding/'+this.generation.id)
            .then(response => {
                this.grower_feeding_record = response.data;
                this.grower_feeding = {};
                if(grower_feeding_record.length === 0){
                    return;
                }else{
                    this.grower_feeding_record.forEach(element => {
                        if((typeof this.grower_feeding[element.line_number] === 'undefined')){
                            this.grower_feeding[element.line_number] = {};
                        }          
                        if((typeof this.grower_feeding[element.line_number][element.family_number] === 'undefined')){
                            this.grower_feeding[element.line_number][element.family_number] = {};
                            this.grower_feeding[element.line_number][element.family_number]['offered'] = [];
                            this.grower_feeding[element.line_number][element.family_number]['refused'] = [];
                        }
                        this.grower_feeding[element.line_number][element.family_number]['offered'].push(element.amount_offered);
                        this.grower_feeding[element.line_number][element.family_number]['refused'].push(element.amount_refused);
                    });
                }
                
            })
            .catch(error => {});
        },
        getFamilyBrooderFeeding : function (){
            axios.get('family_summary_brooder_feeding/'+this.generation.id)
            .then(response => {
                this.brooder_feeding_record = response.data;
                this.brooder_feeding = {};
                 if(brooder_feeding_record.length === 0){
                    return;
                }else{
                    this.brooder_feeding_record.forEach(element => {
                        if((typeof this.brooder_feeding[element.line_number] === 'undefined')){
                            this.brooder_feeding[element.line_number] = {};
                        }          
                        if((typeof this.brooder_feeding[element.line_number][element.family_number] === 'undefined')){
                            this.brooder_feeding[element.line_number][element.family_number] = {};
                            this.brooder_feeding[element.line_number][element.family_number]['offered'] = [];
                            this.brooder_feeding[element.line_number][element.family_number]['refused'] = [];
                        }
                        this.brooder_feeding[element.line_number][element.family_number]['offered'].push(element.amount_offered);
                        this.brooder_feeding[element.line_number][element.family_number]['refused'].push(element.amount_refused);
                    });
                }
                
            })
            .catch(error => {});
        },
        getSum : function (array) {
            return math.sum(array).toFixed(2);
        }
    },
    mounted () {
        $('ul.tabs').tabs();
        this.init();
    }
}
</script>

<style scoped>

</style>
