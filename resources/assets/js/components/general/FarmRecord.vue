<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
                <div class="row">
                    <div class="col s12 m4 l4">
                        <a @click="facet = true; production = false; inventory = false; selected_generations=null; selected_generations_feeding = null; selected_generations_inventory = null; year_feeding = null; year_inventory = null" 
                        class="waves-effect waves-light btn blue-grey lighten-1">Facet</a>
                    </div>
                    <div class="col s12 m4 l4">
                        <a @click="production = true; facet = false; inventory = false; selected_generations=null; selected_generations_feeding = null; selected_generations_inventory = null; year_feeding = null; year_inventory = null" 
                        class="waves-effect waves-light btn blue-grey lighten-1">Production</a>
                    </div>
                    <div class="col s12 m4 l4">
                        <a @click="inventory = true; production = false; facet = false; selected_generations=null; selected_generations_feeding = null; selected_generations_inventory = null; year_feeding = null; year_inventory = null" 
                        class="waves-effect waves-light btn blue-grey lighten-1">Inventory</a>
                    </div>
                </div>
                <div v-if="facet == true">
                    <div class="row">
                        <div class="col s12 m12 l12">
                                <label for="generation_select">Select Generation</label>
                                <v-select @input="getPhenoMorphoFamilySummary" v-model="selected_generations" resetOnOptionsChange label="number" :options="generations.data" id="generation_select">
                                    <i slot="spinner" class="icon icon-spinner"></i>
                                </v-select>
                            </div>
                        </div>
                        <div v-if="selected_generations==null">
                            <div class="row">
                                <div class="col s12 m12 l12 center-align">
                                    No Generation Selected
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div v-for="(summary, index) of pheno_morpho" :key="index">
                                <h5>{{index}}</h5>
                                <div class="row" v-if="summary[0]['pheno'].length == 0 || summary[1]['pheno'].length == 0 || summary[0]['morpho'].length == 0 || summary[1]['morpho'].length == 0">
                                    <div class="col s12 m12 l12 center">
                                        <h5>No data for this Generation</h5>
                                    </div>
                                </div>
                                <div v-else>
                                    <!-- duck -->
                                    <div v-if="summary[0]['pheno'].length >= 13"> 
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <h5>Male : Phenotypic</h5>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col s12 m12 l12">
                                                <strong>Plumage Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][0]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][0], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Plumage Pattern</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][1]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][1], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Body Carriage</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][2]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][2], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Shank Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][3]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][3], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Skin Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][4]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][4], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Neck Feather Markings</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][5]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][5], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Wing Feather Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][6]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][6], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Tail Feather Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][7]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][7], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Bill Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][8]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][8], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>
                                            
                                            <div class="col s12 m12 l12">
                                                <strong>Bill Shape</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][9]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][9], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Bean Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][10]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][10], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Presence of Crest</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][11]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][11], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Eye Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][12]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][12], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <h5>Male : Morphometric</h5>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col s12 m12 l12">
                                                <table class="bordered responsive-table">
                                                    <thead>
                                                    <tr>
                                                        <th>Attribute</th>
                                                        <th>Minimum</th>
                                                        <th>Maximum</th>
                                                        <th>Standard Dev</th>
                                                        <th>Mean</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <tr>
                                                        <td>Height (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][0])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][0])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][0])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][0])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Weight (g)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][1])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][1])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][1])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][1])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Body Length (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][2])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][2])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][2])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][2])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Chest Circumference (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][3])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][3])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][3])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][3])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Wing Span (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][4])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][4])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][4])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][4])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shank Length (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][5])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][5])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][5])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][5])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bill Length (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][6])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][6])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][6])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][6])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Neck Length (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][7])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][7])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][7])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][7])}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <h5>Female : Phenotypic</h5>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col s12 m12 l12">
                                                <strong>Plumage Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][0]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][0], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Plumage Pattern</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][1]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][1], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Body Carriage</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][2]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][2], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Shank Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][3]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][3], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Skin Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][4]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][4], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Neck Feather Markings</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][5]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][5], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Wing Feather Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][6]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][6], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Tail Feather Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][7]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][7], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Bill Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][8]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][8], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>
                                            
                                            <div class="col s12 m12 l12">
                                                <strong>Bill Shape</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][9]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][9], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Bean Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][10]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][10], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Presence of Crest</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][11]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][11], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Eye Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][12]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][12], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s12 m12 l12 center-align">
                                                    <h5>Female : Morphometric</h5>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col s12 m12 l12">
                                                    <table class="bordered responsive-table">
                                                        <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Minimum</th>
                                                            <th>Maximum</th>
                                                            <th>Standard Dev</th>
                                                            <th>Mean</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        <tr>
                                                            <td>Height (cm)</td>
                                                            <td>{{getMinimum(summary[1]['morpho'][0])}}</td>
                                                            <td>{{getMaximum(summary[1]['morpho'][0])}}</td>
                                                            <td>{{getStandardDeviation(summary[0]['morpho'][0])}}</td>
                                                            <td>{{getMean(summary[1]['morpho'][0])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Weight (g)</td>
                                                            <td>{{getMinimum(summary[1]['morpho'][1])}}</td>
                                                            <td>{{getMaximum(summary[1]['morpho'][1])}}</td>
                                                            <td>{{getStandardDeviation(summary[0]['morpho'][1])}}</td>
                                                            <td>{{getMean(summary[1]['morpho'][1])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Body Length (cm)</td>
                                                            <td>{{getMinimum(summary[1]['morpho'][2])}}</td>
                                                            <td>{{getMaximum(summary[1]['morpho'][2])}}</td>
                                                            <td>{{getStandardDeviation(summary[1]['morpho'][2])}}</td>
                                                            <td>{{getMean(summary[1]['morpho'][2])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Chest Circumference (cm)</td>
                                                            <td>{{getMinimum(summary[1]['morpho'][3])}}</td>
                                                            <td>{{getMaximum(summary[1]['morpho'][3])}}</td>
                                                            <td>{{getStandardDeviation(summary[1]['morpho'][3])}}</td>
                                                            <td>{{getMean(summary[1]['morpho'][3])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Wing Span (cm)</td>
                                                            <td>{{getMinimum(summary[1]['morpho'][4])}}</td>
                                                            <td>{{getMaximum(summary[1]['morpho'][4])}}</td>
                                                            <td>{{getStandardDeviation(summary[1]['morpho'][4])}}</td>
                                                            <td>{{getMean(summary[1]['morpho'][4])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Shank Length (cm)</td>
                                                            <td>{{getMinimum(summary[1]['morpho'][5])}}</td>
                                                            <td>{{getMaximum(summary[1]['morpho'][5])}}</td>
                                                            <td>{{getStandardDeviation(summary[1]['morpho'][5])}}</td>
                                                            <td>{{getMean(summary[1]['morpho'][5])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bill Length (cm)</td>
                                                            <td>{{getMinimum(summary[1]['morpho'][6])}}</td>
                                                            <td>{{getMaximum(summary[1]['morpho'][6])}}</td>
                                                            <td>{{getStandardDeviation(summary[1]['morpho'][6])}}</td>
                                                            <td>{{getMean(summary[1]['morpho'][6])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Neck Length (cm)</td>
                                                            <td>{{getMinimum(summary[1]['morpho'][7])}}</td>
                                                            <td>{{getMaximum(summary[1]['morpho'][7])}}</td>
                                                            <td>{{getStandardDeviation(summary[1]['morpho'][7])}}</td>
                                                            <td>{{getMean(summary[1]['morpho'][7])}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <div class="divider"></div>
                                        </div>
                                    </div>
                                    <!-- chicken -->
                                    <div v-else>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <h5>Male : Phenotypic</h5>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col s12 m12 l12">
                                                <strong>Plumage Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][0]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][0], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Plumage Pattern</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][1]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][1], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Hackle Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][2]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][2], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Hackle Pattern</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][3]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][3], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Body Carriage</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][4]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][4], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Comb Type</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][5]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][5], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>
                                            
                                            <div class="col s12 m12 l12">
                                                <strong>Comb Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][6]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][6], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Earlobe Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][7]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][7], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Iris Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][8]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][8], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Beak Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][9]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][9], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>


                                            <div class="col s12 m12 l12">
                                                <strong>Shank Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][10]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][10], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Skin Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[0]['pheno'][11]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[0]['pheno'][11], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <h5>Male : Morphometric</h5>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col s12 m12 l12">
                                                <table class="bordered responsive-table">
                                                    <thead>
                                                    <tr>
                                                        <th>Attribute</th>
                                                        <th>Minimum</th>
                                                        <th>Maximum</th>
                                                        <th>Standard Dev</th>
                                                        <th>Mean</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <tr>
                                                        <td>Height (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][0])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][0])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][0])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][0])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Weight (g)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][1])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][1])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][1])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][1])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Body Length (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][2])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][2])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][2])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][2])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Chest Circumference (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][3])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][3])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][3])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][3])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Wing Span (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][4])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][4])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][4])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][4])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shank Length (cm)</td>
                                                        <td>{{getMinimum(summary[0]['morpho'][5])}}</td>
                                                        <td>{{getMaximum(summary[0]['morpho'][5])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][5])}}</td>
                                                        <td>{{getMean(summary[0]['morpho'][5])}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                            <h5>Female : Phenotypic</h5> 
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col s12 m12 l12">
                                                <strong>Plumage Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][0]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][0], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Plumage Pattern</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][1]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][1], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Hackle Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][2]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][2], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Hackle Pattern</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][3]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][3], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Body Carriage</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][4]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][4], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Comb Type</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][5]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][5], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>
                                            
                                            <div class="col s12 m12 l12">
                                                <strong>Comb Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][6]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][6], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Earlobe Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][7]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][7], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Iris Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][8]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][8], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>

                                            <div class="col s12 m12 l12">
                                                <strong>Beak Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][9]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][9], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>


                                            <div class="col s12 m12 l12">
                                                <strong>Shank Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][10]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][10], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>


                                            <div class="col s12 m12 l12">
                                                <strong>Skin Color</strong> 
                                                <table class="bordered centered responsive-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Attribute</th>
                                                            <th>Frequency</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>  

                                                    <tbody>
                                                        <tr v-for="(pheno, index) in summary[1]['pheno'][11]" :key="index">
                                                            <td>{{index}}</td>
                                                            <td>{{pheno}}</td>
                                                            <td>{{getPercentage(summary[1]['pheno'][11], pheno)}}%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center-align">
                                                <h5>Female : Morphometric</h5>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col s12 m12 l12">
                                                <table class="bordered responsive-table">
                                                    <thead>
                                                    <tr>
                                                        <th>Attribute</th>
                                                        <th>Minimum</th>
                                                        <th>Maximum</th>
                                                        <th>Standard Dev</th>
                                                        <th>Mean</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <tr>
                                                        <td>Height (cm)</td>
                                                        <td>{{getMinimum(summary[1]['morpho'][0])}}</td>
                                                        <td>{{getMaximum(summary[1]['morpho'][0])}}</td>
                                                        <td>{{getStandardDeviation(summary[1]['morpho'][0])}}</td>
                                                        <td>{{getMean(summary[1]['morpho'][0])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Weight (g)</td>
                                                        <td>{{getMinimum(summary[1]['morpho'][1])}}</td>
                                                        <td>{{getMaximum(summary[1]['morpho'][1])}}</td>
                                                        <td>{{getStandardDeviation(summary[1]['morpho'][1])}}</td>
                                                        <td>{{getMean(summary[1]['morpho'][1])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Body Length (cm)</td>
                                                        <td>{{getMinimum(summary[1]['morpho'][2])}}</td>
                                                        <td>{{getMaximum(summary[1]['morpho'][2])}}</td>
                                                        <td>{{getStandardDeviation(summary[1]['morpho'][2])}}</td>
                                                        <td>{{getMean(summary[1]['morpho'][2])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Chest Circumference (cm)</td>
                                                        <td>{{getMinimum(summary[1]['morpho'][3])}}</td>
                                                        <td>{{getMaximum(summary[1]['morpho'][3])}}</td>
                                                        <td>{{getStandardDeviation(summary[1]['morpho'][3])}}</td>
                                                        <td>{{getMean(summary[1]['morpho'][3])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Wing Span (cm)</td>
                                                        <td>{{getMinimum(summary[1]['morpho'][4])}}</td>
                                                        <td>{{getMaximum(summary[1]['morpho'][4])}}</td>
                                                        <td>{{getStandardDeviation(summary[1]['morpho'][4])}}</td>
                                                        <td>{{getMean(summary[1]['morpho'][4])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shank Length (cm)</td>
                                                        <td>{{getMinimum(summary[1]['morpho'][5])}}</td>
                                                        <td>{{getMaximum(summary[1]['morpho'][5])}}</td>
                                                        <td>{{getStandardDeviation(summary[0]['morpho'][5])}}</td>
                                                        <td>{{getMean(summary[1]['morpho'][5])}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="production == true">
                        <div class="row valign-wrapper">
                            <div class="col s5 m5 l5">
                                <label for="generation_select_prod">Select Generation</label>
                                <v-select v-model="selected_generations_production" resetOnOptionsChange label="number" :options="generations.data" id="generation_select_prod">
                                    <i slot="spinner" class="icon icon-spinner"></i>
                                </v-select>
                            </div>
                            <div class="col s4 m4 l4">
                                <label for="date_select_prod">Select Year</label>
                                <datepicker v-model="year_production" :minimumView="'year'" :initialView="'year'" :format="'yyyy'"></datepicker>
                            </div>
                            <div class="col s3 m3 l3">
                                <a v-if="(year_production === null) || (selected_generations_production === null)" class="waves-effect waves-light btn blue-grey lighten-1 disabled">Show</a>
                                <a v-else @click="getProductionData();show_production=true" class="waves-effect waves-light btn blue-grey lighten-1">Show</a>
                            </div>
                        </div>
                        <div v-if="(year_production === null) || (selected_generations_production === null) || (show_production == false)" class="row">
                            <div class="col s12 m12 l12 center">
                                <h5>Select Generation and Year</h5>
                            </div>
                        </div>
                        <div v-if="(year_production !== null) && (selected_generations_production !== null) && (show_production == true)">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h5>Production Indices</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h6>Feeding Record</h6>
                                </div>
                                <div class="col s12 m12 l12">
                                    <table class="bordered responsive-table centered">
                                        <thead>
                                            <tr>
                                                <th>Family</th>
                                                <th>Total Offered</th>
                                                <th>Avg Offered</th>
                                                <th>Std Dev</th>
                                                <th>Min</th>
                                                <th>Max</th>
                                                <th>Total Refused</th>
                                                <th>Avg Refused</th>
                                                <th>Std Dev</th>
                                                <th>Min</th>
                                                <th>Max</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(feeding_record, index) in feeding_records" :key="index">
                                                <td>{{index}}</td>
                                                <td>{{getTotalFeeding(feeding_record)}}</td>
                                                <td>{{getAvgOffered(feeding_record)}}</td>
                                                <td>{{getStdOffered(feeding_record)}}</td>
                                                <td>{{getMinOffered(feeding_record)}}</td>
                                                <td>{{getMaxOffered(feeding_record)}}</td>
                                                <td>{{getTotalRefused(feeding_record)}}</td>
                                                <td>{{getAvgRefused(feeding_record)}}</td>
                                                <td>{{getStdRefused(feeding_record)}}</td>
                                                <td>{{getMinRefused(feeding_record)}}</td>
                                                <td>{{getMaxRefused(feeding_record)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h6>Growth Record</h6>
                                </div>
                                <div class="col s12 m12 l12">
                                    <table class="bordered responsive-table centered">
                                        <thead>
                                            <tr>
                                                <th>Family</th>
                                                <th>Collection Day</th>
                                                <th>Avg(<i class="fas fa-mars"></i>) Weight</th>
                                                <th>Min(<i class="fas fa-mars"></i>) Weight</th>
                                                <th>Max(<i class="fas fa-mars"></i>) Weight</th>
                                                <th>SD(<i class="fas fa-mars"></i>) Weight</th>
                                                <th>Avg(<i class="fas fa-venus"></i>) Weight</th>
                                                <th>Min(<i class="fas fa-venus"></i>) Weight</th>
                                                <th>Max(<i class="fas fa-venus"></i>) Weight</th>
                                                <th>SD(<i class="fas fa-venus"></i>) Weight</th>
                                                <th>Avg(<i class="fas fa-venus-mars"></i>) Weight</th>
                                                <th>Min(<i class="fas fa-venus-mars"></i>) Weight</th>
                                                <th>Max(<i class="fas fa-venus-mars"></i>) Weight</th>
                                                <th>SD(<i class="fas fa-venus-mars"></i>) Weight</th>
                                            </tr>
                                        </thead>

                                        <tbody v-for="(growth_record, index) in growth_records" :key="index">
                                            <tr>
                                                <td>{{index}}</td>
                                                <td>{{getGrowthData(growth_record)[0].day}}</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>{{getGrowthAverage(getGrowthData(growth_record)[0].weight_per_head)}}</td>
                                                <td>{{getGrowthMin(getGrowthData(growth_record)[0].weight_per_head)}}</td>
                                                <td>{{getGrowthMax(getGrowthData(growth_record)[0].weight_per_head)}}</td>
                                                <td>{{getGrowthStd(getGrowthData(growth_record)[0].weight_per_head)}}</td>
                                            </tr>

                                            <tr v-if="getGrowthData(growth_record)[1].day !== undefined">
                                                <td>-</td>
                                                <td>{{getGrowthData(growth_record)[1].day}}</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>{{getGrowthAverage(getGrowthData(growth_record)[1].weight_per_head)}}</td>
                                                <td>{{getGrowthMin(getGrowthData(growth_record)[1].weight_per_head)}}</td>
                                                <td>{{getGrowthMax(getGrowthData(growth_record)[1].weight_per_head)}}</td>
                                                <td>{{getGrowthStd(getGrowthData(growth_record)[1].weight_per_head)}}</td>
                                            </tr>

                                            <tr v-if="getGrowthData(growth_record)[2].day !== undefined">
                                                <td>-</td>
                                                <td>{{getGrowthData(growth_record)[2].day}}</td>
                                                <td>{{getGrowthAverage(getGrowthData(growth_record)[2].weight_per_male)}}</td>
                                                <td>{{getGrowthMin(getGrowthData(growth_record)[2].weight_per_male)}}</td>
                                                <td>{{getGrowthMax(getGrowthData(growth_record)[2].weight_per_male)}}</td>
                                                <td>{{getGrowthStd(getGrowthData(growth_record)[2].weight_per_male)}}</td>
                                                <td>{{getGrowthAverage(getGrowthData(growth_record)[2].weight_per_female)}}</td>
                                                <td>{{getGrowthMin(getGrowthData(growth_record)[2].weight_per_female)}}</td>
                                                <td>{{getGrowthMax(getGrowthData(growth_record)[2].weight_per_female)}}</td>
                                                <td>{{getGrowthStd(getGrowthData(growth_record)[2].weight_per_female)}}</td>
                                                <td>{{getGrowthAverage(getGrowthData(growth_record)[2].weight_per_head)}}</td>
                                                <td>{{getGrowthMin(getGrowthData(growth_record)[2].weight_per_head)}}</td>
                                                <td>{{getGrowthMax(getGrowthData(growth_record)[2].weight_per_head)}}</td>
                                                <td>{{getGrowthStd(getGrowthData(growth_record)[2].weight_per_head)}}</td>
                                            </tr>
                                            <tr v-if="getGrowthData(growth_record)[3].day !== undefined">
                                                <td>-</td>
                                                <td>{{getGrowthData(growth_record)[3].day}}</td>
                                                <td>{{getGrowthAverage(getGrowthData(growth_record)[3].weight_per_male)}}</td>
                                                <td>{{getGrowthMin(getGrowthData(growth_record)[3].weight_per_male)}}</td>
                                                <td>{{getGrowthMax(getGrowthData(growth_record)[3].weight_per_male)}}</td>
                                                <td>{{getGrowthStd(getGrowthData(growth_record)[3].weight_per_male)}}</td>
                                                <td>{{getGrowthAverage(getGrowthData(growth_record)[3].weight_per_female)}}</td>
                                                <td>{{getGrowthMin(getGrowthData(growth_record)[3].weight_per_female)}}</td>
                                                <td>{{getGrowthMax(getGrowthData(growth_record)[3].weight_per_female)}}</td>
                                                <td>{{getGrowthStd(getGrowthData(growth_record)[3].weight_per_female)}}</td>
                                                <td>{{getGrowthAverage(getGrowthData(growth_record)[3].weight_per_head)}}</td>
                                                <td>{{getGrowthMin(getGrowthData(growth_record)[3].weight_per_head)}}</td>
                                                <td>{{getGrowthMax(getGrowthData(growth_record)[3].weight_per_head)}}</td>
                                                <td>{{getGrowthStd(getGrowthData(growth_record)[3].weight_per_head)}}</td>
                                            </tr>
                                            <tr v-if="getGrowthData(growth_record)[4].day !== undefined">
                                                <td>-</td>
                                                <td>{{getGrowthData(growth_record)[4].day}}</td>
                                                <td>{{getGrowthAverage(getGrowthData(growth_record)[4].weight_per_male)}}</td>
                                                <td>{{getGrowthMin(getGrowthData(growth_record)[4].weight_per_male)}}</td>
                                                <td>{{getGrowthMax(getGrowthData(growth_record)[4].weight_per_male)}}</td>
                                                <td>{{getGrowthStd(getGrowthData(growth_record)[4].weight_per_male)}}</td>
                                                <td>{{getGrowthAverage(getGrowthData(growth_record)[4].weight_per_female)}}</td>
                                                <td>{{getGrowthMin(getGrowthData(growth_record)[4].weight_per_female)}}</td>
                                                <td>{{getGrowthMax(getGrowthData(growth_record)[4].weight_per_female)}}</td>
                                                <td>{{getGrowthStd(getGrowthData(growth_record)[4].weight_per_female)}}</td>
                                                <td>{{getGrowthAverage(getGrowthData(growth_record)[4].weight_per_head)}}</td>
                                                <td>{{getGrowthMin(getGrowthData(growth_record)[4].weight_per_head)}}</td>
                                                <td>{{getGrowthMax(getGrowthData(growth_record)[4].weight_per_head)}}</td>
                                                <td>{{getGrowthStd(getGrowthData(growth_record)[4].weight_per_head)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h6>Egg Quality</h6>
                                </div>
                                <div class="col s12 m12 l12">
                                    <table class="bordered responsive-table centered">
                                        <thead>
                                            <tr>
                                                <th>Family</th>
                                                <th>Week</th>
                                                <th>Avg Lt</th>
                                                <th>Avg Wt</th>
                                                <th>Prom Col</th>
                                                <th>Prom Shpe</th>
                                                <th>Avg Width</th>
                                                <th>Avg AH</th>
                                                <th>Avg AW</th>
                                                <th>Avg YW</th>
                                                <th>Prom YC</th>
                                                <th>Avg SW</th>
                                                <th>Avg TT</th>
                                                <th>Avg MT</th>
                                                <th>Avg BT</th>
                                            </tr>
                                        </thead>

                                        <tbody v-for="(eggqual_record, index) in eggqual_records" :key="index">
                                            <tr>
                                                <td>{{index}}</td>
                                                <td>{{getEggQualData(eggqual_record)[0].week}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[0].weight)}}</td>
                                                <td>{{sort(getEggQualData(eggqual_record)[0].color)}}</td>
                                                <td>{{sort(getEggQualData(eggqual_record)[0].shape)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[0].len)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[0].width)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[0].albumen_height)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[0].albumen_weight)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[0].yolk_weight)}}</td>
                                                <td>{{sort(getEggQualData(eggqual_record)[0].yolk_color)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[0].shell_weight)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[0].thickness_top)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[0].thickness_mid)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[0].thickness_bot)}}</td>
                                            </tr>
                                            <tr v-if="getEggQualData(eggqual_record)[1].week !== undefined">
                                                <td></td>
                                                <td>{{getEggQualData(eggqual_record)[1].week}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[1].weight)}}</td>
                                                <td>{{sort(getEggQualData(eggqual_record)[1].color)}}</td>
                                                <td>{{sort(getEggQualData(eggqual_record)[1].shape)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[1].len)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[1].width)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[1].albumen_height)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[1].albumen_weight)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[1].yolk_weight)}}</td>
                                                <td>{{sort(getEggQualData(eggqual_record)[1].yolk_color)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[1].shell_weight)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[1].thickness_top)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[1].thickness_mid)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[1].thickness_bot)}}</td>
                                            </tr>
                                            <tr v-if="getEggQualData(eggqual_record)[2].week !== undefined">
                                                <td></td>
                                                <td>{{getEggQualData(eggqual_record)[2].week}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[2].weight)}}</td>
                                                <td>{{sort(getEggQualData(eggqual_record)[2].color)}}</td>
                                                <td>{{sort(getEggQualData(eggqual_record)[2].shape)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[2].len)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[2].width)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[2].albumen_height)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[2].albumen_weight)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[2].yolk_weight)}}</td>
                                                <td>{{sort(getEggQualData(eggqual_record)[2].yolk_color)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[2].shell_weight)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[2].thickness_top)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[2].thickness_mid)}}</td>
                                                <td>{{getMeanValues(getEggQualData(eggqual_record)[2].thickness_bot)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h6>Egg Production</h6>
                                </div>
                                <div class="col s12 m12 l12">
                                    <table class="bordered responsive-table centered">
                                        <thead>
                                            <tr>
                                                <th>Family</th>
                                                <th>Avg Intact</th>
                                                <th>STD Intact</th>
                                                <th>Avg Egg Weight</th>
                                                <th>STD Egg Weight</th>
                                                <th>Avg Broken</th>
                                                <th>STD Broken</th>
                                                <th>Avg Rejects</th>
                                                <th>STD Rejects</th>
                                            </tr>
                                        </thead>

                                        <tbody v-for="(eggprod_record, index) in eggprod_records" :key="index">
                                            <tr>
                                                <td>{{index}}</td>
                                                <td>{{getMeanValues(getEggProductionData(eggprod_record)[0])}}</td>
                                                <td>{{getStdValues(getEggProductionData(eggprod_record)[0])}}</td>
                                                <td>{{getMeanValues(getEggProductionData(eggprod_record)[1])}}</td>
                                                <td>{{getStdValues(getEggProductionData(eggprod_record)[1])}}</td>
                                                <td>{{getMeanValues(getEggProductionData(eggprod_record)[2])}}</td>
                                                <td>{{getStdValues(getEggProductionData(eggprod_record)[2])}}</td>
                                                <td>{{getMeanValues(getEggProductionData(eggprod_record)[3])}}</td>
                                                <td>{{getStdValues(getEggProductionData(eggprod_record)[3])}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h6>Hatchery Records</h6>
                                </div>
                                <div class="col s12 m12 l12">
                                    <table class="bordered responsive-table centered">
                                        <thead>
                                            <tr>
                                                <th>Family</th>
                                                <th>Mean Eggs Set</th>
                                                <th>STD Eggs Set</th>
                                                <th>Mean Fertile</th>
                                                <th>STD Fertile</th>
                                                <th>Mean Hatched</th>
                                                <th>STD Hatched</th>
                                                <th>Mean Fertility</th>
                                                <th>STD Fertility</th>
                                                <th>Mean Hatchability</th>
                                                <th>STD Hatchability</th>
                                            </tr>
                                        </thead>

                                        <tbody v-for="(hatchery_record, index) in hatchery_records" :key="index">
                                            <tr>
                                                <td>{{index}}</td>
                                                <td>{{getMeanValues(getHatcheryData(hatchery_record)[0])}}</td>
                                                <td>{{getStdValues(getHatcheryData(hatchery_record)[0])}}</td>
                                                <td>{{getMeanValues(getHatcheryData(hatchery_record)[1])}}</td>
                                                <td>{{getStdValues(getHatcheryData(hatchery_record)[1])}}</td>
                                                <td>{{getMeanValues(getHatcheryData(hatchery_record)[2])}}</td>
                                                <td>{{getStdValues(getHatcheryData(hatchery_record)[2])}}</td>
                                                <td>{{getMeanValues(getHatcheryData(hatchery_record)[3])}}</td>
                                                <td>{{getStdValues(getHatcheryData(hatchery_record)[3])}}</td>
                                                <td>{{getMeanValues(getHatcheryData(hatchery_record)[4])}}</td>
                                                <td>{{getStdValues(getHatcheryData(hatchery_record)[4])}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="inventory == true">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h5>Inventory</h5>
                            </div>
                        </div>
                    </div>
                 
            </div>
        </div>
    </div>
</template>

<script>
    const math = require('mathjs');
    import Datepicker from 'vuejs-datepicker';
    var moment = require('moment');
    export default {
        components : {
            Datepicker
        },
        data () {
            return {
                generations : [],
                selected_generations : null,
                selected_generations_production : null,
                selected_generations_inventory : null,
                pheno_morpho_loading : true,
                feeding_loading : true,
                growth_loading : true,
                eggprod_loading : true,
                eggqual_loading : true,
                hatchery_loading : true,
                pheno_morpho : {},
                pheno_morpho_keys : '',
                feeding_records : {},
                growth_records : {},
                eggqual_records : {},
                eggprod_records : {},
                hatchery_records : {},
                year_production : null,
                year_inventory : null,
                
                facet : false,
                production : false,
                inventory : false,
                show_production : false,
            }
        },
        methods : {
            fetchGeneration : async function () {
                try {
                    const response = await axios.get('fetch_generation');
                    this.generations = response.data;
                } catch (error) {
                    console.error("Generations still loading");
                }
            },
            getPhenoMorphoFamilySummary : async function () {
                try {
                    const response = await axios.get('family_pheno_morpho_genfam/'+this.selected_generations.id);
                    this.pheno_morpho = response.data;
                    this.production_loading = false;
                } catch (error) {
                    this.production_loading = true;
                }
            },
            getFeedingRecord : async function () {
                try {
                    const response = await axios.get('family_feeding_summary/'+this.selected_generations_production.id+'/'+this.customFormatter(this.year_production));
                    this.feeding_records = response.data;
                    this.feeding_loading = false;
                } catch (error) {
                    this.feeding_loading = true;
                }
            },
            getGrowthRecord : async function () {
                try {
                    const response = await axios.get('family_growth_summary/'+this.selected_generations_production.id+'/'+this.customFormatter(this.year_production));
                    this.growth_records = response.data;
                    this.growth_loading = false;
                } catch (error) {
                    this.growth_loading = true;
                }
            },
            getEggQualityRecord : async function () {
                try {
                    const response = await axios.get('family_egg_quality_summary/'+this.selected_generations_production.id+'/'+this.customFormatter(this.year_production));
                    this.eggqual_records = response.data;
                    this.eggqual_loading = false;
                } catch (error) {
                    this.eggqual_loading = true;
                }
            },
            getEggProductionRecord : async function () {
                try {
                    const response = await axios.get('family_egg_production_summary/'+this.selected_generations_production.id+'/'+this.customFormatter(this.year_production));
                    this.eggprod_records = response.data;
                    this.eggprod_loading = false;
                } catch (error) {
                    this.eggprod_loading = true;
                }
            },
            getHatcheryRecord : async function () {
                try {
                    const response = await axios.get('family_hatchery_record_summary/'+this.selected_generations_production.id+'/'+this.customFormatter(this.year_production));
                    this.hatchery_records = response.data;
                    this.hatchery_loading = false;
                } catch (error) {
                    this.hatchery_loading = true;
                }
            },
            getProductionData : function () {
                this.getFeedingRecord();
                this.getGrowthRecord();
                this.getEggQualityRecord();
                this.getEggProductionRecord();
                this.getHatcheryRecord();
            },
            getPercentage : function (object, value){
               var array = Object.values(object);
               var sum = 0;
               array.forEach(element => {
                   sum = sum + element;
               });
               return (value/sum)*100
            },
            getMinimum : function (object){
                var array = Object.values(object);
                return (array.reduce(function(a, b) {
                    return Math.min(a, b);
                }));
            },
            getMaximum : function (object){
                var array = Object.values(object);
                return (array.reduce(function(a, b) {
                    return Math.max(a, b);
                }));
            },
            getMean : function (object){
                var array = Object.values(object);
                var mean = math.mean(array).toFixed(3);
                return mean;
            },
            getStandardDeviation : function (object){
                var array = Object.values(object);
                var std = math.std(array).toFixed(3);
                return std;
            },
            customFormatter : function (date) {
                var formatted = moment(date).format('YYYY')
                return formatted;
            },
            getTotalFeeding : function (object) {
                var total = object;
                var total_offered = [];
                total.forEach(element => {
                    total_offered.push(element.amount_offered);
                });
                return math.sum(total_offered).toFixed(3);
            },
            getMinOffered : function (object) {
                var total = object;
                var offered = [];
                total.forEach(element => {
                    offered.push(element.amount_offered);
                });
                return math.min(offered).toFixed(3);
            },
            getMaxOffered : function (object) {
                var total = object;
                var offered = [];
                total.forEach(element => {
                    offered.push(element.amount_offered);
                });
                return math.max(offered).toFixed(3);
            },
            getAvgOffered : function (object) {
                var total = object;
                var offered = [];
                total.forEach(element => {
                    offered.push(element.amount_offered);
                });
                return math.mean(offered).toFixed(3);
            },
            getStdOffered : function (object) {
                var total = object;
                var offered = [];
                total.forEach(element => {
                    offered.push(element.amount_offered);
                });
                return math.std(offered).toFixed(3);
            },
            getTotalRefused : function (object) {
                var total = object;
                var total_refused = [];
                total.forEach(element => {
                    total_refused.push(element.amount_refused);
                });
                return math.sum(total_refused).toFixed(3);
            },
            getMinRefused : function (object) {
                var total = object;
                var refused = [];
                total.forEach(element => {
                    refused.push(element.amount_refused);
                });
                return math.min(refused).toFixed(3);
            },
            getMaxRefused : function (object) {
                var total = object;
                var refused = [];
                total.forEach(element => {
                    refused.push(element.amount_refused);
                });
                return math.max(refused).toFixed(3);
            },
            getAvgRefused : function (object) {
                var total = object;
                var refused = [];
                total.forEach(element => {
                    refused.push(element.amount_refused);
                });
                return math.mean(refused).toFixed(3);
            },
            getStdRefused : function (object) {
                var total = object;
                var refused = [];
                total.forEach(element => {
                    refused.push(element.amount_refused);
                });
                return math.std(refused).toFixed(3);
            },
            getGrowthData : function (object) {
                var data = object;
                var summary = [];
                var day0 = [];
                var day21 = [];
                var day45 = [];
                var day60 = [];
                var day100 = [];
                data.forEach(element => {
                    if(element.collection_day == 0){
                        if(typeof day0["weight_per_head"] === 'undefined'){
                            day0["day"] = 0;
                            day0["weight_per_head"] = element.total_weight/element.total_quantity;
                        }else{
                            day0["weight_per_head"].push(element.total_weight/element.total_quantity);
                        }
                    }else if(element.collection_day == 21){
                        if(typeof day21["weight_per_head"] === 'undefined'){
                            day21["day"] = 21;
                            day21["weight_per_head"] = element.total_weight/element.total_quantity;
                        }else{
                            day21["weight_per_head"].push(element.total_weight/element.total_quantity);
                        }
                    }else if(element.collection_day == 45){
                        if((typeof day45["weight_per_head"] === 'undefined') && typeof day45["weight_per_male"] === 'undefined' && typeof day45["weight_per_female"] === 'undefined'){
                            day45["day"] = 45;
                            day45["weight_per_head"] = element.total_weight/element.total_quantity;
                            day45["weight_per_male"] = element.male_weight/element.male_quantity;
                            day45["weight_per_female"] = element.female_weight/element.female_quantity;                            
                        }else{
                            day45["weight_per_head"].push(element.total_weight/element.total_quantity);
                            day45["weight_per_male"].push(element.male_weight/element.male_quantity);
                            day45["weight_per_female"].push(element.female_weight/element.female_quantity);
                        }
                    }else if(element.collection_day == 60){
                        if(typeof day60["weight_per_head"] === 'undefined' && typeof day60["weight_per_male"] === 'undefined' && typeof day60["weight_per_female"] === 'undefined'){
                            day60["day"] = 60;
                            day60["weight_per_head"] = element.total_weight/element.total_quantity;
                            day60["weight_per_male"] = element.male_weight/element.male_quantity;
                            day60["weight_per_female"] = element.female_weight/element.female_quantity;
                        }else{
                            day60["weight_per_head"].push(element.total_weight/element.total_quantity);
                            day60["weight_per_male"].push(element.male_weight/element.male_quantity);
                            day60["weight_per_female"].push(element.female_weight/element.female_quantity);
                        }
                    }else if(element.collection_day == 100){
                        if(typeof day100["weight_per_head"] === 'undefined' && typeof day100["weight_per_male"] === 'undefined' && typeof day100["weight_per_female"] === 'undefined'){
                            day100["day"] = 100;
                            day100["weight_per_head"] = element.total_weight/element.total_quantity;
                            day100["weight_per_male"] = element.male_weight/element.male_quantity;
                            day100["weight_per_female"] = element.female_weight/element.female_quantity;
                        }else{
                            day100["weight_per_head"].push(element.total_weight/element.total_quantity);
                            day100["weight_per_male"].push(element.male_weight/element.male_quantity);
                            day100["weight_per_female"].push(element.female_weight/element.female_quantity);
                        }
                    }
                });
                summary.push(day0, day21, day45, day60, day100);
                return summary;
            },
            getGrowthAverage : function (array) {
                if(array === undefined || array.length == 0){
                    return null;
                }else{
                    return math.mean(array).toFixed(3);
                }
            },
            getGrowthStd : function (array) {
                if(array === undefined || array.length == 0){
                    return null;
                }else{
                    return math.std(array).toFixed(3);
                }
            },
            getGrowthMin : function (array) {
                if(array === undefined || array.length == 0){
                    return null;
                }else{
                    return math.min(array).toFixed(3);
                }
            },
            getGrowthMax : function (array) {
                if(array === undefined || array.length == 0){
                    return null;
                }else{
                    return math.min(array).toFixed(3);
                }
            },
            getEggQualData : function (object) {
                var data = object;
                var summary = [];
                var week35 = [];
                var week40 = [];
                var week60 = [];
                data.forEach(element => {
                    if(element.egg_quality_at === 35){
                        if(typeof week35['week'] === 'undefined'){
                            week35['week'] = 35;
                            week35['weight'] = [];
                            week35['color'] = [];
                            week35['shape'] = [];
                            week35['len'] = [];
                            week35['width'] = [];
                            week35['albumen_height'] = [];
                            week35['albumen_weight'] = [];
                            week35['yolk_weight'] = [];
                            week35['yolk_color'] = [];
                            week35['shell_weight'] = [];
                            week35['thickness_top'] = [];
                            week35['thickness_mid'] = [];
                            week35['thickness_bot'] = [];
                        }
                        week35['weight'].push(element.weight);
                        if(typeof week35['color'][element.color]  === 'undefined'){
                            week35['color'][element.color] = 1;
                        }else{
                            week35['color'][element.color]++;
                        }
                        if(typeof week35['shape'][element.shape]  === 'undefined'){
                            week35['shape'][element.shape] = 1;
                        }else{
                            week35['shape'][element.shape]++ ;
                        }
                        week35['len'].push(element.len);
                        week35['width'].push(element.width);
                        week35['albumen_height'].push(element.albumen_height);
                        week35['albumen_weight'].push(element.albumen_weight);
                        week35['yolk_weight'].push(element.yolk_weight);
                         if(typeof week35['yolk_color'][element.yolk_color]  === 'undefined'){
                            week35['yolk_color'][element.yolk_color] = 1;
                        }else{
                            week35['yolk_color'][element.yolk_color]++;
                        }
                        week35['shell_weight'].push(element.shell_weight);
                        week35['thickness_top'].push(element.thickness_top);
                        week35['thickness_mid'].push(element.thickness_mid);
                        week35['thickness_bot'].push(element.thickness_bot);
                    }else if(element.egg_quality_at === 40){
                        if(typeof week40['week'] === 'undefined'){
                            week40['week'] = 40;
                            week40['weight'] = [];
                            week40['color'] = [];
                            week40['shape'] = [];
                            week40['len'] = [];
                            week40['width'] = [];
                            week40['albumen_height'] = [];
                            week40['albumen_weight'] = [];
                            week40['yolk_weight'] = [];
                            week40['yolk_color'] = [];
                            week40['shell_weight'] = [];
                            week40['thickness_top'] = [];
                            week40['thickness_mid'] = [];
                            week40['thickness_bot'] = [];
                        }
                        week40['weight'].push(element.weight);
                        if(typeof week40['color'][element.color]  === 'undefined'){
                            week40['color'][element.color] = 1;
                        }else{
                            week40['color'][element.color]++;
                        }
                        if(typeof week40['shape'][element.shape]  === 'undefined'){
                            week40['shape'][element.shape] = 1;
                        }else{
                            week40['shape'][element.shape]++;
                        }
                        week40["len"].push(element.len);
                        week40['width'].push(element.width);
                        week40['albumen_height'].push(element.albumen_height);
                        week40['albumen_weight'].push(element.albumen_weight);
                        week40['yolk_weight'].push(element.yolk_weight);
                         if(typeof week40['yolk_color'][element.yolk_color]  === 'undefined'){
                            week40['yolk_color'][element.yolk_color] = 1;
                        }else{
                            week40['yolk_color'][element.yolk_color]++;
                        }
                        week40['shell_weight'].push(element.shell_weight);
                        week40['thickness_top'].push(element.thickness_top);
                        week40['thickness_mid'].push(element.thickness_mid);
                        week40['thickness_bot'].push(element.thickness_bot);
                    }else if(element.egg_quality_at === 60){
                        if(typeof week60['week'] === 'undefined'){
                            week60['week'] = 60;
                            week60['weight'] = [];
                            week60['color'] = [];
                            week60['shape'] = [];
                            week60['len'] = [];
                            week60['width'] = [];
                            week60['albumen_height'] = [];
                            week60['albumen_weight'] = [];
                            week60['yolk_weight'] = [];
                            week60['yolk_color'] = [];
                            week60['shell_weight'] = [];
                            week60['thickness_top'] = [];
                            week60['thickness_mid'] = [];
                            week60['thickness_bot'] = [];
                        }
                        week60['weight'].push(element.weight);
                        if(typeof week60['color'][element.color]  === 'undefined'){
                            week60['color'][element.color] = 1;
                        }else{
                            week60['color'][element.color]++;
                        }
                        if(typeof week60['shape'][element.shape]  === 'undefined'){
                            week60['shape'][element.shape] = 1;
                        }else{
                            week60['shape'][element.shape]++;
                        }
                        week60["len"].push(element.len);
                        week60['width'].push(element.width);
                        week60['albumen_height'].push(element.albumen_height);
                        week60['albumen_weight'].push(element.albumen_weight);
                        week60['yolk_weight'].push(element.yolk_weight);
                         if(week60['yolk_color'][element.yolk_color]  === 'undefined'){
                            week60['yolk_color'][element.yolk_color] = 1;
                        }else{
                            week60['yolk_color'][element.yolk_color]++;
                        }
                        week60['shell_weight'].push(element.shell_weight);
                        week60['thickness_top'].push(element.thickness_top);
                        week60['thickness_mid'].push(element.thickness_mid);
                        week60['thickness_bot'].push(element.thickness_bot);
                    }
                });
                summary.push(week35, week40, week60);
                return summary;
            },
            getEggProductionData : function (object) {
                var data = object;
                var summary = [];
                var intact = [];
                var weight = [];
                var broken = [];
                var reject = [];

                data.forEach(element => {
                    intact.push(element.total_eggs_intact);
                    weight.push(element.total_egg_weight);
                    broken.push(element.total_broken);
                    reject.push(element.total_rejects);
                });
                summary.push(intact, weight, broken, reject);
                return summary;
            },
            getMeanValues : function (array){
                var filtered = math.filter(array, /[0-9]+/);
                if(filtered === undefined || filtered.length === 0){
                    return;
                }else{
                    return math.mean(filtered).toFixed(3);
                }
                
            },
            getStdValues : function (array){
                var filtered = math.filter(array, /[0-9]+/);
                if(filtered === undefined || filtered.length === 0){
                    return;
                }else{
                    return math.std(filtered).toFixed(3);
                }
            },
            getHatcheryData : function (object) {
                var data = object;
                var set = [];
                var hatched = [];
                var fertile = [];
                var hatchability = [];
                var fertility = [];
                var summary = [];
                data.forEach(element => {
                    if(element.number_eggs_set != null){
                        set.push(element.number_eggs_set);
                    }else{
                        set.push(0);
                    }
                    if(element.number_fertile != null){
                        fertile.push(element.number_fertile);
                    }else{
                        fertile.push(0);
                    }
                    if(element.number_hatched != null){
                        hatched.push(element.number_hatched);
                    }else{
                        hatched.push(0);
                    }
                    if(element.number_eggs_set != 0 || element.number_eggs_set != null){
                        hatchability.push((element.number_hatched/element.number_eggs_set) * 100);
                        fertility.push((element.number_fertile/element.number_eggs_set) * 100);
                    }else{
                        hatchability.push(0);
                        fertility.push(0);
                    }
                });
                summary.push(set, fertile, hatched, hatchability, fertility);
                return summary;
            },
            capitalize : function (string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },
            sort : function (colors) {
                var keys = [];
                var max = 0;
                for (var val in colors) {
                    if(colors[val] > max){
                        max = colors[val];
                        keys = [];
                        keys.push(val);
                    }else if(colors[val] == max){
                        keys.push(val);
                    }
                }
                return keys.join(", ");
            }
        },
        mounted() {
            this.fetchGeneration();
        },
        created() {

        }
    }
</script>

<style>
    .col > .btn {
        width: 100%;
    }
</style>