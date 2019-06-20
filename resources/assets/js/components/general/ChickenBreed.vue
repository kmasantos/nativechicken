<template>
    <div class="row">
        <div class="col s12 l12">
            <div ref="info_card" class="card-panel">
                <div class="row valign-wrapper">
                    <div class="col s10 l10 valign">
                        <h5 style="font-family: 'Poppins', sans-serif;">{{selected}}</h5>
                        <i v-if="selected==='Boholano Native Chicken'">Developed and maintained by Department of Agriculture - Ubay Stock Farm<br>Ubay, Bohol</i>
                        <i v-if="selected==='Camarines Native Chicken'">Developed and maintained by Bicol University College of Agriculture and Forestry<br>Guinobatan, Albay</i>
                        <i v-if="selected==='Darag Native Chicken'">Developed and maintained by West Visayas State University<br>La Paz, Iloilo</i>
                        <i v-if="selected==='ZamPen Native Chicken'">Developed and maintained by Western Mindanao State University<br>San Ramon, Zamboanga City</i>
                    </div>
                    <div class="col s2 l2 valign">
                        <a @click="close" class="waves-effect waves-gray btn-flat tooltip" data-tippy-content="Close"><i class="far fa-times-circle"></i></a>
                    </div>
                </div>
                <!-- BOHOLANO -->
                <div v-if="selected==='Boholano Native Chicken'">
                    <div class="row">
                        <div class="col s12 l6">
                            <img class="materialboxed" data-caption="Boholano Native Chicken" height="400px" width="100%" src="https://i.ibb.co/MVtD4Cv/boholano.png">
                        </div>
                        <div class="col s12 l6">
                            <img class="materialboxed" data-caption="Boholano Native Chicken" height="400px" width="100%" src="https://i.ibb.co/LRNZBP8/boholanobreeds.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">History of Boholano Native Chicken Strain</h6>
                        </div>
                        <div class="col s12 l12">
                            <p>Boholano native chicken is the brand of <i>“Manok Bisaya”</i> developed in Bohol province by DA-Ubay Stock Farm, in coordination with Provincial Local Government Units and DOST-PCAARRD.</p>
                            <p>Pre-selected stocks from different municipalities of the province were subjected to random mating at DA-Ubay Stock Farm to produce the foundation stocks. Seventy-two (72) foundation stocks (60 pullets and 12 roosters) were purified based on appearance (i.e., plumage color and type of comb) after the 4th generation.  The plumage color of this breed is locally described as “pula”.  Through continuous breeding and selection at DA-Ubay Stock Farm the Boholano native strain was developed primarily for meat production.  Boholano native chickens are raised under semi-confinement.</p>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Physical Characteristics</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Boholano roosters are plain red to wine red (“tubaon”), while hens have light red to brown (“pula”) laced plumage.</li>
                                <li><i class="fas fa-chevron-right"></i> Both males and females have red single comb, orange iris, yellow beak, white skin and slightly upright stance. Most roosters have red earlobes and white shanks, while hens have reddish white earlobes and yellow shanks.</li>
                                <li><i class="fas fa-chevron-right"></i> At 16 weeks of age, Boholano roosters weigh 0.82 kg. They are about 21 cm tall and 35 cm long. It’s chest circumference measures 24.6 cm while its wingspan is 42 cm and shank length is 9.7 cm</li>
                                <li><i class="fas fa-chevron-right"></i> At the same age, Boholano hens weigh 0.75 kg and its height is 20 cm. Its body length is 34 cm, while its chest circumference is 24 cm.  The hen’s wingspan is 41 cm and its shank length is 9.5 cm.</li>
                            </ul>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Average Production Performance</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Age at first lay – 22 weeks of age</li>
                                <li><i class="fas fa-chevron-right"></i> Egg production per hen per year – 62</li>
                                <li><i class="fas fa-chevron-right"></i> Egg weight – 40.5 g</li>
                                <li><i class="fas fa-chevron-right"></i> Fertility of 63% and Hatchability of 76%</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- CAMARINES -->
                <div v-if="selected==='Camarines Native Chicken'">
                    <div class="row">
                        <div class="col s12 m12 l6">
                            <img class="materialboxed" data-caption="Camarines Native Chicken © T. Pequeña" height="400px" width="100%" src="https://i.ibb.co/n8yc0Gh/camarinesbreeds.jpg">
                        </div>
                        <div class="col s12 m12 l6">
                            <img class="materialboxed   " data-caption="Camarines Native Chicken © T. Pequeña" height="400px" width="100%" src="https://i.ibb.co/JrjN1Gs/IMG-0600-1.png">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">History of Camarines Native Chicken</h6>
                        </div>
                        <div class="col s12 l12">
                            <p>Camarines was developed from the local <i>“Balawon”</i> native chickens in the Bicol Region.</p>
                            <p>Research and Development works started in 2013 when PCAARRD and Bicol University funded the research project “Development of breeding true–to-type of Camarines Breed of Philippine Native Chicken”.</p>
                            <p>Available breeders were collected from the six provinces of the Bicol Region to serve as foundation stocks. After one generation of random mating, twelve families consisting of one male and five females per family were established from Generations 1-3.  The native chickens are raised under semi-confinement.  Currently, Camarines native chicken is being utilized as a dual-purpose breed.</p>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Physical Characteristics</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> The Camarines rooster has yellow-orange hackle and plumage with barred pattern.</li>
                                <li><i class="fas fa-chevron-right"></i> The hen, on the other hand, has a predominantly brown plumage with laced pattern and yellow hackle.</li>
                                <li><i class="fas fa-chevron-right"></i> Camarines native chickens have single red comb, red earlobe, orange iris, white beak and skin, and white or gray shanks.</li>
                                <li><i class="fas fa-chevron-right"></i> At 16 weeks of age, roosters weigh 1.1 kg and are about 26 cm tall, while hens weigh 0.9 kg and are about 22 cm tall on average.</li>
                                <li><i class="fas fa-chevron-right"></i> The rooster has a body length of 21.3 cm, chest circumference of 25 cm, and wingspan of 41 cm. Their shanks reach 7.1 cm long.</li>
                                <li><i class="fas fa-chevron-right"></i> The hen has a body length of 17.4 cm, chest circumference of 23 cm and a wingspan of 41 cm on average. Their shank length is 5.6 cm on average.</li>
                            </ul>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Average Production Performance</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Age at first lay – 20-22 weeks of age</li>
                                <li><i class="fas fa-chevron-right"></i> Egg production per hen per year – 62</li>
                                <li><i class="fas fa-chevron-right"></i> Egg weight – 40 g</li>
                                <li><i class="fas fa-chevron-right"></i> Fertility of 69% and Hatchability of 70%</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- DARAG -->
                <div v-if="selected==='Darag Native Chicken'">
                    <div class="row">
                        <div class="col s12 l6">
                            <img class="materialboxed" data-caption="Darag Native Chicken © C. Casiple" height="400px" width="100%" src="https://i.ibb.co/ngRjVxc/IMG-5880-1.png">
                        </div>
                        <div class="col s12 l6">
                            <img class="materialboxed" data-caption="Darag Native Chicken" height="400px" width="100%" src="https://i.ibb.co/cYmcmFy/darag1.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">History of Darag Native Chicken</h6>
                        </div>
                        <div class="col s12 l12">
                            <p>West Visayas State University (WVSU), Iloilo City started the collection, purification, and development of Darag in 1985 using its Institutional resources.</p>
                            <p>Dr. Bernabe B. Cocjin, then faculty of the College of Agriculture who later became WVSU President, initiated the collection of the Philippine native chickens in Panay Island with the focus on the yellowish brown plumage and gray shank color. After purification process, the Center for Darag was established at the WVSU College of Agriculture and Forestry in Lambunao, Iloilo in 1991. Budget, facilities, and people were some of the constraints in the center that hampered the operation and eventually decreased the chicken population. To save the program, Dr. Cocjin had no choice but to bring back the production to the main campus of Iloilo City.</p>
                            <p>From 1997 to 2004, DOST-PCAARRD funded research on the “Improvement, Utilization and Conservation Project for Philippine Chickens in Western Visayas” in collaboration with UP Los Banos, was conducted to produce the elite flock and implement breeding systems that can be used by farmers. In 2006, the progeny of this flock were introduced to the farmers’ field under different farming systems for acclimatization.</p>
                            <p>In 2011, DOST-PCAARRD funded a new project on the sustainable production and commercialization of Darag Chicken. Proof of the development and success of this program was the increasing number of native chicken technology adopters and industry partners that reached a total of 223 in the region. The recently terminated project produced 11, 579 breeders and 105,095 chickens for slaughter.</p>
                            <p>Together with the WVSU Darag team spearheaded by Dr. Ma. Lulu L. Loyola, and the organized group of breeders (Panay Darag Breeders Association, Adventist Development Relief Agency, Cameleon Association Inc., etc.) jointly ensure the sustainable production and stable supply of Darag in the region.</p>
                            <p>Darag native chicken is currently utilized for meat.  These breeders, in a ratio of 1 male to 5 females, are raised under semi-confinement.  Selection of replacement stocks is based on weight at 120 days (i.e., cockerel is 1.0 - 1.2 kg, pullet is 800 g).</p>
                            <p>Darag is now one of the documented native chickens of the Philippines, becoming a flagship commodity of the country and bringing honor to WVSU as the sole institution that developed this native resource of the region.  It spreads its wings not only in Western Visayas but all over the country. Whoever catches, raises, and produces the chicken will surely have a bright future because truly, “Sa Darag May Buas Damlag (In Darag, there is a bright future).”</p>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Physical Characteristics</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Darag roosters have plain red plumage. Hens have yellow-brown hackle and brown laced feathers on the body.</li>
                                <li><i class="fas fa-chevron-right"></i> Darag native chickens have red single comb, white skin, and gray shanks.They are slightly upright.  Most roosters have red ear lobes, brown iris and beak, while hens have red-white earlobes, orange iris and gray beak.</li>
                                <li><i class="fas fa-chevron-right"></i> At 18 weeks of age, Darag roosters weigh 1.50 kg with a height of 24 cm and body length of about 43 cm. It’s chest circumference measures 31 cm while its wingspan is 49.5 cm. Shank length is 11.6 cm.</li>
                                <li><i class="fas fa-chevron-right"></i> At the same age, Darag hens is lighter and smaller than the rooster. It’s weight and height are 1.2 kg and 20 cm, respectively. Its body length is 38 cm,  chest circumference is 28 cm, and a wingspan of 41 cm on average. Shank length is 8.6 cm.</li>
                            </ul>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Average Production Performance</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Age at first lay – 20 weeks of age</li>
                                <li><i class="fas fa-chevron-right"></i> Egg production per hen per year – 110</li>
                                <li><i class="fas fa-chevron-right"></i> Egg weight – 41 g</li>
                                <li><i class="fas fa-chevron-right"></i> Fertility of 81% and Hatchability of 73%</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- ZAMPEN -->
                <div v-if="selected==='ZamPen Native Chicken'">
                    <div class="row">
                        <div class="col s12 l5">
                            <img class="materialboxed" data-caption="Zampen Native Chicken © M.J. Cuadra" height="400px" width="100%" src="https://i.ibb.co/T4pktXS/zampen1.png">
                        </div>
                        <div class="col s12 l4">
                            <img class="materialboxed" data-caption="ZamPen Native Chicken (Rooster) © M.J. Cuadra" height="400px" width="100%" src="https://i.ibb.co/QQ8kYdL/image.png">
                        </div>
                        <div class="col s12 l3">
                            <img class="materialboxed" data-caption="ZamPen Native Chicken (Hen) © M.J. Cuadra" height="400px" width="100%" src="https://i.ibb.co/NpDjfyv/zampen2.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">History of ZamPen Native Chicken</h6>
                        </div>
                        <div class="col s12 l12">
                            <p>The ZamPen native chicken was developed from Joloano strain that had undergone a process of breeding and selection to come up a homogenous population.</p>
                            <p>Western Mindanao State University (WMSU) initiated a research project on the purification of the strain last 2013 which was funded by DOST-PCAARRD. The populations were collected from the different parts of Region 9 (Zamboanga Peninsula), particularly in Zamboanga City, Zamboanga del Sur and Zamboanga Del Norte.</p>
                            <p>Selection of initial breeders were based on physical traits of sexually matured female such as black plumage color, medium sized pea comb, orange iris, full breast and large body size. For the sexually matured males, traits include plumage color of chestnut  to red and black with white tinge in body and tail <i>(“Buyugon”)</i>, red pea comb, long neck,  large well-developed breast muscle, large body size, and long legs. These initial breeding stocks were used in the purification process and raised under semi-confinement system at 1:5 male to female ratio. With this process, the 3rd generation came up with common features and is now branded as “ZamPen Native Chicken”. The breed is being maintained by WMSU and some identified breeders/multiplier farms in the region.</p>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Physical Characteristics</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Most ZamPen roosters have plain black plumage with red saddle and back, while hens have plain black plumage.</li>
                                <li><i class="fas fa-chevron-right"></i> ZamPen native chickens have red pea comb, red earlobe, orange iris, black beak, white skin and stands upright. Shanks of roosters are either yellow or gray, while most hens have gray shanks.</li>
                                <li><i class="fas fa-chevron-right"></i> At 16 weeks of age, ZamPen roosters weigh 1.29 kg with a height of 24 cm and body length of about 43 cm. Their chest circumference measures 31 cm while their wingspan is 45 cm. Shank length is 11 cm.</li>
                                <li><i class="fas fa-chevron-right"></i> ZamPen hens weigh 1.1 kg and are 24 cm tall. Their body length is 39 cm, chest circumference is 29 cm and wingspan spreads to 41 cm. Shank length is 9 cm.</li>
                            </ul>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Average Production Performance</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Age at first lay – 22 weeks of age</li>
                                <li><i class="fas fa-chevron-right"></i> Egg production per hen per year – 105</li>
                                <li><i class="fas fa-chevron-right"></i> Egg weight – 42 g</li>
                                <li><i class="fas fa-chevron-right"></i> Fertility of 83% and Hatchability of 77.5%</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 l12 center">
                        <a @click="scrollTo('info_card')" class="waves-effect waves-gray btn-flat tooltip" data-tippy-content="Back to top"><i class="fas fa-chevron-up top"></i></a>
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
        'selected'
    ],
    methods : {
        close : function () {
            this.$emit('close', null)
        },
        scrollTo : function (ref){
            var element = this.$refs[ref];
            var top = element.offsetTop-110;
            window.scrollTo(0, top);
        }
    },
    mounted () {
        $('.materialboxed').materialbox();
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
    .center-image {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }
</style>
