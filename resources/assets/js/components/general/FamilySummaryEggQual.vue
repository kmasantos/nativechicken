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
                                                    <th>Line</th>
                                                    <th>Family Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(egg35, index35) in eggqual35" :key="index35">
                                                    <td>{{index35}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                        <thead>
                                                            <tr>
                                                                <th data-tippy-content="Family" class="tooltip">F</th>
                                                                <th data-tippy-content="Egg Weight" class="tooltip">Egg WT</th>
                                                                <th data-tippy-content="Egg Length" class="tooltip">Egg L</th>
                                                                <th data-tippy-content="Egg Width" class="tooltip">Egg W</th>
                                                                <th data-tippy-content="Egg Shape" class="tooltip">Egg SHP</th>
                                                                <th data-tippy-content="Egg Color" class="tooltip">Egg C</th>
                                                                <th data-tippy-content="Shell Thickness (Average of Top, Middle and Bottom Thickness)" class="tooltip">Shell THK</th>
                                                                <th data-tippy-content="Shell Weight" class="tooltip">Shell WT</th>
                                                                <th data-tippy-content="Yolk Weight" class="tooltip">Yolk WT</th>
                                                                <th data-tippy-content="Albumin Weight" class="tooltip">ALB WT</th>
                                                                <th data-tippy-content="Albumin Height" class="tooltip">ALB HT</th>
                                                                <th data-tippy-content="Yolk Color" class="tooltip">Yolk C</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr v-for="(fam, famindex) in egg35" :key="famindex">
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
                                                                                <td>{{getMean(fam['weight'])}}</td>
                                                                                <td>{{getStd(fam['weight'])}}</td>
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
                                                                                <td>{{getMean(fam['length'])}}</td>
                                                                                <td>{{getStd(fam['length'])}}</td>
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
                                                                                <td>{{getMean(fam['width'])}}</td>
                                                                                <td>{{getStd(fam['width'])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td>{{getProminent(fam['shape']).join()}}</td>
                                                                <td>{{getProminent(fam['color']).join()}}</td>
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
                                                                                <td>{{getMean(fam['shell_thickness'])}}</td>
                                                                                <td>{{getStd(fam['shell_thickness'])}}</td>
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
                                                                                <td>{{getMean(fam['shell_weight'])}}</td>
                                                                                <td>{{getStd(fam['shell_weight'])}}</td>
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
                                                                                <td>{{getMean(fam['yolk_weight'])}}</td>
                                                                                <td>{{getStd(fam['yolk_weight'])}}</td>
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
                                                                                <td>{{getMean(fam['albumin_weight'])}}</td>
                                                                                <td>{{getStd(fam['albumin_weight'])}}</td>
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
                                                                                <td>{{getMean(fam['albumin_height'])}}</td>
                                                                                <td>{{getStd(fam['albumin_height'])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
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
                                                    <th>Line</th>
                                                    <th>Family Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(egg40, index40) in eggqual40" :key="index40">
                                                    <td>{{index40}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                        <thead>
                                                            <tr>
                                                                <th data-tippy-content="Family" class="tooltip">F</th>
                                                                <th data-tippy-content="Egg Weight" class="tooltip">Egg WT</th>
                                                                <th data-tippy-content="Egg Length" class="tooltip">Egg L</th>
                                                                <th data-tippy-content="Egg Width" class="tooltip">Egg W</th>
                                                                <th data-tippy-content="Egg Shape" class="tooltip">Egg SHP</th>
                                                                <th data-tippy-content="Egg Color" class="tooltip">Egg C</th>
                                                                <th data-tippy-content="Shell Thickness (Average of Top, Middle and Bottom Thickness)" class="tooltip">Shell THK</th>
                                                                <th data-tippy-content="Shell Weight" class="tooltip">Shell WT</th>
                                                                <th data-tippy-content="Yolk Weight" class="tooltip">Yolk WT</th>
                                                                <th data-tippy-content="Albumin Weight" class="tooltip">ALB WT</th>
                                                                <th data-tippy-content="Albumin Height" class="tooltip">ALB HT</th>
                                                                <th data-tippy-content="Yolk Color" class="tooltip">Yolk C</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr v-for="(fam, famindex) in egg40" :key="famindex">
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
                                                                                <td>{{getMean(fam['weight'])}}</td>
                                                                                <td>{{getStd(fam['weight'])}}</td>
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
                                                                                <td>{{getMean(fam['length'])}}</td>
                                                                                <td>{{getStd(fam['length'])}}</td>
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
                                                                                <td>{{getMean(fam['width'])}}</td>
                                                                                <td>{{getStd(fam['width'])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td>{{getProminent(fam['shape']).join()}}</td>
                                                                <td>{{getProminent(fam['color']).join()}}</td>
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
                                                                                <td>{{getMean(fam['shell_thickness'])}}</td>
                                                                                <td>{{getStd(fam['shell_thickness'])}}</td>
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
                                                                                <td>{{getMean(fam['shell_weight'])}}</td>
                                                                                <td>{{getStd(fam['shell_weight'])}}</td>
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
                                                                                <td>{{getMean(fam['yolk_weight'])}}</td>
                                                                                <td>{{getStd(fam['yolk_weight'])}}</td>
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
                                                                                <td>{{getMean(fam['albumin_weight'])}}</td>
                                                                                <td>{{getStd(fam['albumin_weight'])}}</td>
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
                                                                                <td>{{getMean(fam['albumin_height'])}}</td>
                                                                                <td>{{getStd(fam['albumin_height'])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
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
                                                    <th>Line</th>
                                                    <th>Family Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(egg60, index60) in eggqual60" :key="index60">
                                                    <td>{{index60}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                        <thead>
                                                            <tr>
                                                                <th data-tippy-content="Family" class="tooltip">F</th>
                                                                <th data-tippy-content="Egg Weight" class="tooltip">Egg WT</th>
                                                                <th data-tippy-content="Egg Length" class="tooltip">Egg L</th>
                                                                <th data-tippy-content="Egg Width" class="tooltip">Egg W</th>
                                                                <th data-tippy-content="Egg Shape" class="tooltip">Egg SHP</th>
                                                                <th data-tippy-content="Egg Color" class="tooltip">Egg C</th>
                                                                <th data-tippy-content="Shell Thickness (Average of Top, Middle and Bottom Thickness)" class="tooltip">Shell THK</th>
                                                                <th data-tippy-content="Shell Weight" class="tooltip">Shell WT</th>
                                                                <th data-tippy-content="Yolk Weight" class="tooltip">Yolk WT</th>
                                                                <th data-tippy-content="Albumin Weight" class="tooltip">ALB WT</th>
                                                                <th data-tippy-content="Albumin Height" class="tooltip">ALB HT</th>
                                                                <th data-tippy-content="Yolk Color" class="tooltip">Yolk C</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr v-for="(fam, famindex) in egg60" :key="famindex">
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
                                                                                <td>{{getMean(fam['weight'])}}</td>
                                                                                <td>{{getStd(fam['weight'])}}</td>
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
                                                                                <td>{{getMean(fam['length'])}}</td>
                                                                                <td>{{getStd(fam['length'])}}</td>
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
                                                                                <td>{{getMean(fam['width'])}}</td>
                                                                                <td>{{getStd(fam['width'])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td>{{getProminent(fam['shape']).join()}}</td>
                                                                <td>{{getProminent(fam['color']).join()}}</td>
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
                                                                                <td>{{getMean(fam['shell_thickness'])}}</td>
                                                                                <td>{{getStd(fam['shell_thickness'])}}</td>
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
                                                                                <td>{{getMean(fam['shell_weight'])}}</td>
                                                                                <td>{{getStd(fam['shell_weight'])}}</td>
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
                                                                                <td>{{getMean(fam['yolk_weight'])}}</td>
                                                                                <td>{{getStd(fam['yolk_weight'])}}</td>
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
                                                                                <td>{{getMean(fam['albumin_weight'])}}</td>
                                                                                <td>{{getStd(fam['albumin_weight'])}}</td>
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
                                                                                <td>{{getMean(fam['albumin_height'])}}</td>
                                                                                <td>{{getStd(fam['albumin_height'])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
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
import tippy from 'tippy.js';
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

                            this.eggqual35[element.line_number][element.family_number]['albumin_height'] = [];
                            this.eggqual35[element.line_number][element.family_number]['albumin_weight'] = [];
                            this.eggqual35[element.line_number][element.family_number]['yolk_weight'] = [];
                            this.eggqual35[element.line_number][element.family_number]['shell_weight'] = [];
                            this.eggqual35[element.line_number][element.family_number]['shell_thickness'] = [];
                        }
                        
                        this.eggqual35[element.line_number][element.family_number]['weight'].push(element.weight);
                        if((typeof this.eggqual35[element.line_number][element.family_number]['color'][(element.color).toUpperCase()] === 'undefined')){
                            this.eggqual35[element.line_number][element.family_number]['color'][(element.color).toUpperCase()] = 0;
                        }
                        this.eggqual35[element.line_number][element.family_number]['color'][(element.color).toUpperCase()]++;
                        if((typeof this.eggqual35[element.line_number][element.family_number]['shape'][(element.shape).toUpperCase()] === 'undefined')){
                            this.eggqual35[element.line_number][element.family_number]['shape'][(element.shape).toUpperCase()] = 0;
                        }
                        this.eggqual35[element.line_number][element.family_number]['shape'][(element.shape).toUpperCase()]++;
                        this.eggqual35[element.line_number][element.family_number]['length'].push(element.length);
                        this.eggqual35[element.line_number][element.family_number]['width'].push(element.width);
                        if((typeof this.eggqual35[element.line_number][element.family_number]['yolkcol'][element.yolk_color] === 'undefined')){
                            this.eggqual35[element.line_number][element.family_number]['yolkcol'][element.yolk_color] = 0;
                        }
                        this.eggqual35[element.line_number][element.family_number]['yolkcol'][element.yolk_color]++;

                        if(element.albumen_height !== 0 || element.albumen_height !== null){
                            this.eggqual35[element.line_number][element.family_number]['albumin_height'].push(element.albumen_height);
                        }
                        if(element.albumen_weight !== 0 || element.albumen_weight !== null){
                            this.eggqual35[element.line_number][element.family_number]['albumin_weight'].push(element.albumen_weight);
                        }
                        if(element.yolk_weight !== 0 || element.yolk_weight !== null){
                            this.eggqual35[element.line_number][element.family_number]['yolk_weight'].push(element.yolk_weight);
                        }
                        if(element.shell_weight !== 0 || element.shell_weight !== null){
                            this.eggqual35[element.line_number][element.family_number]['shell_weight'].push(element.shell_weight);
                        }
                        if((element.thickness_top !== 0 || element.thickness_top !== null) && (element.thickness_mid !== 0 || element.thickness_mid !== null) || (element.thickness_bot !== 0 || element.thickness_bot !== null)){
                            this.eggqual35[element.line_number][element.family_number]['shell_thickness'].push((element.thickness_top + element.thickness_mid + element.thickness_bot)/3);
                        }

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

                            this.eggqual40[element.line_number][element.family_number]['albumin_height'] = [];
                            this.eggqual40[element.line_number][element.family_number]['albumin_weight'] = [];
                            this.eggqual40[element.line_number][element.family_number]['yolk_weight'] = [];
                            this.eggqual40[element.line_number][element.family_number]['shell_weight'] = [];
                            this.eggqual40[element.line_number][element.family_number]['shell_thickness'] = [];
                        }
                        
                        this.eggqual40[element.line_number][element.family_number]['weight'].push();
                        if((typeof this.eggqual40[element.line_number][element.family_number]['color'][(element.color).toUpperCase()] === 'undefined')){
                            this.eggqual40[element.line_number][element.family_number]['color'][(element.color).toUpperCase()] = 0;
                        }
                        this.eggqual40[element.line_number][element.family_number]['color'][(element.color).toUpperCase()]++;
                        if((typeof this.eggqual40[element.line_number][element.family_number]['shape'][(element.shape).toUpperCase()] === 'undefined')){
                            this.eggqual40[element.line_number][element.family_number]['shape'][(element.shape).toUpperCase()] = 0;
                        }
                        this.eggqual40[element.line_number][element.family_number]['shape'][(element.shape).toUpperCase()]++;
                        this.eggqual40[element.line_number][element.family_number]['length'].push();
                        this.eggqual40[element.line_number][element.family_number]['width'].push();
                        if((typeof this.eggqual40[element.line_number][element.family_number]['yolkcol'][element.yolk_color] === 'undefined')){
                            this.eggqual40[element.line_number][element.family_number]['yolkcol'][element.yolk_color] = 0;
                        }
                        this.eggqual40[element.line_number][element.family_number]['yolkcol']++;

                        if(element.albumen_height !== 0 || element.albumen_height !== null){
                            this.eggqual40[element.line_number][element.family_number]['albumin_height'].push(element.albumen_height);
                        }
                        if(element.albumen_weight !== 0 || element.albumen_weight !== null){
                            this.eggqual40[element.line_number][element.family_number]['albumin_weight'].push(element.albumen_weight);
                        }
                        if(element.yolk_weight !== 0 || element.yolk_weight !== null){
                            this.eggqual40[element.line_number][element.family_number]['yolk_weight'].push(element.yolk_weight);
                        }
                        if(element.shell_weight !== 0 || element.shell_weight !== null){
                            this.eggqual40[element.line_number][element.family_number]['shell_weight'].push(element.shell_weight);
                        }
                        if((element.thickness_top !== 0 || element.thickness_top !== null) && (element.thickness_mid !== 0 || element.thickness_mid !== null) || (element.thickness_bot !== 0 || element.thickness_bot !== null)){
                            this.eggqual40[element.line_number][element.family_number]['shell_thickness'].push((element.thickness_top + element.thickness_mid + element.thickness_bot)/3);
                        }       

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

                            this.eggqual60[element.line_number][element.family_number]['albumin_height'] = [];
                            this.eggqual60[element.line_number][element.family_number]['albumin_weight'] = [];
                            this.eggqual60[element.line_number][element.family_number]['yolk_weight'] = [];
                            this.eggqual60[element.line_number][element.family_number]['shell_weight'] = [];
                            this.eggqual60[element.line_number][element.family_number]['shell_thickness'] = [];
                        }
                        
                        this.eggqual60[element.line_number][element.family_number]['weight'].push();
                        if((typeof this.eggqual60[element.line_number][element.family_number]['color'][(element.color).toUpperCase()] === 'undefined')){
                            this.eggqual60[element.line_number][element.family_number]['color'][(element.color).toUpperCase()] = 0;
                        }
                        this.eggqual60[element.line_number][element.family_number]['color'][(element.color).toUpperCase()]++;
                        if((typeof this.eggqual60[element.line_number][element.family_number]['shape'][(element.shape).toUpperCase()] === 'undefined')){
                            this.eggqual60[element.line_number][element.family_number]['shape'][(element.shape).toUpperCase()] = 0;
                        }
                        this.eggqual60[element.line_number][element.family_number]['shape'][(element.shape).toUpperCase()]++;
                        this.eggqual60[element.line_number][element.family_number]['length'].push();
                        this.eggqual60[element.line_number][element.family_number]['width'].push();
                        if((typeof this.eggqual60[element.line_number][element.family_number]['yolkcol'][element.yolk_color] === 'undefined')){
                            this.eggqual60[element.line_number][element.family_number]['yolkcol'][element.yolk_color] = 0;
                        }
                        this.eggqual60[element.line_number][element.family_number]['yolkcol']++;

                        if(element.albumen_height !== 0 || element.albumen_height !== null){
                            this.eggqual60[element.line_number][element.family_number]['albumin_height'].push(element.albumen_height);
                        }
                        if(element.albumen_weight !== 0 || element.albumen_weight !== null){
                            this.eggqual60[element.line_number][element.family_number]['albumin_weight'].push(element.albumen_weight);
                        }
                        if(element.yolk_weight !== 0 || element.yolk_weight !== null){
                            this.eggqual60[element.line_number][element.family_number]['yolk_weight'].push(element.yolk_weight);
                        }
                        if(element.shell_weight !== 0 || element.shell_weight !== null){
                            this.eggqual60[element.line_number][element.family_number]['shell_weight'].push(element.shell_weight);
                        }
                        if((element.thickness_top !== 0 || element.thickness_top !== null) && (element.thickness_mid !== 0 || element.thickness_mid !== null) || (element.thickness_bot !== 0 || element.thickness_bot !== null)){
                            this.eggqual60[element.line_number][element.family_number]['shell_thickness'].push((element.thickness_top + element.thickness_mid + element.thickness_bot)/3);
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
        tippy("#wk35", {
            target : '.tooltip',
            arrow: true,
            arrowType: 'round',
            animation: 'scale',
            inertia: true,
        });
        tippy("#wk40", {
            target : '.tooltip',
            arrow: true,
            arrowType: 'round',
            animation: 'scale',
            inertia: true,
        });
        tippy("#wk60", {
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
