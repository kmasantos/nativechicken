<template>
    <div class="row">
        <div class="col s12 m12 l12 center-align" v-if="!users_loaded">
            <h4>Sorry! Cannot Display Users</h4> 
        </div>
        <div class="col s12 m12 l12" v-else>
            <div class="center-align" v-if="users.data.length == 0">
               <h4>No users to display</h4> 
            </div>
            <table class="bordered highlight responsive-table centered" v-else>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Farm Code</th>
                        <th>Farm</th>
                        <th>Last Login</th>
                        <th>Manage User</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="user in users.data" :key="user.user_id">
                        <td>{{user.user_name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.code}}</td>
                        <td>{{user.farm_name}}</td>
                        <td v-if="user.last_active!=null">{{user.last_active}}</td>
                        <td v-else>-</td>
                        <td>
                            <div class="col s4 m4 l4">
                                <a @click="selected_user=user.user_id;selected_user_name=user.user_name;username_edit=user.user_name;
                                            email_edit=user.email;farm_code_edit=user.code" 
                                        href="#edit_user_modal" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Edit User">
                                    <i class="fas fa-user-edit left"></i>
                                </a>
                            </div>
                            <div class="col s4 m4 l4">
                                <a v-if="!user.blocked" @click="selected_user=user.user_id;selected_user_name=user.user_name;selected_user_status=user.blocked" href="#block_user_modal" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Block User">
                                    <i v-if="!user.blocked" class="fas fa-user-lock left"></i>
                                    <i v-else class="fas fa-user-check left"></i>
                                </a>
                                <a v-else @click="selected_user=user.user_id;selected_user_name=user.user_name;selected_user_status=user.blocked" href="#block_user_modal" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Unblock User">
                                    <i class="fas fa-user-check left"></i>
                                </a>
                            </div>
                            <div class="col s4 m4 l4">
                                <a @click="selected_user=user.user_id;selected_user_name=user.user_name" href="" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Delete User">
                                    <i class="fas fa-user-times left"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="col s12 m12 l12 center">
                <pagination :data="users" @pagination-change-page="getUserList"></pagination>
            </div>  
        </div>
        <div id="add_user_modal" class="modal modal-fixed-footer">
            <form action="post" v-on:submit.prevent="createNewUser">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Create New User</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model="username" placeholder="Username" id="username" type="text">
                                    <label class="active" for="username">Username</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model="email" placeholder="email@gmail.com" id="email" type="email" class="validate">
                                    <label class="active" for="email">Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model="farm_code" placeholder="ex. BHL, WMSU, etc." id="code" type="text">
                                    <label class="active" for="code">Farm Code</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model="farm_name" placeholder="ex. Rustic Farms Philippines" id="farm_name" type="text">
                                    <label class="active" for="farm_name">Farm Name</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model="farm_address" placeholder="ex. 755 L. Wood St, Pasay, Metro Manila" id="farm_address" type="text">
                                    <label class="active" for="farm_address">Farm Address</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <label for="breed">Breed</label>
                                    <v-select v-model="breed_selected" label="breed" :options="breeds" id="breed">
                                        <i slot="spinner" class="icon icon-spinner"></i>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button  href="javascript:void(0);" class="modal-action modal-close waves-effect waves-indigo btn-flat" type="submit">Submit</button>
                    <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-indigo btn-flat">Close</a>
                </div>
            </form>
        </div>
        <div id="block_user_modal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4 v-if="!selected_user_status" class="red-text">Block {{selected_user_name}}</h4>
                        <h4 v-else class="green-text">Unblock {{selected_user_name}}</h4>
                    </div>
                </div>
                
                <div class="row">
                    <div v-if="!selected_user_status" class="col s12 m12 l12">
                        <p>Are you sure you want to <span class="red-text">block</span> <strong>{{selected_user_name}}</strong>?</p>
                        <p>This will block the user's access to the information system.</p>
                    </div>
                    <div v-else class="col s12 m12 l12">
                        <p>Are you sure you want to <span class="green-text">unblock</span> <strong>{{selected_user_name}}</strong>?</p>
                        <p>This will make the user be able login to the information system again.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a @click="blockUnblockUser" href="javascript:void(0);" class="modal-action modal-close waves-effect waves-indigo btn-flat">Agree</a>
                <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-indigo btn-flat">Close</a>
            </div>
        </div>
        <div id="edit_user_modal" class="modal modal-fixed-footer">
            <form v-on:submit.prevent="editUser" method="PUT">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h4>Edit {{selected_user_name}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model="username_edit" placeholder="Edit Username" id="edit_username" type="text">
                                    <label class="active" for="edit_username">Username</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model="email_edit" placeholder="Edit Email" id="edit_email" type="text">
                                    <label class="active" for="edit_email">Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input v-model="farm_code_edit" placeholder="Edit Farm Code" id="edit_farm_code" type="text">
                                    <label class="active" for="edit_farm_code">Farm Code</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="modal-action modal-close waves-effect waves-indigo btn-flat" type="submit">Submit</button>
                    <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-indigo btn-flat">Close</a>
                </div>
            </form>
        </div>
        <div class="fixed-action-btn horizontal tooltipped" data-position="left" data-delay="100" data-tooltip="Create New User">
            <a class="btn-floating btn-large indigo darken-1 modal-trigger" href="#add_user_modal">
                <i class="fas fa-user-plus"></i>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                users : {},
                users_loaded : false,
                breeds : [],
                breeders_loaded : false,
                username : '',
                email : '',
                farm_code : '',
                farm_name : '',
                farm_address: '',
                breed_selected : '',

                selected_user : '',
                selected_user_name : '',
                selected_user_status : '',

                username_edit : '',
                email_edit : '',
                farm_code_edit : '',
            }
        },
        methods : {
            getUserList : async function (page = 1) {
                try {
                    const response = await axios.get('user_list?page=' + page);
                    this.users = response.data;
                    this.users_loaded = true;
                } catch (error) {
                    this.users_loaded = false;
                }
            },
            getBreedsList : async function () {
                try {
                    const response = await axios.get('breed_list');
                    this.breeds = response.data;
                    this.breeders_loaded = true;
                } catch (error) {
                    this.breeders_loaded = false;
                }
            },
            createNewUser : function () {
                if(!this.checkEmailFormat(this.email)){
                    Materialize.toast("Incorrect email format", 5000, 'red rounded');
                }
                axios.post('create_user', {
                    username : this.username,
                    email : this.email,
                    farm_code : this.farm_code,
                    farm_name : this.farm_name,
                    farm_address : this.farm_address,
                    breed_selected : this.breed_selected.id
                })
                .then(response => {
                    if(response.data.error == undefined){
                        this.getUserList();
                        this.username = ''
                        this.email = '';
                        this.farm_code = '';
                        this.farm_name = '';
                        this.farm_address = '';
                        this.breed_selected = '';
                        Materialize.toast('Successfully created new user', 5000, 'green rounded');
                    }else{
                        Materialize.toast(response.data.error, 5000, 'red rounded');
                    }
                }).catch(error => {
                    Materialize.toast(error, 3000, 'red rounded');
                });
            },
            blockUnblockUser : function () {
                axios.patch('block_user/' + this.selected_user)
                .then(response => {
                    this.getUserList(); 
                    this.selected_user = '';
                    this.selected_user_name = '';
                    this.selected_user_status = '';
                    Materialize.toast('Successfully changed user state', 5000, 'green rounded');
                })
                .catch(error => {
                    Materialize.toast('Failed to change user state', 5000, 'red rounded');
                });
            },
            editUser : function () {
                axios.put('edit_user', {
                    user : this.selected_user,
                    username : this.username_edit,
                    email : this.email_edit,
                    farm_code : this.farm_code_edit
                })
                .then(response => {
                    if(response.data.success != null){
                        this.selected_user = '';
                        this.username_edit = '';
                        this.email_edit = '';
                        this.farm_code_edit = '';
                        Materialize.toast(response.data.success, 5000, 'green rounded');
                        this.getUserList();
                    }
                    if(response.data.error != null){
                        Materialize.toast(response.data.error, 5000, 'red rounded');
                    }
                })
                .catch(error => {
                    console.log(error);
                });
            }, 
            capitalize : function (string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },
            checkEmailFormat : function (string){
                var re = /\S+@\S+\.\S+/;
                return re.test(email);
            }
        },
        mounted() {
            $(document).ready(function(){
                $('.tooltipped').tooltip({delay: 50});
                $('.modal').modal({
                    dismissible: false,
                });
            });
            this.getUserList();
            this.getBreedsList();
        },
        created() {
            
        }
    }
</script>

<style>
    #block_user_modal{
        max-height: 30%;
        width: 35%;
    }
    #edit_user_modal{
        max-height: 55%;
        max-width: 45%;
    }
</style>
