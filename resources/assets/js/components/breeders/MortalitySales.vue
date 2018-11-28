<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <div class="row valign-wrapper">
                    <div class="col s6 m6 l6">
                        <h5>Mortality & Sales | {{breeder_tag}}</h5>
                    </div>
                    <div class="col s3 m3 l3 center">
                        <a class="waves-effect waves-green btn-flat green-text modal-trigger" href="#mortality"><i class="fas fa-plus-circle left"></i>Add</a>
                    </div>
                    <div class="col s3 m3 l3">
                        <a v-on:click="closeMortalitySales" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
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
                                <th>Price</th>
                                <th>Reason</th>
                                <th>Remarks</th>
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
                                    <td v-if="record.remarks == null">-</td>
                                    <td v-else>{{record.remarks}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="mortality" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Mortality & Sales | {{breeder_tag}}</h4>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="card">
                                <div class="card-content">
                                    <p><i class="fas fa-exclamation-circle"></i> Go to <strong>Mortality</strong> tab to report animal death.</p>
                                    <p><i class="fas fa-exclamation-circle"></i> Go to <strong>Sales</strong> tab to report animal sales.</p>
                                    <p><i class="fas fa-exclamation-circle"></i> Go to <strong>Egg Sales</strong> tab to report egg sales.</p>
                                </div>
                                <div class="card-tabs">
                                <ul class="tabs tabs-fixed-width">
                                    <li class="tab"><a href="#mort">Mortality</a></li>
                                    <li class="tab"><a href="#sale">Sales</a></li>
                                    <li class="tab"><a href="#egg">Egg Sales</a></li>
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
                                                    <div class="row">
                                                        <div class="col s12 m6 l6 input-field">
                                                            <input v-model.number="mort_male" placeholder="Number dead of male" id="mort_male" type="number" min=0>
                                                            <label class="active" for="mort_male">Male Death</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m6 l6 input-field">
                                                            <input v-model.number="mort_female" placeholder="Number dead of female" id="mort_female" type="number" min=0>
                                                            <label class="active" for="mort_female">Female Death</label>
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
                                                    <div class="row">
                                                        <div class="col s12 m6 l6 input-field">
                                                            <input v-model.number="sale_male" placeholder="Number of sold male" id="sale_male" type="number" min=0>
                                                            <label class="active" for="sale_male">Male Sold</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m6 l6 input-field">
                                                            <input v-model.number="sale_female" placeholder="Number of sold female" id="sale_female" type="number" min=0>
                                                            <label class="active" for="sale_female">Female Sold</label>
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
                                    <div id="egg">
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <form v-on:submit.prevent="addEggSalesRecord" method="post">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="egg_date">Date Eggs Sold</label>
                                                            <datepicker id="egg_date" :format="customFormatter" v-model="egg_date" placeholder="Date when eggs are sold"></datepicker>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m6 l6 input-field">
                                                            <input v-model.number="sale_eggs" placeholder="Number of eggs sold" id="sale_eggs" type="number" min=0>
                                                            <label class="active" for="sale_eggs">Number Sold</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m6 l6 input-field">
                                                            <input v-model.number="egg_price" placeholder="Price/piece" id="egg_price" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                                            <label class="active" for="egg_price">Price</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m6 l6 input-field">
                                                            <input v-model="egg_remarks" placeholder="Add remarks" id="egg_remarks" type="text">
                                                            <label for="egg_remarks" class="active">Remarks</label>
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
            'breeder', 'breeder_tag'
        ],
        data () {
            return {
                records : {},
                records_length : 0,

                mort_date_died : '',
                mort_male : '',
                mort_female : '',
                mort_reason : '',
                mort_remarks : '',

                sale_date : '',
                sale_male : '',
                sale_female : '',
                sale_price : '',
                sale_remarks : '',

                egg_date : '',
                sale_eggs : '',
                egg_price : '',
                egg_remarks : '',
            }
        },
        methods : {
            getMortalitySale : function (page = 1) {
                axios.get('breeder_mortalitysale_record/'+this.breeder+'?page='+page)
                .then(response => {
                    this.records = response.data;
                    this.records_length = this.records.data.length;
                })
                .catch(error => {
                    console.log(error);
                });
            },
            addSalesRecord : function () {
                axios.post('breeder_sale', {
                    breeder_id : this.breeder,
                    date : this.customFormatter(this.sale_date),
                    male : this.sale_male,
                    female : this.sale_female,
                    price : this.sale_price,
                    remarks : this.sale_remarks,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.sale_date = '',
                        this.sale_male = '',
                        this.sale_female = '',
                        this.sale_remarks = '',
                        this.sale_price = '',
                        Materialize.toast('Successfully added sales record', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast(error, 3000, 'red rounded');
                });
                this.getMortalitySale();
            },
            addMortalityRecord : function () {
                axios.post('breeder_mortality', {
                    breeder_id : this.breeder,
                    date : this.customFormatter(this.mort_date_died),
                    male : this.mort_male,
                    female : this.mort_female,
                    reason : this.mort_reason,
                    remarks : this.mort_remarks,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.mort_date_died = '',
                        this.mort_male = '',
                        this.mort_female = '',
                        this.mort_reason = '',
                        this.mort_remarks = '',
                        Materialize.toast('Successfully added mortality record', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast(error, 3000, 'red rounded');
                });
                this.getMortalitySale();
            },
            addEggSalesRecord : function () {
                axios.post('breeder_egg_sale', {
                    breeder_id : this.breeder,
                    date : this.customFormatter(this.egg_date),
                    eggs : this.sale_eggs,
                    price : this.egg_price,
                    remarks : this.egg_remarks,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.egg_date = '',
                        this.sale_eggs = '',
                        this.egg_price = '',
                        this.egg_remarks = '',
                        Materialize.toast('Successfully added egg sales record', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast(error, 3000, 'red rounded');
                });
                this.getMortalitySale();
            },
            closeMortalitySales : function () {
                this.$emit('close_mortality', null);
            },
            customFormatter : function(date) {
                return moment(date).format('YYYY-MM-DD');
            },
            capitalize : function (string) {
                var lower = string;
                var upper = lower.charAt(0).toUpperCase() + lower.substr(1);
                return upper;
            },
        },
        beforeCreate () {
            $('.tooltipped').tooltip('remove');
        },
        created () {
            this.getMortalitySale();
        },
        destroyed () {
            $('.tooltipped').tooltip({delay: 50});
        },
        mounted () {
            $('#mortality').modal({
                dismissible : false,
            });
            $('ul.tabs').tabs();
        },
    }
</script>
