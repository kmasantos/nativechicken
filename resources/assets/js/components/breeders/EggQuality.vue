<template>
    <div id="eggqualitymaindiv" class="row">
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
                                    <th class="tooltip" data-tippy-content="Date Collected"><i class="far fa-calendar-alt"></i></th>
                                    <th class="tooltip" data-tippy-content="Collected at Week"><i class="fas fa-calendar-week"></i></th>
                                    <th class="tooltip" data-tippy-content="Egg Weight"><i class="fas fa-weight-hanging"></i></th>
                                    <th class="tooltip" data-tippy-content="Egg Color"><i class="fas fa-palette"></i></th>
                                    <th class="tooltip" data-tippy-content="Egg Shape"><i class="fas fa-shapes"></i></th>
                                    <th class="tooltip" data-tippy-content="Egg Length"><i class="fas fa-ruler-vertical"></i></th>
                                    <th class="tooltip" data-tippy-content="Egg Width"><i class="fas fa-ruler-horizontal"></i></th>
                                    <th class="tooltip" data-tippy-content="Albumen Height"><i class="fas fa-ruler"></i></th>
                                    <th class="tooltip" data-tippy-content="Albumen Weight"><i class="fas fa-weight"></i></th>
                                    <th class="tooltip" data-tippy-content="Yolk Weight"><i class="fas fa-circle"></i></th>
                                    <th class="tooltip" data-tippy-content="Yolk Color"><i class="fas fa-swatchbook"></i></th>
                                    <th class="tooltip" data-tippy-content="Shell Weight"><i class="fas fa-balance-scale"></i></th>
                                    <th class="tooltip" data-tippy-content="Top Shell Thickness"><i class="fas fa-arrow-up"></i></th>
                                    <th class="tooltip" data-tippy-content="Middle Shell Thickness"><i class="fas fa-grip-lines"></i></th>
                                    <th class="tooltip" data-tippy-content="Bottom Shell Thickness"><i class="fas fa-arrow-down"></i></th>
                                    <th class="tooltip" data-tippy-content="Delete"><i class="far fa-trash-alt"></i></th>
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
                    <form v-on:submit.prevent="validateForm" method="POST">
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
                                            <label for="date_added">Date Collected <i v-if="check_date_collected===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i></label>
                                            <datepicker id="date_added" :format="customFormatter" v-model="date_collected"></datepicker>
                                        </div>
                                    </div>
                                    <label for="radio_age">Egg Quality at  <i v-if="check_egg_quality_at===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i></label>
                                    <div id="radio_age" class="row">
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
                                            <input v-if="animal_type===1" id="egg_weigth" type="number" min="30" max="55" class="validate" v-model="egg_weight" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <input v-if="animal_type===2" id="egg_weigth" type="number" min="40" max="70" class="validate" v-model="egg_weight" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label class="active" for="egg_weight">Egg Weight (g) 
                                                <i v-if="check_egg_weight===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i>
                                                <i v-if="(animal_type === 1 && egg_weight!=='' && (egg_weight<30 || egg_weight>55))" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be greater than or equal 30g but less than or equal 55g</i>
                                                <i v-if="(animal_type === 2 && egg_weight!=='' && (egg_weight<40 || egg_weight>70))" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be greater than or equal 30g but less than or equal 55g</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="length" type="number" min=0 class="validate" v-model="egg_length" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label class="active" for="length">Length (mm) <i v-if="check_egg_length===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i>
                                            <i v-if="(animal_type === 1 && egg_length!=='' && (egg_length<30 || egg_length>60))" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be greater than or equal 30mm but less than or equal 60mm</i>
                                            <i v-if="(animal_type === 2 && egg_length!=='' && (egg_length<45 || egg_length>60))" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be greater than or equal 45mm but less than or equal 60mm</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="width" type="number" min=0 class="validate" v-model="egg_width" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label class="active" for="width">Width (mm) <i v-if="check_egg_width===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i>
                                            <i v-if="(animal_type === 1 && egg_width!=='' && (egg_width<40 || egg_width>45))" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be greater than or equal to 40mm but less than or equal to 45mm</i>
                                            <i v-if="(animal_type === 2 && egg_width!=='' && (egg_width<35 || egg_width>45))" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be greater than or equal 35mm but less than than or equal 45mm</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="albumen_height" type="number" min=0 class="validate" v-model="albumen_height" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label class="active" for="albumen_height">Albument Height (mm) <i>(Optional)</i></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="albumen_weight" type="number" class="validate" v-model="albumen_weight" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label class="active" for="albumen_weight">Albumen Weight (mm) <i v-if="check_albumen_weight===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i>
                                            <i v-if="((albumen_weight!=='' && egg_weight!=='') && albumen_weight>egg_weight)" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be less than the egg weight </i>
                                            <i v-if="((egg_weight!=='' && albumen_weight!=='' && yolk_weight !== '' && shell_weight !== '') && (albumen_weight+yolk_weight+shell_weight)>egg_weight)" class="orange-text"><i class="fas fa-exclamation-circle"></i> Total input for albumen weight, yolk weight and shell weight should be less than or equal to the egg weight</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="yolk_weight" type="number" class="validate" v-model="yolk_weight" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label class="active" for="yolk_weight">Yolk Weight (g) <i v-if="check_yolk_weight===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i>
                                            <i v-if="((yolk_weight!=='' && egg_weight!=='') && yolk_weight>egg_weight)" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be less than the egg weight </i>
                                            <i v-if="((egg_weight!=='' && albumen_weight!=='' && yolk_weight !== '' && shell_weight !== '') && (albumen_weight+yolk_weight+shell_weight)>egg_weight)" class="orange-text"><i class="fas fa-exclamation-circle"></i> Total input for albumen weight, yolk weight and shell weight should be less than or equal to the egg weight</i>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="shell_weight" type="number" class="validate" v-model="shell_weight" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label class="active" for="shell_weight">Shell Weight (g) <i v-if="check_shell_weight===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i>
                                            <i v-if="((shell_weight!=='' && egg_weight!=='') && shell_weight>egg_weight)" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be less than the egg weight </i>
                                            <i v-if="((egg_weight!=='' && albumen_weight!=='' && yolk_weight !== '' && shell_weight !== '') && (albumen_weight+yolk_weight+shell_weight)>egg_weight)" class="orange-text"><i class="fas fa-exclamation-circle"></i> Total input for albumen weight, yolk weight and shell weight should be less than or equal to the egg weight</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="top" type="number" min=0 class="validate" v-model="thickness_top" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label class="active" for="top">Shell Thickness Top (mm) <i v-if="check_thickness_top===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i>
                                            <i v-if="(thickness_top!=='' && (thickness_top<0.25 || thickness_top>0.45))" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be greater than or equal to 0.25mm but less than or equal to 0.45mm</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="middle" type="number" min=0 class="validate" v-model="thickness_mid" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label class="active" for="middle">Shell Thickness Middle (mm) <i v-if="check_thickness_mid===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i>
                                            <i v-if="(thickness_mid!=='' && (thickness_mid<0.25 || thickness_mid>0.45))" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be greater than or equal to 0.25mm but less than or equal to 0.45mm</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <input id="bottom" type="number" min=0 class="validate" v-model="thickness_bot" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                            <label class="active" for="bottom">Shell Thickness Bottom (mm) <i v-if="check_thickness_bot===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i>
                                            <i v-if="(thickness_bot!=='' && (thickness_bot<0.25 || thickness_bot>0.45))" class="orange-text"><i class="fas fa-exclamation-circle"></i> Input should be greater than or equal to 0.25mm but less than or equal to 0.45mm</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 l6">
                                            <label>Egg Color <i v-if="check_egg_color===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i></label>
                                            <select v-model="egg_color" class="browser-default">
                                                <option value="" disabled selected>Choose your option</option>
                                                <option value="Cream" style="background-color:#fefdf8;border-color:1px solid black">Cream</option>
                                                <option value="Brown" style="background-color:#b3958b;border-color:1px solid black">Brown</option>
                                                <option value="Dark Brown" style="background-color:#815339;border-color:1px solid black">Dark Brown</option>
                                                <option value="Light Brown" style="background-color:#a69b97;border-color:1px solid black">Light Brown</option>
                                                <option value="White" style="background-color:#e1f2fa;border-color:1px solid black">White</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 l6">
                                            <label>Egg Shape <i v-if="check_egg_shape===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i></label>
                                            <select v-model="egg_shape" class="browser-default">
                                                <option value="" disabled selected>Choose your option</option>
                                                <option value="Ovoid">Ovoid</option>
                                                <option value="Circle">Circle</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 l6">
                                            <label>Egg Color <i v-if="check_yolk_color===false" class="red-text"><i class="fas fa-times-circle"></i> Input required</i></label>
                                            <select v-model="yolk_color" class="browser-default">
                                                <option value="" disabled selected>Choose your option</option>
                                                <option value="1" style="background-color:#f7d483;border-color:1px solid black">1</option>
                                                <option value="2" style="background-color:#fcd16b;border-color:1px solid black">2</option>
                                                <option value="3" style="background-color:#fdd25f;border-color:1px solid black">3</option>
                                                <option value="4" style="background-color:#fed235;border-color:1px solid black">4</option>
                                                <option value="5" style="background-color:#fecb00;border-color:1px solid black">5</option>
                                                <option value="6" style="background-color:#ffc700;border-color:1px solid black">6</option>
                                                <option value="7" style="background-color:#fec200;border-color:1px solid black">7</option>
                                                <option value="8" style="background-color:#fec200;border-color:1px solid black">8</option>
                                                <option value="9" style="background-color:#feba01;border-color:1px solid black">9</option>
                                                <option value="10" style="background-color:#fdb200;border-color:1px solid black">10</option>
                                                <option value="11" style="background-color:#fea900;border-color:1px solid black">11</option>
                                                <option value="12" style="background-color:#fe9b00;border-color:1px solid black">12</option>
                                                <option value="13" style="background-color:#fd9800;border-color:1px solid black">13</option>
                                                <option value="14" style="background-color:#ff8b00;border-color:1px solid black">14</option>
                                                <option value="15" style="background-color:#ff7f1a;border-color:1px solid black">15</option>
                                                <option value="16" style="background-color:#fe6722;border-color:1px solid black">16</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                            <button class="modal-action waves-effect waves-green btn-flat" type="submit">Submit</button>
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
                        <a @click.prevent="deleteEggQualityRecord" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-gray btn-flat">Yes</a>
                        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-gray btn-flat">No</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import tippy from 'tippy.js';
    import Datepicker from 'vuejs-datepicker';
    Vue.component('pagination', require('laravel-vue-pagination'));
    var moment = require('moment');
    export default {
        components : {
            Datepicker
        },
        props: [
            'breeder', 'breeder_tag', 'animal_type'
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

                check_date_collected : true,
                check_egg_quality_at : true,
                check_egg_weight : true,
                check_egg_color : true,
                check_egg_shape : true,
                check_egg_length : true,
                check_egg_width : true,
                check_albumen_weight : true,
                check_yolk_weight : true,
                check_yolk_color : true,
                check_shell_weight : true,
                check_thickness_top : true,
                check_thickness_mid : true,
                check_thickness_bot : true,
                error : [],
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
            validateForm : function () {
                if(this.date_collected === '' || this.egg_quality_at === '' || this.egg_weight === '' || this.egg_color === '' ||
                this.egg_shape === '' || this.egg_length === '' || this.egg_width === '' || this.albumen_weight === '' ||
                this.yolk_weight === '' || this.yolk_color === "" || this.shell_weight === '' || this.thickness_top === '' || 
                this.thickness_mid === '' || this.thickness_bot === ''){
                    if(this.date_collected === '') {this.check_date_collected = false} else {this.check_date_collected=true}
                    if(this.egg_quality_at === '') {this.check_egg_quality_at = false} else {this.check_egg_quality_at = true}
                    if(this.egg_weight === '') {this.check_egg_weight = false} else {this.check_egg_weight = true}
                    if(this.egg_color === '') {this.check_egg_color = false} else {this.check_egg_color = true}
                    if(this.egg_shape === '') {this.check_egg_shape = false} else {this.check_egg_shape = true}
                    if(this.egg_length === '') {this.check_egg_length = false} else {this.check_egg_length = true}
                    if(this.egg_width === '') {this.check_egg_width = false} else {this.check_egg_width = true}
                    if(this.albumen_weight === '') {this.check_albumen_weight = false} else {this.check_albumen_weight = true}
                    if(this.yolk_weight === '') {this.check_yolk_weight = false} else {this.check_yolk_weight = true}
                    if(this.yolk_color === '') {this.check_yolk_color = false} else {this.check_yolk_color = true}
                    if(this.shell_weight === '') {this.check_shell_weight = false} else {this.check_shell_weight = true}
                    if(this.thickness_top === '') {this.check_thickness_top = false} else {this.check_thickness_top = true}
                    if(this.thickness_mid === '') {this.check_thickness_mid = false} else {this.check_thickness_mid = true}
                    if(this.thickness_bot === '') {this.check_thickness_bot = false} else {this.check_thickness_bot = true}
                    return;
                }else{
                    if((this.albumen_weight + this.yolk_weight + this.shell_weight)>this.egg_weight){
                        Materialize.toast('Total of Albumen Weight ('+this.albumen_weight+'), Yolk Weight ('+this.yolk_weight+') & Shell Weight (' +this.shell_weight+') should be less than or equal to Egg Weight ('+this.egg_weight+')' , 5000, 'rounded')
                        return;
                    }
                    this.addEggQualityRecord();
                }

            },
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            },
            closeEggQual : function () {
                this.$emit('close_eggqual', null)
            }
        },
        mounted() {
            tippy('#eggqualitymaindiv', {
                target : '.tooltip',
                arrow: true,
                arrowType: 'round',
                animation: 'scale',
                inertia: true,
            });
            $('#eggquality').modal({
                dismissible : false,
            });
            $('#delete_eggqual').modal({
                dismissible : false,
            });
            this.initialize();
        },
        
    }
</script>

<style scoped>
    .modal {
        height: 90%;
        width: 80%;
    }
</style>
