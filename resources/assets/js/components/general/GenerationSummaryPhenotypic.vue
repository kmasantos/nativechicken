<template>
    <div class="row">
        <div class="col s12 m12 l12">
             <div class="card">
                <div class="card-tabs">
                <ul class="tabs tabs-fixed-width">
                    <li class="tab"><a class="active" href="#tab1">REPLACEMENT</a></li>
                    <li class="tab"><a href="#tab2">BREEDER</a></li>
                </ul>
                </div>
                <div class="card-content grey lighten-4">
                    <div id="tab1">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h5 class="center-align">MALE <i class="fas fa-mars"></i></h5>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PLUMAGE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['plumage_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['plumage_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['plumage_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PLUMAGE PATTERN</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['plumage_pattern']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['plumage_pattern'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['plumage_pattern'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">SHANK COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['shank_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['shank_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['shank_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">SKIN COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['skin_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['skin_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['skin_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BODY CARRIAGE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['body_carriage']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['body_carriage'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['body_carriage'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6" v-if="animal_type===1">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">HACKLE PATTERN</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['hackle_pattern']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['hackle_pattern'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['hackle_pattern'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6" v-if="animal_type===2">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">NECK FEATHER MARKING</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['neckf_mark']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['neckf_mark'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['neckf_mark'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">HACKLE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['hackle_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['hackle_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['hackle_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">COMB TYPE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['comb_type']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['comb_type'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['comb_type'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">COMB COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['comb_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['comb_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['comb_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">EARLOBE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['earlobe_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['earlobe_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['earlobe_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">IRIS COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['iris_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['iris_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['iris_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BEAK COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['beak_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['beak_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['beak_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PHENOTYPIC SUMMARY FOR MALE DUCKS -->
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">NECK FEATHER COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['neckf_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['neckf_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['neckf_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">TAIL FEATHER COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['tailf_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['tailf_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['tailf_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BILL COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['bill_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['bill_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['bill_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BILL SHAPE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['bill_shape']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['bill_shape'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['bill_shape'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BEAN COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['bean_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['bean_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['bean_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PRESENCE OF CREST</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['presence_crest']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['presence_crest'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['presence_crest'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m12 l12">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">EYE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_replacement_records['eye_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_replacement_records['eye_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_replacement_records['eye_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h5 class="center-align">FEMALE <i class="fas fa-venus"></i></h5>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PLUMAGE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['plumage_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['plumage_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['plumage_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PLUMAGE PATTERN</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['plumage_pattern']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['plumage_pattern'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['plumage_pattern'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">SHANK COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['shank_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['shank_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['shank_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">SKIN COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['skin_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['skin_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['skin_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BODY CARRIAGE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['body_carriage']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['body_carriage'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['body_carriage'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6" v-if="animal_type===1">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">HACKLE PATTERN</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['hackle_pattern']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['hackle_pattern'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['hackle_pattern'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6" v-if="animal_type===2">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">NECK FEATHER MARKING</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['neckf_mark']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['neckf_mark'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['neckf_mark'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">HACKLE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['hackle_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['hackle_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['hackle_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">COMB TYPE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['comb_type']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['comb_type'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['comb_type'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">COMB COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['comb_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['comb_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['comb_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">EARLOBE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['earlobe_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['earlobe_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['earlobe_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">IRIS COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['iris_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['iris_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['iris_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BEAK COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['beak_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['beak_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['beak_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PHENOTYPIC SUMMARY FOR MALE DUCKS -->
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">NECK FEATHER COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['neckf_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['neckf_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['neckf_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">TAIL FEATHER COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['tailf_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['tailf_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['tailf_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BILL COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['bill_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['bill_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['bill_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BILL SHAPE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['bill_shape']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['bill_shape'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['bill_shape'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BEAN COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['bean_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['bean_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['bean_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PRESENCE OF CREST</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['presence_crest']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['presence_crest'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['presence_crest'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m12 l12">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">EYE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_replacement_records['eye_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_replacement_records['eye_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_replacement_records['eye_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h5 class="center-align">MALE <i class="fas fa-mars"></i></h5>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PLUMAGE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['plumage_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['plumage_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['plumage_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PLUMAGE PATTERN</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['plumage_pattern']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['plumage_pattern'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['plumage_pattern'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">SHANK COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['shank_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['shank_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['shank_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">SKIN COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['skin_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['skin_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['skin_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BODY CARRIAGE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['body_carriage']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['body_carriage'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['body_carriage'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6" v-if="animal_type===1">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">HACKLE PATTERN</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['hackle_pattern']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['hackle_pattern'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['hackle_pattern'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6" v-if="animal_type===2">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">NECK FEATHER MARKING</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['neckf_mark']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['neckf_mark'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['neckf_mark'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">HACKLE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['hackle_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['hackle_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['hackle_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">COMB TYPE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['comb_type']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['comb_type'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['comb_type'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">COMB COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['comb_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['comb_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['comb_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">EARLOBE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['earlobe_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['earlobe_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['earlobe_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">IRIS COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['iris_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['iris_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['iris_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BEAK COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['beak_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['beak_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['beak_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PHENOTYPIC SUMMARY FOR MALE DUCKS -->
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">NECK FEATHER COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['neckf_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['neckf_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['neckf_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">TAIL FEATHER COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['tailf_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['tailf_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['tailf_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BILL COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['bill_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['bill_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['bill_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BILL SHAPE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['bill_shape']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['bill_shape'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['bill_shape'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BEAN COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['bean_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['bean_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['bean_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PRESENCE OF CREST</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['presence_crest']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['presence_crest'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['presence_crest'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m12 l12">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">EYE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in male_breeder_records['eye_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in male_breeder_records['eye_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, male_breeder_records['eye_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h5 class="center-align">FEMALE <i class="fas fa-venus"></i></h5>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PLUMAGE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['plumage_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['plumage_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['plumage_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PLUMAGE PATTERN</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['plumage_pattern']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['plumage_pattern'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['plumage_pattern'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">SHANK COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['shank_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['shank_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['shank_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">SKIN COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['skin_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['skin_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['skin_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BODY CARRIAGE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['body_carriage']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['body_carriage'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['body_carriage'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6" v-if="animal_type===1">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">HACKLE PATTERN</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['hackle_pattern']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['hackle_pattern'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['hackle_pattern'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6" v-if="animal_type===2">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">NECK FEATHER MARKING</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['neckf_mark']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['neckf_mark'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['neckf_mark'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">HACKLE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['hackle_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['hackle_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['hackle_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">COMB TYPE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['comb_type']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['comb_type'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['comb_type'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">COMB COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['comb_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['comb_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['comb_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">EARLOBE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['earlobe_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['earlobe_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['earlobe_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===1">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">IRIS COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['iris_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['iris_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['iris_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BEAK COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['beak_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['beak_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['beak_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PHENOTYPIC SUMMARY FOR MALE DUCKS -->
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">NECK FEATHER COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['neckf_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['neckf_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['neckf_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">TAIL FEATHER COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['tailf_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['tailf_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['tailf_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BILL COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['bill_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['bill_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['bill_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BILL SHAPE</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['bill_shape']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['bill_shape'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['bill_shape'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">BEAN COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['bean_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['bean_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['bean_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">PRESENCE OF CREST</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['presence_crest']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['presence_crest'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['presence_crest'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="animal_type===2">
                            <div class="col s12 m12 l12">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h6 class="center-align">EYE COLOR</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Generation</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="(data, index) in female_breeder_records['eye_color']" :key="index">
                                                    <td>{{index}}</td>
                                                    <td>
                                                        <table class="centered responsive-table">
                                                            <thead>
                                                            <tr>
                                                                <th><i class="fas fa-feather"></i></th>
                                                                <th><i class="fas fa-sort-amount-down"></i></th>
                                                                <th><i class="fas fa-percentage"></i></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr v-for="(freq, attr) in female_breeder_records['eye_color'][index]" :key="attr">
                                                                    <td>{{attr}}</td>
                                                                    <td>{{freq}}</td>
                                                                    <td>{{getPercentage(freq, female_breeder_records['eye_color'][index])}}%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
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
const math = require('mathjs');
export default {
    props: [
        'animal_type'
    ],
    data () {
        return {
            breeder_data : null,
            replacement_data : null,
            breeder_data_len : 0,
            replacement_data_len : 0,
            breeder_records : {},
            replacement_records : {},
            male_breeder_records : {},
            female_breeder_records : {},
            male_replacement_records : {},
            female_replacement_records : {},
        }
    },
    methods : {
        init : function () {
            this.getBreederPhenoSummary();
            this.getReplacementPhenoSummary();
        },
        
        getBreederPhenoSummary : function () {
            axios.get('generation_summary_breeder_pheno')
            .then(response => {
                this.breeder_data = response.data;
                this.breeder_data_len = this.breeder_data.length;
                this.male_breeder_records = {};
                this.female_breeder_records = {};
                if(this.animal_type === 1){
                    this.male_breeder_records['plumage_color'] = {};
                    this.female_breeder_records['plumage_color'] = {};
                    this.male_breeder_records['plumage_pattern'] = {};
                    this.female_breeder_records['plumage_pattern'] = {};
                    this.male_breeder_records['hackle_color'] = {};
                    this.female_breeder_records['hackle_color'] = {};
                    this.male_breeder_records['hackle_pattern'] = {};
                    this.female_breeder_records['hackle_pattern'] = {};
                    this.male_breeder_records['body_carriage'] = {};
                    this.female_breeder_records['body_carriage'] = {};
                    this.male_breeder_records['comb_type'] = {};
                    this.female_breeder_records['comb_type'] = {};
                    this.male_breeder_records['comb_color'] = {};
                    this.female_breeder_records['comb_color'] = {};
                    this.male_breeder_records['earlobe_color'] = {};
                    this.female_breeder_records['earlobe_color'] = {};
                    this.male_breeder_records['iris_color'] = {};
                    this.female_breeder_records['iris_color'] = {};
                    this.male_breeder_records['beak_color'] = {};
                    this.female_breeder_records['beak_color'] = {};
                    this.male_breeder_records['shank_color'] = {};
                    this.female_breeder_records['shank_color'] = {};
                    this.male_breeder_records['skin_color'] = {};
                    this.female_breeder_records['skin_color'] = {};
                    
                    this.breeder_data.forEach(element => {
                        var values = JSON.parse(element.phenotypic);
                        if(element.gender === "male"){
                            if((typeof this.male_breeder_records['plumage_color'][element.number] === 'undefined')){
                                this.male_breeder_records['plumage_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['plumage_color'][element.number][values[0].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['plumage_color'][element.number][values[0].toUpperCase()] = 0
                            }
                            this.male_breeder_records['plumage_color'][element.number][values[0].toUpperCase()]++;
                            
                            if((typeof this.male_breeder_records['plumage_pattern'][element.number] === 'undefined')){
                                this.male_breeder_records['plumage_pattern'][element.number] = {};
                            }

                            if((typeof this.male_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()] = 0
                            }
                            this.male_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()]++;

                            if((typeof this.male_breeder_records['hackle_color'][element.number] === 'undefined')){
                                this.male_breeder_records['hackle_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['hackle_color'][element.number][values[2].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['hackle_color'][element.number][values[2].toUpperCase()] = 0
                            }
                            this.male_breeder_records['hackle_color'][element.number][values[2].toUpperCase()]++;

                            if((typeof this.male_breeder_records['hackle_pattern'][element.number] === 'undefined')){
                                this.male_breeder_records['hackle_pattern'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['hackle_pattern'][element.number][values[3].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['hackle_pattern'][element.number][values[3].toUpperCase()] = 0
                            }
                            this.male_breeder_records['hackle_pattern'][element.number][values[3].toUpperCase()]++;

                            if((typeof this.male_breeder_records['body_carriage'][element.number] === 'undefined')){
                                this.male_breeder_records['body_carriage'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['body_carriage'][element.number][values[4].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['body_carriage'][element.number][values[4].toUpperCase()] = 0
                            }
                            this.male_breeder_records['body_carriage'][element.number][values[4].toUpperCase()]++;
                            
                            if((typeof this.male_breeder_records['comb_type'][element.number] === 'undefined')){
                                this.male_breeder_records['comb_type'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['comb_type'][element.number][values[5].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['comb_type'][element.number][values[5].toUpperCase()] = 0
                            }
                            this.male_breeder_records['comb_type'][element.number][values[5].toUpperCase()]++;
                            
                            if((typeof this.male_breeder_records['comb_color'][element.number] === 'undefined')){
                                this.male_breeder_records['comb_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['comb_color'][element.number][values[6].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['comb_color'][element.number][values[6].toUpperCase()] = 0
                            }
                            this.male_breeder_records['comb_color'][element.number][values[6].toUpperCase()]++;
                            
                            if((typeof this.male_breeder_records['earlobe_color'][element.number] === 'undefined')){
                                this.male_breeder_records['earlobe_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['earlobe_color'][element.number][values[7].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['earlobe_color'][element.number][values[7].toUpperCase()] = 0
                            }
                            this.male_breeder_records['earlobe_color'][element.number][values[7].toUpperCase()]++;
                            if((typeof this.male_breeder_records['iris_color'][element.number] === 'undefined')){
                                this.male_breeder_records['iris_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['iris_color'][element.number][values[8].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['iris_color'][element.number][values[8].toUpperCase()] = 0
                            }
                            this.male_breeder_records['iris_color'][element.number][values[8].toUpperCase()]++;
                            
                            if((typeof this.male_breeder_records['beak_color'][element.number] === 'undefined')){
                                this.male_breeder_records['beak_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['beak_color'][element.number][values[9].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['beak_color'][element.number][values[9].toUpperCase()] = 0
                            }
                            this.male_breeder_records['beak_color'][element.number][values[9].toUpperCase()]++;

                            if((typeof this.male_breeder_records['shank_color'][element.number] === 'undefined')){
                                this.male_breeder_records['shank_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['shank_color'][element.number][values[10].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['shank_color'][element.number][values[10].toUpperCase()] = 0
                            }
                            this.male_breeder_records['shank_color'][element.number][values[10].toUpperCase()]++;

                            if((typeof this.male_breeder_records['skin_color'][element.number] === 'undefined')){
                                this.male_breeder_records['skin_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['skin_color'][element.number][values[11].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['skin_color'][element.number][values[11].toUpperCase()] = 0
                            }
                            this.male_breeder_records['skin_color'][element.number][values[11].toUpperCase()]++;

                        }else{
                            if((typeof this.female_breeder_records['plumage_color'][element.number] === 'undefined')){
                                this.female_breeder_records['plumage_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_color'][element.number][values[0].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['plumage_color'][element.number][values[0].toUpperCase()] = 0
                            }
                            this.female_breeder_records['plumage_color'][element.number][values[0].toUpperCase()]++;
                            
                            if((typeof this.female_breeder_records['plumage_pattern'][element.number] === 'undefined')){
                                this.female_breeder_records['plumage_pattern'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()] = 0
                            }
                            this.female_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()]++;

                            if((typeof this.female_breeder_records['hackle_color'][element.number] === 'undefined')){
                                this.female_breeder_records['hackle_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['hackle_color'][element.number][values[2].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['hackle_color'][element.number][values[2].toUpperCase()] = 0
                            }
                            this.female_breeder_records['hackle_color'][element.number][values[2].toUpperCase()]++;

                            if((typeof this.female_breeder_records['hackle_pattern'][element.number] === 'undefined')){
                                this.female_breeder_records['hackle_pattern'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['hackle_pattern'][element.number][values[3].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['hackle_pattern'][element.number][values[3].toUpperCase()] = 0
                            }
                            this.female_breeder_records['hackle_pattern'][element.number][values[3].toUpperCase()]++;

                            if((typeof this.female_breeder_records['body_carriage'][element.number] === 'undefined')){
                                this.female_breeder_records['body_carriage'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['body_carriage'][element.number][values[4].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['body_carriage'][element.number][values[4].toUpperCase()] = 0
                            }
                            this.male_breeder_records['body_carriage'][element.number][values[4].toUpperCase()]++;
                            
                            if((typeof this.female_breeder_records['comb_type'][element.number] === 'undefined')){
                                this.female_breeder_records['comb_type'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['comb_type'][element.number][values[5].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['comb_type'][element.number][values[5].toUpperCase()] = 0
                            }
                            this.female_breeder_records['comb_type'][element.number][values[5].toUpperCase()]++;

                            if((typeof this.female_breeder_records['comb_color'][element.number] === 'undefined')){
                                this.female_breeder_records['comb_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['comb_color'][element.number][values[6].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['comb_color'][element.number][values[6].toUpperCase()] = 0
                            }
                            this.female_breeder_records['comb_color'][element.number][values[6].toUpperCase()]++;

                            if((typeof this.female_breeder_records['earlobe_color'][element.number] === 'undefined')){
                                this.female_breeder_records['earlobe_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['earlobe_color'][element.number][values[7].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['earlobe_color'][element.number][values[7].toUpperCase()] = 0
                            }
                            this.female_breeder_records['earlobe_color'][element.number][values[7].toUpperCase()]++;

                            if((typeof this.female_breeder_records['iris_color'][element.number] === 'undefined')){
                                this.female_breeder_records['iris_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['iris_color'][element.number][values[8].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['iris_color'][element.number][values[8].toUpperCase()] = 0
                            }
                            this.female_breeder_records['iris_color'][element.number][values[8].toUpperCase()]++;

                            if((typeof this.female_breeder_records['beak_color'][element.number] === 'undefined')){
                                this.female_breeder_records['beak_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['beak_color'][element.number][values[9].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['beak_color'][element.number][values[9].toUpperCase()] = 0
                            }
                            this.female_breeder_records['beak_color'][element.number][values[9].toUpperCase()]++;

                            if((typeof this.female_breeder_records['shank_color'][element.number] === 'undefined')){
                                this.female_breeder_records['shank_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['shank_color'][element.number][values[10].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['shank_color'][element.number][values[10].toUpperCase()] = 0
                            }
                            this.female_breeder_records['shank_color'][element.number][values[10].toUpperCase()]++;

                            if((typeof this.female_breeder_records['skin_color'][element.number] === 'undefined')){
                                this.female_breeder_records['skin_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['skin_color'][element.number][values[11].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['skin_color'][element.number][values[11].toUpperCase()] = 0
                            }
                            this.female_breeder_records['skin_color'][element.number][values[11].toUpperCase()]++;
                        }
                    });

                }else if(this.animal_type === 2){
                    this.male_breeder_records['plumage_color'] = {};
                    this.female_breeder_records['plumage_color'] = {};
                    this.male_breeder_records['plumage_pattern'] = {};
                    this.female_breeder_records['plumage_pattern'] = {};
                    this.male_breeder_records['body_carriage'] = {};
                    this.female_breeder_records['body_carriage'] = {};
                    this.male_breeder_records['shank_color'] = {};
                    this.female_breeder_records['shank_color'] = {};
                    this.male_breeder_records['skin_color'] = {};
                    this.female_breeder_records['skin_color'] = {};
                    this.male_breeder_records['neckf_mark'] = {};
                    this.female_breeder_records['neckf_mark'] = {};
                    this.male_breeder_records['neckf_color'] = {};
                    this.female_breeder_records['neckf_color'] = {};
                    this.male_breeder_records['tailf_color'] = {};
                    this.female_breeder_records['tailf_color'] = {};
                    this.male_breeder_records['bill_color'] = {};
                    this.female_breeder_records['bill_color'] = {};
                    this.male_breeder_records['bill_shape'] = {};
                    this.female_breeder_records['bill_shape'] = {};
                    this.male_breeder_records['bean_color'] = {};
                    this.female_breeder_records['bean_color'] = {};
                    this.male_breeder_records['presence_crest'] = {};
                    this.female_breeder_records['presence_crest'] = {};
                    this.male_breeder_records['eye_color'] = {};
                    this.female_breeder_records['eye_color'] = {};
                    this.breeder_data.forEach(element => {
                        var values = JSON.parse(element.phenotypic);
                        if(element.gender === "male"){
                            if((typeof this.male_breeder_records['plumage_color'][element.number] === 'undefined')){
                                this.male_breeder_records['plumage_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['plumage_color'][element.number][values[0].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['plumage_color'][element.number][values[0].toUpperCase()] = 0
                            }
                            this.male_breeder_records['plumage_color'][element.number][values[0].toUpperCase()]++;

                            if((typeof this.male_breeder_records['plumage_pattern'][element.number] === 'undefined')){
                                this.male_breeder_records['plumage_pattern'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()] = 0
                            }
                            this.male_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()]++;

                            if((typeof this.male_breeder_records['body_carriage'][element.number] === 'undefined')){
                                this.male_breeder_records['body_carriage'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['body_carriage'][element.number][values[2].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['body_carriage'][element.number][values[2].toUpperCase()] = 0
                            }
                            this.male_breeder_records['body_carriage'][element.number][values[2].toUpperCase()]++;

                            if((typeof this.male_breeder_records['shank_color'][element.number] === 'undefined')){
                                this.male_breeder_records['shank_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['shank_color'][element.number][values[3].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['shank_color'][element.number][values[3].toUpperCase()] = 0
                            }
                            this.male_breeder_records['shank_color'][element.number][values[3].toUpperCase()]++;

                            if((typeof this.male_breeder_records['skin_color'][element.number] === 'undefined')){
                                this.male_breeder_records['skin_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['skin_color'][element.number][values[4].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['skin_color'][element.number][values[4].toUpperCase()] = 0
                            }
                            this.male_breeder_records['skin_color'][element.number][values[4].toUpperCase()]++;

                            if((typeof this.male_breeder_records['neckf_mark'][element.number] === 'undefined')){
                                this.male_breeder_records['neckf_mark'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['neckf_mark'][element.number][values[5].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['neckf_mark'][element.number][values[5].toUpperCase()] = 0
                            }
                            this.male_breeder_records['neckf_mark'][element.number][values[5].toUpperCase()]++;

                            if((typeof this.male_breeder_records['neckf_color'][element.number] === 'undefined')){
                                this.male_breeder_records['neckf_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['neckf_color'][element.number][values[6].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['neckf_color'][element.number][values[6].toUpperCase()] = 0
                            }
                            this.male_breeder_records['neckf_color'][element.number][values[6].toUpperCase()]++;

                            if((typeof this.male_breeder_records['tailf_color'][element.number] === 'undefined')){
                                this.male_breeder_records['tailf_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['tailf_color'][element.number][values[7].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['tailf_color'][element.number][values[7].toUpperCase()] = 0
                            }
                            this.male_breeder_records['tailf_color'][element.number][values[7].toUpperCase()]++;

                            if((typeof this.male_breeder_records['bill_color'][element.number] === 'undefined')){
                                this.male_breeder_records['bill_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['bill_color'][element.number][values[8].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['bill_color'][element.number][values[8].toUpperCase()] = 0
                            }
                            this.male_breeder_records['bill_color'][element.number][values[8].toUpperCase()]++;

                            if((typeof this.male_breeder_records['bill_shape'][element.number] === 'undefined')){
                                this.male_breeder_records['bill_shape'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['bill_shape'][element.number][values[9].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['bill_shape'][element.number][values[9].toUpperCase()] = 0
                            }
                            this.male_breeder_records['bill_shape'][element.number][values[9].toUpperCase()]++;

                            if((typeof this.male_breeder_records['bean_color'][element.number] === 'undefined')){
                                this.male_breeder_records['bean_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['bean_color'][element.number][values[10].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['bean_color'][element.number][values[10].toUpperCase()] = 0
                            }
                            this.male_breeder_records['bean_color'][element.number][values[10].toUpperCase()]++;

                            if((typeof this.male_breeder_records['presence_crest'][element.number] === 'undefined')){
                                this.male_breeder_records['presence_crest'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['presence_crest'][element.number][values[11].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['presence_crest'][element.number][values[11].toUpperCase()] = 0
                            }
                            this.male_breeder_records['presence_crest'][element.number][values[11].toUpperCase()]++;

                            if((typeof this.male_breeder_records['eye_color'][element.number] === 'undefined')){
                                this.male_breeder_records['eye_color'][element.number] = {};
                            }
                            if((typeof this.male_breeder_records['eye_color'][element.number][values[12].toUpperCase()] === 'undefined')){
                                this.male_breeder_records['eye_color'][element.number][values[12].toUpperCase()] = 0
                            }
                            this.male_breeder_records['eye_color'][element.number][values[12].toUpperCase()]++;

                        }else{
                            if((typeof this.female_breeder_records['plumage_color'][element.number] === 'undefined')){
                                this.female_breeder_records['plumage_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_color'][element.number][values[0].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['plumage_color'][element.number][values[0].toUpperCase()] = 0
                            }
                            this.female_breeder_records['plumage_color'][element.number][values[0].toUpperCase()]++;

                            if((typeof this.female_breeder_records['plumage_pattern'][element.number] === 'undefined')){
                                this.female_breeder_records['plumage_pattern'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()] = 0
                            }
                            this.female_breeder_records['plumage_pattern'][element.number][values[1].toUpperCase()]++;

                            if((typeof this.female_breeder_records['body_carriage'][element.number] === 'undefined')){
                                this.female_breeder_records['body_carriage'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['body_carriage'][element.number][values[2].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['body_carriage'][element.number][values[2].toUpperCase()] = 0
                            }
                            this.female_breeder_records['body_carriage'][element.number][values[2].toUpperCase()]++;

                            if((typeof this.female_breeder_records['shank_color'][element.number] === 'undefined')){
                                this.female_breeder_records['shank_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['shank_color'][element.number][values[3].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['shank_color'][element.number][values[3].toUpperCase()] = 0
                            }
                            this.female_breeder_records['shank_color'][element.number][values[3].toUpperCase()]++;

                            if((typeof this.female_breeder_records['skin_color'][element.number] === 'undefined')){
                                this.female_breeder_records['skin_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['skin_color'][element.number][values[4].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['skin_color'][element.number][values[4].toUpperCase()] = 0
                            }
                            this.female_breeder_records['skin_color'][element.number][values[4].toUpperCase()]++;

                            if((typeof this.female_breeder_records['neckf_mark'][element.number] === 'undefined')){
                                this.female_breeder_records['neckf_mark'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['neckf_mark'][element.number][values[5].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['neckf_mark'][element.number][values[5].toUpperCase()] = 0
                            }
                            this.female_breeder_records['neckf_mark'][element.number][values[5].toUpperCase()]++;

                            if((typeof this.female_breeder_records['neckf_color'][element.number] === 'undefined')){
                                this.female_breeder_records['neckf_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['neckf_color'][element.number][values[6].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['neckf_color'][element.number][values[6].toUpperCase()] = 0
                            }
                            this.female_breeder_records['neckf_color'][element.number][values[6].toUpperCase()]++;

                            if((typeof this.female_breeder_records['tailf_color'][element.number] === 'undefined')){
                                this.female_breeder_records['tailf_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['tailf_color'][element.number][values[7].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['tailf_color'][element.number][values[7].toUpperCase()] = 0
                            }
                            this.female_breeder_records['tailf_color'][element.number][values[7].toUpperCase()]++;

                            if((typeof this.female_breeder_records['bill_color'][element.number] === 'undefined')){
                                this.female_breeder_records['bill_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['bill_color'][element.number][values[8].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['bill_color'][element.number][values[8].toUpperCase()] = 0
                            }
                            this.female_breeder_records['bill_color'][element.number][values[8].toUpperCase()]++;

                            if((typeof this.female_breeder_records['bill_shape'][element.number] === 'undefined')){
                                this.female_breeder_records['bill_shape'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['bill_shape'][element.number][values[9].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['bill_shape'][element.number][values[9].toUpperCase()] = 0
                            }
                            this.female_breeder_records['bill_shape'][element.number][values[9].toUpperCase()]++;

                            if((typeof this.female_breeder_records['bean_color'][element.number] === 'undefined')){
                                this.female_breeder_records['bean_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['bean_color'][element.number][values[10].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['bean_color'][element.number][values[10].toUpperCase()] = 0
                            }
                            this.female_breeder_records['bean_color'][element.number][values[10].toUpperCase()]++;

                            if((typeof this.female_breeder_records['presence_crest'][element.number] === 'undefined')){
                                this.female_breeder_records['presence_crest'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['presence_crest'][element.number][values[11].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['presence_crest'][element.number][values[11].toUpperCase()] = 0
                            }
                            this.female_breeder_records['presence_crest'][element.number][values[11].toUpperCase()]++;

                            if((typeof this.female_breeder_records['eye_color'][element.number] === 'undefined')){
                                this.female_breeder_records['eye_color'][element.number] = {};
                            }
                            if((typeof this.female_breeder_records['eye_color'][element.number][values[12].toUpperCase()] === 'undefined')){
                                this.female_breeder_records['eye_color'][element.number][values[12].toUpperCase()] = 0
                            }
                            this.female_breeder_records['eye_color'][element.number][values[12].toUpperCase()]++;
                        }
                    });
                }
                
            })
            .catch(error => {});
        },

        getReplacementPhenoSummary : function () {
            axios.get('generation_summary_replacement_pheno')
            .then(response => {
                this.replacement_data = response.data;
                this.replacement_data_len = this.replacement_data.length;
                this.male_replacement_records = {};
                this.female_replacement_records = {};
                if(this.animal_type === 1){
                    this.male_replacement_records['plumage_color'] = {};
                    this.female_replacement_records['plumage_color'] = {};
                    this.male_replacement_records['plumage_pattern'] = {};
                    this.female_replacement_records['plumage_pattern'] = {};
                    this.male_replacement_records['hackle_color'] = {};
                    this.female_replacement_records['hackle_color'] = {};
                    this.male_replacement_records['hackle_pattern'] = {};
                    this.female_replacement_records['hackle_pattern'] = {};
                    this.male_replacement_records['body_carriage'] = {};
                    this.female_replacement_records['body_carriage'] = {};
                    this.male_replacement_records['comb_type'] = {};
                    this.female_replacement_records['comb_type'] = {};
                    this.male_replacement_records['comb_color'] = {};
                    this.female_replacement_records['comb_color'] = {};
                    this.male_replacement_records['earlobe_color'] = {};
                    this.female_replacement_records['earlobe_color'] = {};
                    this.male_replacement_records['iris_color'] = {};
                    this.female_replacement_records['iris_color'] = {};
                    this.male_replacement_records['beak_color'] = {};
                    this.female_replacement_records['beak_color'] = {};
                    this.male_replacement_records['shank_color'] = {};
                    this.female_replacement_records['shank_color'] = {};
                    this.male_replacement_records['skin_color'] = {};
                    this.female_replacement_records['skin_color'] = {};
                    
                    this.replacement_data.forEach(element => {
                        var values = JSON.parse(element.phenotypic);
                        if(element.gender === "male"){
                            if((typeof this.male_replacement_records['plumage_color'][element.number] === 'undefined')){
                                this.male_replacement_records['plumage_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['plumage_color'][element.number][values[0].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['plumage_color'][element.number][values[0].toUpperCase()] = 0;
                            }
                            this.male_replacement_records['plumage_color'][element.number][values[0].toUpperCase()]++;
                            
                            if((typeof this.male_replacement_records['plumage_pattern'][element.number] === 'undefined')){
                                this.male_replacement_records['plumage_pattern'][element.number] = {};
                            }

                            if((typeof this.male_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()] = 0
                            }
                            this.male_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()]++;

                            if((typeof this.male_replacement_records['hackle_color'][element.number] === 'undefined')){
                                this.male_replacement_records['hackle_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['hackle_color'][element.number][values[2].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['hackle_color'][element.number][values[2].toUpperCase()] = 0
                            }
                            this.male_replacement_records['hackle_color'][element.number][values[2].toUpperCase()]++;

                            if((typeof this.male_replacement_records['hackle_pattern'][element.number] === 'undefined')){
                                this.male_replacement_records['hackle_pattern'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['hackle_pattern'][element.number][values[3].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['hackle_pattern'][element.number][values[3].toUpperCase()] = 0
                            }
                            this.male_replacement_records['hackle_pattern'][element.number][values[3].toUpperCase()]++;

                            if((typeof this.male_replacement_records['body_carriage'][element.number] === 'undefined')){
                                this.male_replacement_records['body_carriage'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['body_carriage'][element.number][values[4].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['body_carriage'][element.number][values[4].toUpperCase()] = 0
                            }
                            this.male_replacement_records['body_carriage'][element.number][values[4].toUpperCase()]++;
                            
                            if((typeof this.male_replacement_records['comb_type'][element.number] === 'undefined')){
                                this.male_replacement_records['comb_type'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['comb_type'][element.number][values[5].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['comb_type'][element.number][values[5].toUpperCase()] = 0
                            }
                            this.male_replacement_records['comb_type'][element.number][values[5].toUpperCase()]++;
                            
                            if((typeof this.male_replacement_records['comb_color'][element.number] === 'undefined')){
                                this.male_replacement_records['comb_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['comb_color'][element.number][values[6].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['comb_color'][element.number][values[6].toUpperCase()] = 0
                            }
                            this.male_replacement_records['comb_color'][element.number][values[6].toUpperCase()]++;
                            
                            if((typeof this.male_replacement_records['earlobe_color'][element.number] === 'undefined')){
                                this.male_replacement_records['earlobe_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['earlobe_color'][element.number][values[7].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['earlobe_color'][element.number][values[7].toUpperCase()] = 0
                            }
                            this.male_replacement_records['earlobe_color'][element.number][values[7].toUpperCase()]++;
                            if((typeof this.male_replacement_records['iris_color'][element.number] === 'undefined')){
                                this.male_replacement_records['iris_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['iris_color'][element.number][values[8].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['iris_color'][element.number][values[8].toUpperCase()] = 0
                            }
                            this.male_replacement_records['iris_color'][element.number][values[8].toUpperCase()]++;
                            
                            if((typeof this.male_replacement_records['beak_color'][element.number] === 'undefined')){
                                this.male_replacement_records['beak_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['beak_color'][element.number][values[9].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['beak_color'][element.number][values[9].toUpperCase()] = 0
                            }
                            this.male_replacement_records['beak_color'][element.number][values[9].toUpperCase()]++;

                            if((typeof this.male_replacement_records['shank_color'][element.number] === 'undefined')){
                                this.male_replacement_records['shank_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['shank_color'][element.number][values[10].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['shank_color'][element.number][values[10].toUpperCase()] = 0
                            }
                            this.male_replacement_records['shank_color'][element.number][values[10].toUpperCase()]++;

                            if((typeof this.male_replacement_records['skin_color'][element.number] === 'undefined')){
                                this.male_replacement_records['skin_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['skin_color'][element.number][values[11].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['skin_color'][element.number][values[11].toUpperCase()] = 0
                            }
                            this.male_replacement_records['skin_color'][element.number][values[11].toUpperCase()]++;

                        }else{
                            if((typeof this.female_replacement_records['plumage_color'][element.number] === 'undefined')){
                                this.female_replacement_records['plumage_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_color'][element.number][values[0].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['plumage_color'][element.number][values[0].toUpperCase()] = 0
                            }
                            this.female_replacement_records['plumage_color'][element.number][values[0].toUpperCase()]++;
                            
                            if((typeof this.female_replacement_records['plumage_pattern'][element.number] === 'undefined')){
                                this.female_replacement_records['plumage_pattern'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()] = 0
                            }
                            this.female_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()]++;

                            if((typeof this.female_replacement_records['hackle_color'][element.number] === 'undefined')){
                                this.female_replacement_records['hackle_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['hackle_color'][element.number][values[2].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['hackle_color'][element.number][values[2].toUpperCase()] = 0
                            }
                            this.female_replacement_records['hackle_color'][element.number][values[2].toUpperCase()]++;

                            if((typeof this.female_replacement_records['hackle_pattern'][element.number] === 'undefined')){
                                this.female_replacement_records['hackle_pattern'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['hackle_pattern'][element.number][values[3].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['hackle_pattern'][element.number][values[3].toUpperCase()] = 0
                            }
                            this.female_replacement_records['hackle_pattern'][element.number][values[3].toUpperCase()]++;

                            if((typeof this.female_replacement_records['body_carriage'][element.number] === 'undefined')){
                                this.female_replacement_records['body_carriage'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['body_carriage'][element.number][values[4].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['body_carriage'][element.number][values[4].toUpperCase()] = 0
                            }
                            this.female_replacement_records['body_carriage'][element.number][values[4].toUpperCase()]++;
                            
                            if((typeof this.female_replacement_records['comb_type'][element.number] === 'undefined')){
                                this.female_replacement_records['comb_type'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['comb_type'][element.number][values[5].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['comb_type'][element.number][values[5].toUpperCase()] = 0
                            }
                            this.female_replacement_records['comb_type'][element.number][values[5].toUpperCase()]++;

                            if((typeof this.female_replacement_records['comb_color'][element.number] === 'undefined')){
                                this.female_replacement_records['comb_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['comb_color'][element.number][values[6].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['comb_color'][element.number][values[6].toUpperCase()] = 0
                            }
                            this.female_replacement_records['comb_color'][element.number][values[6].toUpperCase()]++;

                            if((typeof this.female_replacement_records['earlobe_color'][element.number] === 'undefined')){
                                this.female_replacement_records['earlobe_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['earlobe_color'][element.number][values[7].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['earlobe_color'][element.number][values[7].toUpperCase()] = 0
                            }
                            this.female_replacement_records['earlobe_color'][element.number][values[7].toUpperCase()]++;

                            if((typeof this.female_replacement_records['iris_color'][element.number] === 'undefined')){
                                this.female_replacement_records['iris_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['iris_color'][element.number][values[8].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['iris_color'][element.number][values[8].toUpperCase()] = 0
                            }
                            this.female_replacement_records['iris_color'][element.number][values[8].toUpperCase()]++;

                            if((typeof this.female_replacement_records['beak_color'][element.number] === 'undefined')){
                                this.female_replacement_records['beak_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['beak_color'][element.number][values[9].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['beak_color'][element.number][values[9].toUpperCase()] = 0
                            }
                            this.female_replacement_records['beak_color'][element.number][values[9].toUpperCase()]++;

                            if((typeof this.female_replacement_records['shank_color'][element.number] === 'undefined')){
                                this.female_replacement_records['shank_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['shank_color'][element.number][values[10].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['shank_color'][element.number][values[10].toUpperCase()] = 0
                            }
                            this.female_replacement_records['shank_color'][element.number][values[10].toUpperCase()]++;

                            if((typeof this.female_replacement_records['skin_color'][element.number] === 'undefined')){
                                this.female_replacement_records['skin_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['skin_color'][element.number][values[11].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['skin_color'][element.number][values[11].toUpperCase()] = 0
                            }
                            this.female_replacement_records['skin_color'][element.number][values[11].toUpperCase()]++;
                        }
                    });

                }else if(this.animal_type === 2){
                    this.male_replacement_records['plumage_color'] = {};
                    this.female_replacement_records['plumage_color'] = {};
                    this.male_replacement_records['plumage_pattern'] = {};
                    this.female_replacement_records['plumage_pattern'] = {};
                    this.male_replacement_records['body_carriage'] = {};
                    this.female_replacement_records['body_carriage'] = {};
                    this.male_replacement_records['shank_color'] = {};
                    this.female_replacement_records['shank_color'] = {};
                    this.male_replacement_records['skin_color'] = {};
                    this.female_replacement_records['skin_color'] = {};
                    this.male_replacement_records['neckf_mark'] = {};
                    this.female_replacement_records['neckf_mark'] = {};
                    this.male_replacement_records['neckf_color'] = {};
                    this.female_replacement_records['neckf_color'] = {};
                    this.male_replacement_records['tailf_color'] = {};
                    this.female_replacement_records['tailf_color'] = {};
                    this.male_replacement_records['bill_color'] = {};
                    this.female_replacement_records['bill_color'] = {};
                    this.male_replacement_records['bill_shape'] = {};
                    this.female_replacement_records['bill_shape'] = {};
                    this.male_replacement_records['bean_color'] = {};
                    this.female_replacement_records['bean_color'] = {};
                    this.male_replacement_records['presence_crest'] = {};
                    this.female_replacement_records['presence_crest'] = {};
                    this.male_replacement_records['eye_color'] = {};
                    this.female_replacement_records['eye_color'] = {};
                    this.breeder_data.forEach(element => {
                        var values = JSON.parse(element.phenotypic);
                        if(element.gender === "male"){
                            if((typeof this.male_replacement_records['plumage_color'][element.number] === 'undefined')){
                                this.male_replacement_records['plumage_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['plumage_color'][element.number][values[0].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['plumage_color'][element.number][values[0].toUpperCase()] = 0
                            }
                            this.male_replacement_records['plumage_color'][element.number][values[0].toUpperCase()]++;

                            if((typeof this.male_replacement_records['plumage_pattern'][element.number] === 'undefined')){
                                this.male_replacement_records['plumage_pattern'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()] = 0
                            }
                            this.male_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()]++;

                            if((typeof this.male_replacement_records['body_carriage'][element.number] === 'undefined')){
                                this.male_replacement_records['body_carriage'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['body_carriage'][element.number][values[2].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['body_carriage'][element.number][values[2].toUpperCase()] = 0
                            }
                            this.male_replacement_records['body_carriage'][element.number][values[2].toUpperCase()]++;

                            if((typeof this.male_replacement_records['shank_color'][element.number] === 'undefined')){
                                this.male_replacement_records['shank_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['shank_color'][element.number][values[3].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['shank_color'][element.number][values[3].toUpperCase()] = 0
                            }
                            this.male_replacement_records['shank_color'][element.number][values[3].toUpperCase()]++;

                            if((typeof this.male_replacement_records['skin_color'][element.number] === 'undefined')){
                                this.male_replacement_records['skin_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['skin_color'][element.number][values[4].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['skin_color'][element.number][values[4].toUpperCase()] = 0
                            }
                            this.male_replacement_records['skin_color'][element.number][values[4].toUpperCase()]++;

                            if((typeof this.male_replacement_records['neckf_mark'][element.number] === 'undefined')){
                                this.male_replacement_records['neckf_mark'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['neckf_mark'][element.number][values[5].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['neckf_mark'][element.number][values[5].toUpperCase()] = 0
                            }
                            this.male_replacement_records['neckf_mark'][element.number][values[5].toUpperCase()]++;

                            if((typeof this.male_replacement_records['neckf_color'][element.number] === 'undefined')){
                                this.male_replacement_records['neckf_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['neckf_color'][element.number][values[6].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['neckf_color'][element.number][values[6].toUpperCase()] = 0
                            }
                            this.male_replacement_records['neckf_color'][element.number][values[6].toUpperCase()]++;

                            if((typeof this.male_replacement_records['tailf_color'][element.number] === 'undefined')){
                                this.male_replacement_records['tailf_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['tailf_color'][element.number][values[7].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['tailf_color'][element.number][values[7].toUpperCase()] = 0
                            }
                            this.male_replacement_records['tailf_color'][element.number][values[7].toUpperCase()]++;

                            if((typeof this.male_replacement_records['bill_color'][element.number] === 'undefined')){
                                this.male_replacement_records['bill_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['bill_color'][element.number][values[8].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['bill_color'][element.number][values[8].toUpperCase()] = 0
                            }
                            this.male_replacement_records['bill_color'][element.number][values[8].toUpperCase()]++;

                            if((typeof this.male_replacement_records['bill_shape'][element.number] === 'undefined')){
                                this.male_replacement_records['bill_shape'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['bill_shape'][element.number][values[9].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['bill_shape'][element.number][values[9].toUpperCase()] = 0
                            }
                            this.male_replacement_records['bill_shape'][element.number][values[9].toUpperCase()]++;

                            if((typeof this.male_replacement_records['bean_color'][element.number] === 'undefined')){
                                this.male_replacement_records['bean_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['bean_color'][element.number][values[10].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['bean_color'][element.number][values[10].toUpperCase()] = 0
                            }
                            this.male_replacement_records['bean_color'][element.number][values[10].toUpperCase()]++;

                            if((typeof this.male_replacement_records['presence_crest'][element.number] === 'undefined')){
                                this.male_replacement_records['presence_crest'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['presence_crest'][element.number][values[11].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['presence_crest'][element.number][values[11].toUpperCase()] = 0
                            }
                            this.male_replacement_records['presence_crest'][element.number][values[11].toUpperCase()]++;

                            if((typeof this.male_replacement_records['eye_color'][element.number] === 'undefined')){
                                this.male_replacement_records['eye_color'][element.number] = {};
                            }
                            if((typeof this.male_replacement_records['eye_color'][element.number][values[12].toUpperCase()] === 'undefined')){
                                this.male_replacement_records['eye_color'][element.number][values[12].toUpperCase()] = 0
                            }
                            this.male_replacement_records['eye_color'][element.number][values[12].toUpperCase()]++;

                        }else{
                            if((typeof this.female_replacement_records['plumage_color'][element.number] === 'undefined')){
                                this.female_replacement_records['plumage_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_color'][element.number][values[0].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['plumage_color'][element.number][values[0].toUpperCase()] = 0
                            }
                            this.female_replacement_records['plumage_color'][element.number][values[0].toUpperCase()]++;

                            if((typeof this.female_replacement_records['plumage_pattern'][element.number] === 'undefined')){
                                this.female_replacement_records['plumage_pattern'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()] = 0
                            }
                            this.female_replacement_records['plumage_pattern'][element.number][values[1].toUpperCase()]++;

                            if((typeof this.female_replacement_records['body_carriage'][element.number] === 'undefined')){
                                this.female_replacement_records['body_carriage'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['body_carriage'][element.number][values[2].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['body_carriage'][element.number][values[2].toUpperCase()] = 0
                            }
                            this.female_replacement_records['body_carriage'][element.number][values[2].toUpperCase()]++;

                            if((typeof this.female_replacement_records['shank_color'][element.number] === 'undefined')){
                                this.female_replacement_records['shank_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['shank_color'][element.number][values[3].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['shank_color'][element.number][values[3].toUpperCase()] = 0
                            }
                            this.female_replacement_records['shank_color'][element.number][values[3].toUpperCase()]++;

                            if((typeof this.female_replacement_records['skin_color'][element.number] === 'undefined')){
                                this.female_replacement_records['skin_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['skin_color'][element.number][values[4].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['skin_color'][element.number][values[4].toUpperCase()] = 0
                            }
                            this.female_replacement_records['skin_color'][element.number][values[4].toUpperCase()]++;

                            if((typeof this.female_replacement_records['neckf_mark'][element.number] === 'undefined')){
                                this.female_replacement_records['neckf_mark'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['neckf_mark'][element.number][values[5].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['neckf_mark'][element.number][values[5].toUpperCase()] = 0
                            }
                            this.female_replacement_records['neckf_mark'][element.number][values[5].toUpperCase()]++;

                            if((typeof this.female_replacement_records['neckf_color'][element.number] === 'undefined')){
                                this.female_replacement_records['neckf_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['neckf_color'][element.number][values[6].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['neckf_color'][element.number][values[6].toUpperCase()] = 0
                            }
                            this.female_replacement_records['neckf_color'][element.number][values[6].toUpperCase()]++;

                            if((typeof this.female_replacement_records['tailf_color'][element.number] === 'undefined')){
                                this.female_replacement_records['tailf_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['tailf_color'][element.number][values[7].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['tailf_color'][element.number][values[7].toUpperCase()] = 0
                            }
                            this.female_replacement_records['tailf_color'][element.number][values[7].toUpperCase()]++;

                            if((typeof this.female_replacement_records['bill_color'][element.number] === 'undefined')){
                                this.female_replacement_records['bill_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['bill_color'][element.number][values[8].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['bill_color'][element.number][values[8].toUpperCase()] = 0
                            }
                            this.female_replacement_records['bill_color'][element.number][values[8].toUpperCase()]++;

                            if((typeof this.female_replacement_records['bill_shape'][element.number] === 'undefined')){
                                this.female_replacement_records['bill_shape'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['bill_shape'][element.number][values[9].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['bill_shape'][element.number][values[9].toUpperCase()] = 0
                            }
                            this.female_replacement_records['bill_shape'][element.number][values[9].toUpperCase()]++;

                            if((typeof this.female_replacement_records['bean_color'][element.number] === 'undefined')){
                                this.female_replacement_records['bean_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['bean_color'][element.number][values[10].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['bean_color'][element.number][values[10].toUpperCase()] = 0
                            }
                            this.female_replacement_records['bean_color'][element.number][values[10].toUpperCase()]++;

                            if((typeof this.female_replacement_records['presence_crest'][element.number] === 'undefined')){
                                this.female_replacement_records['presence_crest'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['presence_crest'][element.number][values[11].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['presence_crest'][element.number][values[11].toUpperCase()] = 0
                            }
                            this.female_replacement_records['presence_crest'][element.number][values[11].toUpperCase()]++;

                            if((typeof this.female_replacement_records['eye_color'][element.number] === 'undefined')){
                                this.female_replacement_records['eye_color'][element.number] = {};
                            }
                            if((typeof this.female_replacement_records['eye_color'][element.number][values[12].toUpperCase()] === 'undefined')){
                                this.female_replacement_records['eye_color'][element.number][values[12].toUpperCase()] = 0
                            }
                            this.female_replacement_records['eye_color'][element.number][values[12].toUpperCase()]++;
                        }
                    });
                }
                
            })
            .catch(error => {});
        },

        getPercentage : function (freq, obj) {
            var total  = 0;
            for (var index in obj) {
                total += obj[index];
            }
            if(total != 0){
                return ((freq/total)*100).toFixed(2);
            }
        },
    },
    mounted () {
        $('ul.tabs').tabs(); 
        this.init();
    }
}
</script>

<style scoped>
    .card-panel {
        height: 500px;
    }
    tbody {
        display:block;
        max-height:500px;
        overflow:auto;
    }
    thead, tbody tr {
        display:table;
        width:100%;
        table-layout:fixed;
    }
    thead {
        width: calc( 100% - 1em )
    }
    table {
        width:100%;
    }
</style>