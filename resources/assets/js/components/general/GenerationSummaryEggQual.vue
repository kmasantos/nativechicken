<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card">
            <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
                <li class="tab"><a href="#w35">Week 35</a></li>
                <li class="tab"><a href="#w40">Week 40</a></li>
                <li class="tab"><a href="#w60">Week 60</a></li>
            </ul>
            </div>
            <div class="card-content grey lighten-4">
                <div id="w35">
                    <div class="row" v-if="!checkEmptyObject(eggqual35)">
                        <div class="col s12 m12 l12 center-align">
                            NO DATA
                        </div>
                    </div>
                    <div class="row" v-else>
                        <div class="col s12 m12 l12">
                            <table class="bordered centered responsive-table">
                                <thead>
                                    <tr>
                                        <th data-tippy-content="Generation" class="tooltip">Gen</th>
                                        <th data-tippy-content="Egg Weight" class="tooltip">Egg WT (g)</th>
                                        <th data-tippy-content="Egg Length" class="tooltip">Egg L (mm)</th>
                                        <th data-tippy-content="Egg Width" class="tooltip">Egg W (mm)</th>
                                        <th data-tippy-content="Egg Shape" class="tooltip">Egg SHP</th>
                                        <th data-tippy-content="Egg Color" class="tooltip">Egg C</th>
                                        <th data-tippy-content="Shell Thickness (Average of Top, Middle and Bottom Thickness)" class="tooltip">Shell THK (mm)</th>
                                        <th data-tippy-content="Shell Weight" class="tooltip">Shell WT (g)</th>
                                        <th data-tippy-content="Yolk Weight" class="tooltip">Yolk WT (g)</th>
                                        <th data-tippy-content="Albumin Weight" class="tooltip">ALB WT (g)</th>
                                        <th data-tippy-content="Albumin Height" class="tooltip">ALB HT (mm)</th>
                                        <th data-tippy-content="Yolk Color" class="tooltip">Yolk C</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(data35, index35) in eggqual35" :key="index35">
                                        <td>{{index35}}</td>
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
                                                        <td>{{getMean(data35["weight"])}}</td>
                                                        <td>{{getStd(data35["weight"])}}</td>
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
                                                        <td>{{getMean(data35["length"])}}</td>
                                                        <td>{{getStd(data35["length"])}}</td>
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
                                                        <td>{{getMean(data35["width"])}}</td>
                                                        <td>{{getStd(data35["width"])}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>{{getProminent(data35["shape"]).join()}}</td>
                                        <td>{{getProminent(data35["color"]).join()}}</td>
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
                                                        <td>{{getMean(data35["shell_thickness"])}}</td>
                                                        <td>{{getStd(data35["shell_thickness"])}}</td>
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
                                                        <td>{{getMean(data35["shell_weight"])}}</td>
                                                        <td>{{getStd(data35["shell_weight"])}}</td>
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
                                                        <td>{{getMean(data35["yolk_weight"])}}</td>
                                                        <td>{{getStd(data35["yolk_weight"])}}</td>
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
                                                        <td>{{getMean(data35["albumin_weight"])}}</td>
                                                        <td>{{getStd(data35["albumin_weight"])}}</td>
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
                                                        <td>{{getMean(data35["albumin_height"])}}</td>
                                                        <td>{{getStd(data35["albumin_height"])}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>{{getProminent(data35["yolkcol"]).join()}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="w40">
                    <div class="row" v-if="!checkEmptyObject(eggqual40)">
                        <div class="col s12 m12 l12 center-align">
                            NO DATA
                        </div>
                    </div>
                    <div class="row" v-else>
                        <div class="col s12 m12 l12">
                            <table class="bordered centered responsive-table">
                                <thead>
                                    <tr>
                                        <th data-tippy-content="Generation" class="tooltip">Gen</th>
                                        <th data-tippy-content="Egg Weight" class="tooltip">Egg WT (g)</th>
                                        <th data-tippy-content="Egg Length" class="tooltip">Egg L (mm)</th>
                                        <th data-tippy-content="Egg Width" class="tooltip">Egg W (mm)</th>
                                        <th data-tippy-content="Egg Shape" class="tooltip">Egg SHP</th>
                                        <th data-tippy-content="Egg Color" class="tooltip">Egg C</th>
                                        <th data-tippy-content="Shell Thickness (Average of Top, Middle and Bottom Thickness)" class="tooltip">Shell THK (mm)</th>
                                        <th data-tippy-content="Shell Weight" class="tooltip">Shell WT (g)</th>
                                        <th data-tippy-content="Yolk Weight" class="tooltip">Yolk WT (g)</th>
                                        <th data-tippy-content="Albumin Weight" class="tooltip">ALB WT (g)</th>
                                        <th data-tippy-content="Albumin Height" class="tooltip">ALB HT (mm)</th>
                                        <th data-tippy-content="Yolk Color" class="tooltip">Yolk C</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(data, index) in eggqual40" :key="index">
                                        <td>{{index}}</td>
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
                                                        <td>{{getMean(data["weight"])}}</td>
                                                        <td>{{getStd(data["weight"])}}</td>
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
                                                        <td>{{getMean(data["length"])}}</td>
                                                        <td>{{getStd(data["length"])}}</td>
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
                                                        <td>{{getMean(data["width"])}}</td>
                                                        <td>{{getStd(data["width"])}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>{{getProminent(data["shape"]).join()}}</td>
                                        <td>{{getProminent(data["color"]).join()}}</td>
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
                                                        <td>{{getMean(data["shell_thickness"])}}</td>
                                                        <td>{{getStd(data["shell_thickness"])}}</td>
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
                                                        <td>{{getMean(data["shell_weight"])}}</td>
                                                        <td>{{getStd(data["shell_weight"])}}</td>
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
                                                        <td>{{getMean(data["yolk_weight"])}}</td>
                                                        <td>{{getStd(data["yolk_weight"])}}</td>
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
                                                        <td>{{getMean(data["albumin_weight"])}}</td>
                                                        <td>{{getStd(data["albumin_weight"])}}</td>
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
                                                        <td>{{getMean(data["albumin_height"])}}</td>
                                                        <td>{{getStd(data["albumin_height"])}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>{{getProminent(data["yolkcol"]).join()}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="w60">
                    <div class="row" v-if="!checkEmptyObject(eggqual60)">
                        <div class="col s12 m12 l12 center-align">
                            NO DATA
                        </div>
                    </div>
                    <div class="row" v-else>
                        <div class="col s12 m12 l12">
                            <table class="bordered centered responsive-table">
                                <thead>
                                    <tr>
                                        <th data-tippy-content="Generation" class="tooltip">Gen</th>
                                        <th data-tippy-content="Egg Weight" class="tooltip">Egg WT (g)</th>
                                        <th data-tippy-content="Egg Length" class="tooltip">Egg L (mm)</th>
                                        <th data-tippy-content="Egg Width" class="tooltip">Egg W (mm)</th>
                                        <th data-tippy-content="Egg Shape" class="tooltip">Egg SHP</th>
                                        <th data-tippy-content="Egg Color" class="tooltip">Egg C</th>
                                        <th data-tippy-content="Shell Thickness (Average of Top, Middle and Bottom Thickness)" class="tooltip">Shell THK (mm)</th>
                                        <th data-tippy-content="Shell Weight" class="tooltip">Shell WT (g)</th>
                                        <th data-tippy-content="Yolk Weight" class="tooltip">Yolk WT (g)</th>
                                        <th data-tippy-content="Albumin Weight" class="tooltip">ALB WT (g)</th>
                                        <th data-tippy-content="Albumin Height" class="tooltip">ALB HT (mm)</th>
                                        <th data-tippy-content="Yolk Color" class="tooltip">Yolk C</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(data, index) in eggqual60" :key="index">
                                        <td>{{index}}</td>
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
                                                        <td>{{getMean(data["weight"])}}</td>
                                                        <td>{{getStd(data["weight"])}}</td>
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
                                                        <td>{{getMean(data["length"])}}</td>
                                                        <td>{{getStd(data["length"])}}</td>
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
                                                        <td>{{getMean(data["width"])}}</td>
                                                        <td>{{getStd(data["width"])}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>{{getProminent(data["shape"]).join()}}</td>
                                        <td>{{getProminent(data["color"]).join()}}</td>
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
                                                        <td>{{getMean(data["shell_thickness"])}}</td>
                                                        <td>{{getStd(data["shell_thickness"])}}</td>
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
                                                        <td>{{getMean(data["shell_weight"])}}</td>
                                                        <td>{{getStd(data["shell_weight"])}}</td>
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
                                                        <td>{{getMean(data["yolk_weight"])}}</td>
                                                        <td>{{getStd(data["yolk_weight"])}}</td>
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
                                                        <td>{{getMean(data["albumin_weight"])}}</td>
                                                        <td>{{getStd(data["albumin_weight"])}}</td>
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
                                                        <td>{{getMean(data["albumin_height"])}}</td>
                                                        <td>{{getStd(data["albumin_height"])}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>{{getProminent(data["yolkcol"]).join()}}</td>
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
import tippy from 'tippy.js';
export default {
    props: [
        'animal_type',
    ],
    data () {
        return {
            eggqual_record : {},
            eggqual35_record_len : 0,
            eggqual40_record_len : 0,
            eggqual60_record_len : 0,
            eggqual35 : {},
            eggqual40 : {},
            eggqual60 : {},
        }
    },
    methods : {
        init : function () {
            this.getGenerationEggQuality();
        },
        getGenerationEggQuality : function () {
            axios.get('generation_summary_eggquality') 
            .then(response => {
                this.eggqual_record = response.data;
                this.eggqual35 = {};
                this.eggqual40 = {};
                this.eggqual60 = {};
                this.eggqual_record.forEach(element => {
                    if(element.egg_quality_at === 35){
                        if((typeof this.eggqual35[element.number] === 'undefined')){
                            this.eggqual35[element.number] = {};
                            this.eggqual35[element.number]['weight'] = [];
                            this.eggqual35[element.number]['color'] = {};
                            this.eggqual35[element.number]['shape'] = {};
                            this.eggqual35[element.number]['length'] = [];
                            this.eggqual35[element.number]['width'] = [];
                            this.eggqual35[element.number]['yolkcol'] = {};

                            this.eggqual35[element.number]['albumin_height'] = [];
                            this.eggqual35[element.number]['albumin_weight'] = [];
                            this.eggqual35[element.number]['yolk_weight'] = [];
                            this.eggqual35[element.number]['shell_weight'] = [];
                            this.eggqual35[element.number]['shell_thickness'] = [];
                        }
                        
                        this.eggqual35[element.number]['weight'].push(element.weight);
                        if((typeof this.eggqual35[element.number]['color'][(element.color).toUpperCase()] === 'undefined')){
                            this.eggqual35[element.number]['color'][(element.color).toUpperCase()] = 0;
                        }
                        this.eggqual35[element.number]['color'][(element.color).toUpperCase()]++;
                        if((typeof this.eggqual35[element.number]['shape'][(element.shape).toUpperCase()] === 'undefined')){
                            this.eggqual35[element.number]['shape'][(element.shape).toUpperCase()] = 0;
                        }
                        this.eggqual35[element.number]['shape'][(element.shape).toUpperCase()]++;
                        this.eggqual35[element.number]['length'].push(element.length);
                        this.eggqual35[element.number]['width'].push(element.width);
                        if((typeof this.eggqual35[element.number]['yolkcol'][element.yolk_color] === 'undefined')){
                            this.eggqual35[element.number]['yolkcol'][element.yolk_color] = 0;
                        }
                        this.eggqual35[element.number]['yolkcol'][element.yolk_color]++;

                        if(element.albumen_height !== 0 || element.albumen_height !== null){
                            this.eggqual35[element.number]['albumin_height'].push(element.albumen_height);
                        }
                        if(element.albumen_weight !== 0 || element.albumen_weight !== null){
                            this.eggqual35[element.number]['albumin_weight'].push(element.albumen_weight);
                        }
                        if(element.yolk_weight !== 0 || element.yolk_weight !== null){
                            this.eggqual35[element.number]['yolk_weight'].push(element.yolk_weight);
                        }
                        if(element.shell_weight !== 0 || element.shell_weight !== null){
                            this.eggqual35[element.number]['shell_weight'].push(element.shell_weight);
                        }
                       if((element.thickness_top !== 0 || element.thickness_top !== null) && (element.thickness_mid !== 0 || element.thickness_mid !== null) || (element.thickness_bot !== 0 || element.thickness_bot !== null)){
                            this.eggqual35[element.number]['shell_thickness'].push((element.thickness_top + element.thickness_mid + element.thickness_bot)/3);
                        }
                    }else if(element.egg_quality_at === 40){
                        if((typeof this.eggqual40[element.number] === 'undefined')){
                            this.eggqual40[element.number] = {};
                            this.eggqual40[element.number]['weight'] = [];
                            this.eggqual40[element.number]['color'] = {};
                            this.eggqual40[element.number]['shape'] = {};
                            this.eggqual40[element.number]['length'] = [];
                            this.eggqual40[element.number]['width'] = [];
                            this.eggqual40[element.number]['yolkcol'] = {};

                            this.eggqual40[element.number]['albumin_height'] = [];
                            this.eggqual40[element.number]['albumin_weight'] = [];
                            this.eggqual40[element.number]['yolk_weight'] = [];
                            this.eggqual40[element.number]['shell_weight'] = [];
                            this.eggqual40[element.number]['shell_thickness'] = [];
                        }
                        
                        this.eggqual40[element.number]['weight'].push(element.weight);
                        if((typeof this.eggqual40[element.number]['color'][(element.color).toUpperCase()] === 'undefined')){
                            this.eggqual40[element.number]['color'][(element.color).toUpperCase()] = 0;
                        }
                        this.eggqual40[element.number]['color'][(element.color).toUpperCase()]++;
                        if((typeof this.eggqual40[element.number]['shape'][(element.shape).toUpperCase()] === 'undefined')){
                            this.eggqual40[element.number]['shape'][(element.shape).toUpperCase()] = 0;
                        }
                        this.eggqual40[element.number]['shape'][(element.shape).toUpperCase()]++;
                        this.eggqual40[element.number]['length'].push(element.length);
                        this.eggqual40[element.number]['width'].push(element.width);
                        if((typeof this.eggqual40[element.number]['yolkcol'][element.yolk_color] === 'undefined')){
                            this.eggqual40[element.number]['yolkcol'][element.yolk_color] = 0;
                        }
                        this.eggqual40[element.number]['yolkcol'][element.yolk_color]++;

                        if(element.albumen_height !== 0 || element.albumen_height !== null){
                            this.eggqual40[element.number]['albumin_height'].push(element.albumen_height);
                        }
                        if(element.albumen_weight !== 0 || element.albumen_weight !== null){
                            this.eggqual40[element.number]['albumin_weight'].push(element.albumen_weight);
                        }
                        if(element.yolk_weight !== 0 || element.yolk_weight !== null){
                            this.eggqual40[element.number]['yolk_weight'].push(element.yolk_weight);
                        }
                        if(element.shell_weight !== 0 || element.shell_weight !== null){
                            this.eggqual40[element.number]['shell_weight'].push(element.shell_weight);
                        }
                        if((element.thickness_top !== 0 || element.thickness_top !== null) && (element.thickness_mid !== 0 || element.thickness_mid !== null) || (element.thickness_bot !== 0 || element.thickness_bot !== null)){
                            this.eggqual40[element.number]['shell_thickness'].push((element.thickness_top + element.thickness_mid + element.thickness_bot)/3);
                        }

                    }else if(element.egg_quality_at === 60){
                        if((typeof this.eggqual60[element.number] === 'undefined')){
                            this.eggqual60[element.number] = {};
                            this.eggqual60[element.number]['weight'] = [];
                            this.eggqual60[element.number]['color'] = {};
                            this.eggqual60[element.number]['shape'] = {};
                            this.eggqual60[element.number]['length'] = [];
                            this.eggqual60[element.number]['width'] = [];
                            this.eggqual60[element.number]['yolkcol'] = {};

                            this.eggqual60[element.number]['albumin_height'] = [];
                            this.eggqual60[element.number]['albumin_weight'] = [];
                            this.eggqual60[element.number]['yolk_weight'] = [];
                            this.eggqual60[element.number]['shell_weight'] = [];
                            this.eggqual60[element.number]['shell_thickness'] = [];
                        }
                        
                        this.eggqual60[element.number]['weight'].push(element.weight);
                        if((typeof this.eggqual60[element.number]['color'][(element.color).toUpperCase()] === 'undefined')){
                            this.eggqual60[element.number]['color'][(element.color).toUpperCase()] = 0;
                        }
                        this.eggqual60[element.number]['color'][(element.color).toUpperCase()]++;
                        if((typeof this.eggqual60[element.number]['shape'][(element.shape).toUpperCase()] === 'undefined')){
                            this.eggqual60[element.number]['shape'][(element.shape).toUpperCase()] = 0;
                        }
                        this.eggqual60[element.number]['shape'][(element.shape).toUpperCase()]++;
                        this.eggqual60[element.number]['length'].push(element.length);
                        this.eggqual60[element.number]['width'].push(element.width);
                        if((typeof this.eggqual60[element.number]['yolkcol'][element.yolk_color] === 'undefined')){
                            this.eggqual60[element.number]['yolkcol'][element.yolk_color] = 0;
                        }
                        this.eggqual60[element.number]['yolkcol'][element.yolk_color]++;

                        if(element.albumen_height !== 0 || element.albumen_height !== null){
                            this.eggqual60[element.number]['albumin_height'].push(element.albumen_height);
                        }
                        if(element.albumen_weight !== 0 || element.albumen_weight !== null){
                            this.eggqual60[element.number]['albumin_weight'].push(element.albumen_weight);
                        }
                        if(element.yolk_weight !== 0 || element.yolk_weight !== null){
                            this.eggqual60[element.number]['yolk_weight'].push(element.yolk_weight);
                        }
                        if(element.shell_weight !== 0 || element.shell_weight !== null){
                            this.eggqual60[element.number]['shell_weight'].push(element.shell_weight);
                        }
                        if((element.thickness_top !== 0 || element.thickness_top !== null) && (element.thickness_mid !== 0 || element.thickness_mid !== null) || (element.thickness_bot !== 0 || element.thickness_bot !== null)){
                            this.eggqual60[element.number]['shell_thickness'].push((element.thickness_top + element.thickness_mid + element.thickness_bot)/3);
                        }
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
                if(math.mean(array).toFixed(2) == 0){
                    return "-";
                }else{
                    return math.mean(array).toFixed(2);
                }
                
            }
        },
        getStd : function (array) {
            if(array === undefined || array.length == 0){
                return "-";
            }else{
                if(math.mean(array).toFixed(2) == 0){
                    return "-";
                }else{
                    return math.std(array).toFixed(2);
                }
            }
        },

        checkEmptyObject : function (Obj) {
            if (Obj === null || typeof Obj !== 'object' ||
                Object.prototype.toString.call(Obj) === '[object Array]') {
                return false
            } else {
                for (var prop in Obj) {
                    if (Obj.hasOwnProperty(prop)) {
                        return true
                    }
                }
                return JSON.stringify(Obj) !== JSON.stringify({})
            }
        }

    },
    mounted () {
        $('ul.tabs').tabs();
        tippy("#w35", {
            target : '.tooltip',
            arrow: true,
            arrowType: 'round',
            animation: 'scale',
            inertia: true,
        });
        tippy("#w40", {
            target : '.tooltip',
            arrow: true,
            arrowType: 'round',
            animation: 'scale',
            inertia: true,
        });
        tippy("#w60", {
            target : '.tooltip',
            arrow: true,
            arrowType: 'round',
            animation: 'scale',
            inertia: true,
        });
        this.init();
    }
}
</script>

<style scoped>

</style>
