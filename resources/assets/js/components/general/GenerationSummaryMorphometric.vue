<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card">
                <div class="card-content">
                    </div>
                <div class="card-tabs">
                <ul class="tabs tabs-fixed-width">
                    <li class="tab"><a href="#tab2">Replacement</a></li>
                    <li class="tab"><a href="#tab1">Breeder</a></li>
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
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">HEIGHT</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["height"])}}</td>
                                                    <td>{{getStd(msummary["height"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">WEIGHT</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["weight"])}}</td>
                                                    <td>{{getStd(msummary["weight"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">BODY LENGTH</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["blength"])}}</td>
                                                    <td>{{getStd(msummary["blength"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">CHEST CIRCUMFERENCE</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["ccircumference"])}}</td>
                                                    <td>{{getStd(msummary["ccircumference"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">WING SPAN</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["wspan"])}}</td>
                                                    <td>{{getStd(msummary["wspan"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">SHANK LENGTH</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["slength"])}}</td>
                                                    <td>{{getStd(msummary["slength"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
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
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">HEIGHT</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["height"])}}</td>
                                                    <td>{{getStd(msummary["height"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">WEIGHT</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["weight"])}}</td>
                                                    <td>{{getStd(msummary["weight"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">BODY LENGTH</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["blength"])}}</td>
                                                    <td>{{getStd(msummary["blength"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">CHEST CIRCUMFERENCE</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["ccircumference"])}}</td>
                                                    <td>{{getStd(msummary["ccircumference"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">WING SPAN</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["wspan"])}}</td>
                                                    <td>{{getStd(msummary["wspan"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">SHANK LENGTH</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in breeder_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["slength"])}}</td>
                                                    <td>{{getStd(msummary["slength"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
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
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">HEIGHT</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["height"])}}</td>
                                                    <td>{{getStd(msummary["height"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">WEIGHT</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["weight"])}}</td>
                                                    <td>{{getStd(msummary["weight"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">BODY LENGTH</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["blength"])}}</td>
                                                    <td>{{getStd(msummary["blength"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">CHEST CIRCUMFERENCE</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["ccircumference"])}}</td>
                                                    <td>{{getStd(msummary["ccircumference"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">WING SPAN</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["wspan"])}}</td>
                                                    <td>{{getStd(msummary["wspan"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">SHANK LENGTH</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_male_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["slength"])}}</td>
                                                    <td>{{getStd(msummary["slength"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
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
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">HEIGHT</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["height"])}}</td>
                                                    <td>{{getStd(msummary["height"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">WEIGHT</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["weight"])}}</td>
                                                    <td>{{getStd(msummary["weight"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">BODY LENGTH</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["blength"])}}</td>
                                                    <td>{{getStd(msummary["blength"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">CHEST CIRCUMFERENCE</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["ccircumference"])}}</td>
                                                    <td>{{getStd(msummary["ccircumference"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">WING SPAN</h6>
                                    </div>
                                </div>
                                <div class="row right-column-divider">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["wspan"])}}</td>
                                                    <td>{{getStd(msummary["wspan"])}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l6">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h6 class="center-align">SHANK LENGTH</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table class="bordered highlight centered responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>GENERATION</th>
                                                    <th>μ</th>
                                                    <th>σ</th>
                                                </tr>
                                            </thead>

                                            <tbody v-for="(msummary, index) in replacement_female_summary" :key="index">
                                                <tr>
                                                    <td>{{index}}</td>
                                                    <td>{{getMean(msummary["slength"])}}</td>
                                                    <td>{{getStd(msummary["slength"])}}</td>
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
</template>

<script>
const math = require('mathjs');
export default {
    props: [
        'animal_type'
    ],
    data () {
        return {
            breeder_morpho : null,
            replacement_morpho : null,
            breeder_male_summary : {},
            breeder_female_summary : {},
            replacement_male_summary : {},
            replacement_female_summary : {},
        }
    },
    methods : {
        init : function () {
            this.getBreederMorphoSummary();
            this.getReplacementMorphoSummary();
        },
        getBreederMorphoSummary : function () {
            axios.get('generation_summary_breeder_morpho')
            .then(response => {
                this.breeder_male_summary = {};
                this.breeder_female_summary = {};
                this.breeder_morpho = response.data;
                this.breeder_morpho.forEach(element => {
                    var values = JSON.parse(element.morphometric);
                    if(element.gender == "male"){
                        if(typeof this.breeder_male_summary[element.number] === 'undefined'){
                            this.breeder_male_summary[element.number] = {};
                            if(this.animal_type == 1){
                                this.breeder_male_summary[element.number]["height"] = [];
                                this.breeder_male_summary[element.number]["weight"] = [];
                                this.breeder_male_summary[element.number]["blength"] = [];
                                this.breeder_male_summary[element.number]["ccircumference"] = [];
                                this.breeder_male_summary[element.number]["wspan"] = [];
                                this.breeder_male_summary[element.number]["slength"] = [];
                            }else{  
                                this.breeder_male_summary[element.number]["height"] = [];
                                this.breeder_male_summary[element.number]["weight"] = [];
                                this.breeder_male_summary[element.number]["blength"] = [];
                                this.breeder_male_summary[element.number]["ccircumference"] = [];
                                this.breeder_male_summary[element.number]["wspan"] = [];
                                this.breeder_male_summary[element.number]["slength"] = [];
                                this.breeder_male_summary[element.number]["billlen"] = [];
                                this.breeder_male_summary[element.number]["nlength"] = [];
                            }
                        }
                        if(this.animal_type == 1){
                            this.breeder_male_summary[element.number]["height"].push(values[0]);
                            this.breeder_male_summary[element.number]["weight"].push(values[1]);
                            this.breeder_male_summary[element.number]["blength"].push(values[2]);
                            this.breeder_male_summary[element.number]["ccircumference"].push(values[3]);
                            this.breeder_male_summary[element.number]["wspan"].push(values[4]);
                            this.breeder_male_summary[element.number]["slength"].push(values[5]);
                        }else{
                            this.breeder_male_summary[element.number]["height"].push(values[0]);
                            this.breeder_male_summary[element.number]["weight"].push(values[1]);
                            this.breeder_male_summary[element.number]["blength"].push(values[2]);
                            this.breeder_male_summary[element.number]["ccircumference"].push(values[3]);
                            this.breeder_male_summary[element.number]["wspan"].push(values[4]);
                            this.breeder_male_summary[element.number]["slength"].push(values[5]);
                            this.breeder_male_summary[element.number]["billlen"].push(values[6]);
                            this.breeder_male_summary[element.number]["nlength"].push(values[7]);
                        }
                    }else {
                        if(typeof this.breeder_female_summary[element.number] === 'undefined'){
                            this.breeder_female_summary[element.number] = {};
                            if(this.animal_type == 1){
                                this.breeder_female_summary[element.number]["height"] = [];
                                this.breeder_female_summary[element.number]["weight"] = [];
                                this.breeder_female_summary[element.number]["blength"] = [];
                                this.breeder_female_summary[element.number]["ccircumference"] = [];
                                this.breeder_female_summary[element.number]["wspan"] = [];
                                this.breeder_female_summary[element.number]["slength"] = [];
                            }else{  
                                this.breeder_female_summary[element.number]["height"] = [];
                                this.breeder_female_summary[element.number]["weight"] = [];
                                this.breeder_female_summary[element.number]["blength"] = [];
                                this.breeder_female_summary[element.number]["ccircumference"] = [];
                                this.breeder_female_summary[element.number]["wspan"] = [];
                                this.breeder_female_summary[element.number]["slength"] = [];
                                this.breeder_female_summary[element.number]["billlen"] = [];
                                this.breeder_female_summary[element.number]["nlength"] = [];
                            }
                        }
                        if(this.animal_type == 1){
                            this.breeder_female_summary[element.number]["height"].push(values[0]);
                            this.breeder_female_summary[element.number]["weight"].push(values[1]);
                            this.breeder_female_summary[element.number]["blength"].push(values[2]);
                            this.breeder_female_summary[element.number]["ccircumference"].push(values[3]);
                            this.breeder_female_summary[element.number]["wspan"].push(values[4]);
                            this.breeder_female_summary[element.number]["slength"].push(values[5]);
                        }else{
                            this.breeder_female_summary[element.number]["height"].push(values[0]);
                            this.breeder_female_summary[element.number]["weight"].push(values[1]);
                            this.breeder_female_summary[element.number]["blength"].push(values[2]);
                            this.breeder_female_summary[element.number]["ccircumference"].push(values[3]);
                            this.breeder_female_summary[element.number]["wspan"].push(values[4]);
                            this.breeder_female_summary[element.number]["slength"].push(values[5]);
                                this.breeder_female_summary[element.number]["billlen"].push(values[6]);
                            this.breeder_female_summary[element.number]["nlength"].push(values[7]);
                        }
                    }
                });
            })
            .catch(error => {
                
            });
        },
        getReplacementMorphoSummary : function () {
            axios.get('generation_summary_replacement_morpho')
            .then(response => {
                this.replacement_male_summary = {};
                this.replacement_female_summary = {};
                this.replacement_morpho = response.data;
                this.replacement_morpho.forEach(element => {
                    var values = JSON.parse(element.morphometric);
                    if(element.gender == "male"){
                        if(typeof this.replacement_male_summary[element.number] === 'undefined'){
                            this.replacement_male_summary[element.number] = {};
                            if(this.animal_type == 1){
                                this.replacement_male_summary[element.number]["height"] = [];
                                this.replacement_male_summary[element.number]["weight"] = [];
                                this.replacement_male_summary[element.number]["blength"] = [];
                                this.replacement_male_summary[element.number]["ccircumference"] = [];
                                this.replacement_male_summary[element.number]["wspan"] = [];
                                this.replacement_male_summary[element.number]["slength"] = [];
                            }else{  
                                this.replacement_male_summary[element.number]["height"] = [];
                                this.replacement_male_summary[element.number]["weight"] = [];
                                this.replacement_male_summary[element.number]["blength"] = [];
                                this.replacement_male_summary[element.number]["ccircumference"] = [];
                                this.replacement_male_summary[element.number]["wspan"] = [];
                                this.replacement_male_summary[element.number]["slength"] = [];
                                this.replacement_male_summary[element.number]["billlen"] = [];
                                this.replacement_male_summary[element.number]["nlength"] = [];
                            }
                        }
                        if(this.animal_type == 1){
                            this.replacement_male_summary[element.number]["height"].push(values[0]);
                            this.replacement_male_summary[element.number]["weight"].push(values[1]);
                            this.replacement_male_summary[element.number]["blength"].push(values[2]);
                            this.replacement_male_summary[element.number]["ccircumference"].push(values[3]);
                            this.replacement_male_summary[element.number]["wspan"].push(values[4]);
                            this.replacement_male_summary[element.number]["slength"].push(values[5]);
                        }else{
                            this.replacement_male_summary[element.number]["height"].push(values[0]);
                            this.replacement_male_summary[element.number]["weight"].push(values[1]);
                            this.replacement_male_summary[element.number]["blength"].push(values[2]);
                            this.replacement_male_summary[element.number]["ccircumference"].push(values[3]);
                            this.replacement_male_summary[element.number]["wspan"].push(values[4]);
                            this.replacement_male_summary[element.number]["slength"].push(values[5]);
                            this.replacement_male_summary[element.number]["billlen"].push(values[6]);
                            this.replacement_male_summary[element.number]["nlength"].push(values[7]);
                        }
                    }else {
                        if(typeof this.replacement_female_summary[element.number] === 'undefined'){
                            this.replacement_female_summary[element.number] = {};
                            if(this.animal_type == 1){
                                this.replacement_female_summary[element.number]["height"] = [];
                                this.replacement_female_summary[element.number]["weight"] = [];
                                this.replacement_female_summary[element.number]["blength"] = [];
                                this.replacement_female_summary[element.number]["ccircumference"] = [];
                                this.replacement_female_summary[element.number]["wspan"] = [];
                                this.replacement_female_summary[element.number]["slength"] = [];
                            }else{  
                                this.replacement_female_summary[element.number]["height"] = [];
                                this.replacement_female_summary[element.number]["weight"] = [];
                                this.replacement_female_summary[element.number]["blength"] = [];
                                this.replacement_female_summary[element.number]["ccircumference"] = [];
                                this.replacement_female_summary[element.number]["wspan"] = [];
                                this.replacement_female_summary[element.number]["slength"] = [];
                                this.replacement_female_summary[element.number]["billlen"] = [];
                                this.replacement_female_summary[element.number]["nlength"] = [];
                            }
                        }
                        if(this.animal_type == 1){
                            this.replacement_female_summary[element.number]["height"].push(values[0]);
                            this.replacement_female_summary[element.number]["weight"].push(values[1]);
                            this.replacement_female_summary[element.number]["blength"].push(values[2]);
                            this.replacement_female_summary[element.number]["ccircumference"].push(values[3]);
                            this.replacement_female_summary[element.number]["wspan"].push(values[4]);
                            this.replacement_female_summary[element.number]["slength"].push(values[5]);
                        }else{
                            this.replacement_female_summary[element.number]["height"].push(values[0]);
                            this.replacement_female_summary[element.number]["weight"].push(values[1]);
                            this.replacement_female_summary[element.number]["blength"].push(values[2]);
                            this.replacement_female_summary[element.number]["ccircumference"].push(values[3]);
                            this.replacement_female_summary[element.number]["wspan"].push(values[4]);
                            this.replacement_female_summary[element.number]["slength"].push(values[5]);
                            this.replacement_female_summary[element.number]["billlen"].push(values[6]);
                            this.replacement_female_summary[element.number]["nlength"].push(values[7]);
                        }
                    }
                });
            })
            .catch(error => {
                
            });
        },
        getMean : function (array) {
            return math.mean(array).toFixed(2);
        },
        getStd : function (array){
            return math.std(array).toFixed(2);
        },
    },
    mounted () {
        $('ul.tabs').tabs();
        this.init();
    }
}
</script>

<style scoped>
    tbody {
        max-height:500px;
        overflow:auto;
    }
</style>

