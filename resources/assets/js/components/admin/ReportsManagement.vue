<template>
    <div class="row">
        <div class="col s12 m12 l12 center-align" v-if="!reports.data">
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
            <div class="center-align" v-if="reports.data.length == 0">
            <h4>No reports to display</h4> 
            </div>
            <table class="bordered highlight striped" v-else>
                <thead>
                    <tr>
                        <th>Report Title</th>
                        <th class="center-align">Report for year: </th>
                        <th class="center-align">Date Published</th>
                        <th class="center-align">Date Archived</th>
                        <th class="center-align">Last Updated</th>
                        <th class="center-align">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="n in reports.data" :key="n.id">
                        <td>
                            <b>{{n.title | truncate(30)}}</b>
                        </td>
                        <td>
                            <b>{{ n.year }}</b>
                        </td>
                        <td v-if="n.published_at!=null" class="center-align">{{n.published_at | formatDate}}</td>
                        <td v-else class="center-align">-</td>
                        <td v-if="n.archived_at!=null" class="center-align">{{n.archived_at | formatDate}}</td>
                        <td v-else class="center-align">-</td>
                        <td v-if="n.updated_at!=null" class="center-align">{{n.updated_at | formatDate}}</td>
                        <td v-else class="center-align">-</td>
                        <td>
                            <div class="row valign-wrapper">
                                <div class="col s6 m6" v-if="n.published_at !== null && n.archived_at === null">
                                    <a href="javascript:void(0);" @click.prevent="archiveReport(n)" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Archive Report">
                                        <i class="fas fa-archive left"></i>
                                    </a>
                                </div>
                                <div class="col s6 m6" v-if="n.published_at === null && n.archived_at === null">
                                    <a href="javascript:void(0);" @click.prevent="publishReport(n)" class="indigo-text darken-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Publish Report">
                                        <i class="fas fa-check left"></i>   
                                    </a>
                                </div>
                                <div class="col s6 m6">
                                    <a ref="javascript:void(0);" @click.prevent="goToReport(n.id)" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Edit Report">
                                        <i class="fas fa-edit left"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="col s12 m12 l12 center">
                <pagination :data="reports" @pagination-change-page="onChangePage"></pagination>
            </div>
        </div> 
    </div>
</template>

<script>
    export default {
        data () {
            return {
                currentPage: 1,
                reports: {},
            }
        },
        methods : {
            onChangePage: function(page) {
                this.currentPage = page;
                this.getReportsList(page);
            },
            publishReport: async function (reports) {
                if (confirm('Do you want to publish this reports?')) {
                    try {
                        const response = await axios.patch(`reports/publish/${reports.id}`);
                        this.getReportsList(this.currentPage);
                    } catch (error) {
                    }
                }
            },
            archiveReport: async function (reports) {
                if (confirm('Do you want to archive this reports?')) {
                    try {
                        const response = await axios.patch(`reports/archive/${reports.id}`);
                        this.getReportsList(this.currentPage);
                    } catch (error) {
                    }
                }
            },
            getReportsList: async function (page = 1) {
                try {
                    const response = await axios.get('reports?page=' + page);
                    this.reports = response.data;
                } catch (error) {
                }
            },
            goToReport: function(id) {
                window.location.href = 'reports_management/edit_report/' + id;
            }
        },
        mounted() {
            $(document).ready(function(){
                $('.tooltipped').tooltip({delay: 50});
            });
            this.getReportsList(this.currentPage);
        },
        created() {
            
        }
    }
</script>

<style>
</style>
