<template>
    <div id="breeder_page_template">
        <div v-if="breeder_hatchery==null&&breeder_feeding==null&&breeder_eggprod==null&&breeder_eggquality==null&&breeder_phenomorpho==null&&breeder_mortality==null">
            <!-- No Breeder Inventory -->
            <div class="row center-align" v-if="breeders_length === 0">
                <div class="col s12 m12 l12">
                    <h5>No Available Breeders</h5>
                </div>
            </div>
            <!-- Search Bar -->
            <div class="row valign-wrapper" v-if="breeders_length > 0">
                <div class="col s12 m12 l8 input-field">
                    <input v-model="search" id="search" type="text">
                    <label for="search" class="active">Search Breeder Tag</label>
                </div>
                <div class="col s12 m12 l4">
                    <a class="waves-effect waves-light btn blue-grey" @click="searchBreeder">Search
                        <i class="material-icons right">search</i>
                    </a>
                </div>
            </div>
            <!-- Breeder Inventory List -->
            <div class="row" v-if="breeders_length > 0">
                <div class="col s12 m12 l12">
                    <transition name="fade" v-on:close="hideNote">
                    <div class="row" v-if="!hide_note">
                        <div class="m12 s12 col">
                            <div class="card-panel deep-orange lighten-5">
                                <div class="row valign-wrapper">
                                    <div class="col s1 center-align"><i id="alert_box_icon" class="fas fa-exclamation-triangle"></i></div>
                                    <div class="col l8">
                                        <h5>Note!</h5>
                                        <h6>Record your data chronologically to ensure correct values for data that are computed automatically by the system</h6>
                                    </div>
                                    <div class="col l3 right-align">
                                        <br>
                                        <a @click="hide_note=true" class="waves-effect waves-light btn btn-large white black-text btn-flat deep-orange lighten-4">Dismiss</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </transition>
                    <div class="row">
                        <div class="col s12 m12 l6" v-for="breeder in breeders.data" :key="breeder.inventory_id">
                            <div class="card blue-grey custom_card">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s8 m8 l8">
                                            <label class="white-label" for="tag_title white-text">Breeder Tag</label>
                                            <span v-if="breeder.breeder_code!=null" id="tag_title" class="card-title white-text tooltip truncate" :data-tippy-content="breeder.breeder_code">{{breeder.breeder_code}}</span>
                                            <span v-else id="tag_title" class="card-title white-text tooltip truncate" :data-tippy-content="breeder.breeder_tag">{{breeder.breeder_tag}}</span>
                                        </div>
                                        <div class="col s4 m4 l4 center-align">
                                            <a @click="breeder_delete=breeder.inventory_id;selected_breeder_tag=breeder.breeder_tag;" href="#cull_modal" class="waves-effect waves-grey btn-flat white-text tooltip modal-trigger" data-tippy-content="Cull"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    <div class="row custom_card_content">
                                        <div class="col s12 m12 l12">
                                            <ul class="collection blue-grey lighten-2">
                                                <li class="collection-item blue-grey lighten-2 tooltip" :data-tippy-content="'System Tag : ' + breeder.breeder_tag"><strong>ST: {{breeder.breeder_tag}}</strong></li>
                                                <li class="collection-item blue-grey lighten-2 tooltip" :data-tippy-content="'Family : ' + breeder.family_number"><strong>F: {{breeder.family_number}}</strong></li>
                                                <li class="collection-item blue-grey lighten-2 tooltip" :data-tippy-content="'Line : ' + breeder.line_number"><strong>L: {{breeder.line_number}}</strong></li>
                                                <li class="collection-item blue-grey lighten-2 tooltip" :data-tippy-content="'Generation : ' + breeder.generation_number"><strong>G: {{breeder.generation_number}}</strong></li>
                                                <li class="collection-item blue-grey lighten-2 center-align custom_content_inventory">
                                                    <div class="row">
                                                        <div class="col s12 m12 l12">
                                                            <strong>Inventory</strong>
                                                        </div>
                                                        <div class="col s12 m12 l12">
                                                            <i class="fas fa-mars"></i><strong> Male : {{breeder.number_male}}</strong>
                                                        </div>
                                                        <div class="col s12 m12 l12">
                                                            <span v-if="(breeder.male_wingbands!=null)" class="truncate"><i class="fas fa-tag tooltip" data-tippy-content="Male Wing Band ID"></i> : {{JSON.parse(breeder.male_wingbands).join(", ")}}</span>
                                                            <span v-else><i class="fas fa-tag tooltip" data-tippy-content="Male Wing Band ID"></i> :  Not Specified</span>
                                                        </div>
                                                        <div class="col s12 m12 l12">
                                                            <i class="fas fa-venus"></i><strong> Female : {{breeder.number_female}}</strong>
                                                        </div>
                                                        <div class="col s12 m12 l12">
                                                            <span v-if="(breeder.female_wingbands!=null)" class="truncate"><i class="fas fa-tag tooltip" data-tippy-content="Female Wing Band ID"></i> : {{JSON.parse(breeder.female_wingbands).join(", ")}}</span>
                                                            <span v-else><i class="fas fa-tag tooltip" data-tippy-content="Female Wing Band ID"></i> : Not Specified</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="collection-item blue-grey lighten-2 tooltip" :data-tippy-content="'Batching Date : ' + breeder.batching_date"><strong>B: {{breeder.batching_date}}</strong></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action center-align">
                                    <a href="#additional_breeder" @click="breeder_additional = breeder.inventory_id; selected_additional_tag=breeder.breeder_tag; getValidAdditionalMaleBreeder(); getValidAdditionalFemaleBreeder();" class="black-text tooltip modal-trigger" data-tippy-content="Add Breeder to Family"><i class="fas fa-exchange-alt"></i></a>
                                    <a href="javascript:void(0)" @click="breeder_feeding = breeder.inventory_id; selected_breeder_tag=breeder.breeder_tag;" class="black-text tooltip" data-tippy-content="Open Feeding Records"><i class="fas fa-cannabis"></i></a>
                                    <a href="javascript:void(0)" @click="breeder_eggprod = breeder.inventory_id; selected_breeder_tag=breeder.breeder_tag;" class="black-text tooltip" data-tippy-content="Open Egg Production Records"><i class="fas fa-chart-line"></i></a>
                                    <a href="javascript:void(0)" @click="breeder_hatchery = breeder.inventory_id;selected_breeder_tag=breeder.breeder_tag;" class="black-text tooltip" data-tippy-content="Open Hatchery Records"><i class="fas fa-crow"></i></a>
                                    <a href="javascript:void(0)" @click="breeder_eggquality = breeder.inventory_id;selected_breeder_tag=breeder.breeder_tag;" class="black-text tooltip" data-tippy-content="Open Egg Quality Records"><i class="fas fa-check-double"></i></a>
                                    <a href="javascript:void(0)" @click="breeder_phenomorpho = breeder.inventory_id;selected_breeder_tag=breeder.breeder_tag;" class="black-text tooltip" data-tippy-content="Open Pheno/Morpho Records"><i class="fas fa-feather"></i></a>
                                    <a href="javascript:void(0)" @click="breeder_mortality = breeder.inventory_id;selected_breeder_tag=breeder.breeder_tag;" class="black-text tooltip" data-tippy-content="Open Mortality & Sales"><i class="fas fa-dollar-sign"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination -->
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                            <pagination :data="breeders" @pagination-change-page="getBreederList"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="breeder_hatchery!=null">
            <hatchery-record :breeder="breeder_hatchery" :breeder_tag="selected_breeder_tag" v-on:close_record="breeder_hatchery=null;selected_breeder_tag=null"></hatchery-record>
        </div>
        <div v-if="breeder_feeding!=null">
            <feedingrecord-breeder :breeder="breeder_feeding" :breeder_tag="selected_breeder_tag" v-on:close_feeding="breeder_feeding=null;selected_breeder_tag=null"></feedingrecord-breeder>
        </div>
        <div v-if="breeder_eggprod!=null">
            <egg-production :breeder="breeder_eggprod" :breeder_tag="selected_breeder_tag" v-on:close_eggprod="breeder_eggprod=null;selected_breeder_tag=null"></egg-production>
        </div>
        <div v-if="breeder_eggquality!=null">
            <eggquality-breeder :breeder="breeder_eggquality" :breeder_tag="selected_breeder_tag" v-on:close_eggqual="breeder_eggquality=null;selected_breeder_tag=null"></eggquality-breeder>
        </div>
        <div v-if="breeder_phenomorpho!=null">
            <phenomorpho-breeder :breeder="breeder_phenomorpho" :breeder_tag="selected_breeder_tag" v-on:close_phenomorpho="breeder_phenomorpho=null;selected_breeder_tag=null"></phenomorpho-breeder>
        </div>
        <div v-if="breeder_mortality!=null">
            <mortality-breeder :breeder="breeder_mortality" :breeder_tag="selected_breeder_tag" v-on:close_mortality="breeder_mortality=null;selected_breeder_tag=null"></mortality-breeder>
        </div>
        <!-- FAB -->
        <div class="fixed-action-btn">
            <a href="#add_breeder_modal" class="btn-floating btn-large blue-grey darken-1 modal-trigger tooltip" data-tippy-content="Add Breeder Record"><i class="fas fa-plus"></i></a>
        </div>
        <!-- Add Breeder Modal -->
        <div id="add_breeder_modal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4>Add Breeder Record</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <p><i class="fas fa-exclamation-circle"></i> Choose <strong>Within System</strong> tab if you wish to add breeders from replacement stocks.</p>
                                <p><i class="fas fa-exclamation-circle"> </i> Choose <strong>Outside System</strong> if you wish to add breeders from outside sources.</p>
                            </div>
                            <div class="card-tabs">
                                <ul class="tabs tabs-fixed-width">
                                    <li @click="within=true" class="tab"><a href="#within">Within System</a></li>
                                    <li @click="within=false" class="tab"><a href="#outside">Outside System</a></li>
                                </ul>
                            </div>
                            <div class="card-content grey lighten-4">
                                <!-- Within System -->
                                <div id="within">
                                    <!-- <form v-on:submit.prevent="addBreeder" method="post"> -->
                                    <form v-on:submit.prevent="validateInput" method="post">
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <i>*Note: Choice of <strong>Line</strong> depends on breeding program</i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Male's Generation</label>
                                                <select @change="selectMaleLine();selected_male_inventory_max;" v-model="selected_male_gen" class="browser-default">
                                                    <option v-if="generations_length === 0" value="" disabled selected>No generation</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="generation in generations" :key="generation.id" :value="generation.id">{{generation.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Male's Line</label>
                                                <select @change="selectMaleFamily();selected_male_inventory_max=0;" v-model="selected_male_line" class="browser-default">
                                                    <option v-if="male_lines_length == 0" value="" disabled selected>No lines</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="line in male_lines" :key="line.id" :value="line.id">{{line.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Male's Family</label>
                                                <select @change="selectMaleInventory();selected_male_inventory_max=0;" v-model="selected_male_fam" class="browser-default">
                                                    <option v-if="male_families_length == 0" value="" disabled selected>No families</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="family in male_families" :key="family.id" :value="family.id">{{family.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Male's Replacement Inventory</label>
                                                <select v-model="selected_male_inv" @change="selected_male_inventory_max=selected_male_inv.number_male" class="browser-default">
                                                    <option v-if="male_inventories_length == 0" value="" disabled selected>No replacement inventory</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="inventories in male_inventories" :key="inventories.id" :value="inventories">Tag: {{inventories.replacement_tag}} | Male: {{inventories.number_male}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col input-field s12 m12 l6">
                                                <input v-model.number="number_male" placeholder="Number of male replacements to transfer" id="males" type="number" pattern="\d+" min=0 :max="selected_male_inventory_max" step="1" class="validate">
                                                <label for="males">
                                                    Number of Male 
                                                    <span class="inline_error_message" v-if="number_male>selected_male_inventory_max">
                                                        <i class="fas fa-exclamation-circle"></i> <i>Maximum value for number of male is {{selected_male_inventory_max}}</i>
                                                    </span>
                                                    <span class="inline_error_message" v-if="number_male<0">
                                                        <i class="fas fa-exclamation-circle"></i> <i>Cannot add value less than 0</i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6 input-field">
                                                <input v-model="male_wingband" type="text" id="male_wingbands" placeholder="Separated by commas without spaces eg. 011,211,322,457">
                                                <label for="male_wingbands">
                                                    Male Wing Bands <i>(Optional)</i>
                                                    <span v-if="count(male_wingband)!=number_male" class="inline_warning_message"><i class="fas fa-exclamation-circle"></i> <i>Count of wing bands does not match number of male. Disregard if not recorded.</i></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <label>Female's Generation</label>
                                                <select @change="selectFemaleLine();selected_female_inventory_max=0;" v-model="selected_female_gen" class="browser-default">
                                                    <option v-if="generations_length === 0" value="" disabled selected>No generation</option>
                                                    <option v-else-if="generations_length > 0" value="" disabled selected>Choose your option</option>
                                                    <option v-for="generation in generations" :key="generation.id" :value="generation.id">{{generation.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Female's Line</label>
                                                <select @change="selectFemaleFamily();selected_female_inventory_max=0;" v-model="selected_female_line" class="browser-default">
                                                    <option v-if="female_lines_length == 0" value="" disabled selected>No lines</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="line in female_lines" :key="line.id" :value="line.id">{{line.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Female's Family</label>
                                                <select @change="selectFemaleInventory();selected_female_inventory_max=0;" v-model="selected_female_fam" class="browser-default">
                                                    <option v-if="female_families_length == 0" value="" disabled selected>No families</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="family in female_families" :key="family.id" :value="family.id">{{family.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Female's Replacement Inventory</label>
                                                <select v-model="selected_female_inv" @change="selected_female_inventory_max=selected_female_inv.number_female" class="browser-default">
                                                    <option v-if="female_inventories_length == 0" value="" disabled selected>No replacement inventory</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="inventories in female_inventories" :key="inventories.id" :value="inventories">Tag : {{inventories.replacement_tag}} | Female : {{inventories.number_female}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col input-field s12 m12 l6">
                                                <input v-model.number="number_female" placeholder="Number of female replacements to transfer" id="females" type="number" pattern="\d+" min=0 :max="selected_female_inventory_max" step="1" class="validate">
                                                <label for="females">
                                                    Number of Female 
                                                    <span class="inline_error_message" v-if="number_female>selected_female_inventory_max">
                                                        <i class="fas fa-exclamation-circle"></i> <i>Maximum value for number of female is {{selected_female_inventory_max}}</i>
                                                    </span>
                                                    <span class="inline_error_message" v-if="number_female<0">
                                                        <i class="fas fa-exclamation-circle"></i> <i>Cannot add value less than 0</i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6 input-field">
                                                <input v-model="female_wingband" type="text" id="female_wingbands" placeholder="Separated by commas without spaces eg. 011,211,322,457">
                                                <label for="female_wingbands">
                                                    Female Wing Bands <i>(Optional)</i> 
                                                    <span v-if="count(female_wingband)!=number_female" class="inline_warning_message"><i class="fas fa-exclamation-circle"></i> <i>Count of wing bands does not match number of female. Disregard if not recorded.</i></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Place to pen</label>
                                                <select v-model="selected_pen" class="browser-default">
                                                    <option v-if="pens_length == 0" value="" disabled selected>No breeder pens available</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="pen in pens" :key="pen.id" :value="pen">{{pen.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label for="date_added">Date Transferred</label>
                                                <datepicker id="date_added" :format="customFormatter(date_added)" v-model="date_added"></datepicker>
                                            </div>
                                        </div>
                                        <div class="row center">
                                            <div class="col s12 m12 l12">
                                                <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action" :disabled="submitting_form">Save
                                                    <i class="far fa-save"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Outside System -->
                                <div id="outside">
                                    <form v-on:submit.prevent="validateInput()" method="post">
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label class="active" for="estimated_batching_date">Estimated Date of Hatch</label>
                                                <datepicker id="estimated_batching_date" :format="customFormatter(estimated_batching_date)" v-model="estimated_batching_date"></datepicker>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Generation</label>
                                                <select @change="selectMaleLine" v-model="selected_male_gen" class="browser-default">
                                                    <option v-if="generations_length == 0" value="" disabled selected>No generation</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="generation in generations" :key="generation.id" :value="generation.id">{{generation.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Line</label>
                                                <select @change="selectMaleFamily" v-model="selected_male_line" class="browser-default">
                                                    <option v-if="male_lines_length == 0" value="" disabled selected>No lines</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="line in male_lines" :key="line.id" :value="line.id">{{line.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Family</label>
                                                <select v-model="selected_male_fam" class="browser-default">
                                                    <option v-if="male_families_length == 0" value="" disabled selected>No families</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="family in male_families" :key="family.id" :value="family.id">{{family.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col input-field s12 m12 l6">
                                                <input v-model.number="number_male" placeholder="Number of male replacements to add" id="males" type="number" min=0 class="validate">
                                                <label for="males">
                                                    Number of Male
                                                    <span class="inline_error_message" v-if="number_male<0">
                                                        <i class="fas fa-exclamation-circle"></i> <i>Cannot add value less than 0</i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6 input-field">
                                                <input v-model="male_wingband" type="text" id="male_wingbands" placeholder="Separated by commas without spaces eg. 011,211,322,457">
                                                <label for="male_wingbands">
                                                    Male Wing Bands <i>(Optional)</i>
                                                    <span v-if="count(male_wingband)!=number_male" class="inline_warning_message"><i class="fas fa-exclamation-circle"></i> <i>Count of wing bands does not match number of male. Disregard if not recorded.</i></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col input-field s12 m12 l6">
                                                <input v-model.number="number_female" placeholder="Number of female replacements to add" id="females" type="number" min=0 class="validate">
                                                <label for="females">
                                                    Number of Female
                                                    <span class="inline_error_message" v-if="number_female<0">
                                                        <i class="fas fa-exclamation-circle"></i> <i>Cannot add value less than 0</i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6 input-field">
                                                <input v-model="female_wingband" type="text" id="female_wingbands" placeholder="Separated by commas without spaces eg. 011,211,322,457">
                                                <label for="female_wingbands">
                                                    Female Wing Bands <i>(Optional)</i> 
                                                    <span v-if="count(female_wingband)!=number_female" class="inline_warning_message"><i class="fas fa-exclamation-circle"></i> <i>Count of wing bands does not match number of female. Disregard if not recorded.</i></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label>Place to pen</label>
                                                <select v-model="selected_pen" class="browser-default">
                                                    <option v-if="pens_length == 0" value="" disabled selected>No breeder pens available</option>
                                                    <option v-else value="" disabled selected>Choose your option</option>
                                                    <option v-for="pen in pens" :key="pen.id" :value="pen">{{pen.number}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l6">
                                                <label for="date_added">Date Transferred</label>
                                                <datepicker id="date_added" :format="customFormatter(date_added)" v-model="date_added"></datepicker>
                                            </div>
                                        </div>
                                        <div class="row center">
                                            <div class="col s12 m12 l12">
                                                <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action" :disabled="submitting_form">Save
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
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
            </div>
        </div>

        <div id="cull_modal" class="modal">
            <div class="modal-content">
                <h4 class="red-text"><i class="fas fa-exclamation-triangle"></i> Cull Breeder {{selected_breeder_tag}}?</h4>
                <p>Are you sure you want to <strong>Cull</strong> this breeder group?</p>
                <p>This action is <strong>irreversible</strong></p>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">No</a>
                <a @click="cullBreeder" href="javascript:void(0)" class="modal-action modal-close waves-effect waves-grey btn-flat">Yes</a>
            </div>
        </div>
        
        <div id="additional_breeder" class="modal modal-fixed-footer">
            <form v-on:submit.prevent="validateAdditionalBreeders">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Add More Breeders to {{selected_additional_tag}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <i>
                                <p>Note :</p>
                                <p>Adding Breeders from the system will use replacement stocks</p>
                                <p>Inventories that will be displayed will depend on the age of flock where the new breeders will be added</p>
                            </i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l6">
                            <label>Get from the system</label>                        
                            <div class="switch">
                                <label>
                                    No
                                <input type="checkbox" v-model="add_within" @change="selected_male_inventory=null;selected_female_inventory=null;add_male = 0; add_female = 0;date_additional=null">
                                <span class="lever"></span>
                                    Yes
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="add_within">
                        <div class="col s12 m12 l6">
                            <label for="male_inventory">Male Inventory</label>
                            <select class="browser-default" v-model="selected_male_inventory" @change="additional_male_inventory_max=selected_male_inventory.number_male">
                                <option v-if="valid_male_inventory === undefined || valid_male_inventory.length == 0" disabled selected>No Inventories</option>
                                <option v-for="inv in valid_male_inventory" :key="inv.id" :value="inv">Tag : {{inv.replacement_tag}} Male : {{inv.number_male}} Batching Date : {{inv.batching_date}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12 l6">
                            <input v-if="selected_male_inventory==null && add_within==true" placeholder="Number of rooster/drake that you want to add to the breeder flock" id="additional_male" type="number" disabled>
                            <input v-else-if="selected_male_inventory==null && add_within==false" v-model="add_male" placeholder="Number of rooster/drake that you want to add to the breeder flock" id="additional_male" type="number">
                            <input v-else-if="selected_male_inventory!=null && add_within==true" v-model="add_male" placeholder="Number of rooster/drake that you want to add to the breeder flock" id="additional_male" type="number" min="1" :max="additional_male_inventory_max" class="validate" pattern="^[0-9]">
                            <label v-if="add_within" for="additional_male" class="active">
                                Male to Add
                                <span class="inline_error_message" v-if="add_male>additional_male_inventory_max">
                                    <i class="fas fa-exclamation-circle"></i> <i>Maximum value for number of male is {{additional_male_inventory_max}}</i>
                                </span>
                                <span class="inline_error_message" v-if="add_male<0">
                                    <i class="fas fa-exclamation-circle"></i> <i>Cannot add value less than 0</i>
                                </span>
                            </label>
                            <label v-else for="additional_male" class="active">
                                Male to Add
                                <span class="inline_error_message" v-if="add_male<0">
                                    <i class="fas fa-exclamation-circle"></i> <i>Cannot add value less than 0</i>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l6 input-field">
                            <input v-model="add_male_wingband" type="text" id="male_wingbands" placeholder="Separated by commas without spaces eg. 011,211,322,457">
                            <label for="male_wingbands" class="active">
                                Male Wing Bands <i>(Optional)</i>
                                <span v-if="count(add_male_wingband)!=add_male" class="inline_warning_message"><i class="fas fa-exclamation-circle"></i> <i>Count of wing bands does not match male. Disregard if not recorded.</i></span>
                            </label>
                        </div>
                    </div>
                    <div class="row" v-if="add_within">
                        <div class="col s12 m12 l6">
                            <label for="female_inventory">Female Inventory</label>
                            <select class="browser-default" v-model="selected_female_inventory" @change="additional_female_inventory_max=selected_female_inventory.number_female">
                                <option v-if="valid_female_inventory === undefined || valid_female_inventory.length == 0" disabled selected>No Inventories</option>
                                <option v-for="inv in valid_female_inventory" :key="inv.id" :value="inv">Tag : {{inv.replacement_tag}} Female : {{inv.number_female}} Batching Date : {{inv.batching_date}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12 l6">
                            <input v-if="selected_female_inventory==null && add_within==true" placeholder="Number of hens that you want to add to the breeder flock" id="additional_female" type="number" disabled>
                            <input v-else-if="selected_female_inventory==null && add_within==false" v-model="add_female" placeholder="Number of hens that you want to add to the breeder flock" id="additional_female" type="number">
                            <input v-else-if="selected_female_inventory!=null && add_within==true" v-model="add_female" value="add_female" placeholder="Number of hens that you want to add to the breeder flock" id="additional_female" type="number" min="1" :max="selected_female_inventory.number_female" class="validate" pattern="^[0-9]">
                            <label v-if="add_within" for="additional_female" class="active">
                                Female to Add
                                <span class="inline_error_message" v-if="add_female>additional_female_inventory_max">
                                    <i class="fas fa-exclamation-circle"></i> <i>Maximum value for number of female is {{additional_female_inventory_max}}</i>
                                </span>
                                <span class="inline_error_message" v-if="add_female<0">
                                    <i class="fas fa-exclamation-circle"></i> <i>Cannot add value less than 0</i>
                                </span>
                            </label>
                            <label v-else for="additional_female" class="active">
                                Female to Add
                                <span class="inline_error_message" v-if="add_female<0">
                                    <i class="fas fa-exclamation-circle"></i> <i>Cannot add value less than 0</i>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l6 input-field">
                            <input v-model="add_female_wingband" type="text" id="female_wingbands" placeholder="Separated by commas without spaces eg. 011,211,069,322">
                            <label for="female_wingbands" class="active">
                                Female Wing Bands <i>(Optional)</i> 
                                <span v-if="count(add_female_wingband)!=add_female" class="inline_warning_message"><i class="fas fa-exclamation-circle"></i> <i>Count of wing bands does not match female. Disregard if not recorded.</i></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="modal-action modal-close waves-effect waves-gray btn-flat" type="submit" :disabled="submitting_add">Submit</button>
                    <a @click="valid_male_inventory = {}; 
                    valid_female_inventory = {};
                    valid_male_inventory_length = 0;
                    valid_female_inventory_length = 0;
                    selected_male_inventory = null;
                    selected_female_inventory = null;
                    add_within=false;
                    add_male = 0;
                    add_female = 0;
                    date_additional = null" 
                    href="javascript:void(0)" class="modal-action modal-close waves-effect waves-gray btn-flat ">Close</a>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import tippy from 'tippy.js';
    Vue.component('pagination', require('laravel-vue-pagination'));
    var moment = require('moment');
    export default {
        components : {
            Datepicker
        },
        data() {
            return {
                search : '',
                breeders : {},
                breeders_length : 0,
                // form data
                within : true,
                hide_note : false,
                selected_male_inventory_max : 0,
                selected_female_inventory_max : 0,
                additional_male_inventory_max : 0,
                additional_female_inventory_max : 0,
                generations : [],
                generations_length : 0,
                selected_male_gen : '',
                selected_female_gen : '',
                male_lines : [],
                male_lines_length : 0,
                selected_male_line : '',
                male_families : [],
                male_families_length : 0,
                selected_male_fam : '',
                male_inventories : [],
                male_inventories_length : 0,
                selected_male_inv : '',
                number_male : 0,
                male_wingband : "",
                female_lines : [],
                female_lines_length : 0,
                selected_female_line : '',
                female_families : [],
                female_families_length : 0,
                selected_female_fam : '',
                female_inventories : [],
                female_inventories_length : 0,
                selected_female_inv : '',
                number_female : 0,
                female_wingband : "",
                pens : [],
                pens_length : 0,
                selected_pen : '',
                date_added : '',
                estimated_batching_date : '',

                inventory_list : true,
                selected_breeder_tag : null,
                breeder_hatchery : null,
                breeder_eggprod : null,
                breeder_eggquality : null,
                breeder_feeding : null,
                breeder_mortality : null,
                breeder_phenomorpho : null,
                breeder_delete : null,
                breeder_mortality : null,

                breeder_additional : '',
                selected_additional_tag : '',
                add_within : false,
                add_male : 0,
                add_female : 0,
                add_male_wingband : "",
                add_female_wingband : "",

                valid_male_inventory : {},
                valid_female_inventory : {},
                valid_male_inventory_length : 0,
                valid_female_inventory_length : 0,
                selected_male_inventory : null,
                selected_female_inventory : null,
                submitting_add : false,
                submitting_form : false,
            }
        },
        methods : {
            initialize : function () {
                this.getBreederList();
                this.fetchGeneration();
                this.fetchPens();
            },
            getBreederList : function (page = 1) {
                axios.get('breeder_list?page=' + page)
                .then(response => {
                    this.breeders = response.data;
                    this.breeders_length = this.breeders.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            fetchGeneration : function () {
                axios.get('breeder_fetch_generation')
                .then(response => {
                    this.generations_length = response.data.length;
                    this.generations = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectMaleLine : function () {
                axios.get('breeder_fetch_line/'+this.selected_male_gen)
                .then(response => {
                    this.male_lines_length = response.data.length;
                    this.male_lines = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectFemaleLine : function () {
                axios.get('breeder_fetch_line/'+this.selected_female_gen)
                .then(response => {
                    this.female_lines_length = response.data.length;
                    this.female_lines = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectMaleFamily : function () {
                axios.get('breeder_fetch_families/'+this.selected_male_line)
                .then(response => {
                    this.male_families_length = response.data.length;
                    this.male_families = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectFemaleFamily : function () {
                axios.get('breeder_fetch_families/'+this.selected_female_line)
                .then(response => {
                    this.female_families_length = response.data.length;
                    this.female_families = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectMaleInventory : function () {
                var gender = "male";
                axios.get('breeder_fetch_inventories/'+this.selected_male_fam+'/'+gender)
                .then(response => {
                    this.male_inventories_length = response.data.length;
                    this.male_inventories = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectFemaleInventory : function () {
                var gender = "female";
                axios.get('breeder_fetch_inventories/'+this.selected_female_fam+'/'+gender)
                .then(response => {
                    this.female_inventories_length = response.data.length;
                    this.female_inventories = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            fetchPens : function () {
                axios.get('breeder_fetch_pens')
                .then(response => {
                    this.pens_length = response.data.length;
                    this.pens = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addBreeder : function () {
                var param = {};
                if(this.within){
                    param = {
                        within : this.within,
                        male_family : this.selected_male_fam,
                        male_inventory : this.selected_male_inv.id,
                        number_male : this.number_male,
                        female_family : this.selected_female_fam,
                        female_inventory : this.selected_female_inv.id,
                        number_female : this.number_female,
                        pen_id : this.selected_pen.id,
                        date_added : this.customFormatter(this.date_added),
                        male_wingband : this.male_wingband,
                        female_wingband : this.female_wingband,
                        generation : this.selected_male_gen,
                        line : this.selected_male_line,
                    };
                }else{
                    param = {
                        within : this.within,
                        estimated_batching_date : this.customFormatter(this.estimated_batching_date),
                        family : this.selected_male_fam,
                        number_male : this.number_male,
                        number_female : this.number_female,
                        pen_id : this.selected_pen.id,
                        date_added : this.customFormatter(this.date_added),
                        male_wingband : this.male_wingband,
                        female_wingband : this.female_wingband,
                        generation : this.selected_male_gen,
                        line : this.selected_male_line,
                    };
                }
                axios.post('add_breeder', param)
                .then(response => {
                    if(response.data.error == undefined){
                        this.selected_male_gen = '';
                        this.selected_female_gen = '';
                        this.male_lines = [];
                        this.male_lines_length = 0;
                        this.selected_male_line = '';
                        this.male_families = [];
                        this.male_families_length = 0;
                        this.selected_male_fam = '';
                        this.male_inventories = [];
                        this.male_inventories_length = 0;
                        this.selected_male_inv = '';
                        this.number_male = 0;
                        this.female_lines = [];
                        this.female_lines_length = 0;
                        this.selected_female_line = '';
                        this.female_families = [];
                        this.female_families_length = 0;
                        this.selected_female_fam = '';
                        this.female_inventories = [];
                        this.female_inventories_length = 0;
                        this.selected_female_inv = '';
                        this.number_female = 0;
                        this.selected_pen = '';
                        this.date_added = '';
                        this.estimated_batching_date = '';
                        this.male_wingband = "";
                        this.female_wingband = "";
                        Materialize.toast('Successfully added breeders', 5000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 5000, 'red rounded');
                    }
                    this.submitting_form=false;
                });
                this.initialize();
            },
            cullBreeder : function () {
                axios.delete('cull_breeder/'+this.breeder_delete)
                .then(response => {
                    if(response.data.error == undefined){
                        this.breeder_delete = '';
                        $('#cull_modal').modal('close')
                        Materialize.toast('Successfully culled breeder', 5000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 5000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast('Failed to cull breeder', 5000, 'red rounded');
                });
                this.initialize();
            },
            addAdditionalBreeder : function () {
                var input = {};
                if(this.add_within){
                    input = {
                        selected_breeder : this.breeder_additional,
                        within : this.add_within,
                        male : this.add_male,
                        female : this.add_female,
                        replacement_male_inventory : this.selected_male_inventory.id,
                        replacement_female_inventory : this.selected_female_inventory.id,
                        male_wingband : this.add_male_wingband,
                        female_wingband : this.add_female_wingband
                    }
                }else{
                    input = {
                        selected_breeder : this.breeder_additional,
                        within : this.add_within,
                        male : this.add_male,
                        female : this.add_female,
                        male_wingband : this.add_male_wingband,
                        female_wingband : this.add_female_wingband
                    }
                }
                axios.post('add_breeder_additional', input)
                .then(response => {
                    this.breeder_additional = '';
                    this.add_within = false;
                    this.add_male = 0;
                    this.add_female = 0;
                    this.selected_male_inventory = null;
                    this.selected_female_inventory = null;
                    this.add_male_wingband = "";
                    this.add_female_wingband = "";
                    Materialize.toast('Successfully added breeder', 5000, 'green rounded');
                    this.submitting_add = false;
                })
                this.getBreederList();
            },
            getValidAdditionalMaleBreeder : function () {
                axios.get('breeder_add_male_inventory/'+this.breeder_additional)
                .then(response => {
                    this.valid_male_inventory = response.data;
                    this.valid_male_inventory_length = this.valid_male_inventory.length;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            getValidAdditionalFemaleBreeder : function () {
                axios.get('breeder_add_female_inventory/'+this.breeder_additional)
                .then(response => {
                    this.valid_female_inventory = response.data;
                    this.valid_female_inventory_length = this.valid_female_inventory.length;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            searchBreeder : function (page = 1) {
                axios.get('search_breeder/'+this.search+"?page="+page).then(response => {
                    this.breeders = response.data;
                    this.breeders_length = this.breeders.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            
            validateInput : function () {
                this.submitting_form=true;
                if(this.within){
                    if(this.selected_male_inv === "" || this.selected_female_inv === "" || this.selected_pen.total_capacity === "" || (this.number_male + this.number_female) === 0 || this.date_added === ""){
                        Materialize.toast('Check your form for incomplete data', 5000, 'red rounded');
                        return;
                    }
                    else{
                        if((this.number_male > this.selected_male_inv.number_male) || this.number_male < 0){
                            Materialize.toast('Invalid number of male', 5000, 'red rounded');
                            return;
                        }
                        if((this.number_female > this.selected_female_inv.number_female) || this.number_female < 0){
                            Materialize.toast('Invalid number of female', 5000, 'red rounded');
                            return;
                        }   
                        if(this.selected_pen.total_capacity < (this.number_male + this.number_female)){
                            Materialize.toast('Pen capacity not enough', 5000, 'red rounded');
                            return;
                        }
                        if((this.count(this.female_wingband) > 0 && this.count(this.female_wingband) != this.number_female) || (this.count(this.male_wingband) > 0 && this.count(this.male_wingband) != this.number_male)){
                            Materialize.toast('Wing band count and animal count does not match', 5000, 'red rounded');
                            return;
                        }
                        this.addBreeder();
                    }
                }else{
                    if(this.selected_pen.total_capacity === "" || (this.number_male + this.number_female) === 0 || this.estimated_batching_date === "" || this.date_added === ""){
                        Materialize.toast('Check your form for incomplete data', 5000, 'red rounded');
                        return;
                    }else{
                        if(this.selected_pen.total_capacity < (this.number_male + this.number_female)){
                            Materialize.toast('Pen capacity not enough', 5000, 'red rounded');
                            return;
                        }
                        if((this.count(this.female_wingband) > 0 && (this.count(this.female_wingband) != this.number_female)) || (this.count(this.male_wingband) > 0 && (this.count(this.male_wingband) != this.number_male))){
                            Materialize.toast('Wing band count and animal count does not match', 5000, 'red rounded');
                            return;
                        }
                        this.addBreeder();
                    }
                }
            },

            validateAdditionalBreeders : function () {
                this.submitting_add=true;
                if(this.add_within){
                    if((this.selected_male_inventory == null && this.add_male!=0) || (this.selected_female_inventory == null && this.add_female!=0) || (this.add_male + this.add_female) === 0){
                        Materialize.toast('Check your form for incomplete data', 5000, 'red rounded');
                        return;
                    }else{
                        if((this.add_male > this.selected_male_inventory.number_male) || this.add_male < 0){
                            Materialize.toast('Invalid number of male', 5000, 'red rounded');
                            return;
                        }
                        if((this.add_female > this.selected_female_inventory.number_female) || this.add_female < 0){
                            Materialize.toast('Invalid number of female', 5000, 'red rounded');
                            return;
                        }
                        if((this.count(this.add_female_wingband) > 0 && (this.count(this.add_female_wingband) != this.add_female)) || (this.count(this.add_male_wingband) > 0 && (this.count(this.add_male_wingband) != this.add_male))){
                            Materialize.toast('Wing band count and animal count does not match', 5000, 'red rounded');
                            return;
                        }
                        this.addAdditionalBreeder();
                    }

                }else{
                    if((this.add_male + this.add_female) === 0){
                        Materialize.toast('Check your form for incomplete data', 5000, 'red rounded');
                        return;
                    }
                    if((this.count(this.add_female_wingband) > 0 && (this.count(this.add_female_wingband) != this.add_female)) || (this.count(this.add_male_wingband) > 0 && (this.count(this.add_male_wingband) != this.add_male))){
                        Materialize.toast('Wing band count and animal count does not match', 5000, 'red rounded');
                        return;
                    }
                    this.addAdditionalBreeder();
                }
            },

            count : function (input) {
                if(input === "") return 0;
                var string = input.replace(/ /g, '');
                return string.split(',').length;
            },

            customFormatter : function (date) {
                var formatted = moment(date).format('YYYY-MM-DD')
                return formatted;
            },
            hideNote : function (el, done) {
                var that = this;
                setTimeout(function() {
                    that.hide_note = false;
                }, 3000);
            },
        },
        mounted () {
            
            tippy('#breeder_page_template', {
                target : '.tooltip',
                arrow: true,
                arrowType: 'round',
                animation: 'scale',
                inertia: true,
            });
            
            this.initialize();
        },
    }
</script>

<style scoped>
    #alert_box_icon{
        font-size: 2.5em;
    }
    .fade-enter-active,
        .fade-leave-active {
        transition: opacity 1s;
    }
    .fade-enter,
    .fade-leave-to
    {
        opacity: 0
    }
    .input-field input[type=number]:focus + label {
        color: #607d8b;
    }
    .input-field input[type=number]:focus {
        border-bottom: 1px solid #607d8b;
        box-shadow: 0 1px 0 0 #546e7a;
    }
    #additional_breeder{
        width: 80%;
        height: 90%;
    }
    .custom_card{
        height: 700px;
    }
    .custom_card_content{
        height: 440px;
    }
    .custom_card_content .collection{
        height: 400px;
    }
    .custom_content_inventory {
        height: 180px;
    }
</style>
