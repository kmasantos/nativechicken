<template>
    <div>
        <a href="" id="downloadlink" ref="csvfiledownload" hidden="true" download="mycsv.csv">download</a>
        <div class="row">
            <div class="col s12 m12 l12 center-align" v-if="!users.data">
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
                                    <a 
                                        @click.prevent="setCurrentUser(user.farm_id)"
                                        href="#generation_modal"
                                        style="margin: 4px;"
                                        class="indigo white-text darken-1 modal-trigger center-align btn" 
                                        data-position="bottom" data-delay="50" data-tooltip="Generation Summary"
                                    >
                                        Generation
                                    </a>
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 modal-trigger center-align btn" data-position="bottom" data-delay="50" data-tooltip="Generation Summary">
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
        <div id="generation_modal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="bordered highlight responsive-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="center-align">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Phenotypic - Replacement</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Phenotypic - Breeder</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Morphometric - Replacement</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Morphometric - Breeder</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Morphometric - Replacement</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Growth Records</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;"  href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>Feeding Perfomance</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a @click.prevent="getFeedingSummary(currentUser)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr> -->
                        <tr>
                            <td>Egg Production</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>Hatchery</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a @click.prevent="getHatcherySummary(currentUser)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr> -->
                        <tr>
                            <td>Egg Quality</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Mortality</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sales</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a @click.prevent="setCurrentUser(null)" href="javascript:void(0);" class="modal-action modal-close waves-effect waves-indigo btn-flat">Close</a>
            </div>
        </div>
    </div>
</template>

<script>

    import { get } from 'lodash';

    export default {
        data () {
            return {
                users : {},
                currentUser: null,
            }
        },
        methods : {
            getHatcherySummary: async function(farmId) {
                const response = await axios.get('summary/hatchery/' + farmId);
                const { farm_generations, hatchery_data } = response.data;
                const csvData = farm_generations.reduce((acc, val) => {
                    
                    const genNumber = val.number;
                    
                    if (hatchery_data[genNumber]) {
                        const { 
                            eggs_set, eggs_fertile, eggs_hatched, fertility, hatchability
                        } = hatchery_data[genNumber];

                        const data = `${genNumber},${eggs_set},${eggs_fertile},${eggs_hatched},${fertility},${hatchability}\n`
                        
                        return acc + data;
                    }

                    const data = `${genNumber},,,,,\n`
                    
                    return acc + data; 

                }, 'Generation, Eggs Set, Eggs Fertile, Eggs Hatched, Fertility, Hachability\n');

                this.downloadCSV(csvData, 'hatchery');
            },
            getFeedingSummary: async function(farmId) {
                const response = await axios.get('summary/feeding_performance/' + farmId);

                const { 
                    farm_generations, brooder_feeding, replacement_feeding, breeder_feeding
                } = response.data;

                const csvData = farm_generations.reduce((acc, val) => {
                    const genNumber = val.number;
                    const brooderData = brooder_feeding[genNumber];
                    const breederData = breeder_feeding[genNumber];
                    const replacementData = replacement_feeding[genNumber];

                    const row1 = `${genNumber},Total Fed,${get(brooderData, 'total_fed', '')},${get(replacementData, 'total_fed', '')},${get(breederData, 'total_fed', '')}`;
                    const row2 = `,Total Refused, ${get(brooderData, 'total_refused', '')},${get(replacementData, 'total_refused', '')},${get(breederData, 'total_refused', '')}`;
                    const row3 = `,Total Consumption, ${get(brooderData, 'total_consumption', '')},${get(replacementData, 'total_consumption', '')},${get(breederData, 'total_consumption', '')}`;

                    return acc + [row1, row2, row3].join('\n') + '\n';
    
                }, 'Generation, Feeding Perfomance, Brooders, Replacements, Breeder\n');

                this.downloadCSV(csvData, 'feeding_performance');
            },
            downloadCSV: function(rawData, fileName) {
                const link = document.getElementById('downloadlink');
                const data = encodeURI(rawData);
                link.setAttribute('href', 'data:text/plain;charset=utf-8,' + data);
                link.setAttribute('download', `${fileName}.csv`);
                link.click();
            },
            setCurrentUser: function(farmId) {
                this.currentUser = farmId;
            },
            getUserList : async function (page = 1) {
                try {
                    const response = await axios.get('user_list?page=' + page);
                    this.users = response.data;
                } catch (error) {
                }
            },
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
            $(document).ready(function(){
                $('.tooltipped').tooltip({delay: 50});
                $('.modal').modal({
                    dismissible: false,
                });
            });
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
