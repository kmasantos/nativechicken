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
                                        <th>Update</th>
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
                                        <td>-</td>
                                    </tr>
                                    <tr v-else v-for="inventory in inventories.data" :key="inventory.inv_id">
                                        <td>{{inventory.broodergrower_tag}}</td>
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
                                        <td><a @click="selected_inventory_id=inventory.inv_id;selected_inventory_tag=inventory.broodergrower_tag" href="#update" class="modal-trigger"><i class="fas fa-pen-square"></i></a></td>
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

                <!-- Update Modal -->
                <div  id="update" class="modal modal-fixed-footer">
                    <form method="patch" v-on:submit.prevent="updateBrooderGrower">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h4>Update {{selected_inventory_tag}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="row">
                                        <div class="col s12 s6 m6 input-field">
                                            <input v-model.number="number_male" class="validate" placeholder="Update number of male" id="male" type="number" min="0">
                                            <label class="active" for="male">Male</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 s6 m6 input-field">
                                            <input v-model.number="number_female" class="validate" placeholder="Update number of female" id="female" type="number" min="0">
                                            <label class="active" for="female">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                            <button href="javascript:void(0)"  class="modal-action modal-close waves-effect waves-green btn-flat" type="submit">Submit</button>
                        </div>
                    </form>
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
                number_male : '',
                number_female : '',
            }
        },
        methods : {
            initialize : function () {
                this.fetchPenInventory();
            },
            fetchPenInventory : function (page = 1) {
                axios.get('broodergrower_pen_info/'+this.inv_pen_id+'?page='+page)
                .then(response => {
                    this.inventories = response.data;
                    this.inventories_length = this.inventories.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            updateBrooderGrower : function () {
                axios.patch('update_broodergrower', {
                    broodergrower_inventory_id : this.selected_inventory_id,
                    number_male : this.number_male,
                    number_female : this.number_female
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.number_male = '',
                        this.number_female = '',
                        Materialize.toast('Successfully updated inventory record', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                }).catch(error => {
                    Materialize.toast('Failed to update inventory record', 3000, 'rounded');
                });
                this.initialize();
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
            $('#update').modal({
                    dismissible : false,
            });
        },
        destroyed () {
            $('.tooltipped').tooltip({delay: 50});
        },
    }
</script>
