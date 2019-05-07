<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align custom-title">
                                BREEDERS
                            </div>
                        </div>
                        <div class="row" v-if="breeder_data_len === 0">
                            <div class="col s12 m12 l12 center-align">
                                <strong>NO DATA</strong>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col s12 m12 l12">
                                <table class="bordered centered responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Generation</th>
                                            <th>Total Deaths</th>
                                            <th>Total Sales</th>
                                            <th>Total Egg Sales</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(data, index) in breeder_records" :key="index">
                                            <td>{{index}}</td>
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
                                                            <td>{{getSum(data['mortality']['male'])}}</td>
                                                            <td>{{getSum(data['mortality']['female'])}}</td>
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
                                                            <td>{{getSum(data['sales']['male'])}}</td>
                                                            <td>{{getSum(data['sales']['female'])}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>{{getSum(data['egg_sales'])}}</td>
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
                            <div class="col s12 m12 l12 center-align custom-title">
                                REPLACEMENT & GROWERS
                            </div>
                        </div>
                        <div class="row" v-if="replacement_data_len === 0">
                            <div class="col s12 m12 l12 center-align">
                                <strong>NO DATA</strong>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col s12 m12 l12">
                                <table class="bordered centered responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Generation</th>
                                            <th>Total Deaths</th>
                                            <th>Total Sales</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(data, index) in replacement_records" :key="index">
                                            <td>{{index}}</td>
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
                                                            <td>{{getSum(data['mortality']['male'])}}</td>
                                                            <td>{{getSum(data['mortality']['female'])}}</td>
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
                                                            <td>{{getSum(data['sales']['male'])}}</td>
                                                            <td>{{getSum(data['sales']['female'])}}</td>
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
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align custom-title">
                                BROODERS
                            </div>
                        </div>
                        <div class="row" v-if="brooder_data_len === 0">
                            <div class="col s12 m12 l12 center-align">
                                <strong>NO DATA</strong>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col s12 m12 l12">
                                <table class="bordered centered responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Generation</th>
                                            <th>Total Deaths</th>
                                            <th>Total Sales</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(data, index) in brooder_records" :key="index">
                                            <td>{{index}}</td>
                                            <td>{{getSum(data['mortality'])}}</td>
                                            <td>{{getSum(data['sales'])}}</td>
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
            breeder_data : null,
            replacement_data : null,
            brooder_data : null,
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
            axios.get('generation_summary_breeder_mortality')
            .then(response => {
                this.breeder_data = response.data;
                this.breeder_data_len = this.breeder_data.length;
                this.breeder_records = {};
                this.breeder_data.forEach(element => {
                    if((typeof this.breeder_records[element.number] === 'undefined')){
                        this.breeder_records[element.number] = {};
                        this.breeder_records[element.number]['mortality'] = {};
                        this.breeder_records[element.number]['mortality']['male'] = [];
                        this.breeder_records[element.number]['mortality']['female'] = [];
                        this.breeder_records[element.number]['sales'] = {};
                        this.breeder_records[element.number]['sales']['male'] = [];
                        this.breeder_records[element.number]['sales']['female'] = [];
                        this.breeder_records[element.number]['egg_sales'] = [];
                    }
                    if(element.category === "died" || element.category === "culled"){
                        if(element.male != null){
                            this.breeder_records[element.number]['mortality']['male'].push(element.male);
                        }
                        if(element.female != null){
                            this.breeder_records[element.number]['mortality']['female'].push(element.female);
                        }
                    }
                    if(element.category === "sold" && element.type === "breeder"){
                        if(element.male != null){
                            this.breeder_records[element.number]['sales']['male'].push(element.male);
                        }
                        if(element.female != null){
                            this.breeder_records[element.number]['sales']['female'].push(element.female);
                        }
                    }
                    if(element.category === "sold" && element.type === "egg"){
                        if(element.total != null){
                            this.breeder_records[element.number]['egg_sales'].push(element.total);
                        }
                    }

                });
                
            })
            .catch(error => {});
        },
        getReplacementData : function () {
            axios.get('generation_summary_replacement_mortality')
            .then(response => {
                this.replacement_data = response.data;
                this.replacement_data_len = this.replacement_data.length;
                this.replacement_records = {};
                this.replacement_data.forEach(element => {
                    if((typeof this.replacement_records[element.number] === 'undefined')){
                        this.replacement_records[element.number] = {};
                        this.replacement_records[element.number]['mortality'] = {};
                        this.replacement_records[element.number]['mortality']['male'] = [];
                        this.replacement_records[element.number]['mortality']['female'] = [];
                        this.replacement_records[element.number]['sales'] = {};
                        this.replacement_records[element.number]['sales']['male'] = [];
                        this.replacement_records[element.number]['sales']['female'] = [];
                    }
                    if(element.category === "died" || element.category === "culled"){
                        if(element.male != null){
                            this.replacement_records[element.number]['mortality']['male'].push(element.male);
                        }
                        if(element.female != null){
                            this.replacement_records[element.number]['mortality']['female'].push(element.female);
                        }
                    }
                    if(element.category === "sold" && element.type === "replacement"){
                        if(element.male != null){
                            this.replacement_records[element.number]['sales']['male'].push(element.male);
                        }
                        if(element.female != null){
                            this.replacement_records[element.number]['sales']['female'].push(element.female);
                        }
                    }

                });
                
            })
            .catch(error => {});
        },
        getBrooderData : function () {
            axios.get('generation_summary_brooder_mortality')
            .then(response => {
                this.brooder_data = response.data;
                this.brooder_data_len = this.brooder_data.length;
                this.brooder_records = {};
                this.brooder_data.forEach(element => {
                    if((typeof this.brooder_records[element.number] === 'undefined')){
                        this.brooder_records[element.number] = {};
                        this.brooder_records[element.number]['mortality'] = [];
                        this.brooder_records[element.number]['sales'] = [];
                    }
                    if(element.category === "died" || element.category === "culled"){
                        if(element.total != null){
                            this.brooder_records[element.number]['mortality'].push(element.total);
                        }
                    }
                    if(element.category === "sold" && element.type === "brooder"){
                        if(element.total != null){
                            this.brooder_records[element.number]['sales'].push(element.total);
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
        this.init();
    }
}
</script>

<style scoped>
    .custom-title {
        font-size: 1.3em;
    }
</style>
