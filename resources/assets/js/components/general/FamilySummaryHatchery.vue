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
                    <div class="card-panel">
                        <div class="row" v-if="hatchery_record_len===0">
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
                                        <tr v-for="(linedata, lineindex) in hatchery_data" :key="lineindex">
                                            <td>{{lineindex}}</td>
                                            <td>
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Family</th>
                                                            <th>Eggs Set</th>
                                                            <th>Eggs Fertile</th>
                                                            <th>Eggs Hatched</th>
                                                            <th>Fertility</th>
                                                            <th>Hatchability</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr v-for="(famdata, famindex) in linedata" :key="famindex">
                                                            <td>{{famindex}}</td>
                                                            <td>{{getSum(famdata['eggs_set'])}}</td>
                                                            <td>{{getSum(famdata['eggs_fertile'])}}</td>
                                                            <td>{{getSum(famdata['eggs_hatched'])}}</td>
                                                            <td>{{getPercentage(getSum(famdata['eggs_fertile']),getSum(famdata['eggs_set']))}} %</td>
                                                            <td>{{getPercentage(getSum(famdata['eggs_hatched']),getSum(famdata['eggs_set']))}} %</td>
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
            hatchery_record : {},
            hatchery_data : {},
            hatchery_record_len : 0,
        }
    },
    methods : {
        init : function (){
            this.getGenerationHatchery();
        },
        getGenerationHatchery : function () {
            axios.get('family_summary_hatchery/'+this.generation.id)
            .then(response => {
                this.hatchery_record = response.data;
                this.hatchery_record_len = this.hatchery_record.length;
                this.hatchery_data = {};
                this.hatchery_record.forEach(element => {
                    if((typeof this.hatchery_data[element.line_number] === 'undefined')){
                        this.hatchery_data[element.line_number] = {};
                        
                    }
                    if((typeof this.hatchery_data[element.line_number][element.family_number] === 'undefined')){
                        this.hatchery_data[element.line_number][element.family_number] = {};
                        this.hatchery_data[element.line_number][element.family_number]['eggs_set'] = [];
                        this.hatchery_data[element.line_number][element.family_number]['eggs_fertile'] = [];
                        this.hatchery_data[element.line_number][element.family_number]['eggs_hatched'] = [];
                    }   

                    if(element.number_hatched != null){
                        this.hatchery_data[element.line_number][element.family_number]['eggs_set'].push(element.number_eggs_set);
                        this.hatchery_data[element.line_number][element.family_number]['eggs_fertile'].push(element.number_fertile);
                        this.hatchery_data[element.line_number][element.family_number]['eggs_hatched'].push(element.number_hatched);
                    }
                });
                
            })
            .catch(error => {});
        },
        getSum : function (array) {
            if(array === undefined || array.length == 0){
                return "-";
            }
            return math.sum(array);
        },
        getPercentage(num, deno) {
            if((deno === undefined || deno.length == 0) && (deno === undefined || deno.length == 0)){
                return "-";
            }
            return ((num/deno)*100).toFixed(2);
        }
    },
    mounted () {
        this.init();
    },

}
</script>

<style scoped>

</style>
