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
                        <td>{{user.last_active}}</td>
                        <td>
                            <div class="col s4 m4 l4">
                                <a class="grey-text darken-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit User">
                                    <i class="fas fa-user-edit left"></i>
                                </a>
                            </div>
                            <div class="col s4 m4 l4">
                                <a class="grey-text darken-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Block User">
                                    <i class="fas fa-user-lock left"></i>
                                </a>
                            </div>
                            <div class="col s4 m4 l4">
                                <a class="grey-text darken-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete User">
                                    <i class="fas fa-user-times left"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                users : {},
                users_loaded : false,
            }
        },
        methods : {
            getUserList : async function () {
                try {
                    const response = await axios.get('user_list');
                    this.users = response.data;
                    this.users_loaded = true;
                } catch (error) {
                    this.users_loaded = false;
                }
            },
            capitalize : function (string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },
        },
        mounted() {
            $(document).ready(function(){
                $('.tooltipped').tooltip({delay: 50});
            
            });
            this.getUserList();
        }
    }
</script>
