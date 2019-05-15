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
                        <div class="card-content" id="center_content">
                            <ul id="morpho_nav">
                                <li><a @click="attribute='HEIGHT'" href="#" onclick="return false;">HEIGHT</a></li>
                                <li><a @click="attribute='WEIGHT'" href="#" onclick="return false;">WEIGHT</a></li>
                                <li><a @click="attribute='BODY LENGTH'" href="#" onclick="return false;">BODY LENGTH</a></li>
                                <li><a @click="attribute='CHEST CIRCUMFERENCE'" href="#" onclick="return false;">CHEST CIRCUMFERENCE</a></li>
                                <li><a @click="attribute='WING SPAN'" href="#" onclick="return false;">WING SPAN</a></li>
                                <li><a @click="attribute='SHANK LENGTH'" href="#" onclick="return false;">SHANK LENGTH</a></li>
                            </ul>
                        </div>
                        <div class="card-tabs">
                            <ul class="tabs tabs-fixed-width">
                                <li class="tab"><a href="#rep">REPLACEMENTS</a></li>
                                <li class="tab"><a href="#bre">BREEDERS</a></li>
                            </ul>
                        </div>
                        <div class="card-content grey lighten-4">
                            <div id="rep">
                                <div class="row" v-if="attribute===null">
                                    <div  class="col s12 m12 l12 center-align">
                                       <strong>Choose Morphometric Characteristics from the above navigation bar</strong> 
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col s12 m12 l12">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <strong>{{attribute}}</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Line</th>
                                                            <th>Data</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr v-for="(data, index) in replacement_summary[attribute]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>
                                                                <table class="bordered centered responsive-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Family</th>
                                                                            <th>μ (<i class="fas fa-mars"></i>)</th>
                                                                            <th>σ (<i class="fas fa-mars"></i>)</th>
                                                                            <th>μ (<i class="fas fa-venus"></i>)</th>
                                                                            <th>σ (<i class="fas fa-venus"></i>)</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        <tr v-for="(famdata, subindex) in replacement_summary[attribute][index]" :key="subindex">
                                                                            <td>{{subindex}}</td>
                                                                            <td>{{getMean(famdata['male'])}}</td>
                                                                            <td>{{getStd(famdata['male'])}}</td>
                                                                            <td>{{getMean(famdata['female'])}}</td>
                                                                            <td>{{getStd(famdata['female'])}}</td>
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
                            <div id="bre">
                                <div class="row" v-if="attribute===null">
                                    <div  class="col s12 m12 l12 center-align">
                                       <strong>Choose Morphometric Characteristics from the above navigation bar</strong> 
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col s12 m12 l12">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <strong>{{attribute}}</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Line</th>
                                                            <th>Data</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr v-for="(data, index) in breeder_summary[attribute]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>
                                                                <table class="bordered centered responsive-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Family</th>
                                                                            <th>μ (<i class="fas fa-mars"></i>)</th>
                                                                            <th>σ (<i class="fas fa-mars"></i>)</th>
                                                                            <th>μ (<i class="fas fa-venus"></i>)</th>
                                                                            <th>σ (<i class="fas fa-venus"></i>)</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        <tr v-for="(famdata, subindex) in breeder_summary[attribute][index]" :key="subindex">
                                                                            <td>{{subindex}}</td>
                                                                            <td>{{getMean(famdata['male'])}}</td>
                                                                            <td>{{getStd(famdata['male'])}}</td>
                                                                            <td>{{getMean(famdata['female'])}}</td>
                                                                            <td>{{getStd(famdata['female'])}}</td>
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
            attribute : null,
            breeder_morpho : null,
            replacement_morpho : null,
            breeder_summary : {},
            replacement_summary : {},
        }
    },
    methods : {
        init : function () {
            this.getBreederMorphoSummary();
            this.getReplacementMorphoSummary();
        },
        getBreederMorphoSummary : function () {
            axios.get('family_summary_breeder_morpho/'+this.generation.id)
            .then(response => {
                this.breeder_morpho = response.data;
                this.breeder_summary = {};
                if(this.animal_type === 1){
                    this.breeder_summary["HEIGHT"] = {};
                    this.breeder_summary["WEIGHT"] = {};
                    this.breeder_summary["BODY LENGTH"] = {};
                    this.breeder_summary["CHEST CIRCUMFERENCE"] = {};
                    this.breeder_summary["WING SPAN"] = {};
                    this.breeder_summary["SHANK LENGTH"] = {};
                    this.breeder_morpho.forEach(element => {
                        var values = JSON.parse(element.morphometric);
                        if((typeof this.breeder_summary["HEIGHT"][element.line_number] === 'undefined')){
                            this.breeder_summary["HEIGHT"][element.line_number] = {};
                        }
                        if((typeof this.breeder_summary["HEIGHT"][element.line_number][element.family_number] === 'undefined')){
                            this.breeder_summary["HEIGHT"][element.line_number][element.family_number] = {};
                        }
                        if(element.gender === "male"){
                            if((typeof this.breeder_summary["HEIGHT"][element.line_number][element.family_number]['male'] === 'undefined')){
                                this.breeder_summary["HEIGHT"][element.line_number][element.family_number]['male'] = [];
                            }
                            this.breeder_summary["HEIGHT"][element.line_number][element.family_number]['male'].push(values[0]);
                        }else if(element.gender === "female"){
                            if((typeof this.breeder_summary["HEIGHT"][element.line_number][element.family_number]['female'] === 'undefined')){
                                this.breeder_summary["HEIGHT"][element.line_number][element.family_number]['female'] = [];
                            }
                            this.breeder_summary["HEIGHT"][element.line_number][element.family_number]['female'].push(values[0]);
                        }

                        if((typeof this.breeder_summary["WEIGHT"][element.line_number] === 'undefined')){
                            this.breeder_summary["WEIGHT"][element.line_number] = {};
                        }
                        if((typeof this.breeder_summary["WEIGHT"][element.line_number][element.family_number] === 'undefined')){
                            this.breeder_summary["WEIGHT"][element.line_number][element.family_number] = {};
                        }
                        if(element.gender === "male"){
                            if((typeof this.breeder_summary["WEIGHT"][element.line_number][element.family_number]['male'] === 'undefined')){
                                this.breeder_summary["WEIGHT"][element.line_number][element.family_number]['male'] = [];
                            }
                            this.breeder_summary["WEIGHT"][element.line_number][element.family_number]['male'].push(values[1]);
                        }else if(element.gender === "female"){
                            if((typeof this.breeder_summary["WEIGHT"][element.line_number][element.family_number]['female'] === 'undefined')){
                                this.breeder_summary["WEIGHT"][element.line_number][element.family_number]['female'] = [];
                            }
                            this.breeder_summary["WEIGHT"][element.line_number][element.family_number]['female'].push(values[1]);
                        }

                        if((typeof this.breeder_summary["BODY LENGTH"][element.line_number] === 'undefined')){
                            this.breeder_summary["BODY LENGTH"][element.line_number] = {};
                        }
                        if((typeof this.breeder_summary["BODY LENGTH"][element.line_number][element.family_number] === 'undefined')){
                            this.breeder_summary["BODY LENGTH"][element.line_number][element.family_number] = {};
                        }
                        if(element.gender === "male"){
                            if((typeof this.breeder_summary["BODY LENGTH"][element.line_number][element.family_number]['male'] === 'undefined')){
                                this.breeder_summary["BODY LENGTH"][element.line_number][element.family_number]['male'] = [];
                            }
                            this.breeder_summary["BODY LENGTH"][element.line_number][element.family_number]['male'].push(values[2]);
                        }else if(element.gender === "female"){
                            if((typeof this.breeder_summary["BODY LENGTH"][element.line_number][element.family_number]['female'] === 'undefined')){
                                this.breeder_summary["BODY LENGTH"][element.line_number][element.family_number]['female'] = [];
                            }
                            this.breeder_summary["BODY LENGTH"][element.line_number][element.family_number]['female'].push(values[2]);
                        }

                        if((typeof this.breeder_summary["CHEST CIRCUMFERENCE"][element.line_number] === 'undefined')){
                            this.breeder_summary["CHEST CIRCUMFERENCE"][element.line_number] = {};
                        }
                        if((typeof this.breeder_summary["CHEST CIRCUMFERENCE"][element.line_number][element.family_number] === 'undefined')){
                            this.breeder_summary["CHEST CIRCUMFERENCE"][element.line_number][element.family_number] = {};
                        }
                        if(element.gender === "male"){
                            if((typeof this.breeder_summary["CHEST CIRCUMFERENCE"][element.line_number][element.family_number]['male'] === 'undefined')){
                                this.breeder_summary["CHEST CIRCUMFERENCE"][element.line_number][element.family_number]['male'] = [];
                            }
                            this.breeder_summary["CHEST CIRCUMFERENCE"][element.line_number][element.family_number]['male'].push(values[3]);
                        }else if(element.gender === "female"){
                            if((typeof this.breeder_summary["CHEST CIRCUMFERENCE"][element.line_number][element.family_number]['female'] === 'undefined')){
                                this.breeder_summary["CHEST CIRCUMFERENCE"][element.line_number][element.family_number]['female'] = [];
                            }
                            this.breeder_summary["CHEST CIRCUMFERENCE"][element.line_number][element.family_number]['female'].push(values[3]);
                        }

                        if((typeof this.breeder_summary["WING SPAN"][element.line_number] === 'undefined')){
                            this.breeder_summary["WING SPAN"][element.line_number] = {};
                        }
                        if((typeof this.breeder_summary["WING SPAN"][element.line_number][element.family_number] === 'undefined')){
                            this.breeder_summary["WING SPAN"][element.line_number][element.family_number] = {};
                        }
                        if(element.gender === "male"){
                            if((typeof this.breeder_summary["WING SPAN"][element.line_number][element.family_number]['male'] === 'undefined')){
                                this.breeder_summary["WING SPAN"][element.line_number][element.family_number]['male'] = [];
                            }
                            this.breeder_summary["WING SPAN"][element.line_number][element.family_number]['male'].push(values[4]);
                        }else if(element.gender === "female"){
                            if((typeof this.breeder_summary["WING SPAN"][element.line_number][element.family_number]['female'] === 'undefined')){
                                this.breeder_summary["WING SPAN"][element.line_number][element.family_number]['female'] = [];
                            }
                            this.breeder_summary["WING SPAN"][element.line_number][element.family_number]['female'].push(values[4]);
                        }

                        if((typeof this.breeder_summary["SHANK LENGTH"][element.line_number] === 'undefined')){
                            this.breeder_summary["SHANK LENGTH"][element.line_number] = {};
                        }
                        if((typeof this.breeder_summary["SHANK LENGTH"][element.line_number][element.family_number] === 'undefined')){
                            this.breeder_summary["SHANK LENGTH"][element.line_number][element.family_number] = {};
                        }
                        if(element.gender === "male"){
                            if((typeof this.breeder_summary["SHANK LENGTH"][element.line_number][element.family_number]['male'] === 'undefined')){
                                this.breeder_summary["SHANK LENGTH"][element.line_number][element.family_number]['male'] = [];
                            }
                            this.breeder_summary["SHANK LENGTH"][element.line_number][element.family_number]['male'].push(values[5]);
                        }else if(element.gender === "female"){
                            if((typeof this.breeder_summary["SHANK LENGTH"][element.line_number][element.family_number]['female'] === 'undefined')){
                                this.breeder_summary["SHANK LENGTH"][element.line_number][element.family_number]['female'] = [];
                            }
                            this.breeder_summary["SHANK LENGTH"][element.line_number][element.family_number]['female'].push(values[5]);
                        }

                    });
                }else{

                }
            })
            .catch(error => {});
        },
        getReplacementMorphoSummary : function () {
            axios.get('family_summary_replacement_morpho/'+this.generation.id)
            .then(response => {
                this.replacement_morpho = response.data;
                this.replacement_summary = {};
                if(this.animal_type === 1){
                    this.replacement_summary["HEIGHT"] = {};
                    this.replacement_summary["WEIGHT"] = {};
                    this.replacement_summary["BODY LENGTH"] = {};
                    this.replacement_summary["CHEST CIRCUMFERENCE"] = {};
                    this.replacement_summary["WING SPAN"] = {};
                    this.replacement_summary["SHANK LENGTH"] = {};
                    this.replacement_morpho.forEach(element => {
                        var values = JSON.parse(element.morphometric);
                        console.log(values);
                        if((typeof this.replacement_summary["HEIGHT"][element.line_number] === 'undefined')){
                            this.replacement_summary["HEIGHT"][element.line_number] = {};
                        }
                        if((typeof this.replacement_summary["HEIGHT"][element.line_number][element.family_number] === 'undefined')){
                            this.replacement_summary["HEIGHT"][element.line_number][element.family_number] = {};
                        }
                        if(element.gender === "male"){
                            if((typeof this.replacement_summary["HEIGHT"][element.line_number][element.family_number]['male'] === 'undefined')){
                                this.replacement_summary["HEIGHT"][element.line_number][element.family_number]['male'] = [];
                            }
                            this.replacement_summary["HEIGHT"][element.line_number][element.family_number]['male'].push(values[0]);
                        }else if(element.gender === "female"){
                            if((typeof this.replacement_summary["HEIGHT"][element.line_number][element.family_number]['female'] === 'undefined')){
                                this.replacement_summary["HEIGHT"][element.line_number][element.family_number]['female'] = [];
                            }
                            this.replacement_summary["HEIGHT"][element.line_number][element.family_number]['female'].push(values[0]);
                        }
                    });
                }else{

                }
            })
            .catch(error => {});
        },
        getMean : function (array) {
            return math.mean(array).toFixed(2);
        },
        getStd : function (array){
            return math.std(array).toFixed(2);
        },
    },
    mounted () {
        $('ul.tabs').tabs();
        this.init();
    }
}
</script>

<style scoped>
    #center_content {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    #morpho_nav{
        list-style-type: none;
        text-align: center;
        display: block;
        margin: 0 auto;
        padding: 0;
        overflow: hidden;
    }
    #morpho_nav li {
        list-style-type: none;
        text-align: center;
        margin: 0px;
        display: inline-block;
    }
    #morpho_nav li a {
        display: block;
        color: #000000;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    #morpho_nav li a:hover {
        background-color: #cfd8dc;
    }
</style>
