<template>
    <div class="row">
        <div class="col s12 l12">
            <div ref="duck_info_card" class="card-panel">
                <div class="row valign-wrapper">
                    <div class="col s10 l10 valign">
                        <h5 style="font-family: 'Poppins', sans-serif;">{{dselected}}</h5>
                        <i v-if="dselected==='Itik Pinas (IP) Itim'">Purified and maintained by the BAI-National Swine and Poultry Research and Development Center, Tiaong</i>
                        <i v-if="dselected==='Itik Pinas (IP) Khaki'">Purified and maintained by the National Swine and Poultry Research and Development Center, Tiaong</i>
                    </div>
                    <div class="col s2 l2 valign">
                        <a @click="dclose" class="waves-effect waves-gray btn-flat tooltip" data-tippy-content="Close"><i class="far fa-times-circle"></i></a>
                    </div>
                </div>
                <!-- IP ITIM -->
                <div v-if="dselected==='Itik Pinas (IP) Itim'">
                    <div class="row">
                        <div class="col s12 l6">
                            <img class="materialboxed" data-caption="Itik Pinas (IP) Itim Duck (Left) & Drake (Right)" height="400px" width="100%" src="https://i.ibb.co/YjVM5VC/itim1.jpg">
                        </div>
                        <div class="col s12 l6">
                            <img class="materialboxed" data-caption="Itik Pinas (IP) Itim Drake (Left) & Duck (Right)" height="400px" src="https://i.ibb.co/pXNKdLK/itim2.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Physical Characteristics</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> IP Itim drake weight can reach 1.34 kg and its length at 52 cm. Their neck length is about 1 cm longer than the IP Itim duck. Similarly, the drake’s wingspan is 2 cm wider and the shanks are 0.5 cm longer than the duck’s.</li>
                                <li><i class="fas fa-chevron-right"></i> Both drake and duck of IP Itim has black plumage, black bean, and brown eye.  Both are also slightly upright. The drake has a green bill while the duck has a black bill. The drake’s distinct marking is the white ‘bib’ in its neck.</li>
                            </ul>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Production Performance</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Average age at first lay – 23 weeks of age</li>
                                <li><i class="fas fa-chevron-right"></i> Egg production per duck per year – 257</li>
                                <li><i class="fas fa-chevron-right"></i> Average egg weight – 65 g</li>
                                <li><i class="fas fa-chevron-right"></i> Egg quality traits</li>
                                <li>
                                    <ul style="play:inline-block; margin-left:2em;">
                                        <li>- Egg color - Cream</li>
                                        <li>- Shape - Ovoid</li>
                                        <li>- Albumen weight - 35 g</li>
                                        <li>- Yolk weight - 20.6 g</li>
                                        <li>- Egg Shell weight - 10.01 g</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- IP KHAKI -->
                <div v-if="dselected==='Itik Pinas (IP) Khaki'">
                    <div class="row">
                        <div class="col s12 l6">
                            <img class="materialboxed center-image" data-caption="Itik Pinas (IP) Khaki" height="400px" width="100%" src="https://i.ibb.co/p0mtKjK/khaki1.png">
                        </div>
                        <div class="col s12 l3">
                            <img class="materialboxed center-image" data-caption="Itik Pinas (IP) Khaki Drake" height="400px" width="100%" src="https://i.ibb.co/tYTSk2H/khaki2.png">
                        </div>
                        <div class="col s12 l3">
                            <img class="materialboxed center-image" data-caption="Itik Pinas (IP) Khaki Duck" height="400px" width="100%" src="https://i.ibb.co/3SWh1Kb/khaki3.png">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Physical Characteristics</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> IP Khaki drake weight can reach 1.19 kg and its length at 55 cm. Their neck length is about 2 cm longer than the IP Khaki duck. Similarly, the drake’s chest circumference is 2 cm wider than the duck’s, though their wingspan is almost equal at 45 cm. The drake’s shanks are about 0.3 cm longer than the duck’s.</li>
                                <li><i class="fas fa-chevron-right"></i> The IP Khaki drakes and ducks have  brown plumage. Both have no distinct markings, has black bean, and brown eye color. Both are also slightly upright. The drake has a green bill while the duck has a black bill, similar to the IP Itim breed.</li>
                            </ul>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Production Performance</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Average age at first lay – 22 weeks of age</li>
                                <li><i class="fas fa-chevron-right"></i> Egg production per duck per year – 256</li>
                                <li><i class="fas fa-chevron-right"></i> Average egg weight – 64 g</li>
                                <li><i class="fas fa-chevron-right"></i> Egg quality traits</li>
                                <li>
                                    <ul style="play:inline-block; margin-left:2em;">
                                        <li>- Egg color - Cream</li>
                                        <li>- Shape - Ovoid</li>
                                        <li>- Albumen weight - 34.87 g</li>
                                        <li>- Yolk weight - 20.8 g</li>
                                        <li>- Egg shell weight - 9.62 g</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col s12 l12 center">
                        <a @click="scrollTo('duck_info_card')" class="waves-effect waves-gray btn-flat tooltip" data-tippy-content="Back to top"><i class="fas fa-chevron-up top"></i></a>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</template>

<script>
import tippy from 'tippy.js';
export default {
    props: [
        'dselected'
    ],
    methods : {
        dclose : function () {
            this.$emit('dclose', null)
        },
        scrollTo : function (ref){
            var element = this.$refs[ref];
            var top = element.offsetTop-110;
            window.scrollTo(0, top);
        }
    },
    mounted () {
        $('.materialboxed').materialbox();
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
