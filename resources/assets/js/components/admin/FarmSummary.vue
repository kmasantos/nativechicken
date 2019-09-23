<template>
    <div class="row">
        <div class="col s12 m12 l12 center-align" v-if="!users.data">
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
                        <th>Generate Summary</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="user in users.data" :key="user.user_id">
                        <td>{{user.user_name}}</td>
                        <td>{{user.code}}</td>
                        <td>{{user.farm_name}}</td>
                        <td>
                            <div class="col s12 m12 l12 center">
                                <a href="javascript:void(0)" class="indigo white-text darken-1 modal-trigger center-align btn" data-position="bottom" data-delay="50" data-tooltip="Generation Summary">
                                    Generation
                                </a>
                                <a href="javascript:void(0)" class="indigo white-text darken-1 modal-trigger center-align btn" data-position="bottom" data-delay="50" data-tooltip="Generation Summary">
                                    Family
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
