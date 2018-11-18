<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <div class="row valign-wrapper">
                    <div class="col s6 m6 l6">
                        <h5>{{breeder_tag}} Mortality & Sales</h5>
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
                                <th>Male</th>
                                <th>Female</th>
                                <th>Total</th>
                                <th>Price</th>
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
                                </tr>
                                <tr v-for="record in records.data" :key="record.id">
                                    <td>{{record.date}}</td>
                                    <td>{{record.category}}</td>
                                    <td>{{record.male}}</td>
                                    <td>{{record.female}}</td>
                                    <td>{{record.total}}</td>
                                    <td>{{record.price}}</td>
                                    <td>{{record.reason}}</td>
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
                            <h4>{{breeder_tag}} Mortality & Sales</h4>
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

                                </div>
                                <div id="sale">

                                </div>
                                <div id="egg">

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
            closeMortalitySales : function () {
                this.$emit('close_mortality', null);
            }
        },
        beforeCreate () {
            $('.tooltipped').tooltip('remove');
        },
        created () {
            $('.tooltipped').tooltip({delay: 50});
            this.getMortalitySale();
        },
        destroyed () {

        },
        mounted () {
            $('#mortality').modal({
                dismissible : false,
            });
            $('ul.tabs').tabs();
        },
    }
</script>
