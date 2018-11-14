<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <div class="row valign-wrapper">
                    <div class="col s8 m8 l8">
                        <h5>{{phenomorpho_pen_number}} Phenotypic & Morphometric Data</h5>
                    </div>
                    <div class="col s4 m4 l4 right-align">
                        <a v-on:click="closePhenoMorpho" class="waves-effect waves-red btn-flat red-text"><i class="far fa-times-circle left"></i>Close</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="responsive-table bordered highlight centered">
                            <thead>
                                <tr>
                                    <th>Tag</th>
                                    <th>Male</th>
                                    <th>Female</th>
                                    <th>Pheno & Morpho Data</th>
                                    <th>Add Pheno & Morpho</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-if="inventories_length == 0">
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr v-else v-for="inventory in inventories.data" :key="inventory.inv_id">
                                    <td>{{inventory.replacement_tag}}</td>
                                    <td>{{inventory.number_male}}</td>
                                    <td>{{inventory.number_female}}</td>
                                    <td><a @click="selected_inventory_id=inventory.inv_id;selected_inventory_tag=inventory.replacement_tag; fetchPhenoMorphoList();" href="#view" class="modal-trigger"><i class="fas fa-eye"></i></a></td>
                                    <td><a @click="selected_inventory_id=inventory.inv_id;selected_inventory_tag=inventory.replacement_tag" href="#pheno_morpho" class="modal-trigger"><i class="fas fa-plus-circle"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- pagination -->
                <div class="row">
                    <div class="col s12 m12 l12 center">
                        <pagination :data="inventories" @pagination-change-page="fetchPhenoMorphoInventory"></pagination>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div id="pheno_morpho" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Phenotypic & Morphometric | {{selected_inventory_tag}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <form v-on:submit.prevent="addPhenoMorpho" method="POST">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                    <ul class="tabs">
                                        <li class="tab col s6"><a class="active" href="#pheno">Phenotypic</a></li>
                                        <li class="tab col s6"><a href="#morpho">Morphometric</a></li>
                                    </ul>
                                    </div>
                                    <div id="pheno" class="col s12 m12 l12">
                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <label for="date_added">Date Collected</label>
                                                    <datepicker id="date_added" :format="customFormatter" v-model="date_collected"></datepicker>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <div class="col s12 m6 l6 input-field">
                                                    <input v-model="tag" id="tag" type="text" placeholder="Tag or Registry ID">
                                                    <label class="active" for="tag">Tag</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Gender</label>
                                                <div class="col s12 m12 l12">
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input v-model="gender" class="with-gap" type="radio" id="gender_male"  value="male"/>
                                                            <label for="gender_male">Male</label>
                                                        </div>
                                                        <div class="col s12 m4 l4">
                                                            <input v-model="gender" class="with-gap" type="radio" id="gender_female" value="female"/>
                                                            <label for="gender_female">Female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Plummage Color</label>
                                                <div class="col s12 m12 l12">
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
                                                </div>
                                                <div class="col s12 m12 l12">
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
                                                </div>
                                                <div class="col s12 m12 l12">
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="plummage_color_others=true" class="with-gap" v-model="plummage_color" type="radio" id="plummage_color_others_rad" value="Others" />
                                                            <label for="plummage_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12" v-if="plummage_color_others">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="plummage_color_others">Others</label>
                                                            <input v-model="plummage_color" id="plummage_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Plummage Pattern</label>
                                                <div class="col s12 m12 l12">
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
                                                </div>
                                                <div class="col s12 m12 l12">
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
                                                            <input @change="plummage_pattern_others=true" class="with-gap" v-model="plummage_pattern" type="radio" id="plummage_pattern_others_rad" value="Others" />
                                                            <label for="plummage_pattern_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12" v-if="plummage_pattern_others">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="plummage_pattern_others">Others</label>
                                                            <input v-model="plummage_pattern" id="plummage_pattern_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Hackle Color</label>
                                                <div class="col s12 m12 l12">
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
                                                </div>
                                                <div class="col s12 m12 l12">
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
                                                            <input @change="hackle_color_others=true" class="with-gap" v-model="hackle_color" type="radio" id="hackle_color_others_rad" value="Others" />
                                                            <label for="hackle_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12" v-if="hackle_color_others">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="hackle_color_others">Others</label>
                                                            <input v-model="hackle_color" id="hackle_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Hackle Pattern</label>
                                                <div class="col s12 m12 l12">
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
                                                            <input @change="hackle_pattern_others=true" class="with-gap" v-model="hackle_pattern" type="radio" id="hackle_pattern_others_rad" value="Others" />
                                                            <label for="hackle_pattern_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12 m4 l4">
                                                            <input @change="hackle_pattern_others=true" class="with-gap" v-model="hackle_pattern" type="radio" id="hackle_type_others_rad" value="Others" />
                                                            <label for="hackle_type_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12" v-if="hackle_pattern_others">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="hackle_pattern_others">Others</label>
                                                            <input v-model="hackle_pattern" id="hackle_pattern_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Body Carriage</label>
                                                <div class="col s12 m12 l12">
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
                                                            <input @change="body_carriage_others=true" class="with-gap" v-model="body_carriage" type="radio" id="body_carriage_others_rad" value="Others" />
                                                            <label for="body_carriage_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12" v-if="body_carriage_others">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="body_carriage_others">Others</label>
                                                            <input v-model="body_carriage" id="body_carriage_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Comb Type</label>
                                                <div class="col s12 m12 l12">
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
                                                            <input @change="comb_type_others=true" class="with-gap" v-model="comb_type" type="radio" id="comb_type_others_rad" value="Others" />
                                                            <label for="comb_type_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12" v-if="comb_type_others">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="comb_type_others">Others</label>
                                                            <input v-model="comb_type" id="comb_type_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Comb Color</label>
                                                <div class="col s12 m12 l12">
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
                                                            <input @change="comb_color_others=true" class="with-gap" v-model="comb_color" type="radio" id="comb_color_others_rad" value="Others" />
                                                            <label for="comb_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12" v-if="comb_color_others">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="comb_color_others">Others</label>
                                                            <input v-model="comb_color" id="comb_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Earlobe Color</label>
                                                <div class="col s12 m12 l12">
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
                                                            <input @change="earlobe_color_others=true" class="with-gap" v-model="earlobe_color" type="radio" id="earlobe_color_others_rad" value="Others" />
                                                            <label for="earlobe_color_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6" v-if="earlobe_color_others">
                                                            <label for="earlobe_color_others">Others</label>
                                                            <input v-model="earlobe_color" id="earlobe_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Iris Color</label>
                                                <div class="col s12 m12 l12">
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
                                                            <input @change="iris_color_others=true" class="with-gap" v-model="iris_color" type="radio" id="iris_color_others_rad" value="Others" />
                                                            <label for="iris_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12" v-if="iris_color_others">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="iris_color_others">Others</label>
                                                            <input v-model="iris_color" id="iris_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Beak Color</label>
                                                <div class="col s12 m12 l12">
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
                                                            <input @change="beak_color_others=true" class="with-gap" v-model="beak_color" type="radio" id="beak_color_others_rad" value="Others" />
                                                            <label for="beak_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12" v-if="beak_color_others">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="beak_color_others">Others</label>
                                                            <input v-model="beak_color" id="beak_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Shank Color</label>
                                                <div class="col s12 m12 l12">
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
                                                            <input @change="shank_color_others=true" class="with-gap" v-model="shank_color" type="radio" id="shank_color_others_rad" value="Others" />
                                                            <label for="shank_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12" v-if="shank_color_others">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="shank_color_others">Others</label>
                                                            <input v-model="shank_color" id="shank_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <label>Skin Color</label>
                                                <div class="col s12 m12 l12">
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
                                                            <input @change="skin_color_others=true" class="with-gap" v-model="skin_color" type="radio" id="skin_color_others_rad" value="Others" />
                                                            <label for="skin_color_others_rad">Others</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m12 l12" v-if="skin_color_others">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="skin_color_others">Others</label>
                                                            <input v-model="skin_color" id="skin_color_others" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <div class="row">
                                                        <div class="col s12 m6 l6">
                                                            <label for="other_features">Others Unique Features</label>
                                                            <input v-model="other_features" id="other_features" type="text" placeholder="e.g. Frizzly, Silky">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="morpho" class="col s12 m12 l12">
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
                                            </div>
                                        </div>
                                        <div class="row center">
                                            <div class="col s12 m12 l12">
                                                <button type="submit" class="btn waves-effect waves-light blue-grey">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                </div>
            </div>

            <div id="view" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Phenotypic & Morphometric | {{selected_inventory_tag}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="responsive-table bordered highlight centered">
                                <thead>
                                    <tr>
                                        <th>Tag</th>
                                        <th>Gender</th>
                                        <th>Pheno</th>
                                        <th>Morpho</th>
                                        <th>Date Collected</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-if="phenomorpho_values_length == 0">
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr v-else v-for="value in phenomorpho_values.data" :key="value.values_id">
                                        <td>{{value.tag}}</td>
                                        <td>{{capitalize(value.gender)}}</td>
                                        <td>{{value.phenotypic}}</td>
                                        <td>{{value.morphometric}}</td>
                                        <td>{{value.date_collected}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row center">
                        <div class="col s12 m12 l12">
                            <pagination :data="inventories" @pagination-change-page="fetchPhenoMorphoInventory"></pagination>
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
var moment = require('moment');
export default {
    components : {
        Datepicker
    },
    props: [
        'phenomorpho_pen_id', 'phenomorpho_pen_number'
    ],
    data () {
        return {
            inventories : {},
            inventories_length : 0,
            selected_inventory_id : '',
            selected_inventory_tag: '',

            date_collected : '',
            tag : '',
            gender : '',
            plummage_color : '',
            plummage_pattern : '',
            hackle_color : '',
            hackle_pattern : '',
            body_carriage : '',
            comb_type : '',
            comb_color : '',
            earlobe_color : '',
            iris_color : '',
            beak_color : '',
            shank_color : '',
            skin_color : '',
            other_features : '',

            plummage_color_others : false,
            plummage_pattern_others : false,
            hackle_color_others : false,
            hackle_pattern_others : false,
            body_carriage_others : false,
            comb_type_others : false,
            comb_color_others : false,
            earlobe_color_others : false,
            iris_color_others : false,
            beak_color_others : false,
            shank_color_others : false,
            skin_color_others : false,

            height : '',
            weight : '',
            body_length : '',
            chest_circumference : '',
            wing_span : '',
            shank_length : '',

            phenomorpho_values : {},
            phenomorpho_values_length : 0,
        }
    },
    methods : {
        initialize : function () {
            this.fetchPhenoMorphoInventory();
        },
        fetchPhenoMorphoInventory : function (page = 1) {
            axios.get('replacement_fetch_phenomorphoinventory/'+this.phenomorpho_pen_id+'?page='+page)
            .then(response => {
                this.inventories = response.data;
                this.inventories_length = this.inventories.data.length;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        fetchPhenoMorphoList : function (page = 1) {
            axios.get('replacement_fetch_phenomorpholist/'+this.selected_inventory_id+'?page='+page)
            .then(response => {
                this.phenomorpho_values = response.data;
                this.phenomorpho_values_length = this.phenomorpho_values.data.length;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        addPhenoMorpho : function () {
            axios.post('add_replacement_phenomorpho', {
                replacement_inventory_id : this.selected_inventory_id,
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
            })
            .then(response => {
                if(response.data.error == undefined){
                    this.selected_inventory_id = '';
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
                    Materialize.toast('Successfully added pheno and morpho data', 3000, 'green rounded');
                }else{
                    Materialize.toast(response.data.error, 3000, 'red rounded');
                }
            })
            .catch(error => {
                Materialize.toast(error, 3000, 'red rounded');
            });
        },
        customFormatter : function(date_added) {
            return moment(date_added).format('YYYY-MM-DD');
        },
        capitalize : function (string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        closePhenoMorpho : function () {
            this.$emit('close_phenomorpho', null)
        }
    },
    beforeCreate() {
        $('.tooltipped').tooltip('remove');
    },
    created () {
        this.initialize();
    },
    mounted () {
        $('#pheno_morpho').modal({
            dismissible : false,
        });
        $('#view').modal({
            dismissible : false,
        });
        $('ul.tabs').tabs();
    },
    destroyed () {
        $('.tooltipped').tooltip({delay: 50});
    },
}
</script>
