<template>        
    <div id="duck_breed_template" class="row" ref="dbreeds">
        <div class="col s12 l3 offset-l3">
            <div class="row">
                <div class="col s12 l12">
                    <div class="card">
                        <div class="card-image">
                            <img src="https://i.ibb.co/nPTh4tb/itim-1.png">
                            <a @click="selected_dbreed='Itik Pinas (IP) Itim';scrollTo('dbreed_info')" class="btn-floating halfway-fab waves-effect waves-light blue-grey lighten-1 tooltip" data-tippy-content="Show Breed Info"><i class="fas fa-info"></i></a>
                        </div>
                        <div class="card-content">
                            <span class="card-title center-align">Itik Pinas (IP) Itim</span>
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
                            <img src="https://i.ibb.co/4MhWw9f/khaki-2.png">
                            <a @click="selected_dbreed='Itik Pinas (IP) Khaki';scrollTo('dbreed_info')" class="btn-floating halfway-fab waves-effect waves-light blue-grey lighten-1 tooltip" data-tippy-content="Show Breed Info"><i class="fas fa-info"></i></a>
                        </div>
                        <div class="card-content">
                            <span class="card-title center-align">Itik Pinas (IP) Khaki</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div ref="dbreed_info" class="col s12 l12">
            <div v-if="selected_dbreed==='Itik Pinas (IP) Itim'">
                <duck-breed :dselected="selected_dbreed='Itik Pinas (IP) Itim'" v-on:dclose="selected_dbreed=null;scrollTo('dbreeds')"></duck-breed>
            </div>
            <div v-if="selected_dbreed==='Itik Pinas (IP) Khaki'">
                <duck-breed :dselected="selected_dbreed='Itik Pinas (IP) Khaki'" v-on:dclose="selected_dbreed=null;scrollTo('dbreeds')"></duck-breed>
            </div>
        </div>
    </div>         
</template>

<script>
import tippy from 'tippy.js';
export default {
    data () {
        return {
            selected_dbreed : null,
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
        tippy('#duck_breed_template', {
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
