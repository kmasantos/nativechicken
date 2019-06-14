<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h4>Dashboard</h4>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align custom-card-title">
                                BREEDERS
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="row">
                                    <div class="col s12 m12 l12 center-align custom_heading">
                                        INVENTORY
                                    </div>
                                    <div class="col s12 m12 l12 center-align">
                                        <i>Last Checked:  {{breeder_inventory_last_update}}</i>
                                    </div>
                                </div>
                                <div class="row center" v-if="breeder_inventory_loading">
                                    <div class="col s12 m12 l12">
                                        <div class="preloader-wrapper active">
                                            <div class="spinner-layer spinner-red-only">
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
                                <div class="row" v-else>
                                    <div class="col s12 m12 l6 right-column-divider">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align custom_subheading">
                                                MALE <i class="fas fa-mars"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align emphasis-big">
                                                {{breeder_male}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m12 l6">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align custom_subheading">
                                                FEMALE <i class="fas fa-venus"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align emphasis-big">
                                                {{breeder_female}}        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row center" v-if="breeder_eggprod_loading">
                            <div class="col s12 m12 l12">
                                <div class="preloader-wrapper active">
                                    <div class="spinner-layer spinner-red-only">
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
                        <div class="row" v-else>
                            <div class="col s12 m12 l12">
                                <div class="row">
                                    <div class="col s12 m12 l12 center-align custom_heading">
                                        EGG PRODUCTION
                                    </div>
                                    <div class="col s12 m12 l12 center-align">
                                        <i>Last Checked:  {{breeder_eggprod_last_update}}</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align custom_subheading">
                                                HEN DAY
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align emphasis-big">
                                                {{breeder_hen_day}}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l4 right-column-divider">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align custom_subheading">
                                                EGGS INTACT
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align emphasis-med">
                                                {{breeder_intact_eggs}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m12 l4 right-column-divider">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align custom_subheading">
                                                EGGS BROKEN
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align emphasis-med">
                                                {{breeder_broken_eggs}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m12 l4">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align custom_subheading">
                                                EGGS REJECTED
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align emphasis-med">
                                                {{breeder_rejected_eggs}}
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
                <div class="col s12 m12 l6">
                    <div class="card-panel">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align custom-card-title">
                                GROWERS & REPLACEMENTS
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="row">
                                    <div class="col s12 m12 l12 center-align custom_heading">
                                        INVENTORY
                                    </div>
                                    <div class="col s12 m12 l12 center-align">
                                        <i>Last Checked:  {{replacement_inventory_last_update}}</i>
                                    </div>
                                </div>
                                <div class="row center" v-if="replacement_inventory_loading">
                                    <div class="col s12 m12 l12">
                                        <div class="preloader-wrapper active">
                                            <div class="spinner-layer spinner-red-only">
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
                                <div class="row" v-else>
                                    <div class="col s12 m12 l6 right-column-divider">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align custom_subheading">
                                                MALE <i class="fas fa-mars"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align emphasis-big">
                                                {{replacement_male}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m12 l6">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align custom_subheading">
                                                FEMALE <i class="fas fa-venus"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align emphasis-big">
                                                {{replacement_female}}        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l6">
                    <div class="card-panel">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align custom-card-title">
                                BROODERS
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="row">
                                    <div class="col s12 m12 l12 center-align custom_heading">
                                        INVENTORY
                                    </div>
                                    <div class="col s12 m12 l12 center-align">
                                        <i>Last Checked:  {{brooder_inventory_last_update}}</i>
                                    </div>
                                </div>
                                <div class="row center" v-if="brooder_inventory_loading">
                                    <div class="col s12 m12 l12">
                                        <div class="preloader-wrapper active">
                                            <div class="spinner-layer spinner-red-only">
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
                                <div class="row" v-else>
                                    <div class="col s12 m12 l12">
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align custom_subheading">
                                                Total <i class="fas fa-venus-mars"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align emphasis-big">
                                                {{brooder_total}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            breeder_eggprod_loading : true,
            breeder_male : 0,
            breeder_female : 0,
            breeder_inventory_last_update : null,
            breeder_intact_eggs : 0,
            breeder_egg_weight : 0,
            breeder_broken_eggs : 0,
            breeder_rejected_eggs : 0,
            breeder_hen_day : 0,
            breeder_eggprod_last_update : null,

            replacement_inventory_loading : true,
            replacement_male : 0,
            replacement_female : 0,
            replacement_inventory_last_update : null,

            brooder_inventory_loading : true,
            brooder_total : 0,
            brooder_inventory_last_update : null,
            
        }
    },
    methods : {
        init : function () {
            this.getBreederSummary();
            this.getReplacementSummary();
            this.getBrooderSummary();
        },
        getDateTime : function () {
            var today = new Date;
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            return date;
        },
        getBreederSummary : function () {
            this.getBreederInventory();
            this.getBreederEggProd();
        },
        getReplacementSummary : function () {
            this.getReplacementInventory();
        },
        getBrooderSummary : function () {
            this.getBrooderInventory();
        },
        getBreederInventory : function () {
            axios.get('farm/dash_breeder_inventory')
            .then(response => {
                var inventory = response.data;
                inventory.forEach(element => {
                    this.breeder_male = this.breeder_male + element.number_male;
                    this.breeder_female = this.breeder_female + element.number_female;
                });
                this.breeder_inventory_last_update = this.getDateTime();
                this.breeder_inventory_loading = false;
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
                    this.breeder_broken_eggs = this.breeder_broken_eggs + element.total_broken;
                    this.breeder_rejected_eggs = this.breeder_rejected_eggs + element.total_rejects; 
                });
                this.breeder_hen_day = (((this.breeder_intact_eggs + this.breeder_broken_eggs + this.breeder_rejected_eggs)/eggprod['female'])*100).toFixed(2);
                this.breeder_eggprod_last_update = this.getDateTime();
                this.breeder_eggprod_loading = false;
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
                this.replacement_inventory_last_update = this.getDateTime();
                this.replacement_inventory_loading = false;
            })
            .catch(error => {
                
            })
        },
        getBrooderInventory : function () {
            axios.get('farm/dash_brooders_inventory')
            .then(response => {
                var inventory = response.data;
                inventory.forEach(element => {
                    this.brooder_total = this.brooder_total + element.total;
                });
                this.brooder_inventory_last_update = this.getDateTime();
                this.brooder_inventory_loading = false;
            })
            .catch(error => {
                
            })
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
    .custom-card-title {
        font-size: 1.3em;
        font-weight: bold;
    }
    .custom_subheading {
        font-size:1.1em;
        font-weight: bold;
    }
    .custom_heading {
        font-size:1.3em;
        font-weight: bold;
    }
</style>
