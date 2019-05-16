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
                        <div class="row" v-if="eggprod_record_len===0">
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
                                        <tr v-for="(linedata, lineindex) in eggprod_data" :key="lineindex">
                                            <td>{{lineindex}}</td>
                                            <td>
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Family</th>
                                                            <th>Hen Day</th>
                                                            <th>Total Intact</th>
                                                            <th>Total Broken</th>
                                                            <th>Total Rejects</th>
                                                            <th>Total Egg Weight (g)</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr v-for="(famdata, famindex) in linedata" :key="famindex">
                                                            <td>{{famindex}}</td>
                                                            <td>{{getHenDay(getSum(famdata['compute']), getSum(famdata['inventory']))}}</td>
                                                            <td>{{getSum(famdata['eggs_intact'])}}</td>
                                                            <td>{{getSum(famdata['eggs_broken'])}}</td>
                                                            <td>{{getSum(famdata['eggs_rejected'])}}</td>
                                                            <td>{{getSum(famdata['eggs_weight']).toFixed(2)}}</td>
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
            eggprod_record : {},
            eggprod_data : {},
            eggprod_record_len : 0,
        }
    },
    methods : {
        init : function () {
            this.getFamilyEggProduction();
        },
        getFamilyEggProduction : function () {
            axios.get('family_summary_eggprod/' + this.generation.id)
            .then(response => {
                this.eggprod_record = response.data;
                this.eggprod_record_len = this.eggprod_record.length;
                this.eggprod_data = {};
                this.eggprod_record.forEach(element => {
                    if((typeof this.eggprod_data[element.line_number] === 'undefined')){
                        this.eggprod_data[element.line_number] = {};
                    }
                    if((typeof this.eggprod_data[element.line_number][element.family_number] === 'undefined')){
                        this.eggprod_data[element.line_number][element.family_number] = {};
                        this.eggprod_data[element.line_number][element.family_number]['eggs_intact'] = [];
                        this.eggprod_data[element.line_number][element.family_number]['eggs_broken'] = [];
                        this.eggprod_data[element.line_number][element.family_number]['eggs_rejected'] = [];
                        this.eggprod_data[element.line_number][element.family_number]['eggs_weight'] = [];
                        this.eggprod_data[element.line_number][element.family_number]['inventory'] = [];
                        this.eggprod_data[element.line_number][element.family_number]['compute'] = [];
                    }
                    this.eggprod_data[element.line_number][element.family_number]['eggs_intact'].push(element.total_eggs_intact);
                    this.eggprod_data[element.line_number][element.family_number]['eggs_broken'].push(element.total_broken);
                    this.eggprod_data[element.line_number][element.family_number]['eggs_rejected'].push(element.total_rejects);
                    this.eggprod_data[element.line_number][element.family_number]['eggs_weight'].push(element.total_egg_weight);
                    if(element.female_inventory != null){
                        this.eggprod_data[element.line_number][element.family_number]['inventory'].push(element.female_inventory);
                        this.eggprod_data[element.line_number][element.family_number]['compute'].push((element.total_eggs_intact+element.total_broken+element.total_rejects));
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

</style>
