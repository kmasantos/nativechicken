<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Add Replacement</h5>
                </div>
            </div>
            <form>
                <div class="row valign-wrapper">
                    <div class="col s12 m9 l9 valign">
                        <label for="search">Search</label>
                        <input v-model="search" placeholder="Type family number" id="search" type="text">
                    </div>
                    <div class="col s12 m3 l3 valign">
                        <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action">Search<i class="material-icons right">search</i></button>
                    </div>
                </div>
            </form>
            <div class="row" v-if="replacements.length === 0">
                <div class="col s12 m12 l12 center">
                    <h5>No Families Available</h5>    
                </div>
            </div>
            <div class="row" v-else>
                <div class="col s12 m12 l12">
                    <table class="bordered responsive-table">
                        <thead>
                            <tr>
                                <th>Family Number</th>
                                <th>Batching Date</th>
                                <th>Pen No.</th>
                                <th>Male Count</th>
                                <th>Female Count</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="replacement in replacements" :key="replacement.id">
                                <td>{{replacement.family_id}}</td>
                                <td>{{replacement.batching_date}}</td>
                                <td>{{replacement.batching_date}}</td>
                                <td>{{replacement.batching_date}}</td>
                                <td>{{replacement.batching_date}}</td>
                                <td>{{replacement.batching_date}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="fixed-action-btn">
                <a href="#add_modal" class="btn-floating btn-large blue-grey darken-1 modal-trigger">
                    <i class="large material-icons">add</i>
                </a>
            </div>
            <div id="add_modal" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Add Replacement</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="input-field col s12 m6 l6">
                                <input id="family_number" type="text" class="validate">
                                <label for="family_number">Family Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="input-field col s12 m6 l6">
                                <input id="number_male" type="number" min=0>
                                <label for="number_male">Number Male</label>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="input-field col s12 m6 l6">
                                <input id="number_female" type="number" min=0>
                                <label for="number_female">Number Female</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                search : '',
                replacements : [],

            }
        },

        mounted() {
            this.getReplacementList();
        },

        methods :{
            getReplacementList : function () 
            {
                axios.get('replacement_list')
                .then(response => this.replacements = response.data)
                .catch(error => console.log(error));
            }
        }
    }
</script>
