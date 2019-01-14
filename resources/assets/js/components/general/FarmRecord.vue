<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
                <h5>Phenotypic Values</h5>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="bordered highlight responsive-table">
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
                <div class="row">
                    <div class="col s12 m12 l12">
                        <v-select :options="['foo','bar']"></v-select>
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
            console.log('Component mounted.')
        },
        created() {

        }
    }
</script>
