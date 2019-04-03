<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h4>Weekly Farm Summary</h4>
                    <p>Last Updated : <i>{{getDateTime()}}</i></p>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h5 class="center-align custom-card-title">BREEDERS</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="row">
                                    <div class="col s12 m6 l6 right-column-divider">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <strong>INVENTORY</strong>
                                            </div>
                                        </div>
                                        <div v-if="breeder_inventory_loading" class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <div class="preloader-wrapper small active">
                                                    <div class="spinner-layer spinner-gray-only">
                                                        <div class="circle-clipper left">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="gap-patch">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="circle-clipper right">
                                                            <div class="circle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="row">
                                            <div class="col s6 m6 l6 center-align right-column-divider">
                                                <p><i class="fas fa-mars"></i> Male</p>
                                                <p class="emphasis-med">{{breeder_male}}</p>
                                            </div>
                                            <div class="col s6 m6 l6 center-align">
                                                <p><i class="fas fa-venus"></i> Female</p>
                                                <p class="emphasis-med">{{breeder_female}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <strong>MORTALITY & SALES</strong>
                                            </div>
                                        </div>
                                        <div v-if="breeder_mortality_loading" class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <div class="preloader-wrapper small active">
                                                    <div class="spinner-layer spinner-gray-only">
                                                        <div class="circle-clipper left">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="gap-patch">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="circle-clipper right">
                                                            <div class="circle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="row">
                                            <div class="col s4 m4 l4 right-column-divider center-align">
                                                <p><i class="fas fa-skull-crossbones"></i> Mortality</p>
                                                <p class="emphasis-med"><i class="fas fa-mars"></i> : {{breeder_mort_male}} <i class="fas fa-venus"></i> : {{breeder_mort_female}}</p>
                                            </div>
                                            <div class="col s4 m4 l4 right-column-divider center-align">
                                                <p><i class="fas fa-dollar-sign"></i> Sales</p>
                                                <p class="emphasis-med"><i class="fas fa-mars"></i> : {{breeder_sale_male}} <i class="fas fa-venus"></i> : {{breeder_sale_female}}</p>
                                            </div>
                                            <div class="col s4 m4 l4 center-align">
                                                <p><i class="fas fa-egg"></i> Egg Sales</p>
                                                <p class="emphasis-med">{{breeder_egg_sale}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="s12 m12 l12">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <strong>FEED CONSUMPTION</strong> 
                                            </div>
                                        </div>
                                        <div v-if="breeder_feeding_loading" class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <div class="preloader-wrapper small active">
                                                    <div class="spinner-layer spinner-gray-only">
                                                        <div class="circle-clipper left">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="gap-patch">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="circle-clipper right">
                                                            <div class="circle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <p>Consumption</p> 
                                                <p class="emphasis-big">
                                                    {{breeder_feed_consumption}} kg
                                                </p>
                                            </div>
                                            <div class="col s6 m6 l6 center-align">
                                                <i>Total Feed Offered: <strong class="emphasis-small">{{breeder_feed_offered}} kg</strong></i>
                                            </div>
                                            <div class="col s6 m6 l6 center-align">
                                                <i>Total Feed Refused: <strong class="emphasis-small">{{breeder_feed_refused}} kg</strong></i>
                                            </div>
                                        </div>     
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="s12 m12 l12">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <strong>EGG PRODUCTION</strong> 
                                            </div>
                                        </div>
                                        <div v-if="breeder_eggprod_loading" class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <div class="preloader-wrapper small active">
                                                    <div class="spinner-layer spinner-gray-only">
                                                        <div class="circle-clipper left">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="gap-patch">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="circle-clipper right">
                                                            <div class="circle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="row">
                                            <div class="col s12 m12 l12">
                                                <div class="row">
                                                    <div class="col s3 m3 l3 center-align right-column-divider">
                                                        <p>Intact</p>
                                                        <p class="emphasis-med">{{breeder_intact_eggs}}</p>
                                                    </div>
                                                    <div class="col s3 m3 l3 center-align right-column-divider">
                                                        <p>Total Weight</p>
                                                        <p class="emphasis-med">{{breeder_egg_weight.toFixed(3)}}</p>
                                                    </div>
                                                    <div class="col s3 m3 l3 center-align right-column-divider">
                                                        <p>Broken</p>
                                                        <p class="emphasis-med">{{breeder_broken_eggs}}</p>
                                                    </div>
                                                    <div class="col s3 m3 l3 center-align">
                                                        <p>Rejected</p>
                                                        <p class="emphasis-med">{{breeder_rejected_eggs}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m12 l12 center-align">
                                                        <p>Approx. Hen-Day Egg Production</p>
                                                        <p class="emphasis-med">{{breeder_hen_day}} %</p>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="s12 m12 l12">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <strong>HATCHERY SUMMARY</strong>
                                            </div>
                                        </div>
                                        <div v-if="breeder_hatchery_loading" class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <div class="preloader-wrapper small active">
                                                    <div class="spinner-layer spinner-gray-only">
                                                        <div class="circle-clipper left">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="gap-patch">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="circle-clipper right">
                                                            <div class="circle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="row">
                                            <div class="col s4 m4 l4 center-align right-column-divider">
                                                <p>Fertility</p>
                                                <p class="emphasis-med">{{((this.breeder_total_eggs/this.breeder_total_fertile)*100).toFixed(2)}} %</p>
                                            </div>
                                            <div class="col s4 m4 l4 center-align right-column-divider">
                                                <p>Hatchability (on Fertile Eggs)</p>
                                                <p class="emphasis-med">{{((this.breeder_total_hatched/this.breeder_total_fertile)*100).toFixed(2)}} %</p>
                                            </div>
                                            <div class="col s4 m4 l4 center-align">
                                                <p>Hatchability (on Total Eggs)</p>
                                                <p class="emphasis-med">{{((this.breeder_total_hatched/this.breeder_total_eggs)*100).toFixed(2)}} %</p>
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
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h5 class="center-align custom-card-title">BROODERS & REPLACEMENTS</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="row">
                                    <div class="col s12 m6 l6 right-column-divider">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <strong>INVENTORY</strong>
                                            </div>
                                        </div>
                                        <div v-if="replacement_inventory_loading" class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <div class="preloader-wrapper small active">
                                                    <div class="spinner-layer spinner-gray-only">
                                                        <div class="circle-clipper left">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="gap-patch">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="circle-clipper right">
                                                            <div class="circle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="row">
                                            <div class="col s6 m6 l6 center-align right-column-divider">
                                                <p><i class="fas fa-mars"></i> Male</p>
                                                <p class="emphasis-med">{{replacement_male}}</p>
                                            </div>
                                            <div class="col s6 m6 l6 center-align">
                                                <p><i class="fas fa-venus"></i> Female</p>
                                                <p class="emphasis-med">{{replacement_female}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <strong>MORTALITY & SALES</strong>
                                            </div>
                                        </div>
                                        <div v-if="breeder_mortality_loading" class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <div class="preloader-wrapper small active">
                                                    <div class="spinner-layer spinner-gray-only">
                                                        <div class="circle-clipper left">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="gap-patch">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="circle-clipper right">
                                                            <div class="circle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="row">
                                            <div class="col s6 m6 l6 right-column-divider center-align">
                                                <p><i class="fas fa-skull-crossbones"></i> Mortality</p>
                                                <p class="emphasis-med"><i class="fas fa-mars"></i> : {{replacement_mort_male}} <i class="fas fa-venus"></i> : {{replacement_mort_female}}</p>
                                            </div>
                                            <div class="col s6 m6 l6 center-align">
                                                <p><i class="fas fa-dollar-sign"></i> Sales</p>
                                                <p class="emphasis-med"><i class="fas fa-mars"></i> : {{replacement_sale_male}} <i class="fas fa-venus"></i> : {{replacement_sale_female}}</p>
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
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h5 class="center-align custom-card-title">BROODERS</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const math = require('mathjs');
export default {
    data() {
        return {
            date : null,
            breeder_inventory_loading : true,
            breeder_mortality_loading : true,
            breeder_feeding_loading : true,
            breeder_eggprod_loading : true,
            breeder_hatchery_loading : true,
            breeder_male : 0,
            breeder_female : 0,
            breeder_mort_male : 0,
            breeder_mort_female : 0,
            breeder_sale_male : 0,
            breeder_sale_female : 0,
            breeder_egg_sale : 0,
            breeder_feed_offered : 0,
            breeder_feed_refused : 0,
            breeder_feed_consumption : 0,
            breeder_intact_eggs : 0,
            breeder_egg_weight : 0,
            breeder_broken_eggs : 0,
            breeder_rejected_eggs : 0,
            breeder_hen_day : 0,
            breeder_total_eggs : 0,
            breeder_total_fertile : 0,
            breeder_total_hatched : 0,

            replacement_inventory_loading : true,
            replacement_mortality_loading : true,
            replacement_feeding_loading : true,
            replacement_male : 0,
            replacement_female : 0,
            replacement_mort_male : 0,
            replacement_mort_female : 0,
            replacement_sale_male : 0,
            replacement_sale_female : 0,
            replacement_feed_offered : 0,
            replacement_feed_refused : 0,
            replacement_feed_consumption : 0,


            brooder_inventory_loading : true,
            brooder_mortality_loading : true,
            brooder_feeding_loading : true,

        }
    },
    methods : {
        init : function () {
            this.getBreederSummary();
            this.getReplacementSummary();
        },
        getDateTime : function () {
            var today = new Date;
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+' '+ today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            return date;
        },
        getBreederSummary : function () {
            this.getBreederInventory();
            this.getBreederMortality();
            this.getBreederFeeding();
            this.getBreederEggProd();
            this.getBreederHatchery();
        },
        getReplacementSummary : function () {
            this.getReplacementInventory();
            this.getReplacementMortality();
        },
        getBrooderSummary : function () {
            
        },
        getBreederInventory : function () {
            axios.get('farm/dash_breeder_inventory')
            .then(response => {
                var inventory = response.data;
                inventory.forEach(element => {
                    this.breeder_male = this.breeder_male + element.number_male;
                    this.breeder_female = this.breeder_female + element.number_female;
                });
                this.breeder_inventory_loading = false;
            })
            .catch(error => {
                
            })
        },
        getBreederMortality : function () {
            axios.get('farm/dash_breeder_mortality')
            .then(response => {
                var mortality = response.data;
                mortality.forEach(element => {
                    if(element.category === "died" || element.category === "culled"){
                        this.breeder_mort_male = this.breeder_mort_male + element.male;
                        this.breeder_mort_female = this.breeder_mort_female + element.female;
                    }
                    else if(element.category === "sold" && element.type=="breeder"){
                        this.breeder_sale_male = this.breeder_sale_male + element.male;
                        this.breeder_sale_female = this.breeder_sale_female + element.female;
                    }else if(element.category === "sold" && element.type=="egg"){
                        this.breeder_egg_sale = this.breeder_egg_sale + element.total;
                    }
                });
                this.breeder_mortality_loading = false;
            })
            .catch(error => {
                
            })  
        },
        getBreederFeeding : function () {
            axios.get('farm/dash_breeder_feeding')
            .then(response => {
                var feeding = response.data;
                feeding.forEach(element => {
                    this.breeder_feed_offered = this.breeder_feed_offered + element.amount_offered;
                    this.breeder_feed_refused = this.breeder_feed_refused + element.amount_refused;
                });
                this.breeder_feed_offered = (this.breeder_feed_offered/1000).toFixed(3);
                this.breeder_feed_refused = (this.breeder_feed_refused/1000).toFixed(3);
                this.breeder_feed_consumption = (this.breeder_feed_offered - this.breeder_feed_refused).toFixed(3);
                this.breeder_feeding_loading = false;
            })
            .catch(error => {
                
            })
        },
        getBreederEggProd : function () {
            axios.get('farm/dash_breeder_eggprod')
            .then(response => {
                var eggprod = response.data;
                eggprod['data'].forEach(element => {
                    this.breeder_intact_eggs = this.breeder_intact_eggs + element.total_eggs_intact;
                    this.breeder_egg_weight = this.breeder_egg_weight + element.total_egg_weight;
                    this.breeder_broken_eggs = this.breeder_broken_eggs + element.total_broken;
                    this.breeder_rejected_eggs = this.breeder_rejected_eggs + element.total_rejects; 
                });
                this.breeder_hen_day = ((this.breeder_intact_eggs/eggprod['female'])*100).toFixed(3);
                this.breeder_eggprod_loading = false;
            })
            .catch(error => {
                
            })
        },
        getBreederHatchery : function () {
            axios.get('farm/dash_breeder_hatchery')
            .then(response => {
                var hatchery = response.data;
                hatchery.forEach(element => {
                    this.breeder_total_eggs = this.breeder_total_eggs + element.number_eggs_set;
                    this.breeder_total_fertile = this.breeder_total_fertile + element.number_fertile;
                    this.breeder_total_hatched = this.breeder_total_hatched + element.number_hatched;
                });
                this.breeder_hatchery_loading = false;
            })
            .catch(error => {
                
            })
        },
        getReplacementInventory : function () {
            axios.get('farm/dash_replacement_inventory')
            .then(response => {
                var inventory = response.data;
                inventory.forEach(element => {
                    this.replacement_male = this.replacement_male + element.number_male;
                    this.replacement_female = this.replacement_female + element.number_female;
                });
                this.replacement_inventory_loading = false;
            })
            .catch(error => {
                
            })
        },
        getReplacementMortality : function () {
            axios.get('farm/dash_replacement_mortality')
            .then(response => {
                var mortality = response.data;
                mortality.forEach(element => {
                    if(element.category === "died" || element.category === "culled"){
                        this.replacement_mort_male = this.replacement_mort_male + element.male;
                        this.replacement_mort_female = this.replacement_mort_female + element.female;
                    }
                    else if(element.category === "sold" && element.type=="replacement"){
                        this.replacement_sale_male = this.replacement_sale_male + element.male;
                        this.replacement_sale_female = this.replacement_sale_female + element.female;
                    }
                });
                this.replacement_mortality_loading = false;
            })
            .catch(error => {
                
            })
        },
        getReplacementFeeding : function () {

        },
    },
    mounted () {
        
    },
    created () {
        this.init();
    }
}
</script>

<style>

</style>

<style scoped>
    .emphasis-big{
        font-size: 2.5em; 
        margin-top: 1px;
        margin-bottom: 1.5px;
        font-weight: bold;
    }
    .emphasis-med{
        font-size: 2em;
        margin-top: 1px;
        margin-bottom: 1.5px;
        font-weight: bold;
    }
    .emphasis-small{
        font-size: 1.5em;
        margin-top: 1px;
        margin-bottom: 1.5px;
        font-weight: bold;
    }
    .card-panel{
        border: 1.3px dashed #546e7a;
    }
</style>
