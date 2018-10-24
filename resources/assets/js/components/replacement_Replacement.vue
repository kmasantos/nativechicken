<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <!-- Title -->
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Replacements</h5>
                </div>
            </div>
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col s12 m12 l12">
                    <ul class="breadcrumb">
                        <li><a href="./">Home</a></li>
                        <li>Replacements</li>
                    </ul>
                </div>
            </div>
            <!-- Search -->
            <div class="row valign-wrapper">
                <div class="col s12 m9 l9 valign">
                    <label for="search">Search</label>
                    <input v-model="search" placeholder="Type family number" id="search" type="text">
                </div>
                <div class="col s12 m3 l3 valign">
                    <button @click="searchReplacements" class="btn waves-effect waves-light blue-grey darken-1" type="submit">Search<i class="fas fa-search right"></i></button>
                </div>
            </div>
            <!-- Data panel -->
            <div class="row" v-if="replacements_loaded">
                <transition name="fade">
                    <!-- Loading success | With data -->
                    <div class="col s12 m12 l12" v-if="replacement_pens_len > 0">
                        <div class="row">
                            <div class="col s12 m6 l6" v-for="replacement_pen in replacement_pens.data" :key="replacement_pen.id">
                                <div class="card blue-grey lighten-4">
                                    <div class="card-content black-text">
                                        <div class="card-title">Pen {{replacement_pen.number}}</div>
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                Content : {{replacement_pen.current_capacity}}
                                            </div>
                                            <div class="col s12 m12 l12">
                                                Free : {{replacement_pen.total_capacity - replacement_pen.current_capacity}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-action right-align">
                                        <a href="#info" @click="selected_pen=replacement_pen.id; fetchPenInfo()" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Pen information">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="#add_modal" v-if="replacement_pen.total_capacity > replacement_pen.current_capacity" @click="selected_pen=replacement_pen.id" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Add replacement">
                                            <i class="far fa-plus-square"></i>
                                        </a>
                                        <a href="#feeding" @click="selected_pen=replacement_pen.id" v-if="replacement_pen.current_capacity>0" class="black-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Feeding records">
                                            <i class="fas fa-utensils"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row center">
                            <div class="col s12 m12 l12">
                                <pagination :data="replacement_pens" @pagination-change-page="getReplacementPens"></pagination>
                            </div>
                        </div>
                    </div>
                    <!-- Loading Success | Empty -->
                    <div class="col s12 m12 l12 center-align" v-else>
                        <h5>No Pens</h5>
                    </div>
                </transition>
            </div>
            <!-- Preloader -->
            <div class="row center" v-else>
                <div class="col s12 m12 l12">
                    <div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        Loading...
                    </div>
                </div>
            </div>
            <!-- Modals -->
            <div id="add_modal" class="modal modal-fixed-footer">
                <form v-on:submit.prevent="addReplacements" method="POST">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Add Replacement</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label for="external">Add from External Sources</label>
                                    <div id="external" class="switch">
                                        <label>
                                            Off
                                            <input type="checkbox" @click="external=!external">
                                            <span class="lever"></span>
                                            On
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Generation</label>
                                    <select class="browser-default" v-model="selected_generation" @change="fetchLines">
                                        <option value="" disabled selected v-if="generations_loaded==false">Loading Options...</option>
                                        <option value="" disabled selected v-else>Select Generation</option>
                                        <option value="" disabled selected v-if="generations.length==0">No Generations</option>
                                        <option v-for="generation in generations" :key="generation.id" v-bind:value="generation.id">{{generation.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Line</label>
                                    <select class="browser-default" v-model="selected_line" @change="fetchFamilies">
                                        <option value="" disabled selected v-if="lines_loaded==false">Loading Options...</option>
                                        <option value="" disabled selected v-else>Select Line</option>
                                        <option value="" disabled selected v-if="lines.length==0">No Lines</option>
                                        <option v-for="line in lines" :key="line.id" v-bind:value="line.id">{{line.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label>Family</label>
                                    <select class="browser-default" v-model="selected_family">
                                        <option value="" disabled v-if="families_loaded==false">Loading Options...</option>
                                        <option value="" disabled selected v-else>Select Family</option>
                                        <option value="" disabled selected v-if="families.length==0">No Families</option>
                                        <option v-for="family in families" :key="family.id" v-bind:value="family.id">{{family.number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <div class="input-field col s12 m6 l6">
                                        <input v-model.number="males" id="number_male" type="number" min=0>
                                        <label for="number_male">Number Male</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <div class="input-field col s12 m6 l6">
                                        <input v-model.number="females" id="number_female" type="number" min=0>
                                        <label for="number_female">Number Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label for="date_added">Batching Date</label>
                                    <datepicker id="date_added" :format="customFormatter" v-model="batching_date"></datepicker>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label for="date_added">Date Added</label>
                                    <datepicker id="date_added" :format="customFormatter" v-model="date_added"></datepicker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                    <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</button>
                </div>
                </form>
            </div>

            <div id="info" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Pen Info</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="responsive-table bordered highlight centered">
                                <thead>
                                    <tr>
                                        <th>Line</th>
                                        <th>Family</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Last Update</th>
                                        <th>Pheno/Morpho</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="info in pen_info" :key="info.fam_id">
                                        <td>{{info.line_number}}</td>
                                        <td>{{info.fam_number}}</td>
                                        <td>{{info.number_male}}</td>
                                        <td>{{info.number_female}}</td>
                                        <td>{{info.last_update}}</td>
                                        <td><a @click="selected_pheno_morpho=info.rep_id;closeInfoModal()" class="modal-trigger" :href="'#pheno_morpho'"><i class="fas fa-venus-mars"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                </div>
            </div>

            <div id="pheno_morpho" class="modal">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Phenotypic and Morphometric Data</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                    <a @click="submitPhenoMorpho" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</a>
                </div>
            </div>

            <div id="feeding" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Feeding Records</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label for="date_added">Date Collected</label>
                                    <datepicker id="date_added" :format="customFormatter" v-model="feed_record_collected"></datepicker>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 s6 m6 input-field">
                                    <input v-model.number="offered" class="validate" placeholder="Amount of Feed Offered (g)" id="feed_offered" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$" validate>
                                    <label for="feed_offered">Feed Offered</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 s6 m6 input-field">
                                    <input v-model.number="refused" class="validate" placeholder="Amount of Feed Refused (g)" id="feed_refused" type="number" min="0" step="0.001" pattern="^\d*(\.\d{0,3})?$">
                                    <label for="feed_refused">Feed Refused</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 s6 m6 input-field">
                                    <input v-model="remarks" placeholder="Add remarks" id="remarks" type="text">
                                    <label for="remarks">Remarks</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                    <a @click="submitPenFeedingRecord" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</a>
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
        data () {
            return {
                search : '',
                replacements_loaded : false,
                replacement_pens : {},
                replacement_pens_len : 0,
                selected_pen : '',

                // form variables
                external : false,
                selected_generation : '',
                selected_line : '',
                selected_family : '',
                date_added : '',
                batching_date : '',
                males : '',
                females : '',

                generations : [],
                lines : [],
                families : [],
                generations_loaded : false,
                lines_loaded : false,
                families_loaded : false,

                pen_info : [],
                info_loaded : false,
                show_info : false,

                selected_pheno_morpho : '',

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

                feed_record_collected : '',
                offered : '',
                refused : '',
                remarks : '',
            }
        },
        methods : {
            initialize : function () {
                this.getReplacementPens();
                this.fetchGenerations();
            },
            getReplacementPens : function (page = 1) {
                this.replacements_loaded = false;
                axios.get('replacement_pens?page='+page)
                .then(response => {
                    this.replacement_pens_len = response.data.data.length;
                    this.replacement_pens = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.replacements_loaded = true;
            },
            searchReplacements : function () {
                this.replacements_loaded = false;
                axios.get('search_replacement_pens/'+this.search)
                .then(response => this.replacement_pens = response.data)
                .catch(function (error) {
                    console.log(error);
                });
                this.replacements_loaded = true;
            },
            fetchGenerations : function () {
                this.generations_loaded = false;
                axios.get('replacement_fetch_generations')
                .then(response => {
                    this.generations = response.data;
                    this.generations_loaded = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            fetchLines : function () {
                this.lines_loaded = false;
                axios.get('replacement_fetch_lines/'+this.selected_generation)
                .then(response => {
                    this.lines = response.data;
                    this.lines_loaded = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            fetchFamilies : function () {
                this.families_loaded = false;
                axios.get('replacement_fetch_families/'+this.selected_line)
                .then(response => {
                    this.families = response.data;
                    this.families_loaded = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addReplacements : function () {
                axios.post('add_replacements', {
                    family_id : this.selected_family,
                    pen_id : this.selected_pen,
                    males : this.males,
                    females : this.females,
                    date_added : this.customFormatter(this.date_added),
                    batching_date : this.customFormatter(this.batching_date),
                    external : this.external
                })
                .then(function (response) {
                    Materialize.toast('Successfully added replacements', 3000, 'rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to add replacements', 3000, 'rounded');
                });
                this.getReplacementPens();
            },
            fetchPenInfo : function (){
                this.info_loaded = false;
                axios.get('replacement_pen_info/'+this.selected_pen)
                .then(response => {
                    this.pen_info = response.data;
                    this.info_loaded = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            submitPhenoMorpho : function (){
                axios.post('add_phenomorpho', {
                    replacement_id : this.selected_pheno_morpho,
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
                    Materialize.toast('Successfully added phenotypic and morphometric data', 3000, 'rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to add phenotypic and morphometric data', 3000, 'rounded');
                });
            },
            submitPenFeedingRecord : function () {
                axios.post('add_penfeeding', {
                    pen_id : this.selected_pen,
                    date_collected : this.customFormatter(this.feed_record_collected),
                    offered : this.offered,
                    refused : this.refused,
                    remark : this.remarks
                })
                .then(function (response) {
                    Materialize.toast('Successfully added feeding record', 3000, 'rounded');
                })
                .catch(function (error) {
                    Materialize.toast('Failed to add feeding record', 3000, 'rounded');
                });
            },
            closeInfoModal : function (){
                $('#info').modal('close');
            },
            customFormatter : function(date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            }
        },
        created () {
            this.initialize();
        }

    }
</script>

<style>
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
