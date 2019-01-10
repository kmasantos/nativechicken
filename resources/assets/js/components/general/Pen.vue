<template>
    <div>
        <!-- MAIN DIV -->
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5>Pens</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <ul class="breadcrumb">
                            <li><a href="./">Home</a></li>
                            <li>Pens</li>
                        </ul>
                    </div>
                </div>
                <form v-on:submit.prevent="searchPen" action="GET">
                    <div class="row valign-wrapper">
                        <div class="col s12 m12 l12 valign">
                            <label for="search">Search</label>
                            <input v-model="search_number" placeholder="Type pen number" id="search" type="text">
                        </div>
                        <div class="col s12 m4 l4">
                            <input v-model="search_type" type="checkbox" class="filled-in" id="brooder_search" value="brooder"/>
                            <label for="brooder_search">Brooder</label>
                        </div>
                        <div class="col s12 m4 l4">
                            <input v-model="search_type" type="checkbox" class="filled-in" id="grower_search" value="grower"/>
                            <label for="grower_search">Grower</label>
                        </div>
                        <div class="col s12 m4 l4">
                            <input v-model="search_type" type="checkbox" class="filled-in" id="layer_search" value="layer"/>
                            <label for="layer_search">Layer</label>
                        </div>
                    </div>
                    <div class="row center">
                        <div class="col s12 m12 l12">
                            <button class="btn waves-effect waves-light blue-grey darken-1" type="submit" name="action">Search<i class="material-icons right">search</i></button>
                        </div>
                    </div>
                </form>
                <div class="row center" v-if="pens_loaded==false">
                    <div class="col s12 m12 112">
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
                    </div>
                    <div class="col s12 m12 l12">Loading...</div>
                </div>
                <div class="row" v-else>
                    <div class="col s12 m12 112 center-align" v-if="pens_not_empty==false">
                        <h5>No Pens</h5>
                    </div>
                    <div class="col s12 m12 112" v-else>
                        <div class="col s12 m12 l12">
                            <table class="responsive-table bordered highlight centered">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Number</th>
                                    <th>Content</th>
                                    <th>Capacity</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="pens_length == 0">
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr v-else v-for="pen in pens.data" :key="pen.id">
                                        <td>{{capitalize(pen.type)}}</td>
                                        <td>{{pen.number}}</td>
                                        <td>{{pen.current_capacity}}</td>
                                        <td>{{pen.total_capacity}}</td>
                                        <td><a @click="selected_pen=pen.id; selected_pen_number=pen.number; edit_number=pen.number; edit_type=pen.type; edit_capacity=pen.total_capacity" href="#pen_edit" class="modal-trigger"><i class="fas fa-edit"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12 center">
                                <pagination :data="pens" @pagination-change-page="loadPen"></pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAB -->
        <div class="fixed-action-btn horizontal click-to-toggle tooltipped" data-position="left" data-delay="50" data-tooltip="Add pen">
            <a class="btn-floating btn-large blue-grey darken-1 modal-trigger" href="#pen_modal">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <!-- MODALS -->
        <div id="pen_modal" class="modal modal-fixed-footer">
            <form v-on:submit.prevent="addPen" action="POST">
                <div class="modal-content">
                    <h4>Add Pen</h4>
                    <div class="divider"></div>
                    <div class="row valign-wrapper">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model="pen_number" placeholder="Input Pen Number" id="pen_number" type="text" name="pen_number">
                                    <label for="pen_number">Pen Number</label>
                                </div>
                            </div>
                            <label for="pen_type">Pen Type</label>
                            <div id="pen_type" class="row">
                                <div class="col s12 m4 l4">
                                    <input v-model="pen_type" class="with-gap" type="radio" id="brooder" value="brooder"/>
                                    <label for="brooder">Brooder</label>
                                </div>
                                <div class="col s12 m4 l4">
                                    <input v-model="pen_type" class="with-gap" type="radio" id="grower" value="grower"/>
                                    <label for="grower">Grower</label>
                                </div>
                                <div class="col s12 m4 l4">
                                    <input v-model="pen_type" class="with-gap" type="radio" id="layer" value="layer"/>
                                    <label for="layer">Layer</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model.number="pen_capacity" placeholder="Total Pen Capacity" id="pen_capacity" type="number" min=0 name="pen_capacity">
                                    <label for="pen_capacity">Pen Capacity</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-close waves-effect waves-grey btn-flat">Close</a>
                    <button class="modal-close waves-effect waves-grey btn-flat" type="submit">Add</button>
                </div>
            </form>
        </div>
        <div id="pen_edit" class="modal modal-fixed-footer">
            <form v-on:submit.prevent="editPen" action="patch">
                <div class="modal-content">
                    <div class="row valign-wrapper">
                        <div class="col s12 m12 l9">
                            <h4>Edit Pen {{selected_pen_number}}</h4>
                        </div>
                        <div class="col s12 m12 l3">
                            <a @click="closeEditModal" href="#delete_pen" class="waves-effect waves-red btn-flat red-text tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Delete Pen"><i class="far fa-trash-alt left"></i> Delete</a>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row valign-wrapper">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model="edit_number" placeholder="New Pen Number" id="edit_number" type="text">
                                    <label for="edit_number">New Pen Number</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model.number="edit_capacity" placeholder="Total Pen Capacity" id="edit_capacity" type="number" min=0>
                                    <label for="edit_capacity">New Pen Capacity</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-close waves-effect waves-grey btn-flat">Close</a>
                    <button class="modal-close waves-effect waves-grey btn-flat" type="submit">Edit</button>
                </div>
            </form>
        </div>
        <div id="delete_pen" class="modal">
            <div class="modal-content">
                <h4 class="red-text"><i class="fas fa-exclamation-triangle"></i> Delete {{selected_pen_number}}?</h4>
                <p>Are you sure you want to <strong>Delete</strong> pen <strong>{{selected_pen_number}}</strong>?</p>
                <p>This action is <strong>irreversible</strong></p>
                <p class="orange-text"><i class="fas fa-asterisk"></i><i> This will not work to pens with content</i></p>
                <input name="delete_pen_id" type="hidden" :value="selected_pen" >
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
                <a @click="deletePen" class="modal-close waves-effect waves-grey btn-flat" type="submit">Yes</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pens_loaded : false,
                pens_not_empty : false,
                search_number : '',
                search_type : [],
                pens : {},
                pens_length : 0,
                pen_number : '',
                pen_type : '',
                pen_capacity : '',

                selected_pen : '',
                selected_pen_number : '',
                edit_number : '',
                edit_capacity : '',
            }
        },
        methods : {
            initialize : function () {
                this.loadPen();
            },
            loadPen : function (page = 1) {
                this.pens_loaded = false;
                this.pens_not_empty = false;
                axios.get('fetch_pens?page='+page)
                .then(response => {
                    this.pens = response.data;
                    this.pens_length = this.pens.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.pens_loaded = true;
                this.pens_not_empty = true;
            },
            searchPen : function (page = 1) {
                var search_array = new Array(this.search_number, this.search_type);
                axios.get('search_pens/'+ JSON.stringify(search_array)+'?page='+page)
                .then(response => {
                    this.pens = response.data
                    this.pens_length = this.pens.data.length;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addPen : function () {
                axios.post('add_pens', {
                    pen_number: this.pen_number,
                    type: this.pen_type,
                    pen_capacity : this.pen_capacity
                }).then(response => {
                    if(response.data.error == undefined){
                        this.pen_number = '';
                        this.pen_type = false;
                        this.pen_capacity = '';
                        Materialize.toast('Successfully added ' + response.data.message, 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }

                })
                .catch(error => {
                    Materialize.toast('Failed to add pen with error : ' + error.message, 3000, 'red rounded');
                });
                this.initialize();
            },
            editPen : function () {
                axios.patch('edit_pen', {
                    pen_id : this.selected_pen,
                    pen_number: this.edit_number,
                    type: this.edit_type,
                    pen_capacity : this.edit_capacity
                }).then(response => {
                    if(response.data.error == undefined){
                        this.selected_pen = '';
                        this.edit_number = '';
                        this.edit_capacity = '';
                        Materialize.toast('Successfully edited ' + response.data.message, 3000, 'green rounded');
                        this.closeEditModal();
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }

                })
                .catch(error => {
                    Materialize.toast('Failed to edit pen with error : ' + error.message, 3000, 'red rounded');
                });
                this.initialize();
            },
            deletePen : function (){
                axios.delete('delete_pen/'+this.selected_pen)
                .then(response => {
                    if(response.data.error == undefined){
                        this.selected_pen = '';
                        $('#delete_pen').modal('close')
                        Materialize.toast('Successfully deleted ' + response.data.message, 3000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 3000, 'red rounded');
                    }
                })
                .catch(error => {
                    Materialize.toast('Failed to deleted pen with error : ' + error.message, 3000, 'red rounded');
                });
                this.initialize();
            },
            closeEditModal : function () {
                $('#pen_edit').modal('close');
            },
            capitalize : function (string) {
                var lower = string;
                var upper = lower.charAt(0).toUpperCase() + lower.substr(1);
                return upper;
            },
        },
        created() {
            this.initialize();
        }
    }
</script>
