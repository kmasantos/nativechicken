<template>
    <div>
        <div class="row valign-wrapper">
            <div class="col s12 m8 l8 input-field">
                <input v-model="search" id="search" type="text">
                <label for="search">Search Generation</label>
            </div>
            <div class="col s12 m4 l4">
                <button @click="searchGeneration" class="btn waves-effect waves-light blue-grey" type="submit" name="action">Search
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
        <div class="row" v-if="generation_loaded=false">
            <div class="col s12 m12 l12 center">
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
                <div>Loading...</div>
            </div>
        </div>
        <div v-else>
            <div class="row" v-if="gen_len > 0">
                <div class="col s12 m12 l12">
                    <table class="responsive-table bordered centered highlight">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Status</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="generation in generations.data" :key="generation.id">
                                <td>{{generation.number}}</td>
                                <td v-if="generation.is_active">Active</td>
                                <td v-else>Inactive</td>
                                <td><a href="#details_modal" @click.prevent="viewDetails(generation.id);selected_generation_number=generation.number" class="modal-trigger"><i class="material-icons">details</i></a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col s12 m12 l12">
                        <pagination :data="generations" @pagination-change-page="getGenerations"></pagination>
                    </div>
                </div>
            </div>
            <div class="row center" v-else>
                <div class="col s12 m12 l12">
                    <h5>No Generations</h5>
                </div>
            </div>
        </div>
        <div class="fixed-action-btn vertical click-to-toggle">
            <a class="btn-floating btn-large blue-grey darken-1">
                <i class="fas fa-plus"></i>
            </a>
            <ul>
                <li><a href="#add_generation" class="btn-floating blue-grey tooltipped modal-trigger" data-position="left" data-delay="50" data-tooltip="Add Generation"><i class="fas fa-genderless"></i></a></li>
                <li><a href="#add_line" class="btn-floating blue-grey tooltipped modal-trigger" data-position="left" data-delay="50" data-tooltip="Add Line"><i class="fas fa-code-branch"></i></a></li>
            </ul>
        </div>
        <div id="add_generation" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4>Add Generation</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <input v-model="add_generation" id="generation_number" type="number" min=0 placeholder="Type generation number" required>
                        <label for="generation_number">Generation Number</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-close waves-effect waves-grey btn-flat">Close</a>
                <a @click="addGeneration" href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</a>
            </div>
        </div>
        <div id="add_line" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4>Add Line</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6 l6">
                        <label>Generation</label>
                        <select v-model="selected_generation" class="browser-default">
                            <option value="" disabled selected>Choose generation</option>
                            <option value="" v-if="gen_list_len === 0" disabled>No generation</option>
                            <option v-else v-for="gen in generation_list" :key="gen.id" v-bind:value="gen.id">{{gen.number}}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6 l6">
                        <label for="line_input">Line Number</label>
                        <input v-model="line_number" id="line_input" placeholder="Type line number">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-close waves-effect waves-grey btn-flat">Close</a>
                <a @click="addLine" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</a>
            </div>
        </div>

        <div id="details_modal" class="modal">
            <div class="modal-content">
                <ul class="collection with-header">
                    <li class="collection-header"><h5>Generation {{selected_generation_number}} Lines</h5></li>
                    <li v-if="line_len == 0" class="collection-item"><div>No Lines in this Generation</div></li>
                    <li v-for="line in line_list" :key="line.id" class="collection-item"><div>Line {{line.number}}</div></li>
                </ul>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-close waves-effect waves-grey btn-flat">Close</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                generations : {},
                line_list : [],
                generation_list : [],

                search : '',
                selected_generation : '',
                selected_generation_number : '',
                add_generation : '',
                line_number : '',
                generation_details : '',

                gen_len : 0,
                line_len : 0,
                gen_list_len : 0,
                generation_loaded : false,
                generation_list_loaded : false,
                line_list_loaded : false
            }
        },
        methods : {
            initialize : function () {
                this.getGenerations();
                this.fetchGenerationList();
            },
            searchGeneration : function(page = 1){
                axios.get('search_generation/'+this.search+'?page='+page)
                .then(response => this.generations = response.data)
                .catch(error => console.log(error));
            },
            getGenerations : function(page = 1){
                this.generation_loaded = false;
                axios.get('fetch_generation?page='+page)
                .then(response => {
                    this.gen_len = response.data.data.length;
                    this.generations = response.data;
                })
                .catch(error => console.log(error));
                this.generation_loaded = true;
            },
            addGeneration : function(event){
                axios.post('add_generation', {
                    generation_number: this.add_generation,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.add_generation = '';
                        Materialize.toast('Generation added', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(function (error) {
                    Materialize.toast('Add generation failed', 3000, 'red rounded');
                });
                this.initialize();
            },
            addLine : function(event){
                axios.post('add_line', {
                    generation_number: this.selected_generation,
                    line_number: this.line_number,
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.selected_generation = '';
                        this.line_number = '';
                        Materialize.toast('Line added', 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(function (error) {
                    console.log(error);
                    Materialize.toast('Adding line to generation failed', 3000, 'red rounded');
                });
            },
            viewDetails : function(generation){
                this.line_list_loaded = false;
                this.generation_details = generation;
                axios.get('get_details/'+this.generation_details)
                .then(response => {
                    this.line_len = response.data.length;
                    this.line_list = response.data;
                })
                .catch(error => console.log(error));
                this.line_list_loaded = true;
            },
            fetchGenerationList : function (){
                this.generation_list_loaded = false;
                axios.get('get_generation_list')
                .then(response => {
                    this.gen_list_len = response.data.length;
                    this.generation_list = response.data;
                })
                .catch(error => console.log(error));
                this.generation_list_loaded = true;
            }
        },
        created () {
            this.initialize();
        }
    }
</script>
