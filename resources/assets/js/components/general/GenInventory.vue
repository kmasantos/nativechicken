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
                            <h6>Inventory Summary</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="bordered centered responsive-table">
                                <thead>
                                    <tr>
                                        <th>Generation</th>
                                        <th>Stage</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody v-for="(inventory_record, index) in inventory_records" :key="index">
                                    <tr>
                                        <td>{{index}}</td>
                                        <td>Breeders</td>
                                        <td>{{total_male(inventory_record.breeder)}}</td>
                                        <td>{{total_female(inventory_record.breeder)}}</td>
                                        <td>{{total(inventory_record.breeder)}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Growers & Replacement</td>
                                        <td>{{total_male(inventory_record.replacement)}}</td>
                                        <td>{{total_female(inventory_record.replacement)}}</td>
                                        <td>{{total(inventory_record.replacement)}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Brooders</td>
                                        <td>{{total_male(inventory_record.brooder)}}</td>
                                        <td>{{total_female(inventory_record.brooder)}}</td>
                                        <td>{{total(inventory_record.brooder)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div row>
                        <div class="col s12 m12 l12">
                            <h6>Mortality Summary</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="bordered centered responsive-table">
                                <thead>
                                    <tr>
                                        <th>Generation</th>
                                        <th>Stage</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody v-for="(mortality_record, index) in mortality_records" :key="index">
                                    <tr>
                                        <td>{{index}}</td>
                                        <td>Breeders</td>
                                        <td>{{total_male(mortality_record.breeder)}}</td>
                                        <td>{{total_female(mortality_record.breeder)}}</td>
                                        <td>{{total(mortality_record.breeder)}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Growers & Replacement</td>
                                        <td>{{total_male(mortality_record.replacement)}}</td>
                                        <td>{{total_female(mortality_record.replacement)}}</td>
                                        <td>{{total(mortality_record.replacement)}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Brooders</td>
                                        <td>{{total_male(mortality_record.brooder)}}</td>
                                        <td>{{total_female(mortality_record.brooder)}}</td>
                                        <td>{{total(mortality_record.brooder)}}</td>
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
        props : ['year'],
        data () {
            return {
                inventory_records : {},
                inventory_loading : true,
                mortality_records : {},
                mortality_loading : true,
            }
        },
        methods : {
            getGenerationInventory : async function() {
                try {
                    const response = await axios.get('generation_inventory');
                    this.inventory_records = response.data;
                    this.inventory_loading = false;
                } catch (error) {
                    this.inventory_loading = true;
                }
            },
            getGenerationMortality : async function() {
                try {
                    const response = await axios.get('generation_mortality');
                    this.mortality_records = response.data;
                    this.mortality_loading = false;
                } catch (error) {
                    this.mortality_loading = true;
                }
            },
            // Helper methods
            total : function (array){
                var data = array;
                var total = 0;
                array.forEach(element => {
                    total = total + element.total;
                });
                return total;
            },
            total_male : function (array) {
                var total = 0;
                array.forEach(element => {
                    total = total + element.number_male;
                });
                return total;
            },
            total_female : function (array) {
                var data = array;
                var total = 0;
                array.forEach(element => {
                    total = total + element.number_female;
                });
                return total;
            }
        },
        mounted() {
            this.getGenerationInventory();
            this.getGenerationMortality();
        }
    }
</script>
