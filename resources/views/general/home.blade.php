@extends('layouts.home_layout')

@section('content')
<div class="row" id="home-content">
        <div id="Home" class="col s12 m12 l12 scrollspy">
           <div class="row">
               <div class="col s12 l12">
                   <h3 class="center-align" style="font-family: 'Poppins', sans-serif;">Philippine Native Chickens and Itik PINAS</h3>
               </div>
            </div>
            <div class="row">
                <div class="col s12 l12">
                    <h5 style="font-family: 'Poppins', sans-serif;">What you need to know about the data available in the Philippine Native Chicken and Itik PINAS Information System</h5>
                </div>
                <div class="col s12 l12">
                    
                    <p style="font-family: 'Raleway', sans-serif;">
                        The project entitled ‘Development of Philippine Native Chicken and Itik PINAS Breed Information System’ is a DOST-PCAARRD funded effort which aims to provide accessible information source regarding selected Philippine Native Chicken and Itik PINAS Breeds.
                    </p>
                    <p style="font-family: 'Raleway', sans-serif;">
                        The project aims to highlight characteristics and performance of Philippine native chickens and duck improved and kept by partner institutions such as Department of Agriculture-Ubay Stock Farm (Boholano), Bicol University College of Agriculture and Forestry (Camarines), West Visayas State University (Darag), Western Mindanao State University (ZamPen) and the Bureau of Animal Industry-National Swine and Poultry Research and Development Center (Itik PINAS) through a web-based information system.
                    </p>
                </div>
            </div>
            <div class="row">
                <div id="Data" class="col s12 l12 scrollspy">
                    <h5 style="font-family: 'Poppins', sans-serif;"><i class="em em-bar_chart"></i> Data</h5>
                </div>
                <div class="col s12 l12">
                    <p>Data collected include the following:</p>
                </div>
                <div class="col s12 l12">
                    <div class="row">
                        <div class="col s12 l4">
                            <div class="row">
                                <div class="col s12 l12">
                                    <div class="card-panel custom-panel">
                                        <div class="row">
                                            <div class="col s12 l12">
                                                <h5 class="center-align" style="font-family: 'Poppins', sans-serif;">Qualitative Data</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 l12 offset-s1 offset-l1">
                                                <ul style="font-family: 'Raleway', sans-serif;">
                                                    <li><i class="fas fa-chevron-right"></i> Plumage Color</li>
                                                    <li><i class="fas fa-chevron-right"></i> Plumage Pattern</li>
                                                    <li><i class="fas fa-chevron-right"></i> Hackle Color</li>
                                                    <li><i class="fas fa-chevron-right"></i> Earlobe Color</li>
                                                    <li><i class="fas fa-chevron-right"></i> Shank Color</li>
                                                    <li><i class="fas fa-chevron-right"></i> Iris Color</li>
                                                    <li><i class="fas fa-chevron-right"></i> Skin Color</li>
                                                    <li><i class="fas fa-chevron-right"></i> Beak Color</li>
                                                    <li><i class="fas fa-chevron-right"></i> Body Carriage</li>
                                                    <li><i class="fas fa-chevron-right"></i> Type of Comb</li>
                                                </ul>
                                            </div>
                                            <div class="col s12 l12 offset-s1 offset-l1" style="font-family: 'Raleway', sans-serif;">
                                                For Ducks
                                                <ul>
                                                    <li><i class="fas fa-chevron-right"></i> Bill Color</li>
                                                    <li><i class="fas fa-chevron-right"></i> Bean Pattern</li>
                                                    <li><i class="fas fa-chevron-right"></i> Neck Markings</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 l4">
                            <div class="row">
                                <div class="col s12 l12">
                                    <div class="card-panel custom-panel">
                                        <div class="row">
                                            <div class="col s12 l12">
                                                <h5 class="center-align" style="font-family: 'Poppins', sans-serif;">Quantitative Data</h5>
                                                <h6 class="center-align" style="font-family: 'Poppins', sans-serif;">(Morphometric Characteristics)</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 l12 offset-s1 offset-l1">
                                                <ul style="font-family: 'Raleway', sans-serif;">
                                                    <li><i class="fas fa-chevron-right"></i> Body Weight</li>
                                                    <li><i class="fas fa-chevron-right"></i> Height</li>
                                                    <li><i class="fas fa-chevron-right"></i> Body Length</li>
                                                    <li><i class="fas fa-chevron-right"></i> Chest Circumference</li>
                                                    <li><i class="fas fa-chevron-right"></i> Wing Span</li>
                                                    <li><i class="fas fa-chevron-right"></i> Shank Length</li>
                                                </ul>
                                            </div>
                                            <div class="col s12 l12 offset-s1 offset-l1" style="font-family: 'Raleway', sans-serif;">
                                                For Ducks
                                                <ul>
                                                    <li><i class="fas fa-chevron-right"></i> Neck Length</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 l4">
                            <div class="row">
                                <div class="col s12 l12">
                                    <div class="card-panel custom-panel">
                                        <div class="row">
                                            <div class="col s12 l12">
                                                <h5 class="center-align" style="font-family: 'Poppins', sans-serif;">Quantitative Data</h5>
                                                <h6 class="center-align" style="font-family: 'Poppins', sans-serif;">(Production Performance)</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 l12 offset-s1 offset-l1">
                                                <ul style="font-family: 'Raleway', sans-serif;">
                                                    <li><i class="fas fa-chevron-right"></i> Egg Production</li>
                                                    <li><i class="fas fa-chevron-right"></i> Fertility and Hatchability</li>
                                                    <li><i class="fas fa-chevron-right"></i> Egg Quality</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="Summary" class="col s12 l12 scrollspy">
                    <h5 style="font-family: 'Poppins', sans-serif;"><i class="em em-spiral_note_pad"></i> Summary Profile of the Philippine Native Chicken and Itik PINAS</h5>
                </div>
                <div class="col s12 l12">
                    <p>Philippine Native Chickens are usually named after their locality. Boholano, Camarines and ZamPen are from the provinces of Bohol, Bicol and Zamboanga Peninsula, respectively, while Darag is the native chicken of Panay Island, Western Visayas.</p>
                    <p>On the other hand, Itik PINAS is a product of selection and maintained at the Bureau of Animal Industry - National Swine and Poultry Research and Development Center, Tiaong, Quezon. These Philippine native chickens and ducks have identifiable characteristics that make each genetic group unique.</p>
                    <p>In this information system, Boholano, Camarines, Darag, and ZamPen and Itik PINAS (IP) Itim and IP Khaki are described. Their physical characteristics, both qualitative and quantitative features, as well as their production performance are discussed below.</p>
                </div>
                <div id="PHNativeChickens" class="col s12 l12 scrollspy">
                    <h5 style="font-family: 'Poppins', sans-serif;"><i class="em em-chicken"></i> Philippine Native Chickens</h5>
                </div>
                <div class="col s12 l12">
                    <h6 style="font-size:1.3em;">Physical Characteristics</h6>
                </div>
                <div class="col s12 l12">
                    <p><strong style="font-weight:bold; font-family: 'Poppins', sans-serif;">Philippine Native Chickens – Rooster.</strong> Unique to Camarines is its yellow-orange plumage with barred pattern. Darag and Boholano roosters have predominantly red plumage, though if in terms of shank color, Darag roosters have gray while most Boholano roosters have white shanks. ZamPen has red hackle, but the feathers in the body are predominantly black. All roosters, except ZamPen which has pea comb, have single comb type. In addition, ZamPen’s distinguishable feature is its body carriage – it stands upright like a royal!</p>
                    <p><strong style="font-weight:bold; font-family: 'Poppins', sans-serif;">Philippine Native Chickens – Hens.</strong> Camarines and Darag both have brown feathers. In the locality, the color of Boholono native chickens are called “pula”. ZamPen hens are the easiest to identify, because it stands upright showing off its black plumage. Boholano, and most Darag and Camarines hens have laced plumage pattern.</p>
                </div>
                <div class="col s12 l12">
                    <h6 style="font-size:1.3em;">Production Performance</h6>
                </div>
                <div class="col s12 l12">
                    <p><strong style="font-weight:bold;">Egg production.</strong> Native chickens start to lay eggs at 20 - 22 weeks of age. In terms of egg production of each hen per year, Camarines produce 62 eggs, ZamPen produce 105 eggs and Darag produces the highest number of eggs at 110. Boholano breeds, on average, produce 62 eggs per hen per year.</p>
                    <p>The average egg weight of ZamPen tends to be the heaviest at 43.6 g each, followed by eggs of Darag at 41.36 g. The egg from Camarines and Boholano are both usually at 40 g.</p>
                    <p><strong style="font-weight:bold;">Fertility and Hatchability.</strong> In terms of fertility, the Darag and ZamPen hens have the highest rate at 81-83% on average. This was followed by the Camarines breed at 69% and the Boholano at 63%. Hatchability of eggs from native chickens range from 70-77%.</p>
                    <p><strong style="font-weight:bold;">Egg quality.</strong> All eggs are cream-colored and ovoid-shaped. Other egg quality traits such as length, width, shape index, albumen height and weight, yolk color and weight, shell weight and thickness, and haugh unit were also included in the database.</p>
                </div>
            </div>
            <div class="row">
                <div id="ChickenBreeds" class="col s12 l12 scrollspy">
                    <h5 style="font-family: 'Poppins', sans-serif;"><i class="em em-hatched_chick"></i> Philippine Native Chicken Breeds</h5>
                </div>
            </div>
            <chicken-breeds></chicken-breeds>
            <div class="row">
                <div id="PHNativeDucks" class="col s12 l12 scrollspy">
                    <h5 style="font-family: 'Poppins', sans-serif;"><i class="em em-duck"></i> Philippine Native Ducks (Itik PINAS)</h5>
                </div>
                <div class="col s12 l12">
                    <h6 style="font-size:1.3em;">History of Itik PINAS</h6>
                </div>
                <div class="col s12 l12">
                    <p>In 2008, the Bureau of Animal Industry through the National Swine and Poultry Research and Development Center (BAI-NSPRDC) in collaboration with Livestock Development Council (LDC), Institute of Animal Science (IAS) - University of the Philippines Los Banos and Duck Industry Association of the Philippines Incorporated (DIAPI), initiated the selection and breeding of the egg type Philippine Mallard duck. A total of 2,000 hatching eggs of Philippine Mallard duck (<i>Anas platyrhynchos domesticus L.</i>) were obtained from three duck farms in provinces of Batangas, Pampanga, and Quezon and set for incubation to produce the foundation stocks.</p>
                    <p>In 2012, the “Development of Sustainable Breeder Philippine Mallard Duck (PMD) Itik Production System Project” was proposed with the purpose of genetic improvement and development of the signature Philippine duck breed. The project was funded by the Philippine Council on Agriculture, Aquatic and Natural Resources Research and Development (PCAARRD) and implemented by BAI-NSPRDC at Tiaong, Quezon.</p>
                    <p>The Itik PINAS is a breeding true-to-type Philippine Mallard ducks selected for high egg production, predictable performance, and consistent product quality. The selection criteria includes the replacement stock coming from the top 50% egg producing family at 40 weeks of age, with egg weight between 65-70 grams. At 18 weeks of age,  body weight is approximately 1.0 - 1.3 kg and plumage color and pattern should either be black or khaki.</p>
                    <p>The Itik PINAS (IP) Itim and IP Khaki lines were developed due to the high preference of stakeholders on the plumage black and brown color. Currently, both male and female black with white ‘bib’ in their neck and IP Khaki have brown plumage color with uniform body weight at 18 weeks of age, producing the egg size suited for processing of balut and with increased egg production.</p>
                    <p>The project adopted the pyramidal structure of breeding program to distribute the Itik PINAS to the stakeholders. In this structure, there are relatively small number of nucleus breeders which produce purebred stocks of IP Itim and IP Khaki for a larger number of multiplier farms who in turn produce these animals for commercial or small scale duck raisers.</p>
                </div>
                <div class="col s12 l12">
                    <h6 style="font-size:1.3em;">Physical Characteristics</h6>
                </div>
                <div class="col s12 l12">
                    <p>The two Itik PINAS (IP) lines have distinct plumage, neck, bill, skin color and shanks from each other. IP Itim has black plumage color with white bib, and black bean color. On the other hand, the IP Khaki has brown plumage, plain neck and and black bean color. IP Khaki drakes have green bills, while ducks have black bills. Both IP lines have brown eye color, dark orange or dark brown shanks, and are slightly upright.</p>
                    <p>IP Itim tend to be slightly heavier and longer with wider wingspan than IP Khaki. On the other hand, IP Khaki has wider chest circumference and longer shanks than IP Itim. Neck length are comparable between IP Itim and IP Khaki.</p>
                </div>
                <div class="col s12 l12">
                    <h6 style="font-size:1.3em;">Production Performance</h6>
                </div>
                <div class="col s12 l12">
                    <p>Egg production per duck per year is 257 eggs, with average egg weight of approximately 65 grams. IP ducks start to lay eggs at about 22-23 weeks of age.  Both IP Itim and IP Khaki have white ovoid eggs.</p>
                </div>
            </div>
            <div class="row">
                <div id="DuckBreeds" class="col s12 l12 scrollspy">
                    <h5 style="font-family: 'Poppins', sans-serif;"><i class="em em-hatching_chick"></i> Philippine Native Duck (Itik PINAS) Breeds</h5>
                </div>
            </div>
            <duck-breeds></duck-breeds>
            <div class="row">
                    <div id="breeders"  class="col s12 l12 scrollspy">
                        <h5 style="font-family: 'Poppins', sans-serif;"><i class="em em-bookmark_tabs"></i> Breeder Directory</h5>
                    </div>
                    <div class="row">
                        <div class="col s12 l6">
                            <h5 style="font-family: 'Poppins', sans-serif;">Directory of Boholano Breeder Farms</h5>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Department of Agriculture VII – Ubay Stock Farm
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Lomangog, Ubay, Bohol
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Dr. Raul D. Migriño | Elizabeth M. Macalandag | Antonio B. Tangayan Jr. 
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09283164577 | 09327931329 | 09952294871
                            </div>
                            <div>
                                <i class="fas fa-at"></i> dausf1921@gmail.com | antoniotangayanjr@gmail.com | joarenkhee@gmail.com
                            </div>
                        </div>
                        <div class="col s12 l6">
                            <h5 style="font-family: 'Poppins', sans-serif;">Directory of Camarines Breeder Farms</h5>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Bicol University College of Agriculture and Forestry
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Guinobatan, Albay
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Dr. Teresita B. Pequena
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09267425926 | (052) 484-6336
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Randy Buen
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Abuyog East Dist. Sorsogon City, Sorsogon
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Precioso Lumabi
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Del Rosario Bacon Dist. Sorsogon City, Sorsogon
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Danilo Fraginal
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> San Isidro Bacon Dist. Sorsogon City, Sorsogon
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Noe Ocbian
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Monte Carmelo, Castilla, Sorsogon
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Salvador Espena
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> San Fernando, Pto. Diaz, Sorsogon
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Nena Espallardo
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> San Ignacio, Gubat, Sorsogon
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col s12 l6">
                            <h5 style="font-family: 'Poppins', sans-serif;">Directory of Darag Breeder Farms</h5>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> West Visayas State University Darag Center
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Luna Street, La Paz, Iloilo City
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Dr. Ma. Lulu L. Loyola, Vice President for Research, Extension and Training
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> (033) 3200871 to 78 local 1126 or 1127 | 09202156804
                            </div>
                            <div>
                                <i class="fas fa-at"></i> vpret@wvsu.edu.ph
                            </div>
                        </div>
                        <div class="col s12 l6">
                            <h5 style="font-family: 'Poppins', sans-serif;">Directory of ZamPen Breeder Farms</h5>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> WMSU-CA Native Chicken Project
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> San Ramon, Zamboanga City
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Jocelyn P. Pedroso, WMSU-CA Dean | Ma. Jocelyn E. Cuadra, Project Staff Contact
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 062-992-4280 | (062) 312-1830 | 09177166495
                            </div>
                            <div>
                                <i class="fas fa-at"></i> mjmec27@gmail.com | mjmec28@yahoo.com
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> BUCOR-SRPPF Native Chicken Project
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> San Ramon, Zamboanga City
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> CSupt. Roberto Veneracion, OIC-BUCOR SRPPF | Wilfredo B. Castillo, Project In-charge
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09174480840
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> JHCSC-Dumingag Native Chicken Project 
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Dapiwak, Dumingag, Zamboanga del Sur
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Dr. Moises Glenn Tangalin
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09988856100
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Jambaro's Farm
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Naga, Zamboanga Sibugay
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Nelia Jambaro
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09177223535
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> GARBEMCO
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Kabasalan, Zamboanga Sibugay
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Lilia Manuel
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09177188854
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Apolinario's Farm
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Cabaluay, Zamboanga City
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Ricardo J. Apolinario, Jr. | Bon Padayhag
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09177085181 | 09265440175
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Dimailig's Farm 
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Lumayang, Zamboanga City
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Virgilio Dimailig
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09171048283
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 l12">
                            <h5 style="font-family: 'Poppins', sans-serif;">Directory of Itik Pinas Breeder Farms</h5>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Bureau of Animal Industry - National Swine And Poultry Research And Development Center
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Tiaong, Quezon
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Rene C. Santiago, DVM, MSc
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09172465530 | (042) 585-7727
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Alcasid Duck Farm
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Cuyab Hot Spring Resort, Brgy. Bucal, Calamba, Laguna
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Mr. Anthony Alcasid
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09178008093
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> RCR Egg Dealer and Balut Industry
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Carmen Saragoza, Nueva Ecija
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Mr. Rene Ramos
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09973349484
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> Green Rose Duck Farm
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Candelaria, Quezon
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Mr. Ramon Marquez
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09209670164 | 09228105157
                            </div>
                            <br>
                            <div style="font-weight: bold">
                                <i class="fas fa-certificate"></i> ASDF
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt"></i> Compostella Valley
                            </div>
                            <div>
                                <i class="fas fa-address-book"></i> Mr. Isidro Albano
                            </div>
                            <div>
                                <i class="fas fa-phone-square"></i> 09176332436
                            </div>
                        </div>
                    </div>
                    
                </div>
            <div class="row">
                <div class="col s12 m12 l12 center-align">
                    <p style="font-family: 'Raleway', sans-serif;text-align: center;">
                        Records included in the information system were therefore collected  by our partner institutions.
                    </p>
                </div>
                <div class="col s4 m4 l2 offset-l1">
                    <div class="row">
                        <div class="col s12 l12 center">
                            <img src="https://i.ibb.co/JdcCRgn/Bicol-University.png" alt="Bicol University" height="120px" border="0">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col s12 l12 center-align" style="font-family: 'Raleway', sans-serif;">
                            Bicol University
                        </div>
                    </div>
                </div>
                <div class="col s4 m4 l2">
                    <div class="row">
                        <div class="col s12 l12 center">
                            <img src="https://i.ibb.co/X81mcgm/622184-444782952232311-838614055-o-removebg.png" alt="BAI-NSPRDC" height="120px" border="0">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col s12 l12 center-align" style="font-family: 'Raleway', sans-serif;">
                            Bureau of Animal Industry - National Swine and Poultry Research and Development Center (BAI-NSPRDC)
                        </div>
                    </div>
                </div>
                <div class="col s4 m4 l2">
                    <div class="row">
                        <div class="col s12 l12 center">
                            <img src="https://i.ibb.co/M8G658Z/ubay-removebg.png" alt="DA-Ubay Stock Farm" height="120px" border="0">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col s12 l12 center-align" style="font-family: 'Raleway', sans-serif;">
                            DA-Ubay Stock Farm
                        </div>
                    </div>
                </div>
                <div class="col s6 m6 l2">
                    <div class="row">
                        <div class="col s12 l12 center">
                            <img src="https://i.ibb.co/ZT18VQ1/Western-Mindanao-State-University.png" alt="Western Mindanao State University" height="120px" border="0">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col s12 l12 center-align" style="font-family: 'Raleway', sans-serif;">
                            Western Mindanao State University
                        </div>
                    </div>
                </div>
                <div class="col s6 m6 l2">
                    <div class="row">
                        <div class="col s12 l12 center">
                            <img src="https://i.ibb.co/BBqthF2/West-Visayas-State-University.png" alt="West Visayas State University" height="120px" border="0">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col s12 l12 center-align" style="font-family: 'Raleway', sans-serif;">
                            West Visayas State University
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customscripts')
@endsection