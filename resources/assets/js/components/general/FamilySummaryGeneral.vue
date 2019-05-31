<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l2" v-if="!generations || !generations.length">
                    <label>Select Generation</label>
                    <select class="browser-default" disabled>
                        <option disabled selected>No Generations</option>
                    </select>
                </div>
                <div class="col s12 m12 l2" v-else>
                    <label>Select Generation</label>
                    <select v-model="generation" @change="selected=null" class="browser-default">
                        <option disabled selected>Choose your option</option>
                        <option v-for="generation in generations" :key="generation.id" :value="generation">{{generation.number}}</option>
                    </select>
                </div>
                
                <div class="col s12 m12 l10">
                    <nav class="sub_nav transparent z-depth-0">
                        <div class="nav-wrapper">
                            <ul id="nav-mobile" class="left">
                                <li><a @click="selected='Phenotypic Summary'" class="black-text" href="#" onclick="return false;">PHENO</a></li>
                                <li><a @click="selected='Morphometric Summary'" class="black-text" href="#" onclick="return false;">MORPHO</a></li>
                                <li><a @click="selected='Feeding Performance'" class="black-text" href="#" onclick="return false;">FEEDING</a></li>
                                <li><a @click="selected='Growth Performance'" class="black-text" href="#" onclick="return false;">GROWTH</a></li>
                                <li><a @click="selected='Egg Production'" class="black-text" href="#" onclick="return false;">EGG PROD</a></li>
                                <li><a @click="selected='Hatchery Data'" class="black-text" href="#" onclick="return false;">HATCHERY</a></li>
                                <li><a @click="selected='Egg Quality'" class="black-text" href="javascript:void(0);">EGG QUALITY</a></li>
                                <li><a @click="selected='Mortality & Sales'" class="black-text" href="#" onclick="return false;">MORTALITY/SALES</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <div id="notice_div" class="row center-align" v-if="selected === null">
                <div class="col s12 m12 l12">
                    <h5><i class="fas fa-exclamation-triangle"></i> Choose a Generation and select an option from the navigation bar to show summary</h5>
                </div>
            </div>
            <div class="row" v-else>
                <div class="col s12 m12 l12">
                    <div v-if="selected=='Phenotypic Summary'">
                        <family-summary-phenotypic :animal_type="animal_type.animaltype_id" :title="selected" :generation="generation"></family-summary-phenotypic>
                    </div>
                    <div v-if="selected=='Morphometric Summary'">
                        <family-summary-morphometric :animal_type="animal_type.animaltype_id" :title="selected" :generation="generation"></family-summary-morphometric>
                    </div>
                    <div v-if="selected=='Feeding Performance'">
                        <family-summary-feeding :animal_type="animal_type.animaltype_id" :title="selected" :generation="generation"></family-summary-feeding>
                    </div>
                    <div v-if="selected=='Growth Performance'">
                        <family-summary-growth :animal_type="animal_type.animaltype_id" :title="selected" :generation="generation"></family-summary-growth>
                    </div>
                    <div v-if="selected=='Egg Production'">
                        <family-summary-eggprod :title="selected" :generation="generation"></family-summary-eggprod >
                    </div>
                    <div v-if="selected=='Hatchery Data'">
                        <family-summary-hatchery :animal_type="animal_type.animaltype_id" :title="selected" :generation="generation"></family-summary-hatchery>
                    </div>
                    <div v-if="selected=='Mortality & Sales'">
                        <family-summary-mortality :animal_type="animal_type.animaltype_id" :title="selected" :generation="generation"></family-summary-mortality>
                    </div>
                    <div v-if="selected=='Egg Quality'">
                        <family-summary-eggqual :animal_type="animal_type.animaltype_id" :title="selected" :generation="generation"></family-summary-eggqual>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</template>

<script>
export default {
    data () {
        return {
            animal_type : null,
            selected : null,
            generations : null,
            generation : null,
        }
    },
    methods : {
        init : function () {
            this.getAnimalType();
            this.fetchGeneration();
        },
        getAnimalType : function () {
            axios.get('fetch_animal_type')
            .then(response => {
                this.animal_type = response.data;
            })
            .catch(error => {});
        },
        fetchGeneration : async function () {
            try {
                const response = await axios.get('get_generation_list');
                this.generations = response.data;
            } catch (error) {
                console.error("Generations still loading");
            }
        },
    },
    mounted () {
        this.init();
    }
}
</script>

<style scoped>
    .sub_nav{
        padding-left: 5px;
    }
    #notice_div{
        top:50%;
    }
</style>
