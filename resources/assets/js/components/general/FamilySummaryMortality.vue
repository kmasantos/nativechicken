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
                                <li class="tab"><a href="#br">BREEDERS</a></li>
                                <li class="tab"><a href="#gr">GROWERS</a></li>
                                <li class="tab"><a href="#bro">BROODERS</a></li>
                            </ul>
                        </div>
                        <div class="card-content grey lighten-4">
                            <div id="br">
                                <div class="row" v-if="breeder_data_len === 0">
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
                                                <tr v-for="(linedata, lineindex) in breeder_records" :key="lineindex">
                                                <td>{{lineindex}}</td>
                                                <td>
                                                    <table class="bordered centered responsive-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Family</th>
                                                                <th>Total Mortality</th>
                                                                <th>Total Heads Sold</th>
                                                                <th>Total Eggs Sold</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr v-for="(famdata, famindex) in linedata" :key="famindex">
                                                                <td>{{famindex}}</td>
                                                                <td>
                                                                    <table class="bordered centered responsive-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th><i class="fas fa-mars"></i></th>
                                                                                <th><i class="fas fa-venus"></i></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>{{getSum(famdata['mortality']['male'])}}</td>
                                                                                <td>{{getSum(famdata['mortality']['female'])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td>
                                                                    <table class="bordered centered responsive-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th><i class="fas fa-mars"></i></th>
                                                                                <th><i class="fas fa-venus"></i></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>{{getSum(famdata['sales']['male'])}}</td>
                                                                                <td>{{getSum(famdata['sales']['female'])}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td>{{getSum(famdata['egg_sales'])}}</td>
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
                            <div id="gr">
                                <div class="row" v-if="replacement_data_len === 0"> 
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
                                                <tr v-for="(linedata, lineindex) in replacement_records" :key="lineindex">
                                                    <td>{{lineindex}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Family</th>
                                                                    <th>Total Mortality</th>
                                                                    <th>Total Heads Sold</th>
                                                                    <th>Total Eggs Sold</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(famdata, famindex) in linedata" :key="famindex">
                                                                    <td>{{famindex}}</td>
                                                                    <td>
                                                                        <table class="bordered centered responsive-table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th><i class="fas fa-mars"></i></th>
                                                                                    <th><i class="fas fa-venus"></i></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>{{getSum(famdata['mortality']['male'])}}</td>
                                                                                    <td>{{getSum(famdata['mortality']['female'])}}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td>
                                                                        <table class="bordered centered responsive-table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th><i class="fas fa-mars"></i></th>
                                                                                    <th><i class="fas fa-venus"></i></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>{{getSum(famdata['sales']['male'])}}</td>
                                                                                    <td>{{getSum(famdata['sales']['female'])}}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
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
                            <div id="bro">
                                <div class="row" v-if="brooder_data_len === 0">
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
                                                <tr v-for="(linedata, lineindex) in brooder_records" :key="lineindex">
                                                    <td>{{lineindex}}</td>
                                                    <td>
                                                        <table class="bordered centered responsive-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Family</th>
                                                                    <th>Total Mortality</th>
                                                                    <th>Total Heads Sold</th>
                                                                    <th>Total Eggs Sold</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(famdata, famindex) in linedata" :key="famindex">
                                                                    <td>{{famindex}}</td>
                                                                    <td>
                                                                        <table class="bordered centered responsive-table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th><i class="fas fa-mars"></i></th>
                                                                                    <th><i class="fas fa-venus"></i></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>{{getSum(famdata['mortality']['male'])}}</td>
                                                                                    <td>{{getSum(famdata['mortality']['female'])}}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td>
                                                                        <table class="bordered centered responsive-table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th><i class="fas fa-mars"></i></th>
                                                                                    <th><i class="fas fa-venus"></i></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>{{getSum(famdata['sales']['male'])}}</td>
                                                                                    <td>{{getSum(famdata['sales']['female'])}}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
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
            breeder_data : {},
            replacement_data : {},
            brooder_data : {},
            breeder_records : {},
            replacement_records : {},
            brooder_records : {},
            breeder_data_len : 0,
            replacement_data_len : 0,
            brooder_data_len : 0
        }
    },
    methods : {
        init : function () {
            this.getBreederData();
            this.getReplacementData();
            this.getBrooderData();
        },
        getBreederData : function () {
            axios.get('family_summary_breeder_mortality/'+this.generation.id)
            .then(response => {
                this.breeder_data = response.data;
                this.breeder_data_len = this.breeder_data.length;
                this.breeder_records = {};
                this.breeder_data.forEach(element => {
                    if((typeof this.breeder_records[element.line_number] === 'undefined')){
                        this.breeder_records[element.line_number] = {};
                        
                    }

                    if((typeof this.breeder_records[element.line_number][element.family_number] === 'undefined')){
                        this.breeder_records[element.line_number][element.family_number] = {};
                        this.breeder_records[element.line_number][element.family_number]['mortality'] = {};
                        this.breeder_records[element.line_number][element.family_number]['mortality']['male'] = [];
                        this.breeder_records[element.line_number][element.family_number]['mortality']['female'] = [];
                        this.breeder_records[element.line_number][element.family_number]['sales'] = {};
                        this.breeder_records[element.line_number][element.family_number]['sales']['male'] = [];
                        this.breeder_records[element.line_number][element.family_number]['sales']['female'] = [];
                        this.breeder_records[element.line_number][element.family_number]['egg_sales'] = [];
                    }

                    if(element.category === "died" || element.category === "culled"){
                        if(element.male != null){
                            this.breeder_records[element.line_number][element.family_number]['mortality']['male'].push(element.male);
                        }
                        if(element.female != null){
                            this.breeder_records[element.line_number][element.family_number]['mortality']['female'].push(element.female);
                        }
                    }
                    if(element.category === "sold" && element.type === "breeder"){
                        if(element.male != null){
                            this.breeder_records[element.line_number][element.family_number]['sales']['male'].push(element.male);
                        }
                        if(element.female != null){
                            this.breeder_records[element.line_number][element.family_number]['sales']['female'].push(element.female);
                        }
                    }
                    if(element.category === "sold" && element.type === "egg"){
                        if(element.total != null){
                            this.breeder_records[element.line_number][element.family_number]['egg_sales'].push(element.total);
                        }
                    }

                });
                
            })
            .catch(error => {});
        },
        getReplacementData : function () {
            axios.get('family_summary_replacement_mortality/'+this.generation.id)
            .then(response => {
                this.replacement_data = response.data;
                this.replacement_data_len = this.replacement_data.length;
                this.replacement_records = {};
                this.replacement_data.forEach(element => {
                    if((typeof this.replacement_records[element.line_number] === 'undefined')){
                        this.replacement_records[element.line_number] = {};
                    }

                    if((typeof this.replacement_records[element.line_number][element.family_number] === 'undefined')){
                        this.replacement_records[element.line_number][element.family_number] = {};
                        this.replacement_records[element.line_number][element.family_number]['mortality'] = {};
                        this.replacement_records[element.line_number][element.family_number]['mortality']['male'] = [];
                        this.replacement_records[element.line_number][element.family_number]['mortality']['female'] = [];
                        this.replacement_records[element.line_number][element.family_number]['sales'] = {};
                        this.replacement_records[element.line_number][element.family_number]['sales']['male'] = [];
                        this.replacement_records[element.line_number][element.family_number]['sales']['female'] = [];
                    }

                    if(element.category === "died" || element.category === "culled"){
                        if(element.male != null){
                            this.replacement_records[element.line_number][element.family_number]['mortality']['male'].push(element.male);
                        }
                        if(element.female != null){
                            this.replacement_records[element.line_number][element.family_number]['mortality']['female'].push(element.female);
                        }
                    }
                    if(element.category === "sold" && element.type === "replacement"){
                        if(element.male != null){
                            this.replacement_records[element.line_number][element.family_number]['sales']['male'].push(element.male);
                        }
                        if(element.female != null){
                            this.replacement_records[element.line_number][element.family_number]['sales']['female'].push(element.female);
                        }
                    }

                });
                
            })
            .catch(error => {});
        },
        getBrooderData : function () {
            axios.get('family_summary_brooder_mortality/'+this.generation.id)
            .then(response => {
                this.brooder_data = response.data;
                this.brooder_data_len = this.brooder_data.length;
                this.brooder_records = {};
                this.brooder_data.forEach(element => {
                    if((typeof this.brooder_records[element.line_number] === 'undefined')){
                        this.brooder_records[element.line_number] = {};
                    }

                    if((typeof this.brooder_records[element.line_number][element.family_number] === 'undefined')){
                        this.brooder_records[element.line_number][element.family_number] = {};
                        this.brooder_records[element.line_number][element.family_number]['mortality'] = [];
                        this.brooder_records[element.line_number][element.family_number]['sales'] = [];
                    }

                    if(element.category === "died" || element.category === "culled"){
                        if(element.total != null){
                            this.brooder_records[element.line_number][element.family_number]['mortality'].push(element.total);
                        }
                    }
                    if(element.category === "sold" && element.type === "brooder"){
                        if(element.total != null){
                            this.brooder_records[element.line_number][element.family_number]['sales'].push(element.total);
                        }
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
