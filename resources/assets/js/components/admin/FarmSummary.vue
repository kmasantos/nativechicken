<template>
    <div>
        <a href="" id="downloadlink" ref="csvfiledownload" hidden="true" download="mycsv.csv">download</a>
        <div class="row">
            <div class="col s12 m12 l12 center-align" v-if="!users.data">
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
            <div class="col s12 m12 l12" v-else>
                <div class="center-align" v-if="users.data.length == 0">
                <h4>No users to display</h4> 
                </div>
                <table class="bordered highlight responsive-table centered" v-else>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Farm Code</th>
                            <th>Farm</th>
                            <th>Generate Summary</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="user in users.data" :key="user.user_id">
                            <td>{{user.user_name}}</td>
                            <td>{{user.code}}</td>
                            <td>{{user.farm_name}}</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a 
                                        @click.prevent="setCurrentUser(user.farm_id)"
                                        href="#generation_modal"
                                        style="margin: 4px;"
                                        class="indigo white-text darken-1 modal-trigger center-align btn" 
                                        data-position="bottom" data-delay="50" data-tooltip="Generation Summary"
                                    >
                                        Generation
                                    </a>
                                    <a 
                                        @click.prevent="setCurrentUser(user.farm_id); getGenerations(user.farm_id)"
                                        href="#family_modal"
                                        style="margin: 4px;"
                                        class="indigo white-text darken-1 modal-trigger center-align btn" 
                                        data-position="bottom" data-delay="50" data-tooltip="Generation Summary"
                                    >
                                        Family
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="col s12 m12 l12 center">
                    <pagination :data="users" @pagination-change-page="getUserList"></pagination>
                </div>  
            </div>
        </div>
        <div id="generation_modal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="bordered highlight responsive-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="center-align">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td>Phenotypic - Replacement</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Phenotypic - Breeder</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr> -->
                        <tr>
                            <td>Morphometric - Replacement</td>
                            <td>
                                <td>
                                <div class="col s12 m12 l12 center">
                                    <a @click.prevent="getMorpoRepla(currentUser)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Morphometric - Breeder</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a @click.prevent="getMorpoBreeder(currentUser)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Growth Records</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a @click.prevent="getGrowthRecord(currentUser)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Feeding Perfomance</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a @click.prevent="getFeedingSummary(currentUser)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Egg Production</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a @click.prevent="getEggProduction(currentUser)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Hatchery</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a @click.prevent="getHatcherySummary(currentUser)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Egg Quality</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a @click.prevent="getEggQuality(currentUser)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Mortality</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a @click.prevent="getMortality(currentUser)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sales</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a @click.prevent="getSales(currentUser)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a @click.prevent="setCurrentUser(null)" href="javascript:void(0);" class="modal-action modal-close waves-effect waves-indigo btn-flat">Close</a>
            </div>
        </div>
        <div id="family_modal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s6 m6 l6">
                        <label>Choose a generation</label>
                        <select v-model="selectedGeneration" class="browser-default">
                            <option v-for="generation in generations" :key="generation.id" v-bind:value="generation">{{generation.number}}</option>
                        </select>
                    </div>
                    <div class="col s12 m12 l12" v-if="selectedGeneration">
                        <table class="bordered highlight responsive-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="center-align">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>Phenotypic - Replacement</td>
                                    <td>
                                        <div class="col s12 m12 l12 center">
                                            <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                                Generate CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phenotypic - Breeder</td>
                                    <td>
                                        <div class="col s12 m12 l12 center">
                                            <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                                Generate CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Morphometric - Replacement</td>
                                    <td>
                                        <div class="col s12 m12 l12 center">
                                            <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                                Generate CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Morphometric - Breeder</td>
                                    <td>
                                        <div class="col s12 m12 l12 center">
                                            <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                                Generate CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td>Growth Records</td>
                                    <td>
                                        <div class="col s12 m12 l12 center">
                                            <a @click.prevent="getFamGrowthRecord(selectedGeneration)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                                Generate CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Feeding Perfomance</td>
                                    <td>
                                        <div class="col s12 m12 l12 center">
                                            <a @click.prevent="getFamFeedingPerformance(selectedGeneration)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                                Generate CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Egg Production</td>
                                    <td>
                                        <div class="col s12 m12 l12 center">
                                            <a @click.prevent="getFamEggProduction(selectedGeneration)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                                Generate CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hatchery</td>
                                    <td>
                                        <div class="col s12 m12 l12 center">
                                            <a @click.prevent="getFamHatchery(selectedGeneration)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                                Generate CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Egg Quality</td>
                                    <td>
                                        <div class="col s12 m12 l12 center">
                                            <a @click.prevent="getFamEggQuality(selectedGeneration)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                                Generate CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mortality</td>
                                    <td>
                                        <div class="col s12 m12 l12 center">
                                            <a @click.prevent="getFamMortality(selectedGeneration)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                                Generate CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sales</td>
                                    <td>
                                        <div class="col s12 m12 l12 center">
                                            <a @click.prevent="getFamSales(selectedGeneration)" href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                                Generate CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <a @click.prevent="setCurrentUser(null); generations = null; selectedGeneration = null;" href="javascript:void(0);" class="modal-action modal-close waves-effect waves-indigo btn-flat">Close</a>
            </div>
        </div>
    </div>
