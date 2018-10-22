<template>
    <div>
        <div class="row valign-wrapper">
            <div class="col s12 m8 l8 input-field">
                <input v-model="search" id="search" type="text">
                <label for="search">Search Family</label>
            </div>
            <div class="col s12 m4 l4">
                <a @click.prevent="searchFamily" class="waves-effect waves-light btn blue-grey">Search
                    <i class="material-icons right">search</i>
                </a>
            </div>
        </div>
        <div class="row" v-if="families_len > 0">
            <div class="col s12 m12 l12">
                <table class="responsive-table bordered highlight">
                    <thead>
                        <tr>
                            <th>Family Number</th>
                            <th>Line Number</th>
                            <th>Generation Number</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="family in families.data" :key="family.id">
                            <td>{{family.family_number}}</td>
                            <td>{{family.line_number}}</td>
                            <td>{{family.generation_number}}</td>
                            <td v-if="family.is_active">Active</td>
                            <td v-else>Inactive</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col s12 m12 l12 center">
                        <pagination :data="families" @pagination-change-page="fetchFamilies"></pagination>
                    </div>
                </div>
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
                <h5>No Family</h5>
            </div>
        </div>
        <div class="fixed-action-btn vertical">
            <a class="btn-floating btn-large blue-grey darken-1 modal-trigger" href="#add_family">
                <i class="material-icons">add</i>
            </a>
        </div>

        <div id="add_family" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4>Add Family</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6 l6">
                        <label>Generation</label>
                        <select v-model="selected_generation" class="browser-default" @click.prevent="fetchGenerations">
                            <option value="" disabled selected>Choose generation</option>
                            <option v-for="generation in generations" :key="generation.id" v-bind:value="generation.id">{{generation.number}}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6 l6">
                        <label>Line</label>
                        <select v-model="selected_line" class="browser-default">
                            <option value="" disabled selected>Choose line</option>
                            <option v-for="line in lines" :key="line.id" v-bind:value="line.id">{{line.number}}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6 l6">
                        <label for="add_family">Family Number</label>
                        <input v-model="family_number" id="add_family" placeholder="Type family number">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a @click.prevent="addFamily" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                search : '',
                families : {},
                generations : [],
                lines : [],
                family_number : '',
                selected_generation : '',
                selected_line : '',
                families_len : 0,
            }
        },
        methods : {
            fetchFamilies : function(page = 1) {
                axios.get('fetch_families?page='+page)
                .then(response => {
                    this.families_len = response.data.data.length;
                    this.families = response.data;
                })
                .catch(error => console.log(error));
            },
            fetchGenerations : function() {
                axios.get('get_generation_list')
                .then(response => this.generations = response.data)
                .catch(error => console.log(error));
                this.fetchLinesInGeneration();
            },
            fetchLinesInGeneration : function() {
                axios.get('fetch_lines/'+this.selected_generation)
                .then(response => this.lines = response.data)
                .catch(error => console.log(error));
            },
            addFamily : function() {
                axios.post('add_family', {
                    line_id: this.selected_line,
                    family_number: this.family_number,
                })
                .then(function (response) {
                    console.log(response);
                    Materialize.toast('Family added', 3000, 'rounded');
                })
                .catch(function (error) {
                    console.log(error);
                    Materialize.toast('Add family failed', 3000, 'rounded');
                });
                this.fetchFamilies();
            },
            searchFamily : function() {
                axios.get('search_family/' + this.search)
                .then(response => this.families = response.data)
                .catch(error => console.log(error));
            }
        },
        mounted() {

        },
        created() {
            this.fetchFamilies();
        }
    }
</script>
