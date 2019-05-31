<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>{{title}} | Generation {{generation.number}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-image fixed-action-btn toolbar">
                            <a data-tippy-content="Click to Choose Phenotypic Characteristics" class="btn-floating btn-large halfway-fab waves-effect waves-light blue-grey tooltip"><i class="fas fa-bars"></i></a>
                            <ul v-if="animal_type === 1">
                                <li data-tippy-content="Plummage Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='plumage_color'"><i class="fas fa-palette"></i></a></li>
                                <li data-tippy-content="Plummage Pattern" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='plumage_pattern'"><i class="fas fa-swatchbook"></i></a></li>
                                <li data-tippy-content="Hackle Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='hackle_color'"><i class="fas fa-feather"></i></a></li>
                                <li data-tippy-content="Hackle Pattern" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='hackle_pattern'"><i class="fas fa-tint"></i></a></li>
                                <li data-tippy-content="Body Carriage" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='body_carriage'"><i class="fas fa-crow"></i></a></li>
                                <li data-tippy-content="Comb Type" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='comb_type'"><i class="fas fa-crown"></i></a></li>
                                <li data-tippy-content="Comb Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='comb_color'"><i class="fas fa-fill"></i></a></li>
                                <li data-tippy-content="Earlobe Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='earlobe_color'"><i class="fas fa-assistive-listening-systems"></i></a></li>
                                <li data-tippy-content="Iris Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='iris_color'"><i class="far fa-eye"></i></a></li>
                                <li data-tippy-content="Beak Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='beak_color'"><i class="fas fa-brush"></i></a></li>
                                <li data-tippy-content="Shank Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='shank_color'"><i class="fas fa-socks"></i></a></li>
                                <li data-tippy-content="Skin Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='skin_color'"><i class="fas fa-allergies"></i></a></li>
                            </ul>
                            <ul v-if="animal_type === 2">
                                <li data-tippy-content="Plummage Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='plumage_color'"><i class="fas fa-palette"></i></a></li>
                                <li data-tippy-content="Plummage Pattern" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='plumage_pattern'"><i class="fas fa-swatchbook"></i></a></li>
                                <li data-tippy-content="Body Carriage" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='body_carriage'"><i class="fas fa-crow"></i></a></li>
                                <li data-tippy-content="Shank Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='shank_color'"><i class="fas fa-socks"></i></a></li>
                                <li data-tippy-content="Skin Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='skin_color'"><i class="fas fa-allergies"></i></a></li>
                                <li data-tippy-content="Neck Feather Marking" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='neckf_mark'"><i class="fas fa-highlighter"></i></a></li>
                                <li data-tippy-content="Neck Feather Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='neckf_color'"><i class="fas fa-tint"></i></a></li>
                                <li data-tippy-content="Tail Feather Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='tailf_color'"><i class="fas fa-eye-dropper"></i></a></li>
                                <li data-tippy-content="Bill Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='bill_color'"><i class="fas fa-brush"></i></a></li>
                                <li data-tippy-content="Bill Shape" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='bill_shape'"><i class="fas fa-shapes"></i></a></li>
                                <li data-tippy-content="Bean Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='bean_color'"><i class="fas fa-map-marker"></i></a></li>
                                <li data-tippy-content="Presence of Crest" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='presence_crest'"><i class="fas fa-jedi"></i></a></li>
                                <li data-tippy-content="Eye Color" class="waves-effect waves-light tooltip"><a href="#" onclick="return false;" @click="characteristic='eye_color'"><i class="far fa-eye"></i></a></li>
                            </ul>
                        </div>
                         <div class="card-content">
                             <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                              <div class="row">
                                                <div class="col s12 m12 l12">
                                                <ul class="tabs">
                                                    <li class="tab col s6 m6 l6"><a href="#test1">REPLACEMENTS</a></li>
                                                    <li class="tab col s6 m6 l6"><a href="#test2">BREEDERS</a></li>
                                                </ul>
                                                </div>
                                                <div id="test1" class="col s12 m12 l12">
                                                    <div v-if="characteristic===null">
                                                        <div class="row">
                                                            <div class="col s12 m12 l12 center-align title-style">
                                                                CHOOSE CHARACTERISTIC TO DISPLAY
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m12 l12 center-align">
                                                                <p>* Press the Menu <i class="fas fa-bars"></i> to choose for the desired characteristics to show</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div v-else>
                                                        <div class="row">
                                                            <div class="col s12 m12 l12 center-align title-style">
                                                                MALE <i class="fas fa-mars"></i>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="Object.entries(male_replacement_records[characteristic]).length === 0 && male_replacement_records[characteristic].constructor === Object">
                                                            <div class="col s12 m12 l12 center-align">
                                                                <strong>NO DATA</strong>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-else>
                                                            <div class="col s12 m12 l12">
                                                                <table class="bordered centered responsive-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Line</th>
                                                                            <th>Data</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        <tr v-for="(line, lindex) in male_replacement_records[characteristic]" :key="lindex">
                                                                            <td>{{lindex}}</td>
                                                                            <td>
                                                                                <table class="bordered centered responsive-table">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th><i class="fas fa-dna"></i></th>
                                                                                            <th><i class="fas fa-table"></i></th>
                                                                                        </tr>
                                                                                    </thead>

                                                                                    <tbody>
                                                                                        <tr v-for="(fam, findex) in line" :key="findex">
                                                                                            <td>{{findex}}</td>
                                                                                            <td>
                                                                                                <table class="bordered centered responsive-table">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th><i class="fas fa-feather"></i></th>
                                                                                                            <th><i class="fas fa-sort-amount-down"></i></th>
                                                                                                            <th><i class="fas fa-percentage"></i></th>
                                                                                                        </tr>
                                                                                                    </thead>

                                                                                                    <tbody>
                                                                                                        <tr v-for="(attr, index) in fam" :key="index">
                                                                                                            <td>{{index}}</td>
                                                                                                            <td>{{attr}}</td>
                                                                                                            <td></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                            
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m12 l12 center-align title-style">
                                                                FEMALE <i class="fas fa-venus"></i>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="Object.entries(female_replacement_records[characteristic]).length === 0 && female_replacement_records[characteristic].constructor === Object">
                                                            <div class="col s12 m12 l12 center-align">
                                                                <strong>NO DATA</strong>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-else>
                                                            <div class="col s12 m12 l12">
                                                                <table class="bordered centered responsive-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Line</th>
                                                                            <th>Data</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        <tr v-for="(line, lindex) in female_replacement_records[characteristic]" :key="lindex">
                                                                            <td>{{lindex}}</td>
                                                                            <td>
                                                                                <table class="bordered centered responsive-table">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th><i class="fas fa-dna"></i></th>
                                                                                            <th><i class="fas fa-table"></i></th>
                                                                                        </tr>
                                                                                    </thead>

                                                                                    <tbody>
                                                                                        <tr v-for="(fam, findex) in line" :key="findex">
                                                                                            <td>{{findex}}</td>
                                                                                            <td>
                                                                                                <table class="bordered centered responsive-table">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th><i class="fas fa-feather"></i></th>
                                                                                                            <th><i class="fas fa-sort-amount-down"></i></th>
                                                                                                            <th><i class="fas fa-percentage"></i></th>
                                                                                                        </tr>
                                                                                                    </thead>

                                                                                                    <tbody>
                                                                                                        <tr v-for="(attr, index) in fam" :key="index">
                                                                                                            <td>{{index}}</td>
                                                                                                            <td>{{attr}}</td>
                                                                                                            <td>{{getPercentage(attr, fam)}}%</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="test2" class="col s12 m12 l12">
                                                    <div v-if="characteristic===null">
                                                        <div class="row">
                                                            <div class="col s12 m12 l12 center-align title-style">
                                                                CHOOSE CHARACTERISTIC TO DISPLAY
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m12 l12 center-align">
                                                                <p>* Press the Menu <i class="fas fa-bars"></i> to choose for the desired characteristics to show</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div v-else>
                                                        <div class="row">
                                                            <div class="col s12 m12 l12 center-align title-style">
                                                                MALE <i class="fas fa-mars"></i>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="Object.entries(male_breeder_records[characteristic]).length === 0 && male_breeder_records[characteristic].constructor === Object">
                                                            <div class="col s12 m12 l12 center-align">
                                                                <strong>NO DATA</strong>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-else>
                                                            <div class="col s12 m12 l12">
                                                                <table class="bordered centered responsive-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Line</th>
                                                                            <th>Data</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        <tr v-for="(line, lindex) in male_breeder_records[characteristic]" :key="lindex">
                                                                            <td>{{lindex}}</td>
                                                                            <td>
                                                                                <table class="bordered centered responsive-table">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th><i class="fas fa-dna"></i></th>
                                                                                            <th><i class="fas fa-table"></i></th>
                                                                                        </tr>
                                                                                    </thead>

                                                                                    <tbody>
                                                                                        <tr v-for="(fam, findex) in line" :key="findex">
                                                                                            <td>{{findex}}</td>
                                                                                            <td>
                                                                                                <table class="bordered centered responsive-table">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th><i class="fas fa-feather"></i></th>
                                                                                                            <th><i class="fas fa-sort-amount-down"></i></th>
                                                                                                            <th><i class="fas fa-percentage"></i></th>
                                                                                                        </tr>
                                                                                                    </thead>

                                                                                                    <tbody>
                                                                                                        <tr v-for="(attr, index) in fam" :key="index">
                                                                                                            <td>{{index}}</td>
                                                                                                            <td>{{attr}}</td>
                                                                                                            <td>{{getPercentage(attr, fam)}}%</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12 m12 l12 center-align title-style">
                                                                FEMALE <i class="fas fa-venus"></i>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="Object.entries(female_breeder_records[characteristic]).length === 0 && female_breeder_records[characteristic].constructor === Object">
                                                            <div class="col s12 m12 l12 center-align">
                                                                <strong>NO DATA</strong>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-else>
                                                            <div class="col s12 m12 l12">
                                                                <table class="bordered centered responsive-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Line</th>
                                                                            <th>Data</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        <tr v-for="(line, lindex) in female_breeder_records[characteristic]" :key="lindex">
                                                                            <td>{{lindex}}</td>
                                                                            <td>
                                                                                <table class="bordered centered responsive-table">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th><i class="fas fa-dna"></i></th>
                                                                                            <th><i class="fas fa-table"></i></th>
                                                                                        </tr>
                                                                                    </thead>

                                                                                    <tbody>
                                                                                        <tr v-for="(fam, findex) in line" :key="findex">
                                                                                            <td>{{findex}}</td>
                                                                                            <td>
                                                                                                <table class="bordered centered responsive-table">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th><i class="fas fa-feather"></i></th>
                                                                                                            <th><i class="fas fa-sort-amount-down"></i></th>
                                                                                                            <th><i class="fas fa-percentage"></i></th>
                                                                                                        </tr>
                                                                                                    </thead>

                                                                                                    <tbody>
                                                                                                        <tr v-for="(attr, index) in fam" :key="index">
                                                                                                            <td>{{index}}</td>
                                                                                                            <td>{{attr}}</td>
                                                                                                            <td>{{getPercentage(attr, fam)}}%</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const math = require('mathjs');
import tippy from 'tippy.js';
export default {
    props: [
        'animal_type',
        'title',
        'generation'
    ],
     data () {
        return {
            characteristic : null,
            breeder_data : null,
            replacement_data : null,
            breeder_data_len : 0,
            replacement_data_len : 0,
            breeder_records : {},
            replacement_records : {},
            male_breeder_records : {},
            female_breeder_records : {},
            male_replacement_records : {},
            female_replacement_records : {},
        }
    },
    methods : {
        init : function () {
            this.getBreederPhenoSummary();
            this.getReplacementPhenoSummary();
        },
        
        getBreederPhenoSummary : function () {
            axios.get('family_summary_breeder_pheno/'+this.generation.id)
            .then(response => {
                this.breeder_data = response.data;
                this.breeder_data_len = this.breeder_data.length;
                this.male_breeder_records = {};
                this.female_breeder_records = {};
                if(this.animal_type === 1){
                    this.male_breeder_records['plumage_color'] = {};
                    this.female_breeder_records['plumage_color'] = {};
                    this.male_breeder_records['plumage_pattern'] = {};
                    this.female_breeder_records['plumage_pattern'] = {};
                    this.male_breeder_records['hackle_color'] = {};
                    this.female_breeder_records['hackle_color'] = {};
                    this.male_breeder_records['hackle_pattern'] = {};
                    this.female_breeder_records['hackle_pattern'] = {};
                    this.male_breeder_records['body_carriage'] = {};
                    this.female_breeder_records['body_carriage'] = {};
                    this.male_breeder_records['comb_type'] = {};
                    this.female_breeder_records['comb_type'] = {};
                    this.male_breeder_records['comb_color'] = {};
                    this.female_breeder_records['comb_color'] = {};
                    this.male_breeder_records['earlobe_color'] = {};
                    this.female_breeder_records['earlobe_color'] = {};
                    this.male_breeder_records['iris_color'] = {};
                    this.female_breeder_records['iris_color'] = {};
                    this.male_breeder_records['beak_color'] = {};
                    this.female_breeder_records['beak_color'] = {};
                    this.male_breeder_records['shank_color'] = {};
                    this.female_breeder_records['shank_color'] = {};
                    this.male_breeder_records['skin_color'] = {};
                    this.female_breeder_records['skin_color'] = {};
                    
                    this.breeder_data.forEach(element => {
                        var values = JSON.parse(element.phenotypic);
                        if(element.gender === "male"){
                            if((typeof this.male_breeder_records['plumage_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['plumage_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['plumage_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['plumage_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] = 0
                            }
                            this.male_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()]++;
                            
                            if((typeof this.male_breeder_records['plumage_pattern'][element.line_number] === 'undefined')){
                                this.male_breeder_records['plumage_pattern'][element.line_number] = {};
                            }

                            if((typeof this.male_breeder_records['plumage_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['plumage_pattern'][element.line_number][element.family_number] = {};
                            }

                            if((typeof this.male_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] = 0
                            }
                            this.male_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()]++;

                            if((typeof this.male_breeder_records['hackle_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['hackle_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['hackle_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['hackle_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()] = 0
                            }
                            this.male_breeder_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()]++;

                            if((typeof this.male_breeder_records['hackle_pattern'][element.line_number] === 'undefined')){
                                this.male_breeder_records['hackle_pattern'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['hackle_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['hackle_pattern'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()] = 0
                            }
                            this.male_breeder_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()]++;

                            if((typeof this.male_breeder_records['body_carriage'][element.line_number] === 'undefined')){
                                this.male_breeder_records['body_carriage'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['body_carriage'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['body_carriage'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()] = 0
                            }
                            this.male_breeder_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()]++;
                            
                            if((typeof this.male_breeder_records['comb_type'][element.line_number] === 'undefined')){
                                this.male_breeder_records['comb_type'][element.line_number]  = {};
                            }
                            if((typeof this.male_breeder_records['comb_type'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['comb_type'][element.line_number][element.family_number]  = {};
                            }
                            if((typeof this.male_breeder_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()] = 0
                            }
                            this.male_breeder_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()]++;
                            
                            if((typeof this.male_breeder_records['comb_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['comb_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['comb_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['comb_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()] = 0
                            }
                            this.male_breeder_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()]++;
                            
                            if((typeof this.male_breeder_records['earlobe_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['earlobe_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['earlobe_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['earlobe_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()] = 0
                            }
                            this.male_breeder_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()]++;

                            if((typeof this.male_breeder_records['iris_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['iris_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['iris_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['iris_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()] = 0
                            }
                            this.male_breeder_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()]++;
                            
                            if((typeof this.male_breeder_records['beak_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['beak_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['beak_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['beak_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()] = 0
                            }
                            this.male_breeder_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()]++;

                            if((typeof this.male_breeder_records['shank_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['shank_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['shank_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['shank_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()] = 0
                            }
                            this.male_breeder_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()]++;

                            if((typeof this.male_breeder_records['skin_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['skin_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['skin_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['skin_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()] = 0
                            }
                            this.male_breeder_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()]++;

                        }else{
                            if((typeof this.female_breeder_records['plumage_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['plumage_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['plumage_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] = 0
                            }
                            this.female_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()]++;
                            
                            if((typeof this.female_breeder_records['plumage_pattern'][element.line_number] === 'undefined')){
                                this.female_breeder_records['plumage_pattern'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['plumage_pattern'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] = 0
                            }
                            this.female_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()]++;

                            if((typeof this.female_breeder_records['hackle_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['hackle_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['hackle_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['hackle_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()] = 0
                            }
                            this.female_breeder_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()]++;

                            if((typeof this.female_breeder_records['hackle_pattern'][element.line_number] === 'undefined')){
                                this.female_breeder_records['hackle_pattern'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['hackle_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['hackle_pattern'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()] = 0
                            }
                            this.female_breeder_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()]++;

                            if((typeof this.female_breeder_records['body_carriage'][element.line_number] === 'undefined')){
                                this.female_breeder_records['body_carriage'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['body_carriage'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['body_carriage'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()] = 0
                            }
                            this.female_breeder_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()]++;
                            
                            if((typeof this.female_breeder_records['comb_type'][element.line_number] === 'undefined')){
                                this.female_breeder_records['comb_type'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['comb_type'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['comb_type'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()] = 0
                            }
                            this.female_breeder_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()]++;

                            if((typeof this.female_breeder_records['comb_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['comb_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['comb_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['comb_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()] = 0
                            }
                            this.female_breeder_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()]++;

                            if((typeof this.female_breeder_records['earlobe_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['earlobe_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['earlobe_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['earlobe_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()] = 0
                            }
                            this.female_breeder_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()]++;

                            if((typeof this.female_breeder_records['iris_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['iris_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['iris_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['iris_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()] = 0
                            }
                            this.female_breeder_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()]++;

                            if((typeof this.female_breeder_records['beak_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['beak_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['beak_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['beak_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()] = 0
                            }
                            this.female_breeder_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()]++;

                            if((typeof this.female_breeder_records['shank_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['shank_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['shank_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['shank_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()] = 0
                            }
                            this.female_breeder_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()]++;

                            if((typeof this.female_breeder_records['skin_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['skin_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['skin_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['skin_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()] = 0
                            }
                            this.female_breeder_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()]++;
                        }
                    });

                }else if(this.animal_type === 2){
                    this.male_breeder_records['plumage_color'] = {};
                    this.female_breeder_records['plumage_color'] = {};
                    this.male_breeder_records['plumage_pattern'] = {};
                    this.female_breeder_records['plumage_pattern'] = {};
                    this.male_breeder_records['body_carriage'] = {};
                    this.female_breeder_records['body_carriage'] = {};
                    this.male_breeder_records['shank_color'] = {};
                    this.female_breeder_records['shank_color'] = {};
                    this.male_breeder_records['skin_color'] = {};
                    this.female_breeder_records['skin_color'] = {};
                    this.male_breeder_records['neckf_mark'] = {};
                    this.female_breeder_records['neckf_mark'] = {};
                    this.male_breeder_records['neckf_color'] = {};
                    this.female_breeder_records['neckf_color'] = {};
                    this.male_breeder_records['tailf_color'] = {};
                    this.female_breeder_records['tailf_color'] = {};
                    this.male_breeder_records['bill_color'] = {};
                    this.female_breeder_records['bill_color'] = {};
                    this.male_breeder_records['bill_shape'] = {};
                    this.female_breeder_records['bill_shape'] = {};
                    this.male_breeder_records['bean_color'] = {};
                    this.female_breeder_records['bean_color'] = {};
                    this.male_breeder_records['presence_crest'] = {};
                    this.female_breeder_records['presence_crest'] = {};
                    this.male_breeder_records['eye_color'] = {};
                    this.female_breeder_records['eye_color'] = {};
                    this.breeder_data.forEach(element => {
                        var values = JSON.parse(element.phenotypic);
                        if(element.gender === "male"){
                            if((typeof this.male_breeder_records['plumage_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['plumage_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['plumage_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['plumage_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] = 0
                            }
                            this.male_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()]++;

                            if((typeof this.male_breeder_records['plumage_pattern'][element.line_number] === 'undefined')){
                                this.male_breeder_records['plumage_pattern'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['plumage_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['plumage_pattern'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] = 0
                            }
                            this.male_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()]++;

                            if((typeof this.male_breeder_records['body_carriage'][element.line_number] === 'undefined')){
                                this.male_breeder_records['body_carriage'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['body_carriage'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['body_carriage'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()] = 0
                            }
                            this.male_breeder_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()]++;

                            if((typeof this.male_breeder_records['shank_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['shank_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['shank_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['shank_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()] = 0
                            }
                            this.male_breeder_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()]++;

                            if((typeof this.male_breeder_records['skin_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['skin_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['skin_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['skin_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()] = 0
                            }
                            this.male_breeder_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()]++;

                            if((typeof this.male_breeder_records['neckf_mark'][element.line_number] === 'undefined')){
                                this.male_breeder_records['neckf_mark'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['neckf_mark'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['neckf_mark'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()] = 0
                            }
                            this.male_breeder_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()]++;

                            if((typeof this.male_breeder_records['neckf_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['neckf_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['neckf_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['neckf_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()] = 0
                            }
                            this.male_breeder_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()]++;

                            if((typeof this.male_breeder_records['tailf_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['tailf_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['tailf_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['tailf_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()] = 0
                            }
                            this.male_breeder_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()]++;

                            if((typeof this.male_breeder_records['bill_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['bill_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['bill_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['bill_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()] = 0
                            }
                            this.male_breeder_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()]++;

                            if((typeof this.male_breeder_records['bill_shape'][element.line_number] === 'undefined')){
                                this.male_breeder_records['bill_shape'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['bill_shape'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['bill_shape'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()] = 0
                            }
                            this.male_breeder_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()]++;

                            if((typeof this.male_breeder_records['bean_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['bean_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['bean_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['bean_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()] = 0
                            }
                            this.male_breeder_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()]++;

                            if((typeof this.male_breeder_records['presence_crest'][element.line_number] === 'undefined')){
                                this.male_breeder_records['presence_crest'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['presence_crest'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['presence_crest'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()] = 0
                            }
                            this.male_breeder_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()]++;

                            if((typeof this.male_breeder_records['eye_color'][element.line_number] === 'undefined')){
                                this.male_breeder_records['eye_color'][element.line_number] = {};
                            }
                            if((typeof this.male_breeder_records['eye_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_breeder_records['eye_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_breeder_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()] = 0
                            }
                            this.male_breeder_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()]++;

                        }else{
                            if((typeof this.female_breeder_records['plumage_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['plumage_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['plumage_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] = 0
                            }
                            this.female_breeder_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()]++;

                            if((typeof this.female_breeder_records['plumage_pattern'][element.line_number] === 'undefined')){
                                this.female_breeder_records['plumage_pattern'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['plumage_pattern'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] = 0
                            }
                            this.female_breeder_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()]++;

                            if((typeof this.female_breeder_records['body_carriage'][element.line_number] === 'undefined')){
                                this.female_breeder_records['body_carriage'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['body_carriage'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['body_carriage'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()] = 0
                            }
                            this.female_breeder_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()]++;

                            if((typeof this.female_breeder_records['shank_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['shank_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['shank_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['shank_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()] = 0
                            }
                            this.female_breeder_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()]++;

                            if((typeof this.female_breeder_records['skin_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['skin_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['skin_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['skin_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()] = 0
                            }
                            this.female_breeder_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()]++;

                            if((typeof this.female_breeder_records['neckf_mark'][element.line_number] === 'undefined')){
                                this.female_breeder_records['neckf_mark'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['neckf_mark'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['neckf_mark'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()] = 0
                            }
                            this.female_breeder_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()]++;

                            if((typeof this.female_breeder_records['neckf_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['neckf_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['neckf_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['neckf_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()] = 0
                            }
                            this.female_breeder_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()]++;

                            if((typeof this.female_breeder_records['tailf_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['tailf_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['tailf_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['tailf_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()] = 0
                            }
                            this.female_breeder_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()]++;

                            if((typeof this.female_breeder_records['bill_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['bill_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['bill_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['bill_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()] = 0
                            }
                            this.female_breeder_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()]++;

                            if((typeof this.female_breeder_records['bill_shape'][element.line_number] === 'undefined')){
                                this.female_breeder_records['bill_shape'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['bill_shape'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['bill_shape'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()] = 0
                            }
                            this.female_breeder_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()]++;

                            if((typeof this.female_breeder_records['bean_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['bean_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['bean_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['bean_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()] = 0
                            }
                            this.female_breeder_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()]++;

                            if((typeof this.female_breeder_records['presence_crest'][element.line_number] === 'undefined')){
                                this.female_breeder_records['presence_crest'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['presence_crest'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['presence_crest'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()] = 0
                            }
                            this.female_breeder_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()]++;

                            if((typeof this.female_breeder_records['eye_color'][element.line_number] === 'undefined')){
                                this.female_breeder_records['eye_color'][element.line_number] = {};
                            }
                            if((typeof this.female_breeder_records['eye_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_breeder_records['eye_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_breeder_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()] = 0
                            }
                            this.female_breeder_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()]++;

                        }
                    });
                }
                
            })
            .catch(error => {});
        },

        getReplacementPhenoSummary : function () {
            axios.get('generation_summary_replacement_pheno')
            .then(response => {
                this.replacement_data = response.data;
                this.replacement_data_len = this.replacement_data.length;
                this.male_replacement_records = {};
                this.female_replacement_records = {};
                if(this.animal_type === 1){
                    this.male_replacement_records['plumage_color'] = {};
                    this.female_replacement_records['plumage_color'] = {};
                    this.male_replacement_records['plumage_pattern'] = {};
                    this.female_replacement_records['plumage_pattern'] = {};
                    this.male_replacement_records['hackle_color'] = {};
                    this.female_replacement_records['hackle_color'] = {};
                    this.male_replacement_records['hackle_pattern'] = {};
                    this.female_replacement_records['hackle_pattern'] = {};
                    this.male_replacement_records['body_carriage'] = {};
                    this.female_replacement_records['body_carriage'] = {};
                    this.male_replacement_records['comb_type'] = {};
                    this.female_replacement_records['comb_type'] = {};
                    this.male_replacement_records['comb_color'] = {};
                    this.female_replacement_records['comb_color'] = {};
                    this.male_replacement_records['earlobe_color'] = {};
                    this.female_replacement_records['earlobe_color'] = {};
                    this.male_replacement_records['iris_color'] = {};
                    this.female_replacement_records['iris_color'] = {};
                    this.male_replacement_records['beak_color'] = {};
                    this.female_replacement_records['beak_color'] = {};
                    this.male_replacement_records['shank_color'] = {};
                    this.female_replacement_records['shank_color'] = {};
                    this.male_replacement_records['skin_color'] = {};
                    this.female_replacement_records['skin_color'] = {};
                    
                    this.replacement_data.forEach(element => {
                        var values = JSON.parse(element.phenotypic);
                        if(element.gender === "male"){
                            if((typeof this.male_replacement_records['plumage_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['plumage_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['plumage_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['plumage_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] = 0
                            }
                            this.male_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()]++;

                            if((typeof this.male_replacement_records['plumage_pattern'][element.line_number] === 'undefined')){
                                this.male_replacement_records['plumage_pattern'][element.line_number] = {};
                            }

                            if((typeof this.male_replacement_records['plumage_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['plumage_pattern'][element.line_number][element.family_number] = {};
                            }

                            if((typeof this.male_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] = 0
                            }
                            this.male_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()]++;

                            if((typeof this.male_replacement_records['hackle_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['hackle_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['hackle_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['hackle_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()] = 0
                            }
                            this.male_replacement_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()]++;

                            if((typeof this.male_replacement_records['hackle_pattern'][element.line_number] === 'undefined')){
                                this.male_replacement_records['hackle_pattern'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['hackle_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['hackle_pattern'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()] = 0
                            }
                            this.male_replacement_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()]++;

                            if((typeof this.male_replacement_records['body_carriage'][element.line_number] === 'undefined')){
                                this.male_replacement_records['body_carriage'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['body_carriage'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['body_carriage'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()] = 0
                            }
                            this.male_replacement_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()]++;

                            if((typeof this.male_replacement_records['comb_type'][element.line_number] === 'undefined')){
                                this.male_replacement_records['comb_type'][element.line_number]  = {};
                            }
                            if((typeof this.male_replacement_records['comb_type'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['comb_type'][element.line_number][element.family_number]  = {};
                            }
                            if((typeof this.male_replacement_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()] = 0
                            }
                            this.male_replacement_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()]++;

                            if((typeof this.male_replacement_records['comb_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['comb_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['comb_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['comb_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()] = 0
                            }
                            this.male_replacement_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()]++;

                            if((typeof this.male_replacement_records['earlobe_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['earlobe_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['earlobe_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['earlobe_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()] = 0
                            }
                            this.male_replacement_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()]++;

                            if((typeof this.male_replacement_records['iris_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['iris_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['iris_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['iris_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()] = 0
                            }
                            this.male_replacement_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()]++;

                            if((typeof this.male_replacement_records['beak_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['beak_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['beak_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['beak_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()] = 0
                            }
                            this.male_replacement_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()]++;

                            if((typeof this.male_replacement_records['shank_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['shank_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['shank_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['shank_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()] = 0
                            }
                            this.male_replacement_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()]++;

                            if((typeof this.male_replacement_records['skin_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['skin_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['skin_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['skin_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()] = 0
                            }
                            this.male_replacement_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()]++;

                        }else{
                            if((typeof this.female_replacement_records['plumage_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['plumage_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['plumage_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] = 0
                            }
                            this.female_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()]++;

                            if((typeof this.female_replacement_records['plumage_pattern'][element.line_number] === 'undefined')){
                                this.female_replacement_records['plumage_pattern'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['plumage_pattern'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] = 0
                            }
                            this.female_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()]++;

                            if((typeof this.female_replacement_records['hackle_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['hackle_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['hackle_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['hackle_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()] = 0
                            }
                            this.female_replacement_records['hackle_color'][element.line_number][element.family_number][values[2].toUpperCase()]++;

                            if((typeof this.female_replacement_records['hackle_pattern'][element.line_number] === 'undefined')){
                                this.female_replacement_records['hackle_pattern'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['hackle_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['hackle_pattern'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()] = 0
                            }
                            this.female_replacement_records['hackle_pattern'][element.line_number][element.family_number][values[3].toUpperCase()]++;

                            if((typeof this.female_replacement_records['body_carriage'][element.line_number] === 'undefined')){
                                this.female_replacement_records['body_carriage'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['body_carriage'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['body_carriage'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()] = 0
                            }
                            this.female_replacement_records['body_carriage'][element.line_number][element.family_number][values[4].toUpperCase()]++;

                            if((typeof this.female_replacement_records['comb_type'][element.line_number] === 'undefined')){
                                this.female_replacement_records['comb_type'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['comb_type'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['comb_type'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()] = 0
                            }
                            this.female_replacement_records['comb_type'][element.line_number][element.family_number][values[5].toUpperCase()]++;

                            if((typeof this.female_replacement_records['comb_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['comb_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['comb_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['comb_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()] = 0
                            }
                            this.female_replacement_records['comb_color'][element.line_number][element.family_number][values[6].toUpperCase()]++;

                            if((typeof this.female_replacement_records['earlobe_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['earlobe_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['earlobe_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['earlobe_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()] = 0
                            }
                            this.female_replacement_records['earlobe_color'][element.line_number][element.family_number][values[7].toUpperCase()]++;

                            if((typeof this.female_replacement_records['iris_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['iris_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['iris_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['iris_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()] = 0
                            }
                            this.female_replacement_records['iris_color'][element.line_number][element.family_number][values[8].toUpperCase()]++;

                            if((typeof this.female_replacement_records['beak_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['beak_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['beak_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['beak_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()] = 0
                            }
                            this.female_replacement_records['beak_color'][element.line_number][element.family_number][values[9].toUpperCase()]++;

                            if((typeof this.female_replacement_records['shank_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['shank_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['shank_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['shank_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()] = 0
                            }
                            this.female_replacement_records['shank_color'][element.line_number][element.family_number][values[10].toUpperCase()]++;

                            if((typeof this.female_replacement_records['skin_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['skin_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['skin_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['skin_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()] = 0
                            }
                            this.female_replacement_records['skin_color'][element.line_number][element.family_number][values[11].toUpperCase()]++;
                        }
                    });

                }else if(this.animal_type === 2){
                    this.male_replacement_records['plumage_color'] = {};
                    this.female_replacement_records['plumage_color'] = {};
                    this.male_replacement_records['plumage_pattern'] = {};
                    this.female_replacement_records['plumage_pattern'] = {};
                    this.male_replacement_records['body_carriage'] = {};
                    this.female_replacement_records['body_carriage'] = {};
                    this.male_replacement_records['shank_color'] = {};
                    this.female_replacement_records['shank_color'] = {};
                    this.male_replacement_records['skin_color'] = {};
                    this.female_replacement_records['skin_color'] = {};
                    this.male_replacement_records['neckf_mark'] = {};
                    this.female_replacement_records['neckf_mark'] = {};
                    this.male_replacement_records['neckf_color'] = {};
                    this.female_replacement_records['neckf_color'] = {};
                    this.male_replacement_records['tailf_color'] = {};
                    this.female_replacement_records['tailf_color'] = {};
                    this.male_replacement_records['bill_color'] = {};
                    this.female_replacement_records['bill_color'] = {};
                    this.male_replacement_records['bill_shape'] = {};
                    this.female_replacement_records['bill_shape'] = {};
                    this.male_replacement_records['bean_color'] = {};
                    this.female_replacement_records['bean_color'] = {};
                    this.male_replacement_records['presence_crest'] = {};
                    this.female_replacement_records['presence_crest'] = {};
                    this.male_replacement_records['eye_color'] = {};
                    this.female_replacement_records['eye_color'] = {};
                    this.breeder_data.forEach(element => {
                        var values = JSON.parse(element.phenotypic);
                        if(element.gender === "male"){
                            if((typeof this.male_replacement_records['plumage_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['plumage_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['plumage_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['plumage_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] = 0
                            }
                            this.male_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()]++;

                            if((typeof this.male_replacement_records['plumage_pattern'][element.line_number] === 'undefined')){
                                this.male_replacement_records['plumage_pattern'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['plumage_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['plumage_pattern'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] = 0
                            }
                            this.male_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()]++;

                            if((typeof this.male_replacement_records['body_carriage'][element.line_number] === 'undefined')){
                                this.male_replacement_records['body_carriage'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['body_carriage'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['body_carriage'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()] = 0
                            }
                            this.male_replacement_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()]++;

                            if((typeof this.male_replacement_records['shank_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['shank_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['shank_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['shank_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()] = 0
                            }
                            this.male_replacement_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()]++;

                            if((typeof this.male_replacement_records['skin_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['skin_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['skin_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['skin_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()] = 0
                            }
                            this.male_replacement_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()]++;

                            if((typeof this.male_replacement_records['neckf_mark'][element.line_number] === 'undefined')){
                                this.male_replacement_records['neckf_mark'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['neckf_mark'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['neckf_mark'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()] = 0
                            }
                            this.male_replacement_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()]++;

                            if((typeof this.male_replacement_records['neckf_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['neckf_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['neckf_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['neckf_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()] = 0
                            }
                            this.male_replacement_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()]++;

                            if((typeof this.male_replacement_records['tailf_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['tailf_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['tailf_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['tailf_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()] = 0
                            }
                            this.male_replacement_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()]++;

                            if((typeof this.male_replacement_records['bill_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['bill_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['bill_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['bill_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()] = 0
                            }
                            this.male_replacement_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()]++;

                            if((typeof this.male_replacement_records['bill_shape'][element.line_number] === 'undefined')){
                                this.male_replacement_records['bill_shape'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['bill_shape'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['bill_shape'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()] = 0
                            }
                            this.male_replacement_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()]++;

                            if((typeof this.male_replacement_records['bean_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['bean_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['bean_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['bean_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()] = 0
                            }
                            this.male_replacement_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()]++;

                            if((typeof this.male_replacement_records['presence_crest'][element.line_number] === 'undefined')){
                                this.male_replacement_records['presence_crest'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['presence_crest'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['presence_crest'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()] = 0
                            }
                            this.male_replacement_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()]++;

                            if((typeof this.male_replacement_records['eye_color'][element.line_number] === 'undefined')){
                                this.male_replacement_records['eye_color'][element.line_number] = {};
                            }
                            if((typeof this.male_replacement_records['eye_color'][element.line_number][element.family_number] === 'undefined')){
                                this.male_replacement_records['eye_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.male_replacement_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()] = 0
                            }
                            this.male_replacement_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()]++;

                        }else{
                            if((typeof this.female_replacement_records['plumage_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['plumage_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['plumage_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()] = 0
                            }
                            this.female_replacement_records['plumage_color'][element.line_number][element.family_number][values[0].toUpperCase()]++;

                            if((typeof this.female_replacement_records['plumage_pattern'][element.line_number] === 'undefined')){
                                this.female_replacement_records['plumage_pattern'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_pattern'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['plumage_pattern'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()] = 0
                            }
                            this.female_replacement_records['plumage_pattern'][element.line_number][element.family_number][values[1].toUpperCase()]++;

                            if((typeof this.female_replacement_records['body_carriage'][element.line_number] === 'undefined')){
                                this.female_replacement_records['body_carriage'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['body_carriage'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['body_carriage'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()] = 0
                            }
                            this.female_replacement_records['body_carriage'][element.line_number][element.family_number][values[2].toUpperCase()]++;

                            if((typeof this.female_replacement_records['shank_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['shank_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['shank_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['shank_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()] = 0
                            }
                            this.female_replacement_records['shank_color'][element.line_number][element.family_number][values[3].toUpperCase()]++;

                            if((typeof this.female_replacement_records['skin_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['skin_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['skin_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['skin_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()] = 0
                            }
                            this.female_replacement_records['skin_color'][element.line_number][element.family_number][values[4].toUpperCase()]++;

                            if((typeof this.female_replacement_records['neckf_mark'][element.line_number] === 'undefined')){
                                this.female_replacement_records['neckf_mark'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['neckf_mark'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['neckf_mark'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()] = 0
                            }
                            this.female_replacement_records['neckf_mark'][element.line_number][element.family_number][values[5].toUpperCase()]++;

                            if((typeof this.female_replacement_records['neckf_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['neckf_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['neckf_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['neckf_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()] = 0
                            }
                            this.female_replacement_records['neckf_color'][element.line_number][element.family_number][values[6].toUpperCase()]++;

                            if((typeof this.female_replacement_records['tailf_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['tailf_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['tailf_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['tailf_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()] = 0
                            }
                            this.female_replacement_records['tailf_color'][element.line_number][element.family_number][values[7].toUpperCase()]++;

                            if((typeof this.female_replacement_records['bill_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['bill_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['bill_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['bill_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()] = 0
                            }
                            this.female_replacement_records['bill_color'][element.line_number][element.family_number][values[8].toUpperCase()]++;

                            if((typeof this.female_replacement_records['bill_shape'][element.line_number] === 'undefined')){
                                this.female_replacement_records['bill_shape'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['bill_shape'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['bill_shape'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()] = 0
                            }
                            this.female_replacement_records['bill_shape'][element.line_number][element.family_number][values[9].toUpperCase()]++;

                            if((typeof this.female_replacement_records['bean_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['bean_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['bean_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['bean_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()] = 0
                            }
                            this.female_replacement_records['bean_color'][element.line_number][element.family_number][values[10].toUpperCase()]++;

                            if((typeof this.female_replacement_records['presence_crest'][element.line_number] === 'undefined')){
                                this.female_replacement_records['presence_crest'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['presence_crest'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['presence_crest'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()] = 0
                            }
                            this.female_replacement_records['presence_crest'][element.line_number][element.family_number][values[11].toUpperCase()]++;

                            if((typeof this.female_replacement_records['eye_color'][element.line_number] === 'undefined')){
                                this.female_replacement_records['eye_color'][element.line_number] = {};
                            }
                            if((typeof this.female_replacement_records['eye_color'][element.line_number][element.family_number] === 'undefined')){
                                this.female_replacement_records['eye_color'][element.line_number][element.family_number] = {};
                            }
                            if((typeof this.female_replacement_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()] = 0
                            }
                            this.female_replacement_records['eye_color'][element.line_number][element.family_number][values[12].toUpperCase()]++;
                        }
                    });
                }
                
            })
            .catch(error => {});
        },

        getPercentage : function (freq, obj) {
            var total  = 0;
            for (var index in obj) {
                total += obj[index];
            }
            if(total != 0){
                return ((freq/total)*100).toFixed(2);
            }
        },
    },
    mounted () {
        tippy('.tooltip', {
            followCursor: true,
        });
        $(document).ready(function(){
            $('ul.tabs').tabs();
        });
        this.init();
    }    
}
</script>

<style scoped>

</style>