</template>

<script>

    import { get, isObject, isArray } from 'lodash';

    export default {
        data () {
            return {
                users : {},
                currentUser: null,
                generations: null,
                selectedGeneration: null,
                stgs: {
                    'brooder_data' : 'Brooder',
                    'replacement_data' : 'Replacement',
                    'breeder_data' : 'Breeder',
                },
                gndrs: {
                    male: 'Male',
                    female: 'Female'
                },
                eq: {
                    'weight': 'Egg Weight (g)',
                    'length': 'Egg Length (mm)',
                    'width': 'Egg Width (mm)',
                    'shell_thickness': 'Shell Thickness (mm)',
                    'shell_weight': 'Shell Weight (g)',
                    'yolk_weight': 'Yolk Weight (g)',
                    'albumen_weight': 'Albumen Weight (g)',
                    'albumen_height': 'Albumen Height (mm)',
                    'shape': 'Egg Shape',
                    'color': 'Egg Color',
                },
                fp: {
                    'total_fed': 'Total Fed',
                    'total_refused': 'Total Refused',
                    'total_consumption': 'Total Consumption',
                },
                mC: {
                    'height': 'Height (cm)',
                    'weight': 'Weight (g)',
                    'blength': 'Body Length (cm)',
                    'ccircumference': 'Chest Circumeference (cm)',
                    'wspan': 'Wing Span (cm)',
                    'slength': 'Shank Length (cm)',
                }
            }
        },
        methods : {

            // Fam

            getFamFeedingPerformance: async function(selectedGeneration) {
                const stages = ['brooder_data', 'replacement_data', 'breeder_data'];
                const feedPerf = [
                    'total_fed',
                    'total_refused',
                    'total_consumption',
                ];
                const response = await axios.get('summary/fam_feeding_performance/' + selectedGeneration.id);
                const { 
                    lines, breeder_data, brooder_data, replacement_data
                } = response.data;

                if (this.checkAllEmpty([breeder_data, brooder_data, replacement_data])) {
                    return alert('No data to generate csv');
                }

                const csvData = lines.reduce((acc, line, lIndex) => {
                    
                    const { number: lineNumber, families } = line;

                    const familiesData = families.map(({ number: famNumber }, fIndex) => {
                        const feedData = feedPerf.map(f => {

                            const stagesData = stages.map(stage => {
                                return get(response.data, `${stage}.${lineNumber}.${famNumber}.${f}`, '');
                            });

                            return [
                                lineNumber,
                                famNumber,
                                this.fp[f],
                                ...stagesData,
                            ].join(',');
                        });

                        return feedData.join('\n');
                    });

                    return acc + familiesData.join('\n') + '\n';

                }, 'Line, Family, Feeding Performance, Brooders, Replacements, Breeder \n');
                this.downloadCSV(csvData, `generation_${selectedGeneration.number}_feeding_performance`);
            },

            getFamGrowthRecord: async function(selectedGeneration) {
                const days = [ 0, 21, 45, 75, 100];
                const response = await axios.get('summary/fam_growth/' + selectedGeneration.id);
                
                const { lines, growth_records } = response.data;

                if (this.checkAllEmpty([growth_records])) {
                    return alert('No data to generate csv');
                }

                const csvData = lines.reduce((acc, line, lIndex) => {
                    const { number: lineNumber, families } = line;

                    const lineData = growth_records[lineNumber];

                    const familiesData = families.map(({ number: famNumber }, fIndex) => {
                        const famData = lineData[famNumber];
                        const daysData = days.map((day, dIndex)=> {
                            return [
                                lineNumber,
                                famNumber,
                                day,
                                this.formatFloat(get(famData, `${day}.male_mean`, '')),
                                this.formatFloat(get(famData, `${day}.male_sd`, '')),
                                this.formatFloat(get(famData, `${day}.female_mean`, '')),
                                this.formatFloat(get(famData, `${day}.female_sd`, '')),
                                this.formatFloat(get(famData, `${day}.total_mean`, '')),
                                this.formatFloat(get(famData, `${day}.total_sd`, '')),
                            ].join(',');
                        });

                        return daysData.join('\n');
                    });

                    return acc + familiesData.join('\n') + '\n';


                }, 'Line, Family, Age, Male (Mean), Male (SD), Female (Mean), Female (SD), Total (Mean), Total (SD) \n');
                this.downloadCSV(csvData, `generation_${selectedGeneration.number}_growth_record`);
            },

            getFamEggQuality: async function(selectedGeneration) {
                const qualityAt = [35, 40, 60];
                const eggQuality = [
                    'weight',
                    'length',
                    'width',
                    'shell_thickness',
                    'shell_weight',
                    'yolk_weight',
                    'albumen_weight',
                    'albumen_height',
                ];
                const response = await axios.get('summary/fam_egg_quality/' + selectedGeneration.id);
                
                const { lines, egg_quality } = response.data;
                
                if (egg_quality && egg_quality.length === 0) {
                    return alert('No data to generate csv');
                }

                const csvData = lines.reduce((acc, line) => {
                    
                    const { number: lineNumber, families } = line;

                    const lineData = egg_quality[lineNumber];

                    const familiesData = families.map(({ number: famNumber }, index) => {

                        const famData = get(lineData, `${famNumber}`, null);
 
                        const eggData = eggQuality.map(eq => {         
                            const qaData = qualityAt.map(week => {
                                return [
                                    this.formatFloat(get(famData, `${week}.${eq}.mean`, '')),
                                    this.formatFloat(get(famData, `${week}.${eq}.std`, ''))
                                ].join(',');
                            });
                            return [
                                lineNumber,
                                famNumber,
                                this.eq[eq],
                                ...qaData
                            ].join(','); 
                        });

                        const secondPart = ['shape', 'color'].map(eq => {
                            const qaData = qualityAt.map(week => {
                                return [
                                    get(famData, `${week}.${eq}`, '')
                                ].join(',');
                            });
                            return [
                                '',
                                '',
                                this.eq[eq],
                                ...qaData
                            ].join(',');
                        });

                        return [
                            ...eggData,
                            ',,,Week 35, Week 40, Week 60',
                            ...secondPart,
                            ''
                        ].join('\n');
                    });

                    return acc + familiesData.join('\n') + '\n';
 
                }, 'Line, Family, Egg Quality, Week 35 (Mean), Week 35 (SD), Week 40 (Mean), Week 40 (SD), Week 60 (Mean), Week 60 (SD) \n');

                this.downloadCSV(csvData, `generation_${selectedGeneration.number}_egg_quality`);
            },

            getFamMortality: async function(selectedGeneration) {
                const stages = ['brooder_data', 'replacement_data', 'breeder_data'];
                const reasons = ['Sickness', 'Trauma - Natural', 'Trauma - Predatory'];
                const genders = ['male', 'female'];
                const response = await axios.get('summary/fam_mortality/' + selectedGeneration.id);

                const { 
                    lines, breeder_data, brooder_data, replacement_data
                } = response.data;

                if (this.checkAllEmpty([breeder_data, brooder_data, replacement_data])) {
                    return alert('No data to generate csv');
                }

                const csvData = lines.reduce((acc, line, lIndex) => {
                    
                    const { number: lineNumber, families } = line;

                    const familiesData = families.map((fam, fIndex) => {

                        const { number: famNumber } = fam;

                        const stagesData = stages.reduce((as, stage, sIndex) => {
                            
                            const stageData = get(response.data, `${stage}.${lineNumber}.${famNumber}`, null);
                            
                            const gData = genders.map((gender, gIndex) => {
                                const rData = reasons.map(reason => {
                                    return get(stageData, `${reason}.${gender}`, null);
                                });
                                
                                return [
                                    fIndex === 0 && gIndex === 0 && sIndex === 0 ? lineNumber : '',
                                    gIndex === 0 && sIndex === 0 ? famNumber : '',
                                    `${this.stgs[stage]} (${this.gndrs[gender]})`,
                                    ...rData
                                ].join(',');

                            });

                            as.push(gData.join('\n'));

                            return as;

                        }, []);

                        return stagesData.join('\n');
                    });

                    return acc + familiesData.join('\n') + '\n';

                }, 'Line, Family, Stage, Sickness, Trauma - Natural, Trauma - Predatory \n');
                this.downloadCSV(csvData, `generation_${selectedGeneration.number}_mortality`);
            },

            getFamSales: async function(selectedGeneration) {
                const stages = ['brooder_data', 'replacement_data', 'breeder_data'];
                const response = await axios.get('summary/fam_sales/' + selectedGeneration.id);
                const { 
                    lines, breeder_data, brooder_data, replacement_data
                } = response.data;

                if (this.checkAllEmpty([breeder_data, brooder_data, replacement_data])) {
                    return alert('No data to generate csv');
                }

                const csvData = lines.reduce((acc, line, lIndex) => {
                    
                    const { number: lineNumber, families } = line;

                    const familiesData = families.map((fam, fIndex) => {

                        const { number: famNumber } = fam;

                        const stagesData = stages.map((stage, sIndex) => {
                            
                            const stageData = get(response.data, `${stage}.${lineNumber}.${famNumber}`, null);

                            return [
                                fIndex === 0 && sIndex === 0 ? lineNumber : '',
                                sIndex === 0 ? famNumber : '',
                                this.stgs[stage],
                                get(stageData, 'male', ''),
                                get(stageData, 'female', ''),
                                get(stageData, 'total', ''),
                                this.formatFloat(get(stageData, 'price_mean', '')),
                                this.formatFloat(get(stageData, 'price_sd', '')),
                            ].join(',');

                        }, []);

                        return stagesData.join('\n');
                    });

                    return acc + familiesData.join('\n') + '\n';

                }, 'Line, Family, Stage, Male, Female, Total, Price (Mean), Price (SD) \n');

                this.downloadCSV(csvData, `generation_${selectedGeneration.number}_sales`);
            },

            getFamHatchery: async function(selectedGeneration) {
                const response = await axios.get('summary/fam_hatchery/' + selectedGeneration.id);
                const { lines, hatchery_data } = response.data;

                if (hatchery_data && hatchery_data.length === 0) {
                    return alert('No data to generate csv');
                }

                const csvData = lines.reduce((acc, line) => {
                    
                    const { number: lineNumber, families } = line;

                    const lineData = hatchery_data[lineNumber];

                    if (lineData) {
                        const familiesData = families.map(({ number: famNumber }, index) => {
                            const famData = lineData[famNumber];
                            return [
                                index === 0 ? lineNumber : '',
                                famNumber,
                                get(famData, 'eggs_set', ''),
                                get(famData, 'eggs_fertile', ''),
                                get(famData, 'eggs_hatched', ''),
                                get(famData, 'fertility', ''),
                                get(famData, 'hatchability', ''),
                            ];
                        });
                        return acc + familiesData.join('\n') + '\n'; 
                    }
                    else {
                        return acc + [
                            lineNumber
                        ].join('\n') + '\n'; 
                    }

                }, 'Line, Family, Eggs Set, Eggs Fertile, Eggs Hatched, Fertility, Hachability \n');
                this.downloadCSV(csvData, `generation_${selectedGeneration.number}_hatchery`);
            },
        
            getFamEggProduction: async function(selectedGeneration) {
                const response = await axios.get('summary/fam_egg_production/' + selectedGeneration.id);
                const { lines, egg_production } = response.data;

                if (egg_production && egg_production.length === 0) {
                    return alert('No data to generate csv');
                }

                const csvData = lines.reduce((acc, line) => {
                    
                    const { number: lineNumber, families } = line;

                    const lineData = egg_production[lineNumber];

                    if (lineData) {
                        const familiesData = families.map(({ number: famNumber }, index) => {
                            const famData = lineData[famNumber];
                            return [
                                index === 0 ? lineNumber : '',
                                famNumber,
                                get(famData, 'compute', null) && get(famData, 'inventory', null) 
                                    ? this.formatFloat(get(famData, 'compute', null) / get(famData, 'inventory', null))
                                    : '',
                                get(famData, 'total_intact', ''),
                                get(famData, 'total_broken', ''),
                                get(famData, 'total_rejects', ''),
                                this.formatFloat(get(famData, 'total_weight', '')),
                            ];
                        });

                        return acc + familiesData.join('\n') + '\n'; 
                    }
                    else {
                        return acc + [
                            lineNumber
                        ].join('\n') + '\n'; 
                    }

                }, 'Line, Family, Hen Day, Total Intact, Total Broken, Total Rejects, Total Egg Weight (g) \n');
                this.downloadCSV(csvData, `generation_${selectedGeneration.number}_egg_production`);
            },

            // Generation
            getMorpoRepla: async function(farmId) {
                const response = await axios.get('summary/morpho_repla/' + farmId);

                const morphoChar = [
                    'height',
                    'weight',
                    'blength',
                    'ccircumference',
                    'wspan',
                    'slength',
                ];

                // 'billlen',
                //     'nlength',
                const genders = [
                    'male', 'female'
                ];
                const { farm_generations, morph_repla, animal_type } = response.data;

                if (this.checkAllEmpty([morph_repla])) {
                    return alert('No data to generate csv');
                }

                const csvData = farm_generations.reduce((acc, val) => {

                    const genNumber = val.number;

                    const mcData = morphoChar.map((morpho, mIndex) => {

                        const gData = genders.map(gender => {
                            const mean = this.formatFloat(get(morph_repla, `${genNumber}.${gender}.${morpho}.mean`, ''));
                            const sd = this.formatFloat(get(morph_repla, `${genNumber}.${gender}.${morpho}.sd`, ''));
                            return [
                                mean,
                                sd
                            ].join(',');
                        }).join(',');

                        return [
                            mIndex === 0 ? genNumber : '',
                            this.mC[morpho],
                            gData
                        ];

                    });

                    return acc + mcData.join('\n') + '\n';
            
                }, 'Generation, Morphometric Characteristics, Male (Mean), Male (SD), Female (Mean), Female (SD) \n');
                // this.downloadCSV(csvData, 'morpho_replacment');
            },
            getMorpoBreeder: async function(farmId) {
                const response = await axios.get('summary/morpho_breeder/' + farmId);

                const morphoChar = [
                    'height',
                    'weight',
                    'blength',
                    'ccircumference',
                    'wspan',
                    'slength',
                ];

                // 'billlen',
                //     'nlength',
                const genders = [
                    'male', 'female'
                ];
                const { farm_generations, morph_breeder, animal_type } = response.data;
                if (this.checkAllEmpty([morph_breeder])) {
                    return alert('No data to generate csv');
                }
                const csvData = farm_generations.reduce((acc, val) => {

                    const genNumber = val.number;

                    const mcData = morphoChar.map((morpho, mIndex) => {

                        const gData = genders.map(gender => {
                            const mean = this.formatFloat(get(morph_breeder, `${genNumber}.${gender}.${morpho}.mean`, ''));
                            const sd = this.formatFloat(get(morph_breeder, `${genNumber}.${gender}.${morpho}.sd`, ''));

                            return [
                                mean,
                                sd
                            ].join(',');
                        }).join(',');

                        return [
                            mIndex === 0 ? genNumber : '',
                            this.mC[morpho],
                            gData
                        ];

                    });

                    return acc + mcData.join('\n') + '\n';
            
                }, 'Generation, Morphometric Characteristics, Male (Mean), Male (SD), Female (Mean), Female (SD) \n');
                this.downloadCSV(csvData, 'morpho_breeder');
            },
            getGrowthRecord: async function(farmId) {
                const response = await axios.get('summary/growth/' + farmId);
                const { farm_generations, growth_records } = response.data;
                const days = [ 0, 21, 45, 75, 100];
                const csvData = farm_generations.reduce((acc, val) => {
                    
                    const genNumber = val.number;

                    if (growth_records[genNumber]) {
                        const data = days.map(day => {
                            const dd = growth_records[genNumber][day];
                            const array = [];
                            if (dd) {
                                array.push(
                                    day === 0 ? genNumber : '',
                                    `Day ${day}`,
                                    this.formatFloat(dd.male_mean),
                                    this.formatFloat(dd.male_sd),
                                    this.formatFloat(dd.female_mean),
                                    this.formatFloat(dd.female_sd),
                                    this.formatFloat(dd.total_mean),
                                    this.formatFloat(dd.total_sd),
                                );
                            }
                            else {
                                array.push(
                                    day === 0 ? genNumber : '',
                                    `Day ${day}`,
                                );
                            }

                            return array.join(',');
                        });
                        return acc + data.join('\n') + '\n'; 
                    }
                    else {
                        return acc + `${genNumber}\n`;
                    }    
                }, 'Generation, Age, Male (Mean), Male (SD), Female (Mean), Female (SD), Total (Mean), Total (SD)\n');
                this.downloadCSV(csvData, 'growth_records');
            },
            getMortality: async function(farmId) {
                const response = await axios.get('summary/mortality/' + farmId);

                const stages = ['brooder_data', 'replacement_data', 'breeder_data'];
                const reasons = ['Sickness', 'Trauma - Natural', 'Trauma - Predatory'];
                const { farm_generations } = response.data;

                const csvData = farm_generations.reduce((acc, val) => {
                    
                    const genNumber = val.number

                    const data = stages.map(stage => {
                        const row = response.data[stage][genNumber];

                        if (row) {
                            const stageData = reasons.reduce((a, reason) => {
                                const sd = row[reason];

                                a[0].push(sd && sd.male > 0 ? sd.male : '');
                                a[1].push(sd && sd.female > 0 ? sd.female : '');

                                return a;
                            }, [
                                [`${this.stgs[stage] === 'Brooder' ? genNumber : '' },${this.stgs[stage]} (Male)`],
                                [`,${this.stgs[stage]} (Female)`],
                            ]);

                            return [
                                stageData[0].join(','),
                                stageData[1].join(','),
                            ].join('\n');
                        }

                        else {
                            return [
                                `${this.stgs[stage] === 'Brooder' ? genNumber : '' },${this.stgs[stage]} (Male)`,
                                `,${this.stgs[stage]} (Female)`,
                            ].join('\n'); 
                        }
                    });
                    return acc + data.join('\n') + '\n'; 

                }, 'Generation, Stage, Sickness, Trauma - Natural, Trauma - Predatory\n');
                this.downloadCSV(csvData, 'mortality');
            },
            getSales: async function(farmId) {
                const response = await axios.get('summary/sales/' + farmId);
                const stages = ['brooder_data', 'replacement_data', 'breeder_data'];
                const { farm_generations } = response.data;

                const csvData = farm_generations.reduce((acc, val) => {
                    
                    const genNumber = val.number
    
                    const data = stages.map(item => {
                        const d = response.data[item][genNumber];
                        const head = `${item === 'brooder_data' ? genNumber : ''},${this.stgs[item]}`;
                        let tail = ''
                        if (d) {
                            tail = `,${d.male},${d.female},${d.total},${d.price_mean.toFixed(2)},${d.price_sd.toFixed(2)}`;
                        }

                        return head + tail;
                    });
                    return acc + data.join('\n') + '\n'; 

                }, 'Generation, Stage, Male, Female, Total, Price (Mean), Price (SD)\n');
                this.downloadCSV(csvData, 'sales');
            },
            getEggProduction: async function(farmId) {
                const response = await axios.get('summary/egg_production/' + farmId);
                const { farm_generations, egg_production } = response.data;
                if (!egg_production || egg_production.length === 0) {
                    return alert('No data available to generate csv!');
                }

                const csvData = farm_generations.reduce((acc, val) => {
                    
                    const genNumber = val.number;
                    
                    if (egg_production[genNumber]) {
                        const {
                            total_intact, total_broken, total_rejects, total_weight
                        } = egg_production[genNumber];

                        let henDay = '';

                        if (egg_production[genNumber].compute && egg_production[genNumber].inventory) {
                            henDay = (egg_production[genNumber].compute / egg_production[genNumber].inventory).toFixed(2);
                        }

                        const data = [
                            `${genNumber}, ${henDay}, ${total_intact}, ${total_broken}, ${total_rejects}, ${total_weight && total_weight.toFixed(2)}`
                        ];
                        
                        return acc + data.join('\n') + '\n'; 
                    }

                    const data = [
                        `${genNumber}`
                    ];
                    
                    return acc + data.join('\n') + '\n'; 

                }, 'Generation, Hen Day, Total Intact, Total Broken, Total Rejects, Total Egg Weight (g) \n');
                this.downloadCSV(csvData, 'egg_production');
            },
            getEggQuality: async function(farmId) {
                const qualityAt = [35, 40, 60];
                const response = await axios.get('summary/egg_quality/' + farmId);
                const { farm_generations, egg_quality } = response.data;

                function createQualityString(eggQualityName, qualityData, prop) {
                    const string = qualityAt.reduce((acc, week) => {
                        if (qualityData[week] && qualityData[week][prop]) {
                             acc.push(qualityData[week][prop].mean, qualityData[week][prop].std);
                        }
                        else {
                            acc.push('', '');
                        }
                        return acc;
                    }, []).join(',');
                    return `${eggQualityName},${string}`;
                }

                function createShapeColor(qualityData, prop) {
                    const string = qualityAt.reduce((acc, week) => {
                        if (qualityData[week] && qualityData[week][prop]) {
                             acc.push(qualityData[week][prop]);
                        }
                        else {
                            acc.push('');
                        }
                        return acc;
                    }, []).join(',');
                    return `${string}`;
                }

                if (!egg_quality || egg_quality.length === 0) {
                    return alert('No data available to generate csv!');
                }

                const csvData = farm_generations.reduce((acc, val) => {
                    const genNumber = val.number;
                    const qualityData = egg_quality[genNumber];
                    if (qualityData) {
                        const data = [
                            `${genNumber},${createQualityString('Egg Weight (g)', qualityData, 'weight')}`,
                            `   ,${createQualityString('Egg Length (mm)', qualityData, 'length')}`,
                            `   ,${createQualityString('Egg Width (mm)', qualityData, 'width')}`,
                            `   ,${createQualityString('Shell Thickness (mm)', qualityData, 'shell_thickness')}`,
                            `   ,${createQualityString('Shell Weight (g)', qualityData, 'shell_weight')}`,
                            `   ,${createQualityString('Yolk Weight (g)', qualityData, 'yolk_weight')}`,
                            `   ,${createQualityString('Albumen Weight (g)', qualityData, 'albumen_weight')}`,
                            `   ,${createQualityString('Albumen Height (mm)', qualityData, 'albumen_height')}`,
                            `   ,   ,Week 35, Week 40, Week 60,    ,    ,    `,
                            `   ,Egg Shape, ${createShapeColor(qualityData, 'shape')},    ,    ,    `,
                            `   ,Egg Color, ${createShapeColor(qualityData, 'color')},    ,    ,    `,
                        ]
                        return acc + data.join('\n') + '\n';
                    }

                    const data = `${genNumber},,,,,,,\n`;
                    return acc + data;

                }, 'Generation, Eggs Quality, Week 35 (Mean), Week 35 (SD), Week 40 (Mean), Week 40 (SD), Week 60 (Mean), Week 60 (SD)\n');
                this.downloadCSV(csvData, 'egg_quality');
            },
            getHatcherySummary: async function(farmId) {
                const response = await axios.get('summary/hatchery/' + farmId);
                const { farm_generations, hatchery_data } = response.data;

                if (!hatchery_data || hatchery_data.length === 0) {
                    return alert('No data available to generate csv!');
                }

                const csvData = farm_generations.reduce((acc, val) => {
                    
                    const genNumber = val.number;
                    
                    if (hatchery_data[genNumber]) {
                        const { 
                            eggs_set, eggs_fertile, eggs_hatched, fertility, hatchability
                        } = hatchery_data[genNumber];

                        const data = `${genNumber},${eggs_set},${eggs_fertile},${eggs_hatched},${fertility},${hatchability}\n`
                        
                        return acc + data;
                    }

                    const data = `${genNumber},,,,,\n`
                    
                    return acc + data; 

                }, 'Generation, Eggs Set, Eggs Fertile, Eggs Hatched, Fertility, Hachability\n');

                this.downloadCSV(csvData, 'hatchery');
            },
            getFeedingSummary: async function(farmId) {
                const response = await axios.get('summary/feeding_performance/' + farmId);

                const { 
                    farm_generations, brooder_feeding, replacement_feeding, breeder_feeding
                } = response.data;

                const csvData = farm_generations.reduce((acc, val) => {
                    const genNumber = val.number;
                    const brooderData = brooder_feeding[genNumber];
                    const breederData = breeder_feeding[genNumber];
                    const replacementData = replacement_feeding[genNumber];

                    const data = [
                        `${genNumber},Total Fed,${get(brooderData, 'total_fed', '')},${get(replacementData, 'total_fed', '')},${get(breederData, 'total_fed', '')}`,
                        `,Total Refused, ${get(brooderData, 'total_refused', '')},${get(replacementData, 'total_refused', '')},${get(breederData, 'total_refused', '')}`,
                        `,Total Consumption, ${get(brooderData, 'total_consumption', '')},${get(replacementData, 'total_consumption', '')},${get(breederData, 'total_consumption', '')}`,
                    ];

                    return acc + data.join('\n') + '\n';
    
                }, 'Generation, Feeding Perfomance, Brooders, Replacements, Breeder\n');

                this.downloadCSV(csvData, 'feeding_performance');
            },
            downloadCSV: function(rawData, fileName) {
                const link = document.getElementById('downloadlink');
                const data = encodeURI(rawData);
                link.setAttribute('href', 'data:text/plain;charset=utf-8,' + data);
                link.setAttribute('download', `${fileName}.csv`);
                link.click();
            },
            setCurrentUser: function(farmId) {
                this.currentUser = farmId;
            },
            getGenerations: async function(farmId) {
                try {
                    const response = await axios.get('generations/' + farmId);
                    this.generations = response.data.generations;
                } catch (error) {
                }
            },
            getUserList: async function (page = 1) {
                try {
                    const response = await axios.get('user_list?page=' + page);
                    this.users = response.data;
                } catch (error) {
                }
            },
            formatFloat: function(val) {
                if (val !== null && val !== undefined && val !== '') {    
                    return val.toFixed(2);
                }
                
                else return '';
            },
            checkAllEmpty: function(array) {
                return array.every(val => {
                    if (val) {
                        if (isObject(val)) {
                            return Object.entries(val).length === 0;
                        }
                        else if (isArray(val)) {
                            return val.length === 0;
                        }
                        else {
                            return false;
                        }
                    }
                    else {
                        return false;
                    }
                });
            }
        },
        mounted() {
            this.getUserList();

            // for (let i = 1; i <= 31; i++) {
            // }

        },
        created() {
        }
    }
</script>

<style>
</style>
