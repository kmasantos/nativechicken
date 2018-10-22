<template>
    <div id="add_modal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h4>Add Family Record</h4>
                </div>
            </div>
            <div class="divider"></div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="input-field col s12 m6 l6">
                        <input v-model="family_id" placeholder="Enter Family ID" id="family_id" type="text">
                        <label for="family_id">Family ID</label>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col s12 m12 l12">
                <div class="col s12 m6 l6">
                    <label>Generation</label>
                    <select v-model="generation_selected" v-on:change="getGeneration" id="generation_choice" class="browser-default">
                        <option value="" disabled selected>Choose generation</option>
                        <option v-for="generation in generations" :key="generation.id" v-bind:value="generation.id">{{generation.number}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col s12 m12 l12">
                    <div class="col s12 m6 l6">
                        <label>Line</label>
                        <select v-model="line_selected" id="line_choice" class="browser-default">
                            <option value="" disabled selected>Choose line</option>
                            <option v-for="line in lines" :key="line.id" v-bind:value="line.id">{{line.number}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat" @click="submitFamilyRecordForm">Submit</button>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                family_id : '',
                generations : [],
                generation_selected : '',
                lines : [],
                line_selected : ''
            }
        },

        created(){
            axios.get('generation_list')
            .then(response => this.generations = response.data)
            .catch(error => console.log(error));
        },

        methods : {
            getGeneration : function(event)
            {
                axios.get('line_list/'+this.generation_selected)
                .then(response => this.lines = response.data)
                .catch(error => console.log(error));
            },

            submitFamilyRecordForm : function(event)
            {
                axios.post('family_record_add', {
                    family_id : this.family_id,
                    generation_id : this.generation_selected,
                    line_id : this.line_selected
                })
                .then(function (response){
                    console.log(response);
                })
                .catch(function(error){
                    console.log(error);
                });
            }
        }
    }
</script>
