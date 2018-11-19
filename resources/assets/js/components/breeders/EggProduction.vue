<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <!-- Egg Production Record -->
                <div class="row" v-show="hide_record==false">
                    <div class="col s6 m6 l6">
                        <h5>Egg Production | {{breeder_tag}}</h5>
                    </div>
                    <div class="col s3 m3 l3 right-align">
                        <a @click="add_record=true; hide_record=true" class="waves-effect waves-green btn-flat green-text"><i class="fas fa-plus-circle left"></i>Add</a>
                    </div>
                    <div class="col s3 m3 l3 center-align">
                        <a v-on:click="closeEggProduction" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
                    </div>
                </div>
                <div v-show="hide_record==false">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="responsive-table bordered highlight centered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Total Intact</th>
                                        <th>Total Weight</th>
                                        <th>Broken</th>
                                        <th>Rejected</th>
                                        <th>Remarks</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-if="eggprod_length == 0">
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr v-else v-for="prod in eggprod.data" :key="prod.id">
                                        <td>{{prod.date_collected}}</td>
                                        <td>{{prod.total_eggs_intact}}</td>
                                        <td>{{prod.total_egg_weight}}</td>
                                        <td>{{prod.total_broken}}</td>
                                        <td>{{prod.total_rejects}}</td>
                                        <td>{{prod.remarks}}</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                            <pagination :data="eggprod" @pagination-change-page="fetchEggProductionRecord"></pagination>
                        </div>
                    </div>
                </div>

                <!-- Egg Production Form -->
                <div class="row" v-show="add_record!=null">
                    <div class="col s12 m12 l12">
                        <form v-on:submit.prevent="addEggProduction" method="post">
                            <div class="row valign-wrapper">
                                <div class="col s9 m19 l9">
                                    <h5>Add Egg Production | {{breeder_tag}}</h5>
                                </div>
                                <div class="col s3 m3 l3 center-align">
                                    <a @click="add_record=null; hide_record=false" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label for="date_added">Date Collected</label>
                                    <datepicker id="date_added" :format="dateFormatter" v-model="date_collected"></datepicker>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 s6 m6 input-field">
                                    <input v-model.number="total_eggs_intact" class="validate" placeholder="Total Eggs that passes as good" id="intact" type="number" min="0" validate>
                                    <label class="active" for="intact">Total Eggs Intact</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 s6 m6 input-field">
                                    <input v-model.number="total_egg_weight" class="validate" placeholder="Totall egg weight of all intact eggs" id="total_weight" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                    <label class="active" for="total_weight">Total Egg Weight</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 s6 m6 input-field">
                                    <input v-model.number="total_broken" class="validate" placeholder="Total Eggs that were broken" id="total_broken" type="number" min="0" validate>
                                    <label class="active" for="total_broken">Total Eggs Broken</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 s6 m6 input-field">
                                    <input v-model.number="total_rejects" class="validate" placeholder="Total Eggs that doesn't pass as good condition" id="total_rejects" type="number" min="0" validate>
                                    <label class="active" for="total_rejects">Total Eggs Rejected</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 s6 m6 input-field">
                                    <input v-model="remarks" placeholder="Add remarks" id="egg_prod_remarks" type="text">
                                    <label class="active" for="egg_prod_remarks">Remarks</label>
                                </div>
                            </div>
                            <div class="row center">
                                <div class="col s12 m12 l12">
                                    <button class="btn waves-effect waves-light blue-grey" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    export default {
        components : {
            Datepicker,
        },
        props :{
            breeder : Number,
            breeder_tag : String,
        },
        data (){
            return {
                eggprod : {},
                eggprod_length : 0,

                // form data
                date_collected : '',
                total_eggs_intact : '',
                total_egg_weight : '',
                total_broken : '',
                total_rejects : '',
                remarks : '',

                add_record : null,
                selected_record : null,
                hide_record : false,
            }
        },
        methods : {
            initialize : function () {
                this.fetchEggProductionRecord();
            },
            fetchEggProductionRecord : function (page = 1) {
                axios.get('breeder_eggprod/'+this.breeder+"?page="+page)
                .then(response => {
                    this.eggprod = response.data;
                    this.eggprod_length = this.eggprod.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addEggProduction : function () {
                axios.post('breeder_add_eggprod', {
                    breeder_id: this.breeder,
                    date_added : this.dateFormatter(this.date_collected),
                    total_eggs_intact : this.total_eggs_intact,
                    total_egg_weight : this.total_egg_weight,
                    total_broken : this.total_broken,
                    total_rejects : this.total_rejects,
                    remarks : this.egg_prod_remarks,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.date_collected = '';
                        this.total_eggs_intact = '';
                        this.total_egg_weight = '';
                        this.total_broken = '';
                        this.total_rejects = '';
                        this.remarks = '';
                        Materialize.toast('Successfully added egg production record', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }

                })
                .catch(error => {
                    Materialize.toast('Failed to add egg production record', 3000, 'red rounded');
                });
                this.initialize();
            },
            dateFormatter : function (date) {
                return moment(date).format('YYYY-MM-DD');
            },
            closeEggProduction: function () {
                this.$emit('close_eggprod', null)
            }
        },
        created () {
            this.initialize();
        },
        beforeCreate() {
            $('.tooltipped').tooltip('remove');
        },
        destroyed () {
            $('.tooltipped').tooltip({delay: 50});
        },

    }
</script>
