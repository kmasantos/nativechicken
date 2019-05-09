<template>
    <div class="row">
        <div class="col s2 m12 l12">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align">
                                BREEDER EGG PRODUCTION DATA
                            </div>
                        </div>
                        <div class="row" v-if="eggprod_record_len === 0">
                            <div class="col s12 m12 l12">
                                <strong>NO DATA</strong> 
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col s12 m12 l12">
                                <table class="bordered centered responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Generation</th>
                                            <th>Hen Day</th>
                                            <th>Total Intact</th>
                                            <th>Total Broken</th>
                                            <th>Total Rejects</th>
                                            <th>Total Egg Weight (g)</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(data, index) in eggprod_data" :key="index">
                                            <td>{{index}}</td>
                                            <td>{{getHenDay(getSum(data['compute']), getSum(data['inventory']))}}</td>
                                            <td>{{getSum(data['eggs_intact'])}}</td>
                                            <td>{{getSum(data['eggs_broken'])}}</td>
                                            <td>{{getSum(data['eggs_rejected'])}}</td>
                                            <td>{{getSum(data['eggs_weight']).toFixed(2)}}</td>
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
            eggprod_record : null,
            eggprod_data : {},
            eggprod_record_len : 0,
        }
    },
    methods : {
        init : function () {
            this.getGenerationEggProductioin();
        },
        getGenerationEggProductioin : function () {
            axios.get('generation_summary_eggprod')
            .then(response => {
                this.eggprod_record = response.data;
                this.eggprod_record_len = this.eggprod_record.length;
                this.eggprod_data = {};
                this.eggprod_record.forEach(element => {
                    if((typeof this.eggprod_data[element.number] === 'undefined')){
                        this.eggprod_data[element.number] = {};
                        this.eggprod_data[element.number]['eggs_intact'] = [];
                        this.eggprod_data[element.number]['eggs_broken'] = [];
                        this.eggprod_data[element.number]['eggs_rejected'] = [];
                        this.eggprod_data[element.number]['eggs_weight'] = [];
                        this.eggprod_data[element.number]['inventory'] = [];
                        this.eggprod_data[element.number]['compute'] = [];

                    }
                    this.eggprod_data[element.number]['eggs_intact'].push(element.total_eggs_intact);
                    this.eggprod_data[element.number]['eggs_broken'].push(element.total_broken);
                    this.eggprod_data[element.number]['eggs_rejected'].push(element.total_rejects);
                    this.eggprod_data[element.number]['eggs_weight'].push(element.total_egg_weight);
                    if(element.female_inventory != null){
                        this.eggprod_data[element.number]['inventory'].push(element.female_inventory);
                        this.eggprod_data[element.number]['compute'].push((element.total_eggs_intact+element.total_broken+element.total_rejects));
                    }
                });
                
            })
            .catch(error => {});
        },
        getSum : function (array) {
            if(array === undefined || array.length == 0){
                return undefined;
            }
            return math.sum(array);
        },
        getHenDay : function (eggs, inventory) {
            if(inventory === undefined || inventory.length == 0){
                return "-";
            }else{
                return ((eggs/inventory)*100).toFixed(2)+" %";
            }
        }

    },
    mounted () {
        this.init();
    }
}
</script>

<style scoped>
    .card-panel {
        height: 800px;
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

