<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m12 l12 custom-notice">
                        <p>
                            <strong>Note:</strong>  
                        </p>
                        <p>
                            <i>• If the data does not specify male and female weights, no values will show</i>
                        </p>
                        <p>
                            <i>• If the data does not specify male and female weights, no values will show</i>
                        </p>
                        <p>
                            <i>• Weights are displayed in <strong>grams</strong></i>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align custom-title">
                                Brooder Weights
                            </div>
                        </div>
                        <div class="row"  v-if="brooder_growth_record_len>0">
                            <div class="col s12 m12 l12">
                                <table class="bordered responsive-table centered">
                                    <thead>
                                        <tr>
                                            <th>Generation</th>
                                            <th>Day 0</th>
                                            <th>Day 21</th>
                                        </tr>
                                    </thead>

                                    <tbody v-for="(data, index) in brooder_growth" :key="index">
                                        <tr>
                                            <td>{{index}}</td>
                                            <td>
                                                <table class="centered responsive-table">
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
                                                <table class="centered responsive-table">
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
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col s12 m12 l12 center-align">
                                <strong>NO DATA</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align custom-title">
                                Grower Weights
                            </div>
                        </div>
                        <div class="row"  v-if="grower_growth_record_len>0">
                            <div class="col s12 m12 l12">
                                <table class="bordered responsive-table centered">
                                    <thead>
                                        <tr>
                                            <th>Generation</th>
                                            <th>Day 45</th>
                                            <th>Day 75</th>
                                            <th>Day 100</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(data, index) in grower_growth" :key="index">
                                            <td>{{index}}</td>
                                            <td>
                                                <table class="centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>μ (<i class="fas fa-mars"></i>)</th>
                                                            <th>σ (<i class="fas fa-mars"></i>)</th>
                                                            <th>μ (<i class="fas fa-venus"></i>)</th>
                                                            <th>σ (<i class="fas fa-venus"></i>)</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>{{getMean(data[45]['male'])}}</td>
                                                            <td>{{getStd(data[45]['male'])}}</td>
                                                            <td>{{getMean(data[45]['female'])}}</td>
                                                            <td>{{getStd(data[45]['female'])}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>μ (<i class="fas fa-mars"></i>)</th>
                                                            <th>σ (<i class="fas fa-mars"></i>)</th>
                                                            <th>μ (<i class="fas fa-venus"></i>)</th>
                                                            <th>σ (<i class="fas fa-venus"></i>)</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>{{getMean(data[75]['male'])}}</td>
                                                            <td>{{getStd(data[75]['male'])}}</td>
                                                            <td>{{getMean(data[75]['female'])}}</td>
                                                            <td>{{getStd(data[75]['female'])}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>μ (<i class="fas fa-mars"></i>)</th>
                                                            <th>σ (<i class="fas fa-mars"></i>)</th>
                                                            <th>μ (<i class="fas fa-venus"></i>)</th>
                                                            <th>σ (<i class="fas fa-venus"></i>)</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>{{getMean(data[100]['male'])}}</td>
                                                            <td>{{getStd(data[100]['male'])}}</td>
                                                            <td>{{getMean(data[100]['female'])}}</td>
                                                            <td>{{getStd(data[100]['female'])}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col s12 m12 l12 center-align">
                                <strong>NO DATA</strong>
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
            grower_growth_record : null,
            brooder_growth_record : null,
            grower_growth : {},
            brooder_growth : {},
            grower_growth_record_len : 0,
            brooder_growth_record_len : 0,
        }
    },
    methods : {
        init : function () {
            this.getGenerationBrooderGrowth();
            this.getGenerationGrowerGrowth();
        },
        getGenerationBrooderGrowth : function () {
            axios.get('generation_summary_brooder_growth')
            .then(response => {
                this.brooder_growth_record = response.data;
                this.brooder_growth_record_len = this.brooder_growth_record.length;
                this.brooder_growth = {};
                this.brooder_growth_record.forEach(element => {
                    if((typeof this.brooder_growth[element.number] === 'undefined')){
                        this.brooder_growth[element.number] = {};
                        this.brooder_growth[element.number][0] = [];
                        this.brooder_growth[element.number][21] = [];
                    }
                    if(element.collection_day === 0){
                        this.brooder_growth[element.number][0].push(element.total_weight);
                    }else if(element.collection_day === 21){
                        this.brooder_growth[element.number][21].push(element.total_weight);
                    }
                });
                
            })
            .catch(error => {

            });
        },
        getGenerationGrowerGrowth : function () {
            axios.get('generation_summary_replacement_growth')
            .then(response => {
                this.grower_growth_record = response.data;
                this.grower_growth_record_len = this.grower_growth_record.length;
                this.grower_growth = {};
                this.grower_growth_record.forEach(element => {
                    if((typeof this.grower_growth[element.number] === 'undefined')){
                        this.grower_growth[element.number] = {};
                        this.grower_growth[element.number][45] = {};
                        this.grower_growth[element.number][75] = {};
                        this.grower_growth[element.number][100] = {};
                        this.grower_growth[element.number][45]['male'] = [];
                        this.grower_growth[element.number][45]['female'] = [];
                        this.grower_growth[element.number][75]['male'] = [];
                        this.grower_growth[element.number][75]['female'] = [];
                        this.grower_growth[element.number][100]['male'] = [];
                        this.grower_growth[element.number][100]['female'] = [];
                    }
                    if(element.collection_day === 45){
                        if(element.male_weight != null){
                            this.grower_growth[element.number][45]['male'].push(element.male_weight);
                        }
                        if(element.female_weight != null){
                            this.grower_growth[element.number][45]['female'].push(element.female_weight);
                        }
                    }else if(element.collection_day === 75){
                        if(element.male_weight != null){
                            this.grower_growth[element.number][75]['male'].push(element.male_weight);
                        }
                        if(element.female_weight != null){
                            this.grower_growth[element.number][75]['female'].push(element.female_weight);
                        }
                    }else if(element.collection_day === 100){
                        if(element.male_weight != null){
                            this.grower_growth[element.number][100]['male'].push(element.male_weight);
                        }
                        if(element.female_weight != null){
                            this.grower_growth[element.number][100]['female'].push(element.female_weight);
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
        this.init();
    }
}
</script>

<style scoped>
    .custom-title {
        font-size: 1.3em;
    }
    .custom-notice {
        background-color: #F3D9CA;
        line-height: 1;
        padding-left: 15%; 
        border-radius: 6px;
    }
    tbody {
        display:block;
        max-height:800px;
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
</style>
