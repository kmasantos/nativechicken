<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel blue-grey lighten-5">
                <div class="row valign-wrapper">
                    <div class="col s6 m6 l6">
                        <h5>Phenotypic & Morphometric | {{breeder_tag}}</h5>
                    </div>
                    <div class="col s3 m3 l3 center">
                        <a class="waves-effect waves-green btn-flat green-text modal-trigger" href="#breeder_phenomorpho"><i class="fas fa-plus-circle left"></i>Add</a>
                    </div>
                    <div class="col s3 m3 l3">
                        <a v-on:click="closePhenoMorpho" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="bordered highlight responsive-table centered">
                            <thead>
                                <tr>
                                    <th class="tooltipped" data-tooltip="Date Data Collected"><i class="far fa-calendar"></i></th>
                                    <th class="tooltipped" data-tooltip="Gender"><i class="fas fa-venus-mars"></i></th>
                                    <th class="tooltipped" data-tooltip="Wingband ID"><i class="fas fa-tag"></i></th>
                                    <th class="tooltipped" data-tooltip="Phenotypic Data"><i class="fas fa-eye"></i></th>
                                    <th class="tooltipped" data-tooltip="Morphometric Data"><i class="fas fa-sort-numeric-down"></i></th>
                                    <th class="tooltipped" data-tooltip="Delete Record"><i class="far fa-trash-alt"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="records_length == 0">
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr v-for="record in records.data" :key="record.phenomorpho_id">
                                    <td>{{record.date_collected}}</td>
                                    <td>{{capitalize(record.gender)}}</td>
                                    <td>{{record.tag}}</td>
                                    <td>{{record.phenotypic.substring(1, record.phenotypic. length-1)}}</td>
                                    <td>{{record.morphometric.substring(1, record.morphometric. length-1)}}</td>
                                    <td><a @click="selected_record = record" href="#delete_phenomorpho" class="modal-trigger"><i class="far fa-trash-alt"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12 center">
                        <pagination :data="records" @pagination-change-page="getBreederPhenoMorpho"></pagination>
                    </div>
                </div>
            </div>
            <div id="breeder_phenomorpho" class="modal modal-fixed-footer">
                <form v-on:submit.prevent="addBreederPhenoMorpho">
                    <div class="modal-content">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h4>Add Phenotypic and Morphometric Data | {{breeder_tag}}</h4>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="card">
                                    <div class="card-content">
                                        <p><i class="fas fa-exclamation-circle"></i> Click Phenotypic tab to display the phenotypic data form.</p>
                                        <p><i class="fas fa-exclamation-circle"></i> Click Morphometric tab to display the morphometric data form.</p>
                                        <p><i class="fas fa-exclamation-circle"></i> Complete Phenotypic and Morphometric Data before submitting the form.</p>
                                    </div>
                                    <div class="card-tabs">
                                    <ul class="tabs tabs-fixed-width">
                                        <li class="tab"><a href="#pheno">Phenotypic</a></li>
                                        <li class="tab"><a href="#morpho">Morphometric</a></li>
                                    </ul>
                                    </div>
                                    <div class="card-content grey lighten-4">
                                        <div id="pheno">
                                            <!-- Pheno -->
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <label for="type_selector">Select Data to Input</label>
                                                    <div id="type_selector" class="switch">
                                                        <label>
                                                        Chicken
                                                        <input type="checkbox" v-model="duck">
                                                        <span class="lever"></span>
                                                        Duck
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <label for="date_added">Date Collected</label>
                                                    <datepicker id="date_added" :format="customFormatter" v-model="date_collected" placeholder="Date when data is entered"></datepicker>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l6 input-field">
                                                    <input v-model="tag" id="tag" type="text" placeholder="Tag or Registry ID">
                                                    <label class="active" for="tag">Tag</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <label>Gender</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input v-model="gender" class="with-gap" type="radio" id="gender_male"  value="male"/>
                                                            <label for="gender_male">Male</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input v-model="gender" class="with-gap" type="radio" id="gender_female"  value="female"/>
                                                            <label for="gender_female">Female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Plumage Color</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=false" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_dblack" value="Black"/>
                                                            <label for="plummage_color_dblack">Black</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=false" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_dblackbrown" value="Black with Brown"/>
                                                            <label for="plummage_color_dblackbrown">Black with Brown</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=false" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_dbrown" value="Brown"/>
                                                            <label for="plummage_color_dbrown">Brown</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=false" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_dbrownblack" value="Brown with Black"/>
                                                            <label for="plummage_color_dbrownblack">Brown with Black</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=true" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_dothers" value="Others"/>
                                                            <label for="plummage_color_dothers">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="plummage_color_others==true">
                                                        <div class="input-field col s12 m6 l6">
                                                            <label class="active" for="plummage_color_others">Others</label>
                                                            <input v-model="plummage_color" id="plummage_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Plumage Color</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=false" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_white" value="White"/>
                                                            <label for="plummage_color_white">White</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=false" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_black" value="Black" />
                                                            <label for="plummage_color_black">Black</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=false" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_red" value="Red" />
                                                            <label for="plummage_color_red">Red</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=false" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_orange" value="Orange" />
                                                            <label for="plummage_color_orange">Orange</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=false" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_brown" value="Brown" />
                                                            <label for="plummage_color_brown">Brown</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=false" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_yellow" value="Yellow" />
                                                            <label for="plummage_color_yellow">Yellow</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=true; plummage_color=''" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_others_rad" value="Others" />
                                                            <label for="plummage_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="plummage_color_others==true">
                                                        <div class="col s12 m6 l6 input-field">
                                                            <label class="active" for="plummage_color_others">Others</label>
                                                            <input v-model="plummage_color" id="plummage_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Plumage Pattern</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=false" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_ddusky" value="Dusky" />
                                                            <label for="plummage_pattern_ddusky">Dusky</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=false" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_dmallard" value="Mallard" />
                                                            <label for="plummage_pattern_dmallard">Mallard</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=false" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_dplainbrown" value="Plain Brown" />
                                                            <label for="plummage_pattern_dplainbrown">Plain Brown</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=false" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_drunner" value="Runner" />
                                                            <label for="plummage_pattern_drunner">Runner</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=false" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_drunnermallard" value="Runner/Mallard" />
                                                            <label for="plummage_pattern_drunnermallard">Runner/Mallard</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=true; plummage_pattern=''" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_others_rad" value="Others" />
                                                            <label for="plummage_pattern_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="plummage_pattern_others==true">
                                                        <div class="input-field col s12 m6 l6">
                                                            <label class="active" for="plummage_pattern_others">Others</label>
                                                            <input v-model="plummage_pattern" id="plummage_pattern_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Plumage Pattern</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=false" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_plain" value="Plain" />
                                                            <label for="plummage_pattern_plain">Plain</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=false" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_barred" value="Barred" />
                                                            <label for="plummage_pattern_barred">Barred</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=false" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_wild" value="Wild Type" />
                                                            <label for="plummage_pattern_wild">Wild Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=false" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_laced" value="Laced" />
                                                            <label for="plummage_pattern_laced">Laced</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=false" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_mottled" value="Mottled" />
                                                            <label for="plummage_pattern_mottled">Mottled</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_pattern_others=true; plummage_pattern=''" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_others_rad" value="Others" />
                                                            <label for="plummage_pattern_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="plummage_pattern_others==true">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="plummage_pattern_others">Others</label>
                                                            <input v-model="plummage_pattern" id="plummage_pattern_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Hackle Color</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="hackle_color_others=false" class="with-gap" v-model="hackle_color" type="radio" id="hackle_color_yellow" value="Yellow" />
                                                            <label for="hackle_color_yellow">Yellow</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="hackle_color_others=false" class="with-gap" v-model="hackle_color" type="radio" id="hackle_color_orange" value="Orange" />
                                                            <label for="hackle_color_orange">Orange</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="hackle_color_others=false" class="with-gap" v-model="hackle_color" type="radio" id="hackle_color_brown" value="Brown" />
                                                            <label for="hackle_color_brown">Brown</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="hackle_color_others=false" class="with-gap" v-model="hackle_color" type="radio" id="hackle_color_red" value="Red" />
                                                            <label for="hackle_color_red">Red</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="hackle_color_others=false" class="with-gap" v-model="hackle_color" type="radio" id="hackle_color_black" value="Black" />
                                                            <label for="hackle_color_black">Black</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="hackle_color_others=true; hackle_color=''" class="with-gap" v-model="hackle_color" type="radio" id="hackle_color_others_rad" value="Others" />
                                                            <label for="hackle_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="hackle_color_others==true">
                                                        <div class="col s12 m6 l6 input-field">
                                                            <label class="active" for="hackle_color_others">Others</label>
                                                            <input v-model="hackle_color" id="hackle_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Hackle Pattern</label>
                                                    <div class="row">
                                                        <div class="col s12 m3 l3">
                                                            <input @change="hackle_pattern_others=false" class="with-gap" v-model="hackle_pattern" type="radio" id="hackle_pattern_plain" value="Plain" />
                                                            <label for="hackle_pattern_plain">Plain</label>
                                                        </div>
                                                        <div class="col s12 m3 l3">
                                                            <input @change="hackle_pattern_others=false" class="with-gap" v-model="hackle_pattern" type="radio" id="hackle_pattern_laced" value="Laced" />
                                                            <label for="hackle_pattern_laced">Laced</label>
                                                        </div>
                                                        <div class="col s12 m3 l3">
                                                            <input @change="hackle_pattern_others=false" class="with-gap" v-model="hackle_pattern" type="radio" id="hackle_pattern_barred" value="Barred" />
                                                            <label for="hackle_pattern_barred">Barred</label>
                                                        </div>
                                                        <div class="col s12 m3 l3">
                                                            <input @change="hackle_pattern_others=true;hackle_pattern=''" class="with-gap" v-model="hackle_pattern" type="radio" id="hackle_pattern_others_rad" value="Others" />
                                                            <label for="hackle_pattern_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="hackle_pattern_others==true">
                                                        <div class="col s12 m6 l6 input-field">
                                                            <label class="active" for="hackle_pattern_others">Others</label>
                                                            <input v-model="hackle_pattern" id="hackle_pattern_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Body Carriage</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="body_carriage_others=false" class="with-gap" v-model="body_carriage" type="radio" id="body_carriage_dhorizontal" value="Horizontal" />
                                                            <label for="body_carriage_dhorizontal">Horizontal</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="body_carriage_others=false" class="with-gap" v-model="body_carriage" type="radio" id="body_carriage_dslight" value="Slight Upright" />
                                                            <label for="body_carriage_dslight">Slight Upright</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="body_carriage_others=false" class="with-gap" v-model="body_carriage" type="radio" id="body_carriage_dupright" value="Upright" />
                                                            <label for="body_carriage_dupright">Upright</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="body_carriage_others=true; body_carriage=''" class="with-gap" v-model="body_carriage" type="radio" id="body_carriage_dothers_rad" value="Others" />
                                                            <label for="body_carriage_dothers_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="body_carriage_others==true">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="body_carriage_dothers">Others</label>
                                                            <input v-model="body_carriage" id="body_carriage_dothers" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Body Carriage</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="body_carriage_others=false" class="with-gap" v-model="body_carriage" type="radio" id="body_carriage_upright" value="Upright" />
                                                            <label for="body_carriage_upright">Upright</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="body_carriage_others=false" class="with-gap" v-model="body_carriage" type="radio" id="body_carriage_slight" value="Slight Upright" />
                                                            <label for="body_carriage_slight">Slight Upright</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="body_carriage_others=true; body_carriage=''" class="with-gap" v-model="body_carriage" type="radio" id="body_carriage_others_rad" value="Others" />
                                                            <label for="body_carriage_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="body_carriage_others==true">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="body_carriage_others">Others</label>
                                                            <input v-model="body_carriage" id="body_carriage_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Comb Type</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="comb_type_others=false" class="with-gap" v-model="comb_type" type="radio" id="comb_type_single" value="Single"/>
                                                            <label for="comb_type_single">Single</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="comb_type_others=false" class="with-gap" v-model="comb_type" type="radio" id="comb_type_pea" value="Pea" />
                                                            <label for="comb_type_pea">Pea</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="comb_type_others=false" class="with-gap" v-model="comb_type" type="radio" id="comb_type_rose" value="Rose" />
                                                            <label for="comb_type_rose">Rose</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="comb_type_others=true; comb_type=''" class="with-gap" v-model="comb_type" type="radio" id="comb_type_others_rad" value="Others" />
                                                            <label for="comb_type_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="comb_type_others==true">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="comb_type_others">Others</label>
                                                            <input v-model="comb_type" id="comb_type_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Comb Color</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="comb_color_others=false" class="with-gap" v-model="comb_color" type="radio" id="comb_color_red" value="Red" />
                                                            <label for="comb_color_red">Red</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="comb_color_others=false" class="with-gap" v-model="comb_color" type="radio" id="comb_color_pink" value="Pink" />
                                                            <label for="comb_color_pink">Pink</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="comb_color_others=false" class="with-gap" v-model="comb_color" type="radio" id="comb_color_black" value="Black" />
                                                            <label for="comb_color_black">Black</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="comb_color_others=true;comb_color=''" class="with-gap" v-model="comb_color" type="radio" id="comb_color_others_rad" value="Others" />
                                                            <label for="comb_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="comb_color_others==true">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="comb_color_others">Others</label>
                                                            <input v-model="comb_color" id="comb_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Earlobe Color</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="earlobe_color_others=false" class="with-gap" v-model="earlobe_color" type="radio" id="earlobe_color_white" value="White" />
                                                            <label for="earlobe_color_white">White</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="earlobe_color_others=false" class="with-gap" v-model="earlobe_color" type="radio" id="earlobe_color_red" value="Red" />
                                                            <label for="earlobe_color_red">Red</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="earlobe_color_others=false" class="with-gap" v-model="earlobe_color" type="radio" id="earlobe_color_redwhwhite" value="Red-White" />
                                                            <label for="earlobe_color_redwhwhite">Red-White</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="earlobe_color_others=true; earlobe_color=''" class="with-gap" v-model="earlobe_color" type="radio" id="earlobe_color_others_rad" value="Others" />
                                                            <label for="earlobe_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="earlobe_color_others==true">
                                                        <div class="col s12 m6 l6" v-if="earlobe_color_others">
                                                            <label class="active" for="earlobe_color_others">Others</label>
                                                            <input v-model="earlobe_color" id="earlobe_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Iris Color</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="iris_color_others=false" class="with-gap" v-model="iris_color" type="radio" id="iris_color_red" value="Red" />
                                                            <label for="iris_color_red">Red</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="iris_color_others=false" class="with-gap" v-model="iris_color" type="radio" id="iris_color_orange" value="Orange" />
                                                            <label for="iris_color_orange">Orange</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="iris_color_others=false" class="with-gap" v-model="iris_color" type="radio" id="iris_color_brown" value="Brown" />
                                                            <label for="iris_color_brown">Brown</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="iris_color_others=false" class="with-gap" v-model="iris_color" type="radio" id="iris_color_yellow" value="Yellow" />
                                                            <label for="iris_color_yellow">Yellow</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="iris_color_others=true; iris_color=''" class="with-gap" v-model="iris_color" type="radio" id="iris_color_others_rad" value="Others" />
                                                            <label for="iris_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="iris_color_others==true">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="iris_color_others">Others</label>
                                                            <input v-model="iris_color" id="iris_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Beak Color</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="beak_color_others=false" class="with-gap" v-model="beak_color" type="radio" id="beak_color_white" value="White" />
                                                            <label for="beak_color_white">White</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="beak_color_others=false" class="with-gap" v-model="beak_color" type="radio" id="beak_color_black" value="Black" />
                                                            <label for="beak_color_black">Black</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="beak_color_others=false" class="with-gap" v-model="beak_color" type="radio" id="beak_color_brown" value="Brown" />
                                                            <label for="beak_color_brown">Brown</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="beak_color_others=false" class="with-gap" v-model="beak_color" type="radio" id="beak_color_yellow" value="Yellow" />
                                                            <label for="beak_color_yellow">Yellow</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="beak_color_others=true; beak_color=''" class="with-gap" v-model="beak_color" type="radio" id="beak_color_others_rad" value="Others" />
                                                            <label for="beak_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="beak_color_others==true">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="beak_color_others">Others</label>
                                                            <input v-model="beak_color" id="beak_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Shank Color</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=false" class="with-gap" v-model="shank_color" type="radio" id="shank_color_dblack" value="Black" />
                                                            <label for="shank_color_dblack">Black</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=false" class="with-gap" v-model="shank_color" type="radio" id="shank_color_dbrown" value="Brown" />
                                                            <label for="shank_color_dbrown">Brown</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=false" class="with-gap" v-model="shank_color" type="radio" id="shank_color_ddarkbrown" value="Dark Brown" />
                                                            <label for="shank_color_ddarkbrown">Dark Brown</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=false" class="with-gap" v-model="shank_color" type="radio" id="shank_color_ddarkorange" value="Dark Orange" />
                                                            <label for="shank_color_ddarkorange">Dark Orange</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=false" class="with-gap" v-model="shank_color" type="radio" id="shank_color_dorangeblack" value="Orange with Black" />
                                                            <label for="shank_color_dorangeblack">Orange with Black</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=true; shank_color=''" class="with-gap" v-model="shank_color" type="radio" id="shank_color_dothers_rad" value="Others" />
                                                            <label for="shank_color_dothers_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="shank_color_others==true">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="shank_color_dothers">Others</label>
                                                            <input v-model="shank_color" id="shank_color_dothers" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Shank Color</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=false" class="with-gap" v-model="shank_color" type="radio" id="shank_color_white" value="White" />
                                                            <label for="shank_color_white">White</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=false" class="with-gap" v-model="shank_color" type="radio" id="shank_color_black" value="Black" />
                                                            <label for="shank_color_black">Black</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=false" class="with-gap" v-model="shank_color" type="radio" id="shank_color_yellow" value="Yellow" />
                                                            <label for="shank_color_yellow">Yellow</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=false" class="with-gap" v-model="shank_color" type="radio" id="shank_color_green" value="Green" />
                                                            <label for="shank_color_green">Green</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=false" class="with-gap" v-model="shank_color" type="radio" id="shank_color_grey" value="Grey" />
                                                            <label for="shank_color_grey">Grey</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="shank_color_others=true; shank_color=''" class="with-gap" v-model="shank_color" type="radio" id="shank_color_others_rad" value="Others" />
                                                            <label for="shank_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="shank_color_others==true">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="shank_color_others">Others</label>
                                                            <input v-model="shank_color" id="shank_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Skin Color</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="skin_color_others=false" class="with-gap" v-model="skin_color" type="radio" id="skin_color_dwhite" value="White" />
                                                            <label for="skin_color_dwhite">White</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="skin_color_others=true; skin_color=''" class="with-gap" v-model="skin_color" type="radio" id="skin_color_others_rad" value="Others" />
                                                            <label for="skin_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="skin_color_others==true">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="skin_color_others">Others</label>
                                                            <input v-model="skin_color" id="skin_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" v-if="!duck">
                                                <div class="col s12 m12 l12">
                                                    <label>Skin Color</label>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="skin_color_others=false" class="with-gap" v-model="skin_color" type="radio" id="skin_color_white" value="White" />
                                                            <label for="skin_color_white">White</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="skin_color_others=false" class="with-gap" v-model="skin_color" type="radio" id="skin_color_yellow" value="Yellow" />
                                                            <label for="skin_color_yellow">Yellow</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input @change="skin_color_others=true; skin_color=''" class="with-gap" v-model="skin_color" type="radio" id="skin_color_others_rad" value="Others" />
                                                            <label for="skin_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="skin_color_others==true">
                                                        <div class="col s12 m6 l6">
                                                            <label class="active" for="skin_color_others">Others</label>
                                                            <input v-model="skin_color" id="skin_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="duck">
                                                <div class="row">
                                                    <div class="col s12 m12 l12">
                                                        <label>Neck Feather Markings</label>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input class="with-gap" v-model="neck_feather" type="radio" id="neck_feather_plain" value="Plain" />
                                                                <label for="neck_feather_plain">Plain</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input class="with-gap" v-model="neck_feather" type="radio" id="neck_feather_bibsmall" value="Bib-Small" />
                                                                <label for="neck_feather_bibsmall">With Bib (Small)</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input class="with-gap" v-model="neck_feather" type="radio" id="neck_feather_bibmed" value="Bib-Medium" />
                                                                <label for="neck_feather_bibmed">With Bib (Medium)</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input class="with-gap" v-model="neck_feather" type="radio" id="neck_feather_biblarge" value="Bib-Large" />
                                                                <label for="neck_feather_biblarge">With Bib (Large)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m12 l12">
                                                        <label>Wing Feather Color</label>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input @change="wing_feather_others=false" class="with-gap" v-model="wing_feather" type="radio" id="wing_feather_black" value="Black" />
                                                                <label for="wing_feather_black">Black</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="wing_feather_others=false" class="with-gap" v-model="wing_feather" type="radio" id="wing_feather_blackbrown" value="Black with Brown" />
                                                                <label for="wing_feather_blackbrown">Black with Brown</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="wing_feather_others=false" class="with-gap" v-model="wing_feather" type="radio" id="wing_feather_blackwhite" value="Black with White" />
                                                                <label for="wing_feather_blackwhite">Black with White</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input @change="wing_feather_others=false" class="with-gap" v-model="wing_feather" type="radio" id="wing_feather_brown" value="Brown" />
                                                                <label for="wing_feather_brown">Brown</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="wing_feather_others=false" class="with-gap" v-model="wing_feather" type="radio" id="wing_feather_brownwhite" value="Brown with White" />
                                                                <label for="wing_feather_brownwhite">Brown with White</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="wing_feather_others=true; wing_feather=''" class="with-gap" v-model="wing_feather" type="radio" id="wing_feather_others_rad" value="Others" />
                                                                <label for="wing_feather_others_rad">Others</label>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="wing_feather_others==true">
                                                            <div class="col s12 m6 l6">
                                                                <label class="active" for="wing_feather_others">Others</label>
                                                                <input v-model="wing_feather" id="wing_feather_others" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m12 l12">
                                                        <label>Tail Feather Color</label>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input @change="tail_feather_others=false" class="with-gap" v-model="tail_feather" type="radio" id="tail_feather_black" value="Black" />
                                                                <label for="tail_feather_black">Black</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="tail_feather_others=false" class="with-gap" v-model="tail_feather" type="radio" id="tail_feather_brown" value="Brown" />
                                                                <label for="tail_feather_brown">Brown</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="tail_feather_others=false" class="with-gap" v-model="tail_feather" type="radio" id="tail_feather_brownwhite" value="Brown with White" />
                                                                <label for="tail_feather_brownwhite">Brown with White</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input @change="tail_feather_others=true; tail_feather=''" class="with-gap" v-model="tail_feather" type="radio" id="tail_feather_others_rad" value="Others" />
                                                                <label for="tail_feather_others_rad">Others</label>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="tail_feather_others==true">
                                                            <div class="col s12 m6 l6">
                                                                <label class="active" for="tail_feather_others">Others</label>
                                                                <input v-model="tail_feather" id="tail_feather_others" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m12 l12">
                                                        <label>Bill Color</label>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input @change="bill_color_others=false" class="with-gap" v-model="bill_color" type="radio" id="bill_color_green" value="Green" />
                                                                <label for="bill_color_green">Green</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="bill_color_others=false" class="with-gap" v-model="bill_color" type="radio" id="bill_color_black" value="Black" />
                                                                <label for="bill_color_black">Black</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="bill_color_others=false" class="with-gap" v-model="bill_color" type="radio" id="bill_color_blackgray" value="Black with Gray" />
                                                                <label for="bill_color_blackgray">Black with Gray</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input @change="bill_color_others=true; bill_color=''" class="with-gap" v-model="bill_color" type="radio" id="bill_color_others_rad" value="Others" />
                                                                <label for="bill_color_others_rad">Others</label>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="bill_color_others==true">
                                                            <div class="input-field col s12 m6 l6">
                                                                <label class="active" for="bill_color_others">Others</label>
                                                                <input v-model="bill_color" id="bill_color_others" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m12 l12">
                                                        <label>Bill Shape</label>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input class="with-gap" v-model="bill_shape" type="radio" id="bill_shape_uniform" value="Uniform" />
                                                                <label for="bill_shape_uniform">Uniform</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input class="with-gap" v-model="bill_shape" type="radio" id="bill_shape_saddle" value="Saddle" />
                                                                <label for="bill_shape_saddle">Saddle</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m12 l12">
                                                        <label>Bean Color</label>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input @change="bean_color_others=false" class="with-gap" v-model="bean_color" type="radio" id="bean_color_black" value="Black" />
                                                                <label for="bean_color_black">Black</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="bean_color_others=false" class="with-gap" v-model="bean_color" type="radio" id="bean_color_grey" value="Grey" />
                                                                <label for="bean_color_grey">Grey</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="bean_color_others=true; bean_color=''" class="with-gap" v-model="bean_color" type="radio" id="bean_color_others_rad" value="Others" />
                                                                <label for="bean_color_others_rad">Others</label>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="bean_color_others==true">
                                                            <div class="input-field col s12 m6 l6">
                                                                <label class="active" for="bean_color_others">Others</label>
                                                                <input v-model="bean_color" id="bean_color_others" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m12 l12">
                                                        <label>Presence of Crest</label>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input @change="crest_others=false" class="with-gap" v-model="crest" type="radio" id="crest_yes" value="Yes" />
                                                                <label for="crest_yes">Yes</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="crest_others=false" class="with-gap" v-model="crest" type="radio" id="crest_no" value="No" />
                                                                <label for="crest_no">No</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="crest_others=true" class="with-gap" v-model="crest" type="radio" id="crest_others_rad" value="Others" />
                                                                <label for="crest_others_rad">Others</label>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="crest_others==true">
                                                            <div class="input-field col s12 m6 l6">
                                                                <label class="active" for="crest_others">Others</label>
                                                                <input v-model="crest" id="crest_others" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m12 l12">
                                                        <label>Eye Color</label>
                                                        <div class="row">
                                                            <div class="col s12 m4 l4">
                                                                <input @change="eye_color_others=false" class="with-gap" v-model="eye_color" type="radio" id="eye_color_black" value="Black" />
                                                                <label for="eye_color_black">Black</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="eye_color_others=false" class="with-gap" v-model="eye_color" type="radio" id="eye_color_brown" value="Brown" />
                                                                <label for="eye_color_brown">Brown</label>
                                                            </div>
                                                            <div class="col s12 m4 l4">
                                                                <input @change="eye_color_others=true" class="with-gap" v-model="eye_color" type="radio" id="eye_color_others_rad" value="Others" />
                                                                <label for="eye_color_others_rad">Others</label>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="eye_color_others==true">
                                                            <div class="input-field col s12 m6 l6">
                                                                <label class="active" for="eye_color_others">Others</label>
                                                                <input v-model="eye_color" id="eye_color_others" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <label class="active" for="other_features">Others Unique Features</label>
                                                    <input v-model="other_features" id="other_features" type="text" placeholder="e.g. Frizzly, Silky">
                                                </div>
                                            </div>
                                        </div>

                                        <div id="morpho">
                                            <!-- Morpho -->
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <div class="row">
                                                        <div class="col s12 l6 m6">
                                                            <label for="height">Height (cm)</label>
                                                            <input id="height" type="number" class="validate" v-model.number="height" min=0 step="0.001" pattern="^\d*(\.\d{0,3})?$" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 l6 m6">
                                                            <label for="weight">Weight (g)</label>
                                                            <input id="weight" type="number" class="validate" v-model.number="weight" min=0 step="0.001" pattern="^\d*(\.\d{0,3})?$" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 l6 m6">
                                                            <label for="body_length">Body Length (cm)</label>
                                                            <input id="body_length" type="number" class="validate" v-model.number="body_length" min=0 step="0.001" pattern="^\d*(\.\d{0,3})?$" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 l6 m6">
                                                            <label for="chest_circumference">Chest Circumference (cm)</label>
                                                            <input id="chest_circumference" type="number" class="validate" v-model.number="chest_circumference" min=0 step="0.001" pattern="^\d*(\.\d{0,3})?$" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 l6 m6">
                                                            <label for="wing_span">Wing Span (cm)</label>
                                                            <input id="wing_span" type="number" class="validate" v-model.number="wing_span" min=0 step="0.001" pattern="^\d*(\.\d{0,3})?$" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 l6 m6">
                                                            <label for="shank_length">Shank Length (cm)</label>
                                                            <input id="shank_length" type="number" class="validate" v-model.number="shank_length" min=0 step="0.001" pattern="^\d*(\.\d{0,3})?$" required>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="duck">
                                                        <div class="col s12 m6 l6">
                                                            <label for="bill_length">Bill Length (cm)</label>
                                                            <input id="bill_length" type="number" class="validate" v-model.number="bill_length" min=0 step="0.001" pattern="^\d*(\.\d{0,3})?$" required>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="duck">
                                                        <div class="col s12 m6 l6">
                                                            <label for="neck_length">Neck Length (cm)</label>
                                                            <input id="neck_length" type="number" class="validate" v-model.number="neck_length" min=0 step="0.001" pattern="^\d*(\.\d{0,3})?$" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Close</a>
                        <button type="submit" class="modal-action modal-close waves-effect waves-grey btn-flat">Submit</button>
                    </div>
                </form>
            </div>

            <div id="delete_phenomorpho" class="modal modal-fixed-footer">
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
                            <p>Are you sure you want to <strong>Delete</strong> this Phenotypic & Morphometric record?</p>
                            <blockquote>
                                <span>Registry Tag/ID : {{selected_record.tag}}</span><br>
                                <span>Gender : {{selected_record.gender}}</span><br>
                                <span>Pheno : {{selected_record.phenotypic}}</span><br>
                                <span>Morpho : {{selected_record.morphometric}}</span><br>
                                <span>Date Collected : {{selected_record.date_collected}}</span><br>
                            </blockquote>
                            <p>This action is <strong>Irreversible</strong>.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a @click.prevent="deletePhenoMorphoData()" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Yes</a>
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">No</a>
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
            'breeder', 'breeder_tag', 'animal_type'
        ],
        data () {
            return {
                records : {},
                records_length : 0,
                date_collected : '',
                duck : false,
                tag : '',
                gender : '',
                plummage_color_others : false,
                plummage_color : '',
                plummage_pattern_others : false,
                plummage_pattern : '',
                hackle_color_others : false,
                hackle_color : '',
                hackle_pattern_others : false,
                hackle_pattern : '',
                body_carriage_others : false,
                body_carriage : '',
                comb_type_others : false,
                comb_type : '',
                comb_color_others : false,
                comb_color : '',
                earlobe_color_others : false,
                earlobe_color : '',
                iris_color_others : false,
                iris_color : '',
                beak_color_others : false,
                beak_color : '',
                shank_color_others : false,
                shank_color : '',
                skin_color_others : false,
                skin_color : '',
                other_features : '',

                neck_feather : '',
                wing_feather_others : false,
                wing_feather : '',
                tail_feather_others : false,
                tail_feather : '',
                bill_color_others : false,
                bill_color : '',
                bill_shape : '',
                bean_color_others : false,
                bean_color : '',
                crest_others : false,
                crest : '',
                eye_color_others : false,
                eye_color : '',


                height : '',
                weight : '',
                body_length : '',
                chest_circumference : '',
                wing_span : '',
                shank_length : '',

                bill_length : '',
                neck_length : '',

                selected_record : '',
            }
        },
        methods : {
            initialize : function () {
                this.getBreederPhenoMorpho();
            },
            getBreederPhenoMorpho : function (page = 1) {
                axios.get('breeder_phenomorpho_records/'+this.breeder+'?page='+page)
                .then(response => {
                    this.records = response.data;
                    this.records_length = this.records.data.length;
                })
                .catch(error => {
                    console.log(error);
                });
            },
            addBreederPhenoMorpho : function () {
                var param = {};
                if(this.duck){
                    param = {
                        breeder_inventory_id : this.breeder,
                        duck : this.duck,
                        tag : this.tag,
                        date_collected : this.customFormatter(this.date_collected),
                        gender : this.gender,
                        plummage_color : this.plummage_color,
                        plummage_pattern : this.plummage_pattern,
                        neck_feather : this.neck_feather,
                        wing_feather : this.wing_feather,
                        tail_feather : this.tail_feather,
                        bill_color : this.bill_color,
                        bill_shape : this.bill_shape,
                        bean_color : this.bean_color,
                        crest : this.crest,
                        eye_color : this.eye_color,
                        body_carriage : this.body_carriage,
                        shank_color : this.shank_color,
                        skin_color : this.skin_color,
                        other_features : this.other_features,
                        height : this.height,
                        weight : this.weight,
                        body_length : this.body_length,
                        chest_circumference : this.chest_circumference,
                        wing_span : this.wing_span,
                        shank_length : this.shank_length,
                        bill_length : this.bill_length,
                        neck_length : this.neck_length,
                    }
                }else{
                    param = {
                        breeder_inventory_id : this.breeder,
                        duck : this.duck,
                        tag : this.tag,
                        date_collected : this.customFormatter(this.date_collected),
                        gender : this.gender,
                        plummage_color : this.plummage_color,
                        plummage_pattern : this.plummage_pattern,
                        hackle_color : this.hackle_color,
                        hackle_pattern : this.hackle_pattern,
                        body_carriage : this.body_carriage,
                        comb_type : this.comb_type,
                        comb_color : this.comb_color,
                        earlobe_color : this.earlobe_color,
                        iris_color : this.iris_color,
                        beak_color : this.beak_color,
                        shank_color : this.shank_color,
                        skin_color : this.skin_color,
                        other_features : this.other_features,
                        height : this.height,
                        weight : this.weight,
                        body_length : this.body_length,
                        chest_circumference : this.chest_circumference,
                        wing_span : this.wing_span,
                        shank_length : this.shank_length,
                    }
                }
                axios.post('breeder_add_phenomorpho', param)
                .then(response => {
                    if(response.data.error === undefined){
                        this.tag = '';
                        this.date_collected = '';
                        this.gender = '';
                        this.plummage_color = '';
                        this.plummage_pattern = '';
                        this.hackle_color = '';
                        this.hackle_pattern = '';
                        this.body_carriage = '';
                        this.comb_type = '';
                        this.comb_color = '';
                        this.earlobe_color = '';
                        this.iris_color = '';
                        this.beak_color = '';
                        this.shank_color = '';
                        this.skin_color = '';
                        this.other_features = '';
                        this.height = '';
                        this.weight = '';
                        this.body_length = '';
                        this.chest_circumference = '';
                        this.wing_span = '';
                        this.shank_length = '';
                        this.plummage_color_others = false;
                        this.plummage_pattern_others = false;
                        this.hackle_color_others = false;
                        this.hackle_pattern_others = false;
                        this.body_carriage_others = false;
                        this.comb_type_others = false;
                        this.comb_color_others = false;
                        this.earlobe_color_others = false;
                        this.iris_color_others = false;
                        this.beak_color_others = false;
                        this.shank_color_others = false;
                        this.skin_color_others = false;
                        this.duck = false;
                        this.neck_feather = '';
                        this.wing_feather = '';
                        this.tail_feather = '';
                        this.bill_color = '';
                        this.bill_shape = '';
                        this.bean_color = '';
                        this.crest = '';
                        this.eye_color = '';
                        this.bill_length = '';
                        this.neck_length = '';
                        this.wing_feather_others = false;
                        this.tail_feather_others = false;
                        this.bill_color_others = false;
                        this.bean_color_others = false;
                        this.crest_others = false;
                        this.eye_color_others = false;
                        Materialize.toast('Successfully added pheno and morpho data', 5000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 5000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast(error.errors, 5000, 'red rounded');
                });
                this.initialize();
            },
            deletePhenoMorphoData : function () {
                axios.delete('breeder_delete_phenomorphorecords/'+this.selected_record.values_id)
                .then(response => {
                    Materialize.toast('Successfully deleted pheno & morpho record', 5000, 'green rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to delete pheno & morpho', 5000, 'red rounded');
                });
                this.selected_record = {};
                this.initialize();
            },
            customFormatter : function (date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            },
            capitalize : function (string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },
            closePhenoMorpho : function () {
                this.$emit('close_phenomorpho', null);
            }
        },
        beforeCreate () {
            $('.tooltipped').tooltip('remove');
        },
        created () {
            this.initialize();
        },
        destroyed () {
            $('.tooltipped').tooltip({delay: 50});
        },
        mounted () {
            $('#breeder_phenomorpho').modal({
                dismissible : false,
            });
            $('#delete_phenomorpho').modal({
                dismissible : false,
            });
            $('ul.tabs').tabs();
            $('.tooltipped').tooltip({delay: 50, position: 'top'});
            tippy('.pheno', {
                
            });
        },

    }
</script>
