<template>
    <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    <div class="row valign-wrapper">
                        <div class="col s8 m8 l8">
                            <h5>Pen {{inv_pen_number}} Inventory</h5>
                        </div>
                        <div class="col s4 m4 l4 right-align">
                            <a v-on:click="closeInventory" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="responsive-table bordered highlight centered">
                                <thead>
                                    <tr>
                                        <th>Tag</th>
                                        <th>Family</th>
                                        <th>Line</th>
                                        <th>Generation</th>
                                        <th>Batching Date</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <th>Added</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-if="inventories_length == 0">
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr v-else v-for="inventory in inventories.data" :key="inventory.inv_id">
                                        <td>{{inventory.replacement_tag}}</td>
                                        <td>{{inventory.fam_number}}</td>
                                        <td>{{inventory.line_number}}</td>
                                        <td>{{inventory.gen_number}}</td>
                                        <td v-if="inventory.batching_date == null">N/A</td>
                                        <td v-else>{{inventory.batching_date}}</td>
                                        <td v-if="inventory.number_male == null">N/A</td>
                                        <td v-else>{{inventory.number_male}}</td>
                                        <td v-if="inventory.number_female == null">N/A</td>
                                        <td v-else>{{inventory.number_female}}</td>
                                        <td>{{inventory.total}}</td>
                                        <td>{{inventory.last_update}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- pagination -->
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <pagination :data="inventories" @pagination-change-page="fetchPenInventory"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    props: [
        'inv_pen_id', 'inv_pen_number'
    ],
    data () {
        return {
            inventories : {},
            inventories_length : 0,
            selected_inventory_id : '',
            selected_inventory_tag : '',
        }
    },
    methods : {
        initialize : function () {
            this.fetchPenInventory();
        },
        fetchPenInventory : function (page = 1) {
            axios.get('replacement_pen_info/'+this.inv_pen_id+'?page='+page)
            .then(response => {
                this.inventories = response.data;
                this.inventories_length = this.inventories.data.length;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        closeInventory : function () {
            this.$emit('close_inventory', null)
        }
    },
    beforeCreate() {
        $('.tooltipped').tooltip('remove');
    },
    created () {
        this.initialize();
    },
    mounted () {
        // $('#update').modal({
        //         dismissible : false,
        // });
    },
    destroyed () {
        $('.tooltipped').tooltip({delay: 50});
    },
}
</script>
