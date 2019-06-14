<template>
    <div id="chicken_breed_template" ref="breeds" class="row">
        <div class="col s12 l3">
            <div class="row">
                <div class="col s12 l12">
                    <div class="card">
                        <div class="card-image">
                            <img src="https://i.ibb.co/xYg698x/boholano-3.png">
                            <a @click="selected_breed='Boholano Native Chicken';scrollTo('breed_info')"  class="btn-floating halfway-fab waves-effect waves-light blue-grey lighten-1 tooltip" data-tippy-content="Show Breed Info"><i class="fas fa-info"></i></a>
                        </div>
                        <div class="card-content">
                            <span class="card-title center-align">Boholano</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 l3">
            <div class="row">
                <div class="col s12 l12">
                    <div class="card">
                        <div class="card-image">
                            <img src="https://i.ibb.co/R3jTZqJ/camarines.png">
                            <a @click="selected_breed='Camarines Native Chicken';scrollTo('breed_info')" href="#breed_info" class="btn-floating halfway-fab waves-effect waves-light blue-grey lighten-1 tooltip" data-tippy-content="Show Breed Info"><i class="fas fa-info"></i></a>
                        </div>
                        <div class="card-content">
                            <span class="card-title center-align">Camarines</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 l3">
            <div class="row">
                <div class="col s12 l12">
                    <div class="card">
                        <div class="card-image">
                            <img src="https://i.ibb.co/VmZftbx/Darag.png">
                            <a @click="selected_breed='Darag Native Chicken';scrollTo('breed_info')" href="#breed_info" class="btn-floating halfway-fab waves-effect waves-light blue-grey lighten-1 tooltip" data-tippy-content="Show Breed Info"><i class="fas fa-info"></i></a>
                        </div>
                        <div class="card-content">
                            <span class="card-title center-align">Darag</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 l3">
            <div class="row">
                <div class="col s12 l12">
                    <div class="card">
                        <div class="card-image">
                            <img src="https://i.ibb.co/dcggB07/Zampen.png">
                            <a @click="selected_breed='ZamPen Native Chicken';scrollTo('breed_info')" href="#breed_info" class="btn-floating halfway-fab waves-effect waves-light blue-grey lighten-1 tooltip" data-tippy-content="Show Breed Info"><i class="fas fa-info"></i></a>
                        </div>
                        <div class="card-content">
                            <span class="card-title center-align">ZamPen</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div ref="breed_info" class="col s12 l12">
            <div id="breed_info" v-if="selected_breed==='Boholano Native Chicken'">
                <chicken-breed :selected="selected_breed='Boholano Native Chicken'" v-on:close="selected_breed=null;scrollTo('breeds')"></chicken-breed>
            </div>
            <div id="breed_info" v-if="selected_breed==='Camarines Native Chicken'">
                <chicken-breed :selected="selected_breed='Camarines Native Chicken'" v-on:close="selected_breed=null;scrollTo('breeds')"></chicken-breed>
            </div>
            <div id="breed_info" v-if="selected_breed==='Darag Native Chicken'">
                <chicken-breed :selected="selected_breed='Darag Native Chicken'" v-on:close="selected_breed=null;scrollTo('breeds')"></chicken-breed>
            </div>
            <div id="breed_info" v-if="selected_breed==='ZamPen Native Chicken'">
                <chicken-breed :selected="selected_breed='ZamPen Native Chicken'" v-on:close="selected_breed=null;scrollTo('breeds')"></chicken-breed>
            </div>
        </div>
    </div>
</template>

<script>
import tippy from 'tippy.js';
export default {
    data () {
        return {
            selected_breed : null,
        }
    },
    methods : {
        scrollTo : function (ref){
            var element = this.$refs[ref];
            var top = element.offsetTop-110;
            window.scrollTo(0, top);
        }
    },
    mounted () {
        tippy('#chicken_breed_template', {
            target : '.tooltip',
            arrow: true,
            arrowType: 'round',
            animation: 'scale',
            inertia: true,
        });
    }
}
</script>

<style scoped>
    
</style>

