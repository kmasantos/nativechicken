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
                        <th>Role</th>
                        <th>Farm</th>
                        <th>Last Login</th>
                        <th>Manage User</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="user in users.data" :key="user.user_id">
                        <td>{{user.user_name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{capitalize(user.role)}}</td>
                        <td>{{user.farm_name}}</td>
                        <td v-if="user.last_active!=null">{{user.last_active}}</td>
                        <td v-else>-</td>
                        <td>
                            <div class="col s4 m4 l4">
                                <a class="indigo-text darken-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit User">
                                    <i class="fas fa-user-edit left"></i>
                                </a>
                            </div>
                            <div class="col s4 m4 l4">
                                <a class="indigo-text darken-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Block User">
                                    <i class="fas fa-user-lock left"></i>
                                </a>
                            </div>
                            <div class="col s4 m4 l4">
                                <a class="indigo-text darken-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete User">
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

</style>
