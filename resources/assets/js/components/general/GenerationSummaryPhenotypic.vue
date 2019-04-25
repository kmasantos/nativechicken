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
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h5 class="center-align">Plumage Color</h5>
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
                                            <tr>
                                                <td>Alvin</td>
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
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
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
                            <div class="col s12 m6 l6">
                                <h5 class="center-align">Plumage Pattern</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h5 class="center-align">Hackle Color</h5>
                            </div>
                            <div class="col s12 m6 l6">
                                <h5 class="center-align">Hackle Pattern</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h5 class="center-align">Body Carriage</h5>
                            </div>
                            <div class="col s12 m6 l6">
                                <h5 class="center-align">Comb Type</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h5 class="center-align">Comb Color</h5>
                            </div>
                            <div class="col s12 m6 l6">
                                <h5 class="center-align">Earlobe Color</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h5 class="center-align">Iris Color</h5>
                            </div>
                            <div class="col s12 m6 l6">
                                <h5 class="center-align">Beak Color</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h5 class="center-align">Shank Color</h5>
                            </div>
                            <div class="col s12 m6 l6">
                                <h5 class="center-align">Skin Color</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h5 class="center-align">FEMALE <i class="fas fa-venus"></i></h5>
                            </div>
                        </div>
                    </div>
                    <div id="tab2">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>    
</template>

<script>
export default {
    props: [
        'animal_type'
    ],
    data () {
        return {
            summary : null,
            male : {},
            female : {},
            
        }
    },
    methods : {
        init : function () {
            this.getBreederPhenoSummary();
        },
        getBreederPhenoSummary : function () {
            axios.get('generation_summary_breeder_pheno')
            .then(response => {
                this.summary = response.data;
                if(this.summary.length > 0){
                    this.count(this.summary);
                }
            })
            .catch(error => {
                
            });
            
        },
        count : function (data) {
            data.forEach(element => {
                if(element.gender == "male"){
                    element.phenotypic.forEach(element => {
                        
                    });
                }
                if(element.gender == "female"){

                }
            });
        }
    },
    mounted () {
        $('ul.tabs').tabs(); 
        this.init();
    }
}
</script>

<style scoped>
     
</style>