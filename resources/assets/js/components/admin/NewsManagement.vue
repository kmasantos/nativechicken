<template>
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
                                <div v-if="n.published_at !== null && n.archived_at === null">
                                    <a href="javascript:void(0);" @click.prevent="archiveNews(n)" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Archive News">
                                        <i class="fas fa-archive left"></i>
                                    </a>
                                </div>
                                <div v-if="n.published_at === null && n.archived_at === null">
                                    <a href="javascript:void(0);" @click.prevent="publishNews(n)" class="indigo-text darken-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Publish News">
                                        <i class="fas fa-check left"></i>   
                                    </a>
                                </div>
                                <div>
                                    <a ref="javascript:void(0);" @click.prevent="goToNews(n.id)" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Edit News">
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
</template>

<script>
    export default {
        data () {
            return {
                currentPage: 1,
                news: {},
            }
        },
        methods : {
            onChangePage: function(page) {
                this.currentPage = page;
                this.getNewsList(page);
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
            goToNews: function(id) {
                window.location.href = 'news_management/edit_news/' + id;
            }
        },
        mounted() {
            $(document).ready(function(){
                $('.tooltipped').tooltip({delay: 50});
            });
            this.getNewsList(this.currentPage);
        },
        created() {
            
        }
    }
</script>

<style>
</style>
