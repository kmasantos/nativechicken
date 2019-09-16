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
            <table class="bordered highlight responsive-table striped" v-else>
                <thead>
                    <tr>
                        <th>News Title</th>
                        <th>Date Published</th>
                        <th>Last Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="n in news.data" :key="n.id">
                        <td>
                            <span>{{n.title | truncate}}</span>
                        </td>
                        <td>{{n.published_at ? (n.published_at | formatDate) : '-'}}</td>
                        <td>{{n.updated_at ? (n.updated_at | formatDate) : '-'}}</td>
                        <td>
                            <div>
                                <a href="#edit_news_modal" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Publish News">
                                    <i class="fas fa-check left"></i>   
                                </a>
                                <a href="#edit_news_modal" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Edit News">
                                    <i class="fas fa-edit left"></i>
                                </a>
                                <a href="#edit_news_modal" class="indigo-text darken-1 tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Edit News">
                                    <i class="fas fa-trash left"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="col s12 m12 l12 center">
                <pagination :data="news" @pagination-change-page="getNewsList"></pagination>
            </div>
        </div>
        <div class="fixed-action-btn horizontal tooltipped" data-position="left" data-delay="100" data-tooltip="Create New User">
            <a class="btn-floating btn-large indigo darken-1 modal-trigger" href="#add_user_modal">
                <i class="fas fa-user-plus"></i>
            </a>
        </div>
    </div>
</template>

<script>

    import moment from 'moment';

    export default {
        data () {
            return {
                news: {}
            }
        },
        filters: {
            truncate: function (value) {
                if (value.length >= 50) {
                    return `${value.slice(0, 50)}...`;
                }
                else 
                    return value;
            },
            formatDate: function (date) {
                return moment(date).format('MMMM D YYYY, h:mm:ss a');
            }
        },
        methods : {
            getNewsList : async function (page = 1) {
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
            this.getNewsList();
        },
        created() {
            
        }
    }
</script>

<style>
</style>
