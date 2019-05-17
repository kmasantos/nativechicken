<template>
    <div class="row">
        <div class="col s12 m12 m12">
            <div class="card-panel blue-grey lighten-5">
                <div class="row">
                    <div class="col s6 m6 l6">
                        <h5>Egg Quality Records | {{breeder_tag}}</h5>
                    </div>
                    <div class="col s3 m3 l3 right-align">
                        <a href="#eggquality" class="waves-effect waves-green btn-flat green-text modal-trigger"><i class="fas fa-plus-circle left"></i>Add</a>
                    </div>
                    <div class="col s3 m3 l3 center-align">
                        <a v-on:click="closeEggQual" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="responsive-table centered bordered highlight">
                            <thead>
                                <tr>
                                    <th class="tooltipped" data-tooltip="Date Collected">Date</th>
                                    <th class="tooltipped" data-tooltip="Collected at Week">Week</th>
                                    <th class="tooltipped" data-tooltip="Weight">Wt</th>
                                    <th class="tooltipped" data-tooltip="Color">C</th>
                                    <th class="tooltipped" data-tooltip="Shape">S</th>
                                    <th class="tooltipped" data-tooltip="Length">L</th>
                                    <th class="tooltipped" data-tooltip="Width">Wd</th>
                                    <th class="tooltipped" data-tooltip="Albumen Height">AH</th>
                                    <th class="tooltipped" data-tooltip="Albumen Weight">AW</th>
                                    <th class="tooltipped" data-tooltip="Yolk Weight">YW</th>
                                    <th class="tooltipped" data-tooltip="Yolk Color">YC</th>
                                    <th class="tooltipped" data-tooltip="Shell Weight">SW</th>
                                    <th class="tooltipped" data-tooltip="Top Shell Thickness">TT</th>
                                    <th class="tooltipped" data-tooltip="Middle Shell Thickness">MT</th>
                                    <th class="tooltipped" data-tooltip="Bottom Shell Thickness">BT</th>
                                    <th class="tooltipped" data-tooltip="Delete"><i class="far fa-trash-alt"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="eggqualities_length == 0">
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
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr v-else v-for="qualities in eggqualities.data" :key="qualities.qual_id">
                                    <td>{{qualities.date_collected}}</td>
                                    <td>{{qualities.egg_quality_at}}</td>
                                    <td v-if="qualities.weight == null">-</td>
                                    <td v-else>{{qualities.weight.toFixed(3)}}</td>
                                    <td v-if="qualities.color == null">-</td>
                                    <td v-else>{{qualities.color}}</td>
                                    <td v-if="qualities.shape == null">-</td>
                                    <td v-else>{{qualities.shape}}</td>
                                    <td v-if="qualities.length == null">-</td>
                                    <td v-else>{{qualities.length.toFixed(3)}}</td>
                                    <td v-if="qualities.width == null">-</td>
                                    <td v-else>{{qualities.width.toFixed(3)}}</td>
                                    <td v-if="qualities.albumen_height == null">-</td>
                                    <td v-else>{{qualities.albumen_height.toFixed(3)}}</td>
                                    <td v-if="qualities.albumen_weight == null">-</td>
                                    <td v-else>{{qualities.albumen_weight.toFixed(3)}}</td>
                                    <td v-if="qualities.yolk_weight == null">-</td>
                                    <td v-else>{{qualities.yolk_weight.toFixed(3)}}</td>
                                    <td v-if="qualities.yolk_color == null">-</td>
                                    <td v-else>{{qualities.yolk_color}}</td>
                                    <td v-if="qualities.shell_weight == null">-</td>
                                    <td v-else>{{qualities.shell_weight.toFixed(3)}}</td>
                                    <td v-if="qualities.thickness_top == null">-</td>
                                    <td v-else>{{qualities.thickness_top.toFixed(3)}}</td>
                                    <td v-if="qualities.thickness_mid == null">-</td>
                                    <td v-else>{{qualities.thickness_mid.toFixed(3)}}</td>
                                    <td v-if="qualities.thickness_bot == null">-</td>
                                    <td v-else>{{qualities.thickness_bot.toFixed(3)}}</td>
                                    <td><a @click="selected_eggqual_record = qualities" href="#delete_eggqual" class="modal-trigger"><i class="far fa-trash-alt"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row center">
                    <div class="col s12 m12 l12">
                        <pagination :data="eggqualities" @pagination-change-page="fetchEggQualityRecord"></pagination>
                    </div>
                </div>
                <div id="eggquality" class="modal modal-fixed-footer">
                    <form v-on:submit.prevent="addEggQualityRecord" method="POST">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h4>Egg Quality | {{breeder_tag}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="row">
                                        <div class="col s12 m6 l6">
                                            <label for="date_added">Date Collected</label>
                                            <datepicker id="date_added" :format="customFormatter" v-model="date_collected"></datepicker>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m3 l3">
                                            <input @change="others=false" class="with-gap" name="egg_quality_at" v-model="egg_quality_at" type="radio" id="egg_quality_35" value = "35"/>
                                            <label for="egg_quality_35">35 Weeks of Age</label>
                                        </div>
                                        <div class="col s12 m3 l3">
                                            <input @change="others=false" class="with-gap" name="egg_quality_at" v-model="egg_quality_at" type="radio" id="egg_quality_40" value = "40"/>
                                            <label for="egg_quality_40">40 Weeks of Age</label>
                                        </div>
                                        <div class="col s12 m3 l3">
                                            <input @change="others=false" class="with-gap" name="egg_quality_at" v-model="egg_quality_at" type="radio" id="egg_quality_60" value = "60"/>
                                            <label for="egg_quality_60">60 Weeks of Age</label>
                                        </div>
                                        <div class="col s12 m3 l3">
                                            <input @change="others=true" class="with-gap" name="egg_quality_at" v-model="egg_quality_at" type="radio" id="egg_quality_others" value = "Others"/>
                                            <label for="egg_quality_others">Others</label>
                                        </div>
                                    </div>
                                    <div class="row" v-if="others">
                                        <div class="col s12 m6 l6">
                                            <input v-model="egg_quality_at" type="number" min=0 placeholder="Input egg quality at week"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="egg_weigth" type="number" min=0 class="validate" v-model="egg_weight" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="egg_weight">Egg Weight (g)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="egg_color" type="text" class="validate" v-model="egg_color" placeholder="e.g. Brown, Cream">
                                            <label for="egg_color">Egg Color</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="egg_shape" type="text" class="validate" v-model="egg_shape" placeholder="e.g. Ovoid">
                                            <label for="egg_shape">Egg Shape</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="length" type="number" min=0 class="validate" v-model="egg_length" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="length">Length (mm)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="width" type="number" min=0 class="validate" v-model="egg_width" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="width">Width (mm)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="abumen_height" type="number" min=0 class="validate" v-model="albumen_height" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="albumen_height">Albument Height (mm)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="albumen_weight" type="number" class="validate" v-model="albumen_weight" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="albumen_weight">Albumen Weight (mm)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="yolk_weight" type="number" class="validate" v-model="yolk_weight" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="yolk_weight">Yolk Weight (g)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="yolk_color" type="text" class="validate" v-model="yolk_color">
                                            <label for="yolk_color">Yolk Color</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="shell_weight" type="number" class="validate" v-model="shell_weight" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="shell_weight">Shell Weight (g)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="top" type="number" min=0 class="validate" v-model="thickness_top" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="top">Shell Thickness Top (mm)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="middle" type="number" min=0 class="validate" v-model="thickness_mid" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="middle">Shell Thickness Middle (mm)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="bottom" type="number" min=0 class="validate" v-model="thickness_bot" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label for="bottom">Shell Thickness Bottom (mm)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                            <button class="modal-action modal-close waves-effect waves-green btn-flat" type="submit">Submit</button>
                        </div>
                    </form>
                </div>

                <div id="delete_eggqual" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h4>Delete Record</h4>
                            </div>
                        </div>
                        <div class="row valign-wrapper">
                            <div class="col s2 m2 l2 red-text center-align">
                                <h4><i class="fas fa-exclamation-triangle"></i></h4>
                            </div>
                            <div class="col s10 m10 l10">
                                <p>Are you sure you want to <strong>Delete</strong> this egg quality record?</p>
                                <blockquote>
                                    <span>Date Collected : {{selected_eggqual_record.date_collected}}</span><br>
                                    <span>Collected at Week : {{selected_eggqual_record.egg_quality_at}}</span><br>
                                    <span>Egg Weight : {{selected_eggqual_record.weight}}</span><br>
                                    <span>Egg Color : {{selected_eggqual_record.color}}</span><br>
                                    <span>Egg Shape : {{selected_eggqual_record.shape}}</span><br>
                                    <span>Length : {{selected_eggqual_record.length}}</span><br>
                                    <span>Width : {{selected_eggqual_record.width}}</span><br>
                                    <span>Albumen Height : {{selected_eggqual_record.albumen_height}}</span><br>
                                    <span>Albumen Weight : {{selected_eggqual_record.albumen_weight}}</span><br>
                                    <span>Yolk Weight : {{selected_eggqual_record.yolk_weight}}</span><br>
                                    <span>Yolk Color : {{selected_eggqual_record.yolk_color}}</span><br>
                                    <span>Shell Weight : {{selected_eggqual_record.shell_weight}}</span><br>
                                    <span>Shell Thickness Top : {{selected_eggqual_record.thickness_top}}</span><br>
                                    <span>Shell Thickness Middle : {{selected_eggqual_record.thickness_mid}}</span><br>
                                    <span>Shell Thickness Bottom : {{selected_eggqual_record.thickness_bot}}</span><br>
                                </blockquote>
                                <p>This action is <strong>Irreversible</strong>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a @click.prevent="deleteEggQualityRecord" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Yes</a>
                        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">No</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    Vue.component('pagination', require('laravel-vue-pagination'));
    var moment = require('moment');
    export default {
        components : {
            Datepicker
        },
        props: [
            'breeder', 'breeder_tag'
        ],
        data()  {
            return {
                eggqualities : {},
                eggqualities_length : 0,

                others : false,
                date_collected : '',
                egg_quality_at : '',
                egg_weight : '',
                egg_color : '',
                egg_shape : '',
                egg_length : '',
                egg_width : '',
                albumen_height : '',
                albumen_weight : '',
                yolk_weight : '',
                yolk_color : '',
                shell_weight : '',
                thickness_top : '',
                thickness_mid : '',
                thickness_bot : '',

                selected_eggqual_record : '',
            }
        },
        methods : {
            initialize : function () {
                this.fetchEggQualityRecord();
            },
            fetchEggQualityRecord : function (page = 1) {
                axios.get('breeder_eggquality/'+this.breeder+'?page='+page)
                .then(response => {
                    this.eggqualities = response.data;
                    this.eggqualities_length = this.eggqualities.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addEggQualityRecord : function () {
                axios.post('breeder_add_eggquality', {
                    breeder_id : this.breeder,
                    date_collected : this.customFormatter(this.date_collected),
                    egg_quality_at : this.egg_quality_at,
                    egg_weight : this.egg_weight,
                    egg_color : this.egg_color,
                    egg_shape : this.egg_shape,
                    egg_length : this.egg_length,
                    egg_width : this.egg_width,
                    albumen_height : this.albumen_height,
                    albumen_weight : this.albumen_weight,
                    yolk_weight : this.yolk_weight,
                    yolk_color : this.yolk_color,
                    shell_weight : this.shell_weight,
                    thickness_top : this.thickness_top,
                    thickness_mid : this.thickness_mid,
                    thickness_bot : this.thickness_bot,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.others = false,
                        this.date_collected = '';
                        this.egg_quality_at = '';
                        this.egg_weight = '';
                        this.egg_color = '';
                        this.egg_shape = '';
                        this.egg_length = '';
                        this.egg_width = '';
                        this.albumen_height = '';
                        this.albumen_weight = '';
                        this.yolk_weight = '';
                        this.yolk_color = '';
                        this.shell_weight = '';
                        this.thickness_top = '';
                        this.thickness_mid = '';
                        this.thickness_bot = '';
                        Materialize.toast('Successfully added egg quality record', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast('Failed to add egg quality record', 3000, 'red rounded');
                });
                this.initialize();
            },
            deleteEggQualityRecord : function () {
                axios.delete('breeder_delete_eggquality/' + this.selected_eggqual_record.qual_id)
                .then(response => {
                    this.selected_eggqual_record = '';
                    Materialize.toast('Successfully deleted egg quality record', 5000, 'green rounded');
                })
                .catch(error => {
                    Materialize.toast('Failed to delete egg quality record', 5000, 'red rounded');
                });
                this.fetchEggQualityRecord();
            },
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            },
            closeEggQual : function () {
                this.$emit('close_eggqual', null)
            }
        },
        beforeCreate() {
            $('.tooltipped').tooltip('remove');
        },
        mounted() {
            $('#eggquality').modal({
                dismissible : false,
            });
            $('#delete_eggqual').modal({
                dismissible : false,
            });
            $('.tooltipped').tooltip({
                delay: 50,
                position: "top",
            });
        },
        created() {
            this.initialize();
        },
        destroyed () {
            $('.tooltipped').tooltip('remove');
            $('.tooltipped').tooltip({delay: 50});
        },
    }
</script>
