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
                                                <tr>
                                                    <td></td>
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
                            </div>
                            <div class="col s12 m6 l6">
                                <h6 class="center-align">PLUMAGE PATTERN</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h6 class="center-align">HACKLE COLOR</h6>
                            </div>
                            <div class="col s12 m6 l6">
                                <h6 class="center-align">HACKLE PATTERN</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h6 class="center-align">BODY CARRIAGE</h6>
                            </div>
                            <div class="col s12 m6 l6">
                                <h6 class="center-align">COMB TYPE</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h6 class="center-align">COMB COLOR</h6>
                            </div>
                            <div class="col s12 m6 l6">
                                <h6 class="center-align">EARLOBE COLOR</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h6 class="center-align">IRIS COLOR</h6>
                            </div>
                            <div class="col s12 m6 l6">
                                <h6 class="center-align">BEAK COLOR</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h6 class="center-align">SHANK COLOR</h6>
                            </div>
                            <div class="col s12 m6 l6">
                                <h6 class="center-align">SKIN COLOR</h6>
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
            breeder_data : null,
            replacement_data : null,
            breeder_data_len : 0,
            replacement_data_len : 0,
            breeder_records : {},
            replacement_records : {},
            
        }
    },
    methods : {
        init : function () {
            this.getBreederPhenoSummary();
        },
        getBreederPhenoSummary : function () {
            axios.get('generation_summary_breeder_pheno')
            .then(response => {
                this.breeder_data = response.data;
                this.breeder_data_len = this.breeder_data.length;
                this.breeder_records = {};
                this.breeder_data.forEach(element => {
                    if((typeof this.breeder_records[element.number] === 'undefined')){
                        this.breeder_records[element.number] = {};
                        this.breeder_records[element.number]['male'] = {};
                        this.breeder_records[element.number]['female'] = {};
                        if(this.animal_type === 1){
                            this.breeder_records[element.number]['male']['plumage_color'];
                            this.breeder_records[element.number]['female']['plumage_color'];
                            this.breeder_records[element.number]['male']['plumage_pattern'];
                            this.breeder_records[element.number]['female']['plumage_pattern'];
                            this.breeder_records[element.number]['male']['hackle_color'];
                            this.breeder_records[element.number]['female']['hackle_color'];
                            this.breeder_records[element.number]['male']['hackle_pattern'];
                            this.breeder_records[element.number]['female']['hackle_pattern'];
                        }else{

                        }
                    }
                    

                });
                
            })
            .catch(error => {});
        },
        count : function (data) {
            
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