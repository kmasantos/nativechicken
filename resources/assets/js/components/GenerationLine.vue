<template>
    <div>
        <div class="row valign-wrapper">
            <div class="col s12 m8 l8 input-field">
                <input v-model="search" id="search" type="text">
                <label for="search">Search Generation</label>
            </div>
            <div class="col s12 m4 l4">
                <button @click="searchGeneration" class="btn waves-effect waves-light blue-gray" type="submit" name="action">Search
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
        <div class="row" v-if="generations.length > 0">
            <div class="col s12 m12 l12">
                <table class="responsive-table bordered">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="generation in generations" :key="generation.id">
                            <td>{{generation.number}}</td>
                            <td v-if="generation.is_active">Active</td>
                            <td v-else>Inactive</td>
                            <td><a href="#details_modal" @click.prevent="viewDetails(generation.id)" class="modal-trigger"><i class="material-icons">details</i></a></td>
                        </tr>
                    </tbody>
                </table>
                <!-- <div class="row">
                    <div class="col s12 m12 l12 center">
                        <ul class="pagination">
                            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                            <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="row center" v-else>
            <div class="col s12 m12 l12">
                <h5>No Generations</h5>
            </div>
        </div>
        <div class="fixed-action-btn vertical click-to-toggle">
            <a class="btn-floating btn-large blue-grey darken-1">
                <i class="material-icons">add</i>
            </a>
            <ul>
                <li><a href="#add_generation" class="btn-floating blue-grey tooltipped modal-trigger" data-position="left" data-delay="50" data-tooltip="Add Generation"><i class="material-icons">line_weight</i></a></li>
                <li><a href="#add_line" class="btn-floating blue-grey tooltipped modal-trigger" data-position="left" data-delay="50" data-tooltip="Add Line"><i class="material-icons">line_style</i></a></li>
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
                            <option v-for="generation in generations" :key="generation.id" v-bind:value="generation.id">{{generation.number}}</option>
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
                <a @click="addLine" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</a>
            </div>
        </div>
        
        <div id="details_modal" class="modal">
            <div class="modal-content">
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Lines</h4></li>
                    <li v-if="line_list.length == 0" class="collection-item"><div>No Lines in this Generation</div></li>
                    <li v-for="line in line_list" :key="line.id" class="collection-item"><div>{{line.number}}</div></li>
                </ul>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                generations : [],
                lines : [],
                search : '',
                selected_generation : '',
                add_generation : '',
                line_number : '',
                generation_details : '',
                line_list : [],
            }
        },
        methods : {
            searchGeneration : function(event){
                axios.get('search_generation/'+this.search)
                .then(response => this.generations = response.data)
                .catch(error => console.log(error));
            },
            fetchGenerations : function(){
                axios.get('fetch_generation')
                .then(response => this.generations = response.data)
                .catch(error => console.log(error));
            },
            addGeneration : function(event){
                axios.post('add_generation', {
                    generation_number: this.add_generation,
                })
                .then(function (response) {
                    console.log(response);
                    Materialize.toast('Generation added', 3000, 'rounded');
                })
                .catch(function (error) {
                    console.log(error);
                    Materialize.toast('Add generation failed', 3000, 'rounded');
                });
                this.fetchGenerations();
            },
            addLine : function(event){
                axios.post('add_line', {
                    generation_number: this.selected_generation,
                    line_number: this.line_number,
                })
                .then(function (response) {
                    console.log(response);
                    Materialize.toast('Line added', 3000, 'rounded');
                })
                .catch(function (error) {
                    console.log(error);
                    Materialize.toast('Adding line to generation failed', 3000, 'rounded');
                });
                this.fetchGenerations();
            },
            
            viewDetails : function(generation){
                this.generation_details = generation;
                axios.get('get_details/'+this.generation_details)
                .then(response => this.line_list = response.data)
                .catch(error => console.log(error));
            },
        },
        created () {
            this.fetchGenerations();
        },
        mounted() {
            
        },
        updated() {
            
        },
        destroyed() {

        }
    }
</script>
