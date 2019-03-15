<template>
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel blue-grey lighten-5">
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
                                        <th>Inventory Code</th>
                                        <th>Fam</th>
                                        <th>Line</th>
                                        <th>Gen</th>
                                        <th>Batch Date</th>
                                        <th><i class="fas fa-mars"></i></th>
                                        <th><i class="fas fa-venus"></i></th>
                                        <th><i class="fas fa-venus-mars"></i></th>
                                        <th>Added</th>
                                        <!-- <th>Update</th> -->
                                        <th>Mort/Sale</th>
                                        <th>Cull</th>
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
                                        <!-- <td><a @click="selected_inventory_id=inventory.inv_id;selected_inventory_tag=inventory.broodergrower_tag" href="#update" class="modal-trigger"><i class="fas fa-pen-square"></i></a></td> -->
                                        <td><a @click="selected_inventory_id=inventory.inv_id;selected_inventory_tag=inventory.broodergrower_tag;getMortalitySale();if(inventory.number_male!=null||inventory.number_female!=null)updated=true;" href="#mortality_sale" class="modal-trigger"><i class="fas fa-dollar-sign"></i></a></td>
                                        <td><a @click="selected_inventory_id=inventory.inv_id;selected_inventory_tag=inventory.broodergrower_tag" href="#cull_modal" class="modal-trigger"><i class="fas fa-minus-circle"></i></a></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- pagination -->
                    <div class="row center">
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
                <div id="mortality_sale" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <div class="row valign-wrapper">
                            <div class="col s8 m8 l8">
                                <h4>Mortality & Sales Record | {{selected_inventory_tag}}</h4>
                            </div>
                            <div class="col s4 m4 l4">
                                <a class="waves-effect waves-green btn-flat green-text modal-trigger" href="#mortality"><i class="fas fa-plus-circle left"></i>Add</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <table class="responsive-table centered bordered highlight">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <th>Price/kg</th>
                                        <th>Reason</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-if="records_length === 0">
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr v-for="record in records.data" :key="record.id">
                                            <td>{{record.date}}</td>
                                            <td>{{capitalize(record.category)}}</td>
                                            <td>{{capitalize(record.type)}}</td>
                                            <td v-if="record.male == null">-</td>
                                            <td v-else>{{record.male}}</td>
                                            <td v-if="record.female == null">-</td>
                                            <td v-else>{{record.female}}</td>
                                            <td>{{record.total}}</td>
                                            <td v-if="record.price == null">-</td>
                                            <td v-else>{{record.price}}</td>
                                            <td v-if="record.reason == null">-</td>
                                            <td v-else>{{record.reason}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <pagination :data="records" @pagination-change-page="getMortalitySale"></pagination>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a @click="updated=false" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                    </div>
                </div>
                <div id="mortality" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h4>Mortality & Sales | {{selected_inventory_tag}}</h4>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="card">
                                    <div class="card-content">
                                        <p><i class="fas fa-exclamation-circle"></i> Go to <strong>Mortality</strong> tab to report animal death.</p>
                                        <p><i class="fas fa-exclamation-circle"></i> Go to <strong>Sales</strong> tab to report animal sales.</p>
                                    </div>
                                    <div class="card-tabs">
                                    <ul class="tabs tabs-fixed-width">
                                        <li class="tab"><a href="#mort">Mortality</a></li>
                                        <li class="tab"><a href="#sale">Sales</a></li>
                                    </ul>
                                    </div>
                                    <div class="card-content grey lighten-4">
                                        <div id="mort">
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <form v-on:submit.prevent="addMortalityRecord" method="post">
                                                        <div class="row">
                                                            <div class="col s12 m6 l6">
                                                                <label class="active" for="mort_date_died">Date Died</label>
                                                                <datepicker id="mort_date_died" :format="customFormatter" v-model="mort_date_died" placeholder="Date when animal death is recorded"></datepicker>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="updated!=false">
                                                            <div class="col s12 m6 l6 input-field">
                                                                <input v-model.number="mort_male" placeholder="Number dead of male" id="mort_male" type="number" min=0>
                                                                <label class="active" for="mort_male">Male Death</label>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="updated!=false">
                                                            <div class="col s12 m6 l6 input-field">
                                                                <input v-model.number="mort_female" placeholder="Number dead of female" id="mort_female" type="number" min=0>
                                                                <label class="active" for="mort_female">Female Death</label>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="updated==false">
                                                            <div class="col s12 m6 l6 input-field">
                                                                <input v-model.number="mort_total" placeholder="Number dead of animals" id="mort_total" type="number" min=0>
                                                                <label class="active" for="mort_total">Total Death</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m6 l6">
                                                                <label>Reason</label>
                                                                <select v-model="mort_reason" class="browser-default">
                                                                    <option value="" disabled selected>Choose your option</option>
                                                                    <option value="Sickness">Sickness</option>
                                                                    <option value="Trauma - Natural">Trauma - Natural</option>
                                                                    <option value="Trauma - Predatory">Trauma - Predatory</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m6 l6 input-field">
                                                                <input v-model="mort_remarks" placeholder="Add remarks" id="mort_remarks" type="text">
                                                                <label for="mort_remarks" class="active">Remarks</label>
                                                            </div>
                                                        </div>
                                                        <div class="row center">
                                                            <div class="col s12 m12 l12">
                                                                <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action">Save
                                                                    <i class="far fa-save"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="sale">
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <form v-on:submit.prevent="addSalesRecord" method="post">
                                                        <div class="row">
                                                            <div class="col s12 m6 l6">
                                                                <label class="active" for="sale_date">Date Sold</label>
                                                                <datepicker id="sale_date" :format="customFormatter" v-model="sale_date" placeholder="Date when animals are sold"></datepicker>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="updated!=false">
                                                            <div class="col s12 m6 l6 input-field">
                                                                <input v-model.number="sale_male" placeholder="Number of sold male" id="sale_male" type="number" min=0>
                                                                <label class="active" for="sale_male">Male Sold</label>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="updated!=false">
                                                            <div class="col s12 m6 l6 input-field">
                                                                <input v-model.number="sale_female" placeholder="Number of sold female" id="sale_female" type="number" min=0>
                                                                <label class="active" for="sale_female">Female Sold</label>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="updated==false">
                                                            <div class="col s12 m6 l6 input-field">
                                                                <input v-model.number="sale_total" placeholder="Number of sold animals" id="sale_total" type="number" min=0>
                                                                <label class="active" for="sale_total">Total Sold</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m6 l6 input-field">
                                                                <input v-model.number="sale_price" placeholder="Price/kg" id="sale_price" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                                                <label class="active" for="sale_price">Price</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m6 l6 input-field">
                                                                <input v-model="sale_remarks" placeholder="Add remarks" id="sale_remarks" type="text">
                                                                <label for="sale_remarks" class="active">Remarks</label>
                                                            </div>
                                                        </div>
                                                        <div class="row center">
                                                            <div class="col s12 m12 l12">
                                                                <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action">Save
                                                                    <i class="far fa-save"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                    </div>
                </div>
                <div id="cull_modal" class="modal">
                    <div class="modal-content">
                        <h4 class="red-text"><i class="fas fa-exclamation-triangle"></i> Cull Replacement {{selected_inventory_tag}}?</h4>
                        <p>Are you sure you want to <strong>Cull</strong> this brooder group?</p>
                        <p>This action is <strong>irreversible</strong></p>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">No</a>
                        <a @click="cullBrooder()" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Yes</a>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    export default {
        components : {
            Datepicker
        },
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

                records : {},
                records_length : 0,
                updated : false,

                mort_date_died : '',
                mort_male : '',
                mort_female : '',
                mort_total : '',
                mort_reason : '',
                mort_remarks : '',

                sale_date : '',
                sale_male : '',
                sale_female : '',
                sale_total : '',
                sale_price : '',
                sale_remarks : '',
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
            getMortalitySale : function (page = 1) {
                axios.get('brooder_mortalitysale_record/'+this.selected_inventory_id+'?page='+page)
                .then(response => {
                    this.records = response.data;
                    this.records_length = this.records.data.length;
                })
                .catch(error => {
                    console.log(error);
                });
            },
            addSalesRecord : function () {
                axios.post('brooder_sale', {
                    brooder_id : this.selected_inventory_id,
                    date : this.customFormatter(this.sale_date),
                    male : this.sale_male,
                    female : this.sale_female,
                    total : this.sale_total,
                    price : this.sale_price,
                    remarks : this.sale_remarks,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.sale_date = '';
                        this.sale_male = '';
                        this.sale_female = '';
                        this.sale_total = '';
                        this.sale_remarks = '';
                        this.sale_price = '';
                        Materialize.toast('Successfully added sales record', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast(error, 3000, 'red rounded');
                });
                this.getMortalitySale();
                this.fetchPenInventory();
                $('#mortality').modal('close');
            },
            addMortalityRecord : function () {
                axios.post('brooder_mortality', {
                    brooder_id : this.selected_inventory_id,
                    date : this.customFormatter(this.mort_date_died),
                    male : this.mort_male,
                    female : this.mort_female,
                    total : this.mort_total,
                    reason : this.mort_reason,
                    remarks : this.mort_remarks,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.mort_date_died = '';
                        this.mort_male = '';
                        this.mort_female = '';
                        this.mort_tota = '';
                        this.mort_reason = '';
                        this.mort_remarks = '';
                        Materialize.toast('Successfully added mortality record', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast(error, 3000, 'red rounded');
                });
                this.getMortalitySale();
                this.fetchPenInventory();
                $('#mortality').modal('close');
            },
            cullBrooder : function () {
                axios.delete('cull_brooder/'+this.selected_inventory_id)
                .then(response => {
                    if(response.data.error == undefined){
                        this.selected_inventory_id = '';
                        $('#cull_modal').modal('close')
                        Materialize.toast('Successfully culled replacement', 5000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 5000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast('Failed to cull replacement', 5000, 'red rounded');
                });
                this.getMortalitySale();
                this.fetchPenInventory();
            },
            customFormatter : function(date) {
                return moment(date).format('YYYY-MM-DD');
            },
            capitalize : function (string) {
                var lower = string;
                var upper = lower.charAt(0).toUpperCase() + lower.substr(1);
                return upper;
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
            $('#mortality_sale').modal({
                dismissible : false,
            });
            $('#mortality').modal({
                dismissible : false,
            });
            $('#cull_modal').modal({
                dismissible : false,
            });
            $('ul.tabs').tabs();
        },
        destroyed () {
            $('.tooltipped').tooltip({delay: 50});
        },
    }
</script>
