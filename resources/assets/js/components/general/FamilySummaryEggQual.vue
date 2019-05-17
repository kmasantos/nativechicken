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
                                <li class="tab"><a href="#wk35">WEEK 35</a></li>
                                <li class="tab"><a href="#wk40">WEEK 40</a></li>
                                <li class="tab"><a href="#wk60">WEEK 60</a></li>
                            </ul>
                        </div>
                        <div class="card-content grey lighten-4">
                            <div id="wk35">
                                <div class="row" v-if="eggqual35.length === 0">
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
                                                <tr v-for="(egg35, index35) in eggqual35" :key="index35">
                                                    <td>{{index35}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Family</th>
                                                                <th>μ Weight</th>
                                                                <th>σ Weight</th>
                                                                <th>Color</th>
                                                                <th>Shape</th>
                                                                <th>μ Length</th>
                                                                <th>σ Length</th>
                                                                <th>μ Width</th>
                                                                <th>σ Width</th>
                                                                <th>Yolk Color</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr v-for="(fam, famindex) in egg35" :key="famindex">
                                                                <td>{{famindex}}</td>
                                                                <td>{{getMean(fam['weight'])}}</td>
                                                                <td>{{getStd(fam['weight'])}}</td>
                                                                <td>{{getProminent(fam['color']).join()}}</td>
                                                                <td>{{getProminent(fam['shape']).join()}}</td>
                                                                <td>{{getMean(fam['length'])}}</td>
                                                                <td>{{getStd(fam['length'])}}</td>
                                                                <td>{{getMean(fam['width'])}}</td>
                                                                <td>{{getStd(fam['width'])}}</td>
                                                                <td>{{getProminent(fam['yolkcol']).join()}}</td>
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
                            <div id="wk40">
                                <div class="row" v-if="eggqual40.length === 0">
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
                                                <tr v-for="(egg40, index40) in eggqual40" :key="index40">
                                                    <td>{{index40}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Family</th>
                                                                <th>μ Weight</th>
                                                                <th>σ Weight</th>
                                                                <th>Color</th>
                                                                <th>Shape</th>
                                                                <th>μ Length</th>
                                                                <th>σ Length</th>
                                                                <th>μ Width</th>
                                                                <th>σ Width</th>
                                                                <th>Yolk Color</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr v-for="(fam, famindex) in egg40" :key="famindex">
                                                                <td>{{famindex}}</td>
                                                                <td>{{getMean(fam['weight'])}}</td>
                                                                <td>{{getStd(fam['weight'])}}</td>
                                                                <td>{{getProminent(fam['color']).join()}}</td>
                                                                <td>{{getProminent(fam['shape']).join()}}</td>
                                                                <td>{{getMean(fam['length'])}}</td>
                                                                <td>{{getStd(fam['length'])}}</td>
                                                                <td>{{getMean(fam['width'])}}</td>
                                                                <td>{{getStd(fam['width'])}}</td>
                                                                <td>{{getProminent(fam['yolkcol']).join()}}</td>
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
                            <div id="wk60">
                                <div class="row" v-if="eggqual60.length === 0">
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
                                                <tr v-for="(egg60, index60) in eggqual60" :key="index60">
                                                    <td>{{index60}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Family</th>
                                                                <th>μ Weight</th>
                                                                <th>σ Weight</th>
                                                                <th>Color</th>
                                                                <th>Shape</th>
                                                                <th>μ Length</th>
                                                                <th>σ Length</th>
                                                                <th>μ Width</th>
                                                                <th>σ Width</th>
                                                                <th>Yolk Color</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr v-for="(fam, famindex) in egg60" :key="famindex">
                                                                <td>{{famindex}}</td>
                                                                <td>{{getMean(fam['weight'])}}</td>
                                                                <td>{{getStd(fam['weight'])}}</td>
                                                                <td>{{getProminent(fam['color']).join()}}</td>
                                                                <td>{{getProminent(fam['shape']).join()}}</td>
                                                                <td>{{getMean(fam['length'])}}</td>
                                                                <td>{{getStd(fam['length'])}}</td>
                                                                <td>{{getMean(fam['width'])}}</td>
                                                                <td>{{getStd(fam['width'])}}</td>
                                                                <td>{{getProminent(fam['yolkcol']).join()}}</td>
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
            eggqual_record : {},
            eggqual35_record_len : 0,
            eggqual40_record_len : 0,
            eggqual69_record_len : 0,
            eggqual35 : {},
            eggqual40 : {},
            eggqual60 : {},
        }
    },
    methods : {
        init : function () {
            this.getFamilyEggQuality();
        },
        getFamilyEggQuality : function () {
            axios.get('family_summary_eggquality/'+this.generation.id) 
            .then(response => {
                this.eggqual_record = response.data;
                this.eggqual35 = {};
                this.eggqual40 = {};
                this.eggqual60 = {};
                this.eggqual_record.forEach(element => {
                    if(element.egg_quality_at === 35){
                        if((typeof this.eggqual35[element.line_number] === 'undefined')){
                            this.eggqual35[element.line_number] = {};
                        }
                        if((typeof this.eggqual35[element.line_number][element.family_number] === 'undefined')){
                            this.eggqual35[element.line_number][element.family_number] = {};
                            this.eggqual35[element.line_number][element.family_number]['weight'] = [];
                            this.eggqual35[element.line_number][element.family_number]['color'] = {};
                            this.eggqual35[element.line_number][element.family_number]['shape'] = {};
                            this.eggqual35[element.line_number][element.family_number]['length'] = [];
                            this.eggqual35[element.line_number][element.family_number]['width'] = [];
                            this.eggqual35[element.line_number][element.family_number]['yolkcol'] = {};
                        }
                        
                        this.eggqual35[element.line_number][element.family_number]['weight'].push(element.weight);
                        if((typeof this.eggqual35[element.line_number][element.family_number]['color'][element.color] === 'undefined')){
                            this.eggqual35[element.line_number][element.family_number]['color'][element.color] = 0;
                        }
                        this.eggqual35[element.line_number][element.family_number]['color'][element.color]++;
                        if((typeof this.eggqual35[element.line_number][element.family_number]['shape'][element.shape] === 'undefined')){
                            this.eggqual35[element.line_number][element.family_number]['shape'][element.shape] = 0;
                        }
                        this.eggqual35[element.line_number][element.family_number]['shape'][element.shape]++;
                        this.eggqual35[element.line_number][element.family_number]['length'].push(element.length);
                        this.eggqual35[element.line_number][element.family_number]['width'].push(element.width);
                        if((typeof this.eggqual35[element.line_number][element.family_number]['yolkcol'][element.yolk_color] === 'undefined')){
                            this.eggqual35[element.line_number][element.family_number]['yolkcol'][element.yolk_color] = 0;
                        }
                        this.eggqual35[element.line_number][element.family_number]['yolkcol'][element.yolk_color]++;

                    }else if(element.egg_quality_at === 40){
                        if((typeof this.eggqual40[element.line_number] === 'undefined')){
                            this.eggqual40[element.line_number] = {};
                        }
                        if((typeof this.eggqual40[element.line_number][element.family_number] === 'undefined')){
                            this.eggqual40[element.line_number][element.family_number] = {};
                            this.eggqual40[element.line_number][element.family_number]['weight'] = [];
                            this.eggqual40[element.line_number][element.family_number]['color'] = {};
                            this.eggqual40[element.line_number][element.family_number]['shape'] = {};
                            this.eggqual40[element.line_number][element.family_number]['length'] = [];
                            this.eggqual40[element.line_number][element.family_number]['width'] = [];
                            this.eggqual40[element.line_number][element.family_number]['yolkcol'] = {};
                        }
                        
                        this.eggqual40[element.line_number][element.family_number]['weight'].push();
                        if((typeof this.eggqual40[element.line_number][element.family_number]['color'][element.color] === 'undefined')){
                            this.eggqual40[element.line_number][element.family_number]['color'][element.color] = 0;
                        }
                        this.eggqual40[element.line_number][element.family_number]['color'][element.color]++;
                        if((typeof this.eggqual40[element.line_number][element.family_number]['shape'][element.shape] === 'undefined')){
                            this.eggqual40[element.line_number][element.family_number]['shape'][element.shape] = 0;
                        }
                        this.eggqual40[element.line_number][element.family_number]['shape'][element.shape]++;
                        this.eggqual40[element.line_number][element.family_number]['length'].push();
                        this.eggqual40[element.line_number][element.family_number]['width'].push();
                        if((typeof this.eggqual40[element.line_number][element.family_number]['yolkcol'][element.yolk_color] === 'undefined')){
                            this.eggqual40[element.line_number][element.family_number]['yolkcol'][element.yolk_color] = 0;
                        }
                        this.eggqual40[element.line_number][element.family_number]['yolkcol']++;

                    }else if(element.egg_quality_at === 60){
                        if((typeof this.eggqual60[element.line_number] === 'undefined')){
                            this.eggqual60[element.line_number] = {};
                        }
                        if((typeof this.eggqual60[element.line_number][element.family_number] === 'undefined')){
                            this.eggqual60[element.line_number][element.family_number] = {};
                            this.eggqual60[element.line_number][element.family_number]['weight'] = [];
                            this.eggqual60[element.line_number][element.family_number]['color'] = [];
                            this.eggqual60[element.line_number][element.family_number]['shape'] = [];
                            this.eggqual60[element.line_number][element.family_number]['length'] = [];
                            this.eggqual60[element.line_number][element.family_number]['width'] = [];
                            this.eggqual60[element.line_number][element.family_number]['yolkcol'] = [];
                        }
                        
                        this.eggqual60[element.line_number][element.family_number]['weight'].push();
                        if((typeof this.eggqual60[element.line_number][element.family_number]['color'][element.color] === 'undefined')){
                            this.eggqual60[element.line_number][element.family_number]['color'][element.color] = 0;
                        }
                        this.eggqual60[element.line_number][element.family_number]['color'][element.color]++;
                        if((typeof this.eggqual60[element.line_number][element.family_number]['shape'][element.shape] === 'undefined')){
                            this.eggqual60[element.line_number][element.family_number]['shape'][element.shape] = 0;
                        }
                        this.eggqual60[element.line_number][element.family_number]['shape'][element.shape]++;
                        this.eggqual60[element.line_number][element.family_number]['length'].push();
                        this.eggqual60[element.line_number][element.family_number]['width'].push();
                        if((typeof this.eggqual60[element.line_number][element.family_number]['yolkcol'][element.yolk_color] === 'undefined')){
                            this.eggqual60[element.line_number][element.family_number]['yolkcol'][element.yolk_color] = 0;
                        }
                        this.eggqual60[element.line_number][element.family_number]['yolkcol']++;
                    }
                });
            });
        },
        getProminent : function (object) {
            var max = -Infinity;
            var maxIndices = [];
            if(Object.keys(object).length === 0 && object.constructor === Object){
                return "-";
            }else{
                Object.keys(object).forEach(function (key){
                    if(object[key] === max){
                        maxIndices.push(key);
                    } else if (object[key] > max) {
                        maxIndices = [key];
                        max = object[key];
                    }
                });
                return maxIndices;
            }
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
