<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Summary for Year : {{year}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h6>Feeding Records</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="bordered centered responsive-table">
                                <thead>
                                <tr>
                                    <th>Generation</th>
                                    <th>Total Offered</th>
                                    <th>Average Offered</th>
                                    <th>Std Dev</th>
                                    <th>Min</th>
                                    <th>Max</th>
                                    <th>Total Refused</th>
                                    <th>Average Refused</th>
                                    <th>Std Dev</th>
                                    <th>Min</th>
                                    <th>Max</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(feeding_record, index) in feeding_records" :key="index">
                                        <td>{{index}}</td>
                                        <td>{{getSumOffered(feeding_record)}}</td>
                                        <td>{{getMeanOffered(feeding_record)}}</td>
                                        <td>{{getStdOffered(feeding_record)}}</td>
                                        <td>{{getMinOffered(feeding_record)}}</td>
                                        <td>{{getMaxOffered(feeding_record)}}</td>
                                        <td>{{getSumRefused(feeding_record)}}</td>
                                        <td>{{getMeanRefused(feeding_record)}}</td>
                                        <td>{{getStdRefused(feeding_record)}}</td>
                                        <td>{{getMinRefused(feeding_record)}}</td>
                                        <td>{{getMaxRefused(feeding_record)}}</td>
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
                        <div class="col s12 m12 l12">
                            <h6>Growth Records</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="bordered centered responsive-table">
                                <thead>
                                    <tr>
                                        <th>Generation</th>
                                        <th>Day</th>
                                        <th>Avg(<i class="fas fa-mars"></i>) Weight</th>
                                        <th>Min(<i class="fas fa-mars"></i>) Weight</th>
                                        <th>Max(<i class="fas fa-mars"></i>) Weight</th>
                                        <th>SD(<i class="fas fa-mars"></i>) Weight</th>
                                        <th>Avg(<i class="fas fa-venus"></i>) Weight</th>
                                        <th>Min(<i class="fas fa-venus"></i>) Weight</th>
                                        <th>Max(<i class="fas fa-venus"></i>) Weight</th>
                                        <th>SD(<i class="fas fa-venus"></i>) Weight</th>
                                        <th>Avg(<i class="fas fa-venus-mars"></i>) Weight</th>
                                        <th>Min(<i class="fas fa-venus-mars"></i>) Weight</th>
                                        <th>Max(<i class="fas fa-venus-mars"></i>) Weight</th>
                                        <th>SD(<i class="fas fa-venus-mars"></i>) Weight</th>
                                    </tr>
                                </thead>

                                <tbody v-for="(growth_record, index) in growth_records" :key="index">
                                    <tr>
                                        <td>{{index}}</td>
                                        <td>0</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>{{getMean(getGrowthData(growth_record)[0]["weight_per_head"])}}</td>
                                        <td>{{getMin(getGrowthData(growth_record)[0]["weight_per_head"])}}</td>
                                        <td>{{getMax(getGrowthData(growth_record)[0]["weight_per_head"])}}</td>
                                        <td>{{getStd(getGrowthData(growth_record)[0]["weight_per_head"])}}</td>
                                    </tr>
                                    <tr>
                                        <td>-</td>
                                        <td>21</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>{{getMean(getGrowthData(growth_record)[1]["weight_per_head"])}}</td>
                                        <td>{{getMin(getGrowthData(growth_record)[1]["weight_per_head"])}}</td>
                                        <td>{{getMax(getGrowthData(growth_record)[1]["weight_per_head"])}}</td>
                                        <td>{{getStd(getGrowthData(growth_record)[1]["weight_per_head"])}}</td>
                                    </tr>
                                    <tr>
                                        <td>-</td>
                                        <td>45</td>
                                        <td>{{getMean(getGrowthData(growth_record)[2]["weight_per_male"])}}</td>
                                        <td>{{getMin(getGrowthData(growth_record)[2]["weight_per_male"])}}</td>
                                        <td>{{getMax(getGrowthData(growth_record)[2]["weight_per_male"])}}</td>
                                        <td>{{getStd(getGrowthData(growth_record)[2]["weight_per_male"])}}</td>
                                        <td>{{getMean(getGrowthData(growth_record)[2]["weight_per_female"])}}</td>
                                        <td>{{getMin(getGrowthData(growth_record)[2]["weight_per_female"])}}</td>
                                        <td>{{getMax(getGrowthData(growth_record)[2]["weight_per_female"])}}</td>
                                        <td>{{getStd(getGrowthData(growth_record)[2]["weight_per_female"])}}</td>
                                        <td>{{getMean(getGrowthData(growth_record)[2]["weight_per_head"])}}</td>
                                        <td>{{getMin(getGrowthData(growth_record)[2]["weight_per_head"])}}</td>
                                        <td>{{getMax(getGrowthData(growth_record)[2]["weight_per_head"])}}</td>
                                        <td>{{getStd(getGrowthData(growth_record)[2]["weight_per_head"])}}</td>
                                    </tr>
                                    <tr>
                                        <td>-</td>
                                        <td>75</td>
                                        <td>{{getMean(getGrowthData(growth_record)[3]["weight_per_male"])}}</td>
                                        <td>{{getMin(getGrowthData(growth_record)[3]["weight_per_male"])}}</td>
                                        <td>{{getMax(getGrowthData(growth_record)[3]["weight_per_male"])}}</td>
                                        <td>{{getStd(getGrowthData(growth_record)[3]["weight_per_male"])}}</td>
                                        <td>{{getMean(getGrowthData(growth_record)[3]["weight_per_female"])}}</td>
                                        <td>{{getMin(getGrowthData(growth_record)[3]["weight_per_female"])}}</td>
                                        <td>{{getMax(getGrowthData(growth_record)[3]["weight_per_female"])}}</td>
                                        <td>{{getStd(getGrowthData(growth_record)[3]["weight_per_female"])}}</td>
                                        <td>{{getMean(getGrowthData(growth_record)[3]["weight_per_head"])}}</td>
                                        <td>{{getMin(getGrowthData(growth_record)[3]["weight_per_head"])}}</td>
                                        <td>{{getMax(getGrowthData(growth_record)[3]["weight_per_head"])}}</td>
                                        <td>{{getStd(getGrowthData(growth_record)[3]["weight_per_head"])}}</td>
                                    </tr>
                                    <tr>
                                        <td>-</td>
                                        <td>100</td>
                                        <td>{{getMean(getGrowthData(growth_record)[4]["weight_per_male"])}}</td>
                                        <td>{{getMin(getGrowthData(growth_record)[4]["weight_per_male"])}}</td>
                                        <td>{{getMax(getGrowthData(growth_record)[4]["weight_per_male"])}}</td>
                                        <td>{{getStd(getGrowthData(growth_record)[4]["weight_per_male"])}}</td>
                                        <td>{{getMean(getGrowthData(growth_record)[4]["weight_per_female"])}}</td>
                                        <td>{{getMin(getGrowthData(growth_record)[4]["weight_per_female"])}}</td>
                                        <td>{{getMax(getGrowthData(growth_record)[4]["weight_per_female"])}}</td>
                                        <td>{{getStd(getGrowthData(growth_record)[4]["weight_per_female"])}}</td>
                                        <td>{{getMean(getGrowthData(growth_record)[4]["weight_per_head"])}}</td>
                                        <td>{{getMin(getGrowthData(growth_record)[4]["weight_per_head"])}}</td>
                                        <td>{{getMax(getGrowthData(growth_record)[4]["weight_per_head"])}}</td>
                                        <td>{{getStd(getGrowthData(growth_record)[4]["weight_per_head"])}}</td>
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
                        <div class="col s12 m12 l12">
                            <h6>Egg Quality</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s1 m12 l12">
                            <table class="bordered responsive-table centered">
                                <thead>
                                    <tr>
                                        <th>Generation</th>
                                        <th>Week</th>
                                        <th>Avg Lt</th>
                                        <th>Avg Wt</th>
                                        <th>Prom Col</th>
                                        <th>Prom Shpe</th>
                                        <th>Avg Width</th>
                                        <th>Avg AH</th>
                                        <th>Avg AW</th>
                                        <th>Avg YW</th>
                                        <th>Prom YC</th>
                                        <th>Avg SW</th>
                                        <th>Avg TT</th>
                                        <th>Avg MT</th>
                                        <th>Avg BT</th>
                                    </tr>
                                </thead>

                                <tbody v-for="(eggqual_record, index) in eggqual_records" :key="index">
                                    <tr>
                                        <td>{{index}}</td>
                                        <td>{{getEggQualData(eggqual_record)[0].week}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[0].weight)}}</td>
                                        <td>{{sort(getEggQualData(eggqual_record)[0].color)}}</td>
                                        <td>{{sort(getEggQualData(eggqual_record)[0].shape)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[0].len)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[0].width)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[0].albumen_height)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[0].albumen_weight)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[0].yolk_weight)}}</td>
                                        <td>{{sort(getEggQualData(eggqual_record)[0].yolk_color)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[0].shell_weight)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[0].thickness_top)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[0].thickness_mid)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[0].thickness_bot)}}</td>
                                    </tr>
                                    <tr v-if="getEggQualData(eggqual_record)[1].week !== undefined">
                                        <td></td>
                                        <td>{{getEggQualData(eggqual_record)[1].week}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[1].weight)}}</td>
                                        <td>{{sort(getEggQualData(eggqual_record)[1].color)}}</td>
                                        <td>{{sort(getEggQualData(eggqual_record)[1].shape)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[1].len)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[1].width)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[1].albumen_height)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[1].albumen_weight)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[1].yolk_weight)}}</td>
                                        <td>{{sort(getEggQualData(eggqual_record)[1].yolk_color)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[1].shell_weight)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[1].thickness_top)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[1].thickness_mid)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[1].thickness_bot)}}</td>
                                    </tr>
                                    <tr v-if="getEggQualData(eggqual_record)[2].week !== undefined">
                                        <td></td>
                                        <td>{{getEggQualData(eggqual_record)[2].week}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[2].weight)}}</td>
                                        <td>{{sort(getEggQualData(eggqual_record)[2].color)}}</td>
                                        <td>{{sort(getEggQualData(eggqual_record)[2].shape)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[2].len)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[2].width)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[2].albumen_height)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[2].albumen_weight)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[2].yolk_weight)}}</td>
                                        <td>{{sort(getEggQualData(eggqual_record)[2].yolk_color)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[2].shell_weight)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[2].thickness_top)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[2].thickness_mid)}}</td>
                                        <td>{{getMean(getEggQualData(eggqual_record)[2].thickness_bot)}}</td>
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
                        <div class="col s12 m12 l12">
                            <h6>Egg Production</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="bordered responsive-table centered">
                                <thead>
                                    <tr>
                                        <th>Generation</th>
                                        <th>Avg Intact</th>
                                        <th>STD Intact</th>
                                        <th>Avg Egg Weight</th>
                                        <th>STD Egg Weight</th>
                                        <th>Avg Broken</th>
                                        <th>STD Broken</th>
                                        <th>Avg Rejects</th>
                                        <th>STD Rejects</th>
                                    </tr>
                                </thead>

                                <tbody v-for="(eggprod_record, index) in eggprod_records" :key="index">
                                    <tr>
                                        <td>{{index}}</td>
                                        <td>{{getMean(getEggProductionData(eggprod_record)[0])}}</td>
                                        <td>{{getStd(getEggProductionData(eggprod_record)[0])}}</td>
                                        <td>{{getMean(getEggProductionData(eggprod_record)[1])}}</td>
                                        <td>{{getStd(getEggProductionData(eggprod_record)[1])}}</td>
                                        <td>{{getMean(getEggProductionData(eggprod_record)[2])}}</td>
                                        <td>{{getStd(getEggProductionData(eggprod_record)[2])}}</td>
                                        <td>{{getMean(getEggProductionData(eggprod_record)[3])}}</td>
                                        <td>{{getStd(getEggProductionData(eggprod_record)[3])}}</td>
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
                        <div class="col s12 m12 l12">
                            <h6>Hatchery Record</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="bordered responsive-table centered">
                                <thead>
                                    <tr>
                                        <th>Generation</th>
                                        <th>Mean Eggs Set</th>
                                        <th>STD Eggs Set</th>
                                        <th>Mean Fertile</th>
                                        <th>STD Fertile</th>
                                        <th>Mean Hatched</th>
                                        <th>STD Hatched</th>
                                        <th>Mean Fertility</th>
                                        <th>STD Fertility</th>
                                        <th>Mean Hatchability</th>
                                        <th>STD Hatchability</th>
                                    </tr>
                                </thead>

                                <tbody v-for="(hatchery_record, index) in hatchery_records" :key="index">
                                    <tr>
                                        <td>{{index}}</td>
                                        <td>{{getMean(getHatcheryData(hatchery_record)[0])}}</td>
                                        <td>{{getStd(getHatcheryData(hatchery_record)[0])}}</td>
                                        <td>{{getMean(getHatcheryData(hatchery_record)[1])}}</td>
                                        <td>{{getStd(getHatcheryData(hatchery_record)[1])}}</td>
                                        <td>{{getMean(getHatcheryData(hatchery_record)[2])}}</td>
                                        <td>{{getStd(getHatcheryData(hatchery_record)[2])}}</td>
                                        <td>{{getMean(getHatcheryData(hatchery_record)[3])}}</td>
                                        <td>{{getStd(getHatcheryData(hatchery_record)[3])}}</td>
                                        <td>{{getMean(getHatcheryData(hatchery_record)[4])}}</td>
                                        <td>{{getStd(getHatcheryData(hatchery_record)[4])}}</td>
                                    </tr>
                                </tbody>
                            </table>
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
            'year'
        ],
        data () {
            return {
                feeding_records : {},
                growth_records : {},
                eggqual_records : {},
                eggprod_records : {},
                hatchery_records : {},
                growth_loading : true, 
                feeding_loading : true,
                eggqual_loading : true,
                eggprod_loading : true,
                hatchery_loading : true,
            }
        },
        methods : {
            getGenerationFeeding : async function () {
                try {
                    const response = await axios.get('generation_feeding/'+this.year);
                    this.feeding_records = response.data;
                    this.feeding_loading = false;
                } catch (error) {
                    this.feeding_loading = true;
                }
            },
            getGenerationGrowth : async function () {
                try {
                    const response = await axios.get('generation_growth/'+this.year);
                    this.growth_records = response.data;
                    this.growth_loading = false;
                } catch (error) {
                    this.growth_loading = true;
                }
            },
            getGenerationEggQual : async function () {
                try {
                    const response = await axios.get('generation_eggqual/'+this.year);
                    this.eggqual_records = response.data;
                    this.eggqual_loading = false;
                } catch (error) {
                    this.eggqual_loading = true;
                }
            },
            getGenerationEggProd : async function () {
                try {
                    const response = await axios.get('generation_eggprod/'+this.year);
                    this.eggprod_records = response.data;
                    this.eggprod_loading = false;
                } catch (error) {
                    this.eggprod_loading = true;
                }
            },
            getGenerationHatchery : async function () {
                try {
                    const response = await axios.get('generation_hatchery/'+this.year);
                    this.hatchery_records = response.data;
                    this.hatchery_loading = false;
                } catch (error) {
                    this.hatchery_loading = true;
                }
            },
            // Helper methods
            getSumOffered: function (object) {
                var offered = [];
                object.forEach(element => {
                    offered.push(element.amount_offered);
                });
                return math.sum(offered).toFixed(3);
            },
            getSumRefused: function (object) {
                var refused = [];
                object.forEach(element => {
                    refused.push(element.amount_refused);
                });
                return math.sum(refused).toFixed(3);
            },
            getMeanOffered : function (object) {
                var offered = [];
                object.forEach(element => {
                    offered.push(element.amount_offered);
                });
                return math.mean(offered).toFixed(3);
            },
            getMeanRefused : function (object) {
                var refused = [];
                object.forEach(element => {
                    refused.push(element.amount_refused);
                });
                return math.mean(refused).toFixed(3);
            },
            getStdOffered : function (object) {
                var offered = [];
                object.forEach(element => {
                    offered.push(element.amount_offered);
                });
                return math.std(offered).toFixed(3);
            },
            getStdRefused : function (object) {
                var refused = [];
                object.forEach(element => {
                    refused.push(element.amount_refused);
                });
                return math.std(refused).toFixed(3);
            },
            getMinOffered : function (object) {
                var offered = [];
                object.forEach(element => {
                    offered.push(element.amount_offered);
                });
                return math.min(offered).toFixed(3);
            },
            getMinRefused : function (object) {
                var refused = [];
                object.forEach(element => {
                    refused.push(element.amount_refused);
                });
                return math.min(refused).toFixed(3);
            },
            getMaxOffered : function (object) {
                var offered = [];
                object.forEach(element => {
                    offered.push(element.amount_offered);
                });
                return math.max(offered).toFixed(3);
            },
            getMaxRefused : function (object) {
                var refused = [];
                object.forEach(element => {
                    refused.push(element.amount_refused);
                });
                return math.max(refused).toFixed(3);
            },
            getGrowthData : function (object) {
                var data = object;
                var summary = [];
                var day0 = [];
                var day21 = [];
                var day45 = [];
                var day75 = [];
                var day100 = [];
                data.forEach(element => {
                    if(element.collection_day === 0){
                        if(typeof day0["day"] == "undefined" || !(day0["day"] instanceof Array)){
                            day0["day"] = 0;
                            day0["weight_per_head"] = [];
                        }
                        day0["weight_per_head"].push(element.total_weight/element.total_quantity);
                        
                    }
                    if(element.collection_day === 21){
                        if(typeof day21["day"] == "undefined" || !(day21["day"] instanceof Array)){
                            day21["day"] = 21;
                            day21["weight_per_head"] = [];
                        }
                        day21["weight_per_head"].push(element.total_weight/element.total_quantity);
                        
                    }
                    if(element.collection_day === 45){
                        if(typeof day45["day"] == "undefined" || !(day45["day"] instanceof Array)){
                            day45["day"] = 45;
                            day45["weight_per_head"] = [];
                            day45["weight_per_male"] = [];
                            day45["weight_per_female"] = [];
                        }
                        day45["weight_per_head"].push(element.total_weight/element.total_quantity);
                        day45["weight_per_male"].push(element.male_weight/element.male_quantity);
                        day45["weight_per_female"].push(element.female_weight/element.female_quantity);
                        
                    }
                    if(element.collection_day === 75){
                        if(typeof day75["day"] == "undefined" || !(day75["day"] instanceof Array)){
                            day75["day"] = 60;
                            day75["weight_per_head"] = [];
                            day75["weight_per_male"] = [];
                            day75["weight_per_female"] = [];
                        }
                        day75["weight_per_head"].push(element.total_weight/element.total_quantity);
                        day75["weight_per_male"].push(element.male_weight/element.male_quantity);
                        day75["weight_per_female"].push(element.female_weight/element.female_quantity);
                        
                    }
                    if(element.collection_day === 100){
                        if(typeof day100["day"] == "undefined" || !(day100["day"] instanceof Array)){
                            day100["day"] = 60;
                            day100["weight_per_head"] = [];
                            day100["weight_per_male"] = [];
                            day100["weight_per_female"] = [];
                        }
                        day100["weight_per_head"].push(element.total_weight/element.total_quantity);
                        day100["weight_per_male"].push(element.male_weight/element.male_quantity);
                        day100["weight_per_female"].push(element.female_weight/element.female_quantity);
                    }
                });
                summary.push(day0, day21, day45, day75, day100);
                return summary;
            },
            getEggQualData : function (object) {
                var data = object;
                var summary = [];
                var week35 = [];
                var week40 = [];
                var week60 = [];
                data.forEach(element => {
                    if(element.egg_quality_at === 35){
                        if(typeof week35['week'] === 'undefined'){
                            week35['week'] = 35;
                            week35['weight'] = [];
                            week35['color'] = [];
                            week35['shape'] = [];
                            week35['len'] = [];
                            week35['width'] = [];
                            week35['albumen_height'] = [];
                            week35['albumen_weight'] = [];
                            week35['yolk_weight'] = [];
                            week35['yolk_color'] = [];
                            week35['shell_weight'] = [];
                            week35['thickness_top'] = [];
                            week35['thickness_mid'] = [];
                            week35['thickness_bot'] = [];
                        }
                        week35['weight'].push(element.weight);
                        if(typeof week35['color'][element.color]  === 'undefined'){
                            week35['color'][element.color] = 1;
                        }else{
                            week35['color'][element.color]++;
                        }
                        if(typeof week35['shape'][element.shape]  === 'undefined'){
                            week35['shape'][element.shape] = 1;
                        }else{
                            week35['shape'][element.shape]++ ;
                        }
                        week35['len'].push(element.len);
                        week35['width'].push(element.width);
                        week35['albumen_height'].push(element.albumen_height);
                        week35['albumen_weight'].push(element.albumen_weight);
                        week35['yolk_weight'].push(element.yolk_weight);
                         if(typeof week35['yolk_color'][element.yolk_color]  === 'undefined'){
                            week35['yolk_color'][element.yolk_color] = 1;
                        }else{
                            week35['yolk_color'][element.yolk_color]++;
                        }
                        week35['shell_weight'].push(element.shell_weight);
                        week35['thickness_top'].push(element.thickness_top);
                        week35['thickness_mid'].push(element.thickness_mid);
                        week35['thickness_bot'].push(element.thickness_bot);
                    }else if(element.egg_quality_at === 40){
                        if(typeof week40['week'] === 'undefined'){
                            week40['week'] = 40;
                            week40['weight'] = [];
                            week40['color'] = [];
                            week40['shape'] = [];
                            week40['len'] = [];
                            week40['width'] = [];
                            week40['albumen_height'] = [];
                            week40['albumen_weight'] = [];
                            week40['yolk_weight'] = [];
                            week40['yolk_color'] = [];
                            week40['shell_weight'] = [];
                            week40['thickness_top'] = [];
                            week40['thickness_mid'] = [];
                            week40['thickness_bot'] = [];
                        }
                        week40['weight'].push(element.weight);
                        if(typeof week40['color'][element.color]  === 'undefined'){
                            week40['color'][element.color] = 1;
                        }else{
                            week40['color'][element.color]++;
                        }
                        if(typeof week40['shape'][element.shape]  === 'undefined'){
                            week40['shape'][element.shape] = 1;
                        }else{
                            week40['shape'][element.shape]++;
                        }
                        week40["len"].push(element.len);
                        week40['width'].push(element.width);
                        week40['albumen_height'].push(element.albumen_height);
                        week40['albumen_weight'].push(element.albumen_weight);
                        week40['yolk_weight'].push(element.yolk_weight);
                         if(typeof week40['yolk_color'][element.yolk_color]  === 'undefined'){
                            week40['yolk_color'][element.yolk_color] = 1;
                        }else{
                            week40['yolk_color'][element.yolk_color]++;
                        }
                        week40['shell_weight'].push(element.shell_weight);
                        week40['thickness_top'].push(element.thickness_top);
                        week40['thickness_mid'].push(element.thickness_mid);
                        week40['thickness_bot'].push(element.thickness_bot);
                    }else if(element.egg_quality_at === 60){
                        if(typeof week60['week'] === 'undefined'){
                            week60['week'] = 60;
                            week60['weight'] = [];
                            week60['color'] = [];
                            week60['shape'] = [];
                            week60['len'] = [];
                            week60['width'] = [];
                            week60['albumen_height'] = [];
                            week60['albumen_weight'] = [];
                            week60['yolk_weight'] = [];
                            week60['yolk_color'] = [];
                            week60['shell_weight'] = [];
                            week60['thickness_top'] = [];
                            week60['thickness_mid'] = [];
                            week60['thickness_bot'] = [];
                        }
                        week60['weight'].push(element.weight);
                        if(typeof week60['color'][element.color]  === 'undefined'){
                            week60['color'][element.color] = 1;
                        }else{
                            week60['color'][element.color]++;
                        }
                        if(typeof week60['shape'][element.shape]  === 'undefined'){
                            week60['shape'][element.shape] = 1;
                        }else{
                            week60['shape'][element.shape]++;
                        }
                        week60["len"].push(element.len);
                        week60['width'].push(element.width);
                        week60['albumen_height'].push(element.albumen_height);
                        week60['albumen_weight'].push(element.albumen_weight);
                        week60['yolk_weight'].push(element.yolk_weight);
                         if(week60['yolk_color'][element.yolk_color]  === 'undefined'){
                            week60['yolk_color'][element.yolk_color] = 1;
                        }else{
                            week60['yolk_color'][element.yolk_color]++;
                        }
                        week60['shell_weight'].push(element.shell_weight);
                        week60['thickness_top'].push(element.thickness_top);
                        week60['thickness_mid'].push(element.thickness_mid);
                        week60['thickness_bot'].push(element.thickness_bot);
                    }
                });
                summary.push(week35, week40, week60);
                return summary;
            },
            getEggProductionData : function (object) {
                var data = object;
                var summary = [];
                var intact = [];
                var weight = [];
                var broken = [];
                var reject = [];

                data.forEach(element => {
                    intact.push(element.total_eggs_intact);
                    weight.push(element.total_egg_weight);
                    broken.push(element.total_broken);
                    reject.push(element.total_rejects);
                });
                summary.push(intact, weight, broken, reject);
                return summary;
            },
            getHatcheryData : function (object) {
                var data = object;
                var set = [];
                var hatched = [];
                var fertile = [];
                var hatchability = [];
                var fertility = [];
                var summary = [];
                data.forEach(element => {
                    if(element.number_eggs_set != null){
                        set.push(element.number_eggs_set);
                    }else{
                        set.push(0);
                    }
                    if(element.number_fertile != null){
                        fertile.push(element.number_fertile);
                    }else{
                        fertile.push(0);
                    }
                    if(element.number_hatched != null){
                        hatched.push(element.number_hatched);
                    }else{
                        hatched.push(0);
                    }
                    if(element.number_eggs_set != 0 || element.number_eggs_set != null){
                        hatchability.push((element.number_hatched/element.number_eggs_set) * 100);
                        fertility.push((element.number_fertile/element.number_eggs_set) * 100);
                    }else{
                        hatchability.push(0);
                        fertility.push(0);
                    }
                });
                summary.push(set, fertile, hatched, hatchability, fertility);
                return summary;
            },
            getMean : function (array) {
                if(array === undefined || array.length == 0){
                    return null;
                }else{
                    var filtered = math.filter(array, /[0-9]+/);
                    return math.mean(filtered).toFixed(3);
                }
            },
            getStd : function (array) {
                if(array === undefined || array.length == 0){
                    return null;
                }else{
                    var filtered = math.filter(array, /[0-9]+/);
                    return math.std(filtered).toFixed(3);
                }
            },
            getMin : function (array) {
                if(array === undefined || array.length == 0){
                    return null;
                }else{
                    return math.min(array).toFixed(3);
                }
            },
            getMax : function (array) {
                if(array === undefined || array.length == 0){
                    return null;
                }else{
                    return math.max(array).toFixed(3);
                }
            },
            sort : function (colors) {
                var keys = [];
                var max = 0;
                for (var val in colors) {
                    if(val == "null"){
                        continue;
                    }
                    if(colors[val] > max){
                        max = colors[val];
                        keys = [];
                        keys.push(val);
                    }else if(colors[val] == max){
                        keys.push(val);
                    }
                }
                return keys.join(", ");
            },
            
        },
        mounted() {
            this.getGenerationFeeding();
            this.getGenerationGrowth();
            this.getGenerationEggQual();
            this.getGenerationEggProd();
            this.getGenerationHatchery();
        }
    }
</script>
