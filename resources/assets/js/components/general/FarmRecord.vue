<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
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
                    <div class="center" v-if="pheno_morpho_loading">
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
            </div>
        </div>
    </div>
</template>

<script>
    const math = require('mathjs')
    export default {
        data () {
            return {
                generations : [],
                selected_generations : "",
                pheno_morpho_loading : true,
                pheno_morpho : {},
                pheno_morpho_keys : '',
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
        },
        mounted() {
            console.log('Component mounted.');
            this.fetchGeneration();  
        },
        created() {

        }
    }
</script>