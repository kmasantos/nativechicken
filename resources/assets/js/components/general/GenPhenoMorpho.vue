<template>
    <div class="row">
        <div class="col s12 m12 m12">
            <h5>Summary for Year : {{year}}</h5>
        </div>
        <div class="col s12 m12 l12" v-for="(pheno_morpho, index) in pheno_morphos" :key="index">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Generation {{index}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Male</h5>
                </div>
                <div class="col s12 m12 l12">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            Phenotypic
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Plumage Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][0]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][0], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Plumage Pattern
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][1]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][1], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Hackle Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][2]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][2], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Hackle Pattern
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][3]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][3], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Body Carriage
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][4]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][4], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Comb Type
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][5]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][5], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Comb Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][6]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][6], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Earlobe Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][7]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][7], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Iris Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][8]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][8], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Beak Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][9]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][9], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Shank Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][10]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][10], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Skin Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['male']['pheno'][11]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['male']['pheno'][11], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            Morphometric
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="bordered centered responsive-table">
                                <thead>
                                    <tr>
                                        <th>Attribute</th>
                                        <th>Min</th>
                                        <th>Max</th>
                                        <th>Mean</th>
                                        <th>Standard Dev</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(attribute, index) in pheno_morpho['male']['morpho']" :key="index">
                                        <td v-if="index === 0">
                                            Height (cm)	
                                        </td>
                                        <td v-if="index === 1">
                                            Weight (g)		
                                        </td>
                                        <td v-if="index === 2">
                                            Body Length (cm)
                                        </td>
                                        <td v-if="index === 3">
                                            Chest Circumference (cm)	
                                        </td>
                                        <td v-if="index === 4">
                                            Wing Span (cm)
                                        </td>
                                        <td v-if="index === 5">
                                            Shank Length (cm)	
                                        </td>
                                        <td>{{getMin(attribute)}}</td>
                                        <td>{{getMax(attribute)}}</td>
                                        <td>{{getMean(attribute)}}</td>
                                        <td>{{getStd(attribute)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>Female</h5>
                </div>
                <div class="col s12 m12 l12">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            Phenotypic
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Plumage Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][0]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][0], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Plumage Pattern
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][1]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][1], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Hackle Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][2]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][2], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Hackle Pattern
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][3]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][3], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Body Carriage
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][4]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][4], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Comb Type
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][5]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][5], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Comb Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][6]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][6], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Earlobe Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][7]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][7], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Iris Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][8]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][8], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Beak Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][9]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][9], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Shank Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][10]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][10], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    Skin Color
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <table class="bordered centered responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Frequency</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(attribute, index) in pheno_morpho['female']['pheno'][11]" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{attribute}}</td>
                                                <td>{{getPercentage(pheno_morpho['female']['pheno'][11], attribute)}}%</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            Morphometric
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="bordered centered responsive-table">
                                <thead>
                                    <tr>
                                        <th>Attribute</th>
                                        <th>Min</th>
                                        <th>Max</th>
                                        <th>Mean</th>
                                        <th>Standard Dev</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(attribute, index) in pheno_morpho['female']['morpho']" :key="index">
                                        <td v-if="index === 0">
                                            Height (cm)	
                                        </td>
                                        <td v-if="index === 1">
                                            Weight (g)		
                                        </td>
                                        <td v-if="index === 2">
                                            Body Length (cm)
                                        </td>
                                        <td v-if="index === 3">
                                            Chest Circumference (cm)	
                                        </td>
                                        <td v-if="index === 4">
                                            Wing Span (cm)
                                        </td>
                                        <td v-if="index === 5">
                                            Shank Length (cm)	
                                        </td>
                                        <td>{{getMin(attribute)}}</td>
                                        <td>{{getMax(attribute)}}</td>
                                        <td>{{getMean(attribute)}}</td>
                                        <td>{{getStd(attribute)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider"></div>
    </div>
</template>

<script>
    const math = require('mathjs');
    export default {
        props: [
            'year'
        ],
        data (){
            return {
                pheno_morphos : null,
                pheno_morpho_loading : true,
            }
        },
        methods : {
            getPhenoMorphoSummary : async function () {
                try {
                    const response = await axios.get('generation_pheno_morpho');
                    this.pheno_morphos = response.data;
                    this.pheno_morpho_loading = false;
                } catch (error) {
                    this.pheno_morpho_loading = true;
                }
            },
            getPercentage : function (object, value){
               var array = Object.values(object);
               var sum = 0;
               array.forEach(element => {
                   sum = sum + element;
               });
               return (value/sum)*100
            },
            getMean : function (object) {
                var array = Object.values(object);
                var mean = math.mean(array).toFixed(3);
                return mean;
            },
            getStd : function (object) {
                var array = Object.values(object);
                var std = math.std(array).toFixed(3);
                return std;
            },
            getMax : function (object) {
                var array = Object.values(object);
                return math.max(array).toFixed(3);
            },
            getMin : function (object) {
                var array = Object.values(object);
                return math.min(array).toFixed(3);
            },
        },
        mounted() {
            this.getPhenoMorphoSummary();
        }
    }
</script>
