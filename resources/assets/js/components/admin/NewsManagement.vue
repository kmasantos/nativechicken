<template>
    <div>
        <div class="row">
            <div class="col s12 m12 l12 center-align" v-if="!news.data">
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
                <div class="center-align" v-if="news.data.length == 0">
                <h4>No news to display</h4> 
                </div>
                <table class="bordered highlight striped" v-else>
                    <thead>
                        <tr>
                            <th>News Title</th>
                            <th class="center-align">Date Published</th>
                            <th class="center-align">Date Archived</th>
                            <th class="center-align">Last Updated</th>
                            <th class="center-align">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="n in news.data" :key="n.id">
                            <td>
                                <b>{{n.title | truncate(30)}}</b>
                            </td>
                            <td v-if="n.published_at!=null" class="center-align">{{n.published_at | formatDate}}</td>
                            <td v-else class="center-align">-</td>
                            <td v-if="n.archived_at!=null" class="center-align">{{n.archived_at | formatDate}}</td>
                            <td v-else class="center-align">-</td>
                            <td v-if="n.updated_at!=null" class="center-align">{{n.updated_at | formatDate}}</td>
                            <td v-else class="center-align">-</td>
                            <td>
                                <div class="row">
                                    <div class="col s6 m6 l6" v-if="n.published_at !== null && n.archived_at === null">
                                        <a href="javascript:void(0);" @click.prevent="archiveNews(n)" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Archive News">
                                            <i class="fas fa-archive left"></i>
                                        </a>
                                    </div>
                                    <div class="col s6 m6 l6" v-if="n.published_at === null && n.archived_at === null">
                                        <a href="javascript:void(0);" @click.prevent="publishNews(n)" class="indigo-text darken-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Publish News">
                                            <i class="fas fa-check left"></i>   
                                        </a>
                                    </div>
                                    <div class="col s6 m6 l6">
                                        <a href="#news_modal" @click.prevent="setFormData(n); isEditMode = true" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Edit News">
                                            <i class="fas fa-edit left"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="col s12 m12 l12 center">
                    <pagination :data="news" @pagination-change-page="onChangePage"></pagination>
                </div>
            </div> 
        </div>
        <div class="fixed-action-btn horizontal tooltipped" data-position="left" data-delay="50" data-tooltip="Create New News">
            <a @click.prevent="setFormData(null)" class="btn-floating btn-large indigo darken-1 modal-trigger" href="#news_modal">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <!-- Modals -->
        <div id="news_modal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="col s12 m12 l12">
                    <div class="input-field col s12">
                        <h6>News Title: </h6>
                        <textarea id="textarea1" class="materialize-textarea" v-model="formData.title"></textarea>
                    </div>
                    <div class="input-field col s12">
                        <h6>News Content: </h6>
                        <vue-editor v-model="formData.content"></vue-editor>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);"  @click.prevent="submitForm()" class="modal-action modal-close waves-effect waves-green btn-flat ">Submit</a>
                <a href="#!" @click.prevent="setFormData(null)" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
            </div>
        </div>
    </div>
</template>

<script>

    import moment from 'moment';
    import { VueEditor } from 'vue2-editor';

    export default {
        data () {
            return {
                currentPage: 1,
                isEditMode: false,
                news: {},
                formData: {
                    id: '',
                    title: '',
                    content: ''
                },
            }
        },
        components: {
            VueEditor
        },
        methods : {
            onChangePage: function(page) {
                this.currentPage = page;
                this.getNewsList(page);
            },  
            setFormData: function (data) {
                if (data) {
                    const { id, title, content } = data;
                    this.formData = Object.assign(this.formData, {
                        id, title, content
                    });
                }
                else {
                    this.formData = Object.assign(this.formData, {
                        id: '',
                        title: '',
                        content: '',
                    });
                }
            },
            submitForm: async function () {

                if (this.isEditMode) {
                    await this.editNews(this.formData);
                }
                else {
                }

            },
            publishNews: async function (news) {
                if (confirm('Do you want to publish this news?')) {
                    try {
                        const response = await axios.patch(`news/publish/${news.id}`);
                        this.getNewsList(this.currentPage);
                    } catch (error) {
                    }
                }
            },
            addNews: async function () {

            },
            editNews: async function (news) {
                if (confirm('Do you want to edit this news?')) {
                    // try {
                        const response = await axios.put('news', { ...news });
                        this.isEditMode = false;
                        this.setFormData(null);
                        this.getNewsList(this.currentPage);
                    // } catch (error) {
                    // }
                }
            },
            archiveNews: async function (news) {
                if (confirm('Do you want to archive this news?')) {
                    try {
                        const response = await axios.patch(`news/archive/${news.id}`);
                        this.getNewsList(this.currentPage);
                    } catch (error) {
                    }
                }
            },
            getNewsList: async function (page = 1) {
                try {
                    const response = await axios.get('news?page=' + page);
                    this.news = response.data;
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
            this.getNewsList(this.currentPage);
        },
        created() {
            
        }
    }
</script>

<style>
</style>
