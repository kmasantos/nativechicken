<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <label for="generation_select">Select Generation</label>
                        <v-select :options="['foo','bar']" id="generation_select"></v-select>
                    </div>
                </div>
                <h5>Phenotypic Values</h5>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="bordered highlight responsive-table centered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Item Name</th>
                                    <th>Item Price</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Alvin</td>
                                    <td>Eclair</td>
                                    <td>$0.87</td>
                                </tr>
                                <tr>
                                    <td>Alan</td>
                                    <td>Jellybean</td>
                                    <td>$3.76</td>
                                </tr>
                                <tr>
                                    <td>Jonathan</td>
                                    <td>Lollipop</td>
                                    <td>$7.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h5>Morphometric Values</h5>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="bordered highlight responsive-table centered">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Minimum</th>
                                    <th>Maximum</th>
                                    <th>Average</th>
                                    <th>Standard Deviation</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
            
            }
        },
        methods : {
            fetchPhenotypicSummary : function () {
                
            },
            fetchMorphometricSummary : function () {
                
            },
        },
        mounted() {
            console.log('Component mounted.');
            
        },
        created() {

        }
    }
</script>