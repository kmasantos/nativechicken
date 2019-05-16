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
                        <div class="card-tabs">
                            <ul class="tabs tabs-fixed-width">
                            <li class="tab"><a href="#test4">BROODER</a></li>
                            <li class="tab"><a href="#test5">GROWER</a></li>
                            </ul>
                        </div>
                        <div class="card-content grey lighten-4">
                            <div id="test4">
                                <div class="row" v-if="Object.entries(grower_growth_record).length === 0 && grower_growth_record.constructor === Object">
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
                                                <tr v-for="(fam, index) in brooder_growth" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Family</th>
                                                                    <th>Day 0</th>
                                                                    <th>Day 21</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(data, famindex) in fam" :key="famindex">
                                                                <td>{{famindex}}</td>
                                                                <td>
                                                                    <table class="bordered centered responsive-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>μ</th>
                                                                                <th>σ</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <tr>
                                                                                <td>{{getMean(data[0])}}</td>
                                                                                <td>{{getStd(data[0])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td>
                                                                    <table class="bordered centered responsive-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>μ</th>
                                                                                <th>σ</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <tr>
                                                                                <td>{{getMean(data[21])}}</td>
                                                                                <td>{{getStd(data[21])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
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
                            <div id="test5">
                                <div class="row" v-if="Object.entries(grower_growth_record).length === 0 && grower_growth_record.constructor === Object">
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
                                                <tr v-for="(fam, index) in grower_growth" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Family</th>
                                                                    <th>Day 45</th>
                                                                    <th>Day 75</th>
                                                                    <th>Day 100</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(data, famindex) in fam" :key="famindex">
                                                                <td>{{famindex}}</td>
                                                                <td>
                                                                    <table class="bordered centered responsive-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>μ</th>
                                                                                <th>σ</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <tr>
                                                                                <td>{{getMean(data[45])}}</td>
                                                                                <td>{{getStd(data[45])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td>
                                                                    <table class="bordered centered responsive-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>μ</th>
                                                                                <th>σ</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <tr>
                                                                                <td>{{getMean(data[75])}}</td>
                                                                                <td>{{getStd(data[75])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td>
                                                                    <table class="bordered centered responsive-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>μ</th>
                                                                                <th>σ</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <tr>
                                                                                <td>{{getMean(data[100])}}</td>
                                                                                <td>{{getStd(data[100])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
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
            grower_growth_record : {},
            brooder_growth_record : {},
            grower_growth : {},
            brooder_growth : {},
            grower_growth_record_len : 0,
            brooder_growth_record_len : 0,
        }
    },
    methods : {
        init : function () {
            this.getFamilyBrooderGrowth();
            this.getFamilyGrowerGrowth();
        },
        getFamilyBrooderGrowth : function () {
            axios.get('family_summary_brooder_growth/'+this.generation.id)
            .then(response => {
                this.brooder_growth_record = response.data;
                this.brooder_growth_record_len = this.brooder_growth_record.length;
                this.brooder_growth = {};
                this.brooder_growth_record.forEach(element => {
                    if((typeof this.brooder_growth[element.line_number] === 'undefined')){
                        this.brooder_growth[element.line_number] = {};
                    }
                    if((typeof this.brooder_growth[element.line_number][element.family_number] === 'undefined')){
                        this.brooder_growth[element.line_number][element.family_number] = {}
                        this.brooder_growth[element.line_number][element.family_number][0] = [];
                        this.brooder_growth[element.line_number][element.family_number][21] = [];
                    }
                    if(element.collection_day === 0){
                        this.brooder_growth[element.line_number][element.family_number][0].push(element.total_weight);
                    }else if(element.collection_day === 21){
                        this.brooder_growth[element.line_number][element.family_number][21].push(element.total_weight);
                    }
                });
                
            })
            .catch(error => {

            });
        },
        getFamilyGrowerGrowth : function () {
            axios.get('family_summary_replacement_growth/'+this.generation.id)
            .then(response => {
                this.grower_growth_record = response.data;
                this.grower_growth_record_len = this.grower_growth_record.length;
                this.grower_growth = {};
                this.grower_growth_record.forEach(element => {
                    if((typeof this.grower_growth[element.line_number] === 'undefined')){
                        this.grower_growth[element.line_number] = {};
                    }
                    if((typeof this.grower_growth[element.line_number][element.family_number] === 'undefined')){
                        this.grower_growth[element.line_number][element.family_number] = {};

                        this.grower_growth[element.line_number][element.family_number][45] = {};
                        this.grower_growth[element.line_number][element.family_number][75] = {};
                        this.grower_growth[element.line_number][element.family_number][100] = {};

                        this.grower_growth[element.line_number][element.family_number][45]['male'] = [];
                        this.grower_growth[element.line_number][element.family_number][45]['female'] = [];

                        this.grower_growth[element.line_number][element.family_number][75]['male'] = [];
                        this.grower_growth[element.line_number][element.family_number][75]['female'] = [];

                        this.grower_growth[element.line_number][element.family_number][100]['male'] = [];
                        this.grower_growth[element.line_number][element.family_number][100]['female'] = [];
                    }   
                    if(element.collection_day === 45){
                        if(element.male_weight != null){
                            this.grower_growth[element.line_number][element.family_number][45]['male'].push(element.male_weight);
                        }
                        if(element.female_weight != null){
                            this.grower_growth[element.line_number][element.family_number][45]['female'].push(element.female_weight);
                        }
                    }else if(element.collection_day === 75){
                        if(element.male_weight != null){
                            this.grower_growth[element.line_number][element.family_number][75]['male'].push(element.male_weight);
                        }
                        if(element.female_weight != null){
                            this.grower_growth[element.line_number][element.family_number][75]['female'].push(element.female_weight);
                        }
                    }else if(element.collection_day === 100){
                        if(element.male_weight != null){
                            this.grower_growth[element.line_number][element.family_number][100]['male'].push(element.male_weight);
                        }
                        if(element.female_weight != null){
                            this.grower_growth[element.line_number][element.family_number][100]['female'].push(element.female_weight);
                        }
                    }
                });
                
            })
            .catch(error => {

            });
        },
        getMean : function (array) {
            if(array === undefined || array.length == 0){
                return "-";
            }else{
                return math.mean(array).toFixed(2);
            }
        },
        getStd : function (array) {
            if(array === undefined || array.length == 0){
                return "-";
            }else{
                return math.std(array).toFixed(2);
            }
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
