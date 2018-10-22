<template>
    <div>
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5>Replacement Phenotypic and Morphometric Values</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <ul class="breadcrumb">
                            <li><a href="javascript:javascript:history.go(-2)">Home</a></li>
                            <li>Replacements</li>
                        </ul>
                    </div>
                </div>
                <form v-on:submit.prevent="searchReplacements" method="GET">
                    <div class="row valign-wrapper">
                        <div class="col s12 m9 l9 valign">
                            <label for="search">Search</label>
                            <input v-model="search" placeholder="Type family number" id="search" type="text">
                        </div>
                        <div class="col s12 m3 l3 valign">
                            <button class="btn waves-effect waves-light blue-grey darken-1" type="submit">Search<i class="fas fa-search right"></i></button>
                        </div>
                    </div>
                </form>
                <div class="row center" v-if="phenomorphorecordsloaded==false">
                    <div class="col s12 m12 l12">
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
                </div>
                <div v-else>
                    <div class="row" v-if="Array.isArray(phenomorphorecords.data) == false">
                        <div class="col s12 m12 l12 center-align">
                            No Records
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    Vue.component('pagination', require('laravel-vue-pagination'));
    var moment = require('moment');
    export default {
        components : {
            Datepicker
        },
        data() {
            return {
                phenomorphorecordsloaded : false,
                phenomorphorecords : {},
            }
        },
        methods : {
            initialize : function () {

            },
        },
        created () {

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
