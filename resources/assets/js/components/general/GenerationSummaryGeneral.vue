<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <nav id="generation_summary_nav" class="transparent z-depth-0">
                <div class="nav-wrapper">
                    <ul>
                        <li><a @click="selected='Phenotypic Summary'" class="black-text" href="javascript:void(0);">PHENOTYPIC</a></li>
                        <li><a @click="selected='Morphometric Summary'" class="black-text" href="javascript:void(0);">MORPHOMETRIC</a></li>
                        <li><a @click="selected='Feeding Performance'" class="black-text" href="javascript:void(0);">FEEDING</a></li>
                        <li><a @click="selected='Growth Performance'" class="black-text" href="javascript:void(0);">GROWTH</a></li>
                        <li><a @click="selected='Egg Production'" class="black-text" href="javascript:void(0);">EGG PRODUCTION</a></li>
                        <li><a @click="selected='Hatchery Data'" class="black-text" href="javascript:void(0);">HATCHERY</a></li>
                        <li><a @click="selected='Mortality & Sales'" class="black-text" href="javascript:void(0);">MORTALITY & SALES</a></li>
                    </ul>
                </div>
            </nav>
            <div v-if="selected==null" class="row">
                <div class="col s12 m12 l12">
                    <h5 class="center">Select an option from the menu above</h5>
                </div>
            </div>
            <div v-else>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="center">{{selected}}</h5>
                    </div>
                </div>
                <div v-if="selected=='Phenotypic Summary'">
                    <generation-summary-phenotypic :animal_type="animal_type.animaltype_id"></generation-summary-phenotypic>
                </div>
                <div v-if="selected=='Morphometric Summary'">
                    <generation-summary-morphometric :animal_type="animal_type.animaltype_id"></generation-summary-morphometric>
                </div>
                <div v-if="selected=='Feeding Performance'">
                    <generation-summary-feeding :animal_type="animal_type.animaltype_id"></generation-summary-feeding>
                </div>
                <div v-if="selected=='Growth Performance'">
                    <generation-summary-growth :animal_type="animal_type.animaltype_id"></generation-summary-growth>
                </div>
                <div v-if="selected=='Egg Production'"></div>
                <div v-if="selected=='Hatchery Data'">
                    <generation-summary-hatchery :animal_type="animal_type.animaltype_id"></generation-summary-hatchery>
                </div>
                <div v-if="selected=='Mortality & Sales'">
                    <generation-summary-mortality :animal_type="animal_type.animaltype_id"></generation-summary-mortality>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            selected : null,
            animal_type : null,
        }
    },
    methods : {
        checkAnimalType : function () {
            axios.get('fetch_animal_type')
            .then(response => {
                this.animal_type = response.data;
            })
            .catch(error => {
                
            });
        },
    },
    mounted () {
        this.checkAnimalType();
    },
    created () {

    },
    destroyed () {
       
    }
}
</script>

<style scoped>
    #generation_summary_nav {
        padding-left: 0px;
    }
</style>
