<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align">
                                BREEDER HATCHERY RECORDS
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <table class="bordered centered responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Generation</th>
                                            <th>Eggs Set</th>
                                            <th>Eggs Fertile</th>
                                            <th>Eggs Hatched</th>
                                            <th>Fertility</th>
                                            <th>Hatchability</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(data, index) in hatchery_data" :key="index">
                                            <td>{{index}}</td>
                                            <td>{{getSum(data['eggs_set'])}}</td>
                                            <td>{{getSum(data['eggs_fertile'])}}</td>
                                            <td>{{getSum(data['eggs_hatched'])}}</td>
                                            <td>{{getPercentage(getSum(data['eggs_fertile']),getSum(data['eggs_set']))}} %</td>
                                            <td>{{getPercentage(getSum(data['eggs_hatched']),getSum(data['eggs_fertile']))}} %</td>
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
            hatchery_record : null,
            hatchery_data : {},
            hatchery_record_len : 0,
        }
    },
    methods : {
        init : function (){
            this.getGenerationHatchery();
        },
        getGenerationHatchery : function () {
            axios.get('generation_summary_hatchery')
            .then(response => {
                this.hatchery_record = response.data;
                this.hatchery_record_len = this.hatchery_record.length;
                this.hatchery_data = {};
                this.hatchery_record.forEach(element => {
                    if((typeof this.hatchery_data[element.number] === 'undefined')){
                        this.hatchery_data[element.number] = {};
                        this.hatchery_data[element.number]['eggs_set'] = [];
                        this.hatchery_data[element.number]['eggs_fertile'] = [];
                        this.hatchery_data[element.number]['eggs_hatched'] = [];
                    }
                    if(element.number_hatched != null){
                        this.hatchery_data[element.number]['eggs_set'].push(element.number_eggs_set);
                        this.hatchery_data[element.number]['eggs_fertile'].push(element.number_fertile);
                        this.hatchery_data[element.number]['eggs_hatched'].push(element.number_hatched);
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
