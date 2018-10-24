<template>
    <div>
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5>Replacement Phenotypic and Morphometric Values</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <ul class="breadcrumb">
                            <li><a href="javascript:javascript:history.go(-2)">Home</a></li>
                            <li><a href="javascript:javascript:history.go(-1)">Replacements</a></li>
                            <li>Phenotypic and Morphometric Records</li>
                        </ul>
                    </div>
                    <form v-on:submit.prevent="submitPhenoMorpho" action="post">
                    <div class="col s12 m12 l12">
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
                                        <label>Gender</label>
                                        <div class="col s12 m12 l12">
                                            <div class="row">
                                                <div class="col s12 m4 l4">
                                                    <input v-model="gender" class="with-gap" name="gender" type="radio" id="gender_male"  value="Male"/>
                                                    <label for="gender_male">Male</label>
                                                </div>
                                                <div class="col s12 m4 l4">
                                                    <input v-model="gender" class="with-gap" name="gender" type="radio" id="gender_female" value="Female"/>
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
                                                <div class="col s12 m4 l4">
                                                    <input @change="hackle_pattern_others=false" class="with-gap" v-model="hackle_pattern" type="radio" id="hackle_pattern_plain" value="Plain" />
                                                    <label for="hackle_pattern_plain">Plain</label>
                                                </div>
                                                <div class="col s12 m4 l4">
                                                    <input @change="hackle_pattern_others=false" class="with-gap" v-model="hackle_pattern" type="radio" id="hackle_pattern_laced" value="Laced" />
                                                    <label for="hackle_pattern_laced">Laced</label>
                                                </div>
                                                <div class="col s12 m4 l4">
                                                    <input @change="hackle_pattern_others=false" class="with-gap" v-model="hackle_pattern" type="radio" id="hackle_pattern_barred" value="Barred" />
                                                    <label for="hackle_pattern_barred">Barred</label>
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
                                        <div class="row center">
                                            <div class="col s12 m12 l12">
                                                <button type="submit" class="waves-effect waves-light btn blue-grey darken-1" @click="submitPhenoMorpho">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
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
        props: ['replacementId'],
        components : {
            Datepicker
        },
        data() {
            return {
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
            }
        },
        methods : {
            submitPhenoMorpho : function () {
                axios.post('/add_phenomorpho', {
                    replacement_id : this.replacementId,
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
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        },
        created () {

        },
    }
</script>
