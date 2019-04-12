<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <nav class="transparent z-depth-0">
                <div class="nav-wrapper">
                    <ul class="center">
                        <li><a @click="selected='Phenotypic Summary'" class="black-text" href="javascript:void(0);">Phenotypic</a></li>
                        <li><a @click="selected='Morphometric Summary'" class="black-text" href="javascript:void(0);">Morphometric</a></li>
                        <li><a @click="selected='Feeding Performance'" class="black-text" href="javascript:void(0);">Feeding</a></li>
                        <li><a @click="selected='Growth Performance'" class="black-text" href="javascript:void(0);">Growth</a></li>
                        <li><a @click="selected='Egg Production'" class="black-text" href="javascript:void(0);">Egg Production</a></li>
                        <li><a @click="selected='Hatchery Data'" class="black-text" href="javascript:void(0);">Hatchery</a></li>
                        <li><a @click="selected='Mortality & Sales'" class="black-text" href="javascript:void(0);">Mortality & Sales</a></li>
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
                <div class="row">
                    <div class="col s12 m12 l12">
                        <ul class="collapsible popout" data-collapsible="expandable">
                            <li>
                                <div class="collapsible-header"><i class="fas fa-crown"></i>BREEDERS</div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            HELLOOOOOO
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="fas fa-feather-alt"></i>GROWERS & REPLACEMENTS</div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            HELLOOOOOO
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="fas fa-crow"></i>BROODERS</div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            HELLOOOOOO
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
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
            selected : null,
        }
    },
    mounted () {

    },
    created () {

    },
    destroyed () {
       
    }
}
</script>

<style scoped>
    
</style>
