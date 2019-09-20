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
                        <th>Farm Code</th>
                        <th>Farm</th>
                        <th>Manage User</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="user in users.data" :key="user.user_id">
                        <td>{{user.user_name}}</td>
                        <td>{{user.code}}</td>
                        <td>{{user.farm_name}}</td>
                        <td>
                            <div class='center-align'>
                                <a href="#!" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Edit User">
                                    <i class="fas fa-user-edit left"></i>
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

                delete_type : null,
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
            deleteUser : function () {
                if(delete_type === null){
                    Materialize.toast("Choose Delete Type", 5000, 'red rounded');
                }else{
                    
                }
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
    #delete_user_modal{
        max-height: 50%;
        max-width: 45%;
    }
    
</style>
