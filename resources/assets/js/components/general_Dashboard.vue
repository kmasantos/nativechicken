<template>
    <div>
        <div id="preloader-whole-page" class="row" v-if="loaded == false">
            <div class="col s12 m12 l12 center">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
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
            <div class="row">
                <div class="col s12 m12 l12 center-align valign">Loading...</div>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col s12 m12 l12">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="card-panel hoverable">
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <h5>General Inventory Status</h5>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="row">
                                <div class="col s12 m6 l6 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Male <i class="fas fa-mars"></i></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>10</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s12 m6 l6 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Female <i class="fas fa-venus"></i></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>10</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                                <h5>Total <i class="fas fa-venus-mars"></i></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>20</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="card-panel hoverable">
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <h5>Monthly Feeding Status</h5>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="row">
                                <div class="col s12 m6 l6 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Breeder</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>10 kg</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s12 m6 l6 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Growers & Replacements</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>50 kg</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Brooders</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>40 kg</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="card-panel hoverable">
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <h5>Monthly Egg Production</h5>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="row">
                                <div class="col s12 m6 l6 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Percent Fertility</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>100%</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s12 m6 l6 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Percent Hatchability</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>100%</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Percent Hen Day</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>100%</h5>
                                            <!-- <h5>((total eggs produced/day)/total hen on the day) * 100</h5> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="card-panel hoverable">
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <h5>Monthly Hatchery Status</h5>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="row">
                                <div class="col s12 m6 l6 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Total Eggs Collected</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>160</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s12 m6 l6 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Total Ave Weight</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>100</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Total Ave Rejected</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col svalign-wrapper2 m12 l12">
                                            <h5>20</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card-panel hoverable">
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <h5>Mortality, Sales  & Culling</h5>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="row">
                                <div class="col s12 m6 l6 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Breeder</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m4 l4">
                                            <div class="row">
                                                <div class="col s12 m12 l12">Mortality</div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">0</div>
                                            </div>
                                        </div>
                                        <div class="col s12 m4 l4">
                                            <div class="row">
                                                <div class="col s12 m12 l12">Sales</div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">0</div>
                                            </div>
                                        </div>
                                        <div class="col s12 m4 l4">
                                            <div class="row">
                                                <div class="col s12 m12 l12">Culling</div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">0</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Growers & Replacements</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m4 l4">
                                            <div class="row">
                                                <div class="col s12 m12 l12">Mortality</div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">0</div>
                                            </div>
                                        </div>
                                        <div class="col s12 m4 l4">
                                            <div class="row">
                                                <div class="col s12 m12 l12">Sales</div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">0</div>
                                            </div>
                                        </div>
                                        <div class="col s12 m4 l4">
                                            <div class="row">
                                                <div class="col s12 m12 l12">Culling</div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">0</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h5>Brooders</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m3 l3">
                                            <div class="row">
                                                <div class="col s12 m12 l12">Mortality</div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">0</div>
                                            </div>
                                        </div>
                                        <div class="col s12 m3 l3">
                                            <div class="row">
                                                <div class="col s12 m12 l12">Sales</div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">0</div>
                                            </div>
                                        </div>
                                        <div class="col s12 m3 l3">
                                            <div class="row">
                                                <div class="col s12 m12 l12">Culling</div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">0</div>
                                            </div>
                                        </div>
                                        <div class="col s12 m3 l3">
                                            <div class="row">
                                                <div class="col s12 m12 l12">Egg Sales</div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">0</div>
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
    export default {
        data() {
            return {
                loaded : false,
            }
        },
        methods : {
            initialize : function () {
                this.loaded = true;
            },
        },
        mounted() {
            console.log('Component mounted.');
        },
        created() {
            this.initialize();
        }
    }
</script>

