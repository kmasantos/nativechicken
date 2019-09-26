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
                                    <a style="margin: 4px;" href="javascript:void(0)" class="indigo white-text darken-1 modal-trigger center-align btn" data-position="bottom" data-delay="50" data-tooltip="Generation Summary">
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
                            <td>Growth Records</td>
                            <td>
                                <div class="col s12 m12 l12 center">
                                    <a style="margin: 4px;"  href="javascript:void(0)" class="indigo white-text darken-1 center-align btn">
                                        Generate CSV
                                    </a>
                                </div>
                            </td>
                        </tr> -->
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
    </div>
</template>

<script>

    import { get } from 'lodash';

    export default {
        data () {
            return {
                users : {},
                currentUser: null,
                stgs: {
                    'brooder_data' : 'Brooder',
                    'replacement_data' : 'Replacement',
                    'breeder_data' : 'Breeder',
                }
            }
        },
        methods : {
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
            getUserList : async function (page = 1) {
                try {
                    const response = await axios.get('user_list?page=' + page);
                    this.users = response.data;
                } catch (error) {
                }
            },
        },
        mounted() {
            $(document).ready(function(){
                $('.tooltipped').tooltip({delay: 50});
                $('.modal').modal({
                    dismissible: false,
                });
            });
            // this.getUserList();
            this.getMortality(16);
        },
        created() {
        }
    }
</script>

<style>
</style>
