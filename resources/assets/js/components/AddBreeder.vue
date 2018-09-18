<template>
    <div>
        <div class="row valign-wrapper">
            <div class="col s12 m8 l8 input-field">
                <input v-model="search" id="search" type="text">
                <label for="search">Search Breeder Family</label>
            </div>
            <div class="col s12 m4 l4">
                <a class="waves-effect waves-light btn blue-gray">Search
                    <i class="material-icons right">search</i>
                </a>
            </div>
        </div>
        <div class="row" v-if="families.length > 0">
            <div class="col s12 m12 l12">
                <div class="row">
                    <div class="col s12 m6 l6" v-for="family in families" :key="family.id">
                        <div class="card blue-grey lighten-5">
                            <div class="card-content">
                                <span class="card-title">Family <strong>{{family.number}}</strong></span>
                                <div class="divider"></div>
                                <div class="row">
                                    <div class="col s12 m12 l12">Line <strong>{{family.line_number}}</strong></div>
                                    <div class="col s12 m12 l12">Generation <strong>{{family.generation_number}}</strong></div>
                                </div>
                            </div> 
                            <div class="card-action">
                                <a href="#add_breeder" class="black-text modal-trigger" @click="selected_family = family.id">Add Breeders</a>
                                <a href="#!" class="black-text">Update Breeders</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row center" v-else>
            <div class="col s12 m12 l12">
                <h5>No Family</h5>
            </div>
        </div>
        <div id="add_breeder" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4>Add Breeder</h4>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <label>Female's Generation</label>
                                <select class="browser-default" v-model="selected_generation" @change="fetchGenerations">
                                    <option value="" disabled selected>Choose Generation</option>
                                    <option v-for="generation in generations" :key="generation.id" v-bind:value="generation.id">{{generation.number}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <label>Female's Line</label>
                                <select class="browser-default" v-model="selected_line" v-if="selected_generation != ''" @change="fetchLines">
                                    <option value="" disabled selected>Choose Line</option>
                                    <option v-for="line in lines" :key="line.id" v-bind:value="line.id">{{line.number}}</option>
                                </select>
                                <select class="browser-default" disabled v-else></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <label>Female's Family</label>
                                <select class="browser-default" v-model="selected_females" v-if="selected_line != ''" @change="fetchFemaleFamilies">
                                    <option value="" disabled selected>Choose family</option>
                                    <option v-for="female_family in female_families" :key="female_family.id" v-bind:value="female_family.id">{{female_family.number}}</option>
                                </select>
                                <select class="browser-default" disabled v-else></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <label>Move to Pen</label>
                                <select class="browser-default" v-model="selected_pen">
                                    <option value="" disabled selected>Choose pen</option>
                                    <option v-for="pen in pens" :key="pen.id" v-bind:value="pen.id">{{pen.number}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <label for="no_male">Number of Male</label>
                                <input v-model.number="number_male" placeholder="Number of Male" id="no_male" type="number" min=0 class="validate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <label for="no_female">Number of Female</label>
                                <input v-model.number="number_female" placeholder="Number of Female" id="no_female" type="number" min=0 class="validate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <label>Date Added</label>
                                <datepicker :format="customFormatter" v-model="date_added" ></datepicker>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-grey btn-flat ">Submit</a>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    var moment = require('moment');
    export default {
        components: {
            Datepicker
        },
        data() {
            return {
                breeders : [],
                search : '',
                families : [],
                female_families : [],
                generations : [],
                lines : [],
                pens : [],
                selected_family : '',
                selected_generation : '',
                selected_line : '',
                selected_females : '',
                selected_pen : '',
                date_added : '',
                number_male : '',
                number_female : ''
            }
        },
        methods : {
            init : function () {
                axios.get('fetch_breeder_families')
                .then(response => this.families = response.data)
                .catch(error => console.log(error));
                axios.get('fetch_generation')
                .then(response => this.generations = response.data)
                .catch(error => console.log(error));
                axios.get('fetch_breeder_pens')
                .then(response => this.pens = response.data)
                .catch(error => console.log(error));

            },
            fetchBreederFamilies : function () {
                axios.get('fetch_breeder_families')
                .then(response => this.families = response.data)
                .catch(error => console.log(error));
            },
            fetchBreeders : function() {
                
            },
            fetchGenerations : function() {
                // axios.get('fetch_generation')
                // .then(response => this.generations = response.data)
                // .catch(error => console.log(error));
                this.fetchLines();
            },
            fetchLines : function() {
                axios.get('fetch_line/'+this.selected_generation)
                .then(response => this.lines = response.data)
                .catch(error => console.log(error));
                this.fetchFemaleFamilies();
            },
            fetchFemaleFamilies : function() {
                axios.get('fetch_female/'+this.selected_line+'/'+this.selected_family)
                .then(response => this.female_families = response.data)
                .catch(error => console.log(error));
            },
            searchBreeders : function() {

            },
            addBreeder : function() {
                axios.post('add_breeder_submit', {
                    family_id: this.selected_family,
                    female_family: this.selected_females,
                    date_added : this.customFormatter(this.date_added),
                    number_male : this.number_male,
                    number_female : this.number_female,
                    pen_id : this.selected_pen
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            customFormatter : function(date_added) {
                return moment(date_added).format('YYYY-MM-DD');
            }
        },
        mounted() {

        },
        created() {
            this.init();
        }
    }
</script>
