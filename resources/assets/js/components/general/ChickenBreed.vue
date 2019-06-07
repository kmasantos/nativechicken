<template>
    <div class="row">
        <div class="col s12 l12">
            <div ref="info_card" class="card-panel">
                <div class="row valign-wrapper">
                    <div class="col s10 l10 valign">
                        <h5 style="font-family: 'Poppins', sans-serif;">{{selected}}</h5>
                        <i v-if="selected==='Boholano Native Chicken'">Purified and maintained by Ubay Stock Farm, Bohol</i>
                        <i v-if="selected==='Camarines Native Chicken'">Purified and maintained by Bicol University College of Agriculture and Forestry, Bicol</i>
                        <i v-if="selected==='Darag Native Chicken'">Purified and maintained by West Visayas State University, Iloilo</i>
                        <i v-if="selected==='Zampen Native Chicken'">Purified and maintained by Western Mindanao State University, Zamboanga</i>
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
                            <img class="materialboxed" data-caption="Boholano Native Chicken" height="400px" src="https://i.ibb.co/LRNZBP8/boholanobreeds.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">History of Boholano Native Chicken Strain</h6>
                        </div>
                        <div class="col s12 l12">
                            <p>Boholano native chicken is the brand of Manok Bisaya developed in the Bohol province.</p>
                            <p>Pre-selected stocks from different municipalities of the province were brought by the Bohol LGU and subjected for random mating to produce the foundation stock at DA-Ubay Stock Farm. Seventy two (72) foundation stocks (60 pullets and 12 roosters) were purified after the 4th generation, under free ranged condition.</p>
                            <p>Through regular selection and mating done by DA-Ubay Stock Farm  the Boholano native strain was produced.</p>
                            <p>Boholano native chickens are locally describe as “pula” for their plumage. After the 4th generation, the female plumage is described as light red to brown and male is red to “Tubaon” (highly similar to wine red).</p>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Physical Characteristics</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Boholano roosters are plain red, while hens have laced plumage. In the locality, the plumage color of Boholano native chickens is called “pula”.</li>
                                <li><i class="fas fa-chevron-right"></i> Boholano native chickens are slightly upright with red and single comb type, orange iris, yellow beak, and white skin.  Usually, roosters have red earlobes and white shanks, while hens have reddish white earlobes and yellow shanks.</li>
                                <li><i class="fas fa-chevron-right"></i> On average, Boholano roosters at 16 weeks weigh 0.82 kg. They are about 21 cm tall and 35 cm long.  It’s chest circumference measures 24.6 cm while its wingspan is 42 cm and shank length is 9.7 cm</li>
                                <li><i class="fas fa-chevron-right"></i> The hen is lighter and smaller than the rooster.  It’s weight and height are 0.75 kg and 20 cm, respectively. Its body length is 34 cm with a 24 cm chest circumference and a 41 cm wingspan.</li>
                            </ul>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Production Performance</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Average age at first lay – 22 weeks of age</li>
                                <li><i class="fas fa-chevron-right"></i> Egg production per hen per year – 62</li>
                                <li><i class="fas fa-chevron-right"></i> Average egg weight – 40.5 g</li>
                                <li><i class="fas fa-chevron-right"></i> Fertility of 63% and Hatchability of 76%</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- CAMARINES -->
                <div v-if="selected==='Camarines Native Chicken'">
                    <div class="row">
                        <div class="col s12 l12">
                            <img class="materialboxed center-image" data-caption="Camarines Native Chicken" height="400px" src="https://i.ibb.co/n8yc0Gh/camarinesbreeds.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">History of Camarines Native Chicken Strain</h6>
                        </div>
                        <div class="col s12 l12">
                            <p>Camarines was characterized by Bondoc, 1998 and Lambio, 2000. This breed is popularly known as “Balawon” by locals in the Bicol Region.</p>
                            <p>Research and Development works started in 2013 when PCAARRD and Bicol University funded the research project “Development of breeding true–to-type of Camarines Breed of Philippine Native Chicken”. The project was managed by Dr. Teresita Bucad-Pequeña of Bicol University College of Agriculture & Forestry (BUCAF) with Prof. Nestor D. Ebuenga, Jr. of Sorsogon State College (SSC) as the Animal Breeder consultant.</p>
                            <p>Available breeders were collected from the six provinces of the Bicol Region to serve as  foundation stocks. The random mating procedure produced offspring served as the sources of 12 families in 1:5 ratio of rooster and hens from generation 0 to 3. Phenotypic Characterization FAO (2012) was done. Production performance was also documented.</p>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Physical Characteristics</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> The Camarines rooster has yellow-orange hackle and plumage with barred  pattern.</li>
                                <li><i class="fas fa-chevron-right"></i> The hen, on the other hand, has a predominantly brown plumage with laced pattern and yellow hackle.</li>
                                <li><i class="fas fa-chevron-right"></i> Camarines native chickens are slightly upright and have red earlobe, white or gray shanks, orange iris, white skin, white beaks, and single red comb.</li>
                                <li><i class="fas fa-chevron-right"></i> Roosters weigh 1.1 kg and are about 26 cm tall, while hens weigh 0.9 kg and are about 22 cm tall on average.</li>
                                <li><i class="fas fa-chevron-right"></i> The rooster’s body length reaches up to 21.3 cm, with a chest circumference of 25 cm, and a wingspan of 41 cm. Their shanks also reach to 7.2 cm long.</li>
                                <li><i class="fas fa-chevron-right"></i> The hen’s body length, meanwhile, reaches up to 17.4 cm, with a chest circumference of until 23 cm and a wingspan of 41 cm on average. Their shanks is 5.6 cm on average.</li>
                            </ul>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Production Performance</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Average age at first lay – 20-22 weeks of age</li>
                                <li><i class="fas fa-chevron-right"></i> Egg production per hen per year – 100</li>
                                <li><i class="fas fa-chevron-right"></i> Average egg weight – 40 g</li>
                                <li><i class="fas fa-chevron-right"></i> Fertility of 69% and Hatchability of 70%</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- DARAG -->
                <div v-if="selected==='Darag Native Chicken'">
                    <div class="row">
                        <div class="col s12 l6">
                            <img class="materialboxed" data-caption="Darag Native Chicken" height="400px" width="100%" src="https://i.ibb.co/cYmcmFy/darag1.jpg">
                        </div>
                        <div class="col s12 l6">
                            <img class="materialboxed" data-caption="Darag Native Chicken" height="400px" width="100%" src="https://i.ibb.co/ZNNK49R/darag2.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">History of Darag Native Chicken Strain</h6>
                        </div>
                        <div class="col s12 l12">
                            <p>Before the development of this native chicken strain, several researchers have been solely conducted by the West Visayas State University (WVSU), Iloilo City that started in the collection, purification, and development of Darag in 1985.</p>
                            <p>Dr. Bernabe B. Cocjin, then faculty of the College of Agriculture who later became WVSU president, initiated the collection of the Philippine native chickens in Panay Island with the focus on the yellowish brown plumage and gray leg color. After purification process, the center for Darag was established at the WVSU College of Agriculture and Forestry in Lambunao, Iloilo in 1991. Budget, facilities, and people were some of the constraints in the center that hampered the operation and eventually decreased the chicken production. To save the chickens, Dr. Cocjin had no choice but to bring back the chicken to the main campus of Iloilo City.</p>
                            <p>From 1997 to 2004, research on the “Improvement, Utilization and Conservation Project for Philippine Chickens in Western Visayas” was conducted to come up with a group of elite flock and breeding systems that were applicable to the farmers’ level.</p>
                            <p>After a span of 33 years from 1985 up to the present of dedicated study on this single poultry commodity, the Darag native chicken of Panay with package of technology (POT) was developed. Due to these endeavors, Darag is now one of the documented native chicken strains of the Philippines, becoming a flagship commodity of the country and bringing honor to WVSU as the sole institution that developed this native resource of the region.</p>
                            <p>From August 2011 to 2014, PCAARRD funded a new project on the sustainable production and commercialization of Darag Chicken. Proof of the development and success of this program was the increasing number of native chicken technology adopters that reached a total of 223 in the region. The recently terminated project produced 11, 579 breeders and 105,095 chickens for slaughter.</p>
                            <p>Now, the Darag spreads its wings not only in Western Visayas but all over the country. Whoever catches, raises, and produces the chicken will surely have a bright future because truly, “Sa Darag May Buas Damlag (In Darag, there is bright future).”</p>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Physical Characteristics</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Darag roosters have red plumage. Hens have yellow-brown hackle and brown feathers on the body. Hens have laced plumage pattern, while Roosters have plain ones.</li>
                                <li><i class="fas fa-chevron-right"></i> Darag native chickens are slightly upright with red and single comb type,   bluish-grey shanks, and white skin.  Usually, roosters have red earlobes, brown iris and beak, while hens have red- white earlobes, orange iris and grey beak.</li>
                                <li><i class="fas fa-chevron-right"></i> On average, Darag roosters weigh 1.50 kg with a height of 24 cm and body length of about 43 cm.  It’s chest circumference measures 31 cm while its wingspan is 49.5 cm. Shank length is 11.6 cm.</li>
                                <li><i class="fas fa-chevron-right"></i> Similar to other native chickens, the hen is lighter and smaller than the rooster.  It’s weight and height are 1.2 kg and 20 cm, respectively. Its body length is 38 cm, and has a chest circumference of 28 cm, and a wingspan of 41 cm on average.  Shank length is 8.6 cm.</li>
                            </ul>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Production Performance</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Average age at first lay – 20 weeks of age</li>
                                <li><i class="fas fa-chevron-right"></i> Egg production per hen per year – 110</li>
                                <li><i class="fas fa-chevron-right"></i> Average egg weight – 41 g</li>
                                <li><i class="fas fa-chevron-right"></i> Fertility of 81% and Hatchability of 73%</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- ZAMPEN -->
                <div v-if="selected==='Zampen Native Chicken'">
                    <div class="row">
                        <div class="col s12 l5">
                            <img class="materialboxed" data-caption="Zampen Native Chicken" height="400px" width="100%" src="https://i.ibb.co/m5Wd166/zampen1.jpg">
                        </div>
                        <div class="col s12 l4">
                            <img class="materialboxed" data-caption="Zampen Native Chicken (Rooster)" height="400px" width="100%" src="https://i.ibb.co/QQ8kYdL/image.png">
                        </div>
                        <div class="col s12 l3">
                            <img class="materialboxed" data-caption="Zampen Native Chicken (Hen)" height="400px" width="100%" src="https://i.ibb.co/NpDjfyv/zampen2.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">History of Zampen Native Chicken Strain</h6>
                        </div>
                        <div class="col s12 l12">
                            <p>ZamPen Native Chicken is originally from the Joloano strain that had undergone selection and breeding to come up a homogenous population.</p>
                            <p>The populations of locally known Joloano strain of native chicken were obtained from the different municipalities and cities in Region 9 or the Zamboanga Peninsula, particularly in Zamboanga City, Zamboanga del Sur, and Zamboanga Del Norte. Selection of initial breeders were based on physical traits of sexually matured female such as black plumage color, medium sized pea comb, full breast,  large body size, and orange iris. For the aggressive matured males, traits include chestnut  to reddish- black with white tinge color in feather and tail plumage colors, red pea comb, long neck,  large well-developed breast muscle, large body size, and long legs. These initial breeding stocks were used in the purification process.</p>
                            <p>With the purification process, the breeding of Joloano strains from the different places in Zamboanga Peninsula came up with common phenotypic and morphologic features of the renowned “ZamPen Native Chicken” of which is now set as its standard characteristics.</p>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Physical Characteristics</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Zampen roosters have red and black plumage, while hens are black.  Their plumage is plain.</li>
                                <li><i class="fas fa-chevron-right"></i> Zampen native chickens have an upright body carriage and red pea comb, orange iris, and black beak.  The shanks of the roosters are either yellow or grey, while most hens have grey shanks.  Even if their feathers are black, their skin is white.  Earlobe color of Zampen native chickens is red.</li>
                                <li><i class="fas fa-chevron-right"></i> Zampen roosters weigh 1.29 kg with a height of 24 cm and body length of about 43 cm.  Their chest circumference measures 31 cm while their wingspan is 45 cm. Shank length is 10.5 cm.</li>
                                <li><i class="fas fa-chevron-right"></i> Zampen hens weigh 1.1 kg and are 24 cm tall.  Their body length is 39 cm, chest circumference is 29 cm and wingspan spreads to 41 cm.  Shank length is 9 cm.</li>
                            </ul>
                        </div>
                        <div class="col s12 l12">
                            <h6 style="font-family: 'Poppins', sans-serif; font-size:1.3em">Production Performance</h6>
                        </div>
                        <div class="col s12 l12">
                            <ul style="font-family: 'Raleway', sans-serif; font-size: 1.2em; display:inline-block; margin-left:3em; font-weight:normal font-style:">
                                <li><i class="fas fa-chevron-right"></i> Average age at first lay – 22 weeks of age</li>
                                <li><i class="fas fa-chevron-right"></i> Egg production per hen per year – 105</li>
                                <li><i class="fas fa-chevron-right"></i> Average egg weight – 42 g</li>
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
