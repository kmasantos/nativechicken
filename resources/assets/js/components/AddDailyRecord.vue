<template>
    <div>
        <div class="row valign-wrapper">
            <div class="col s12 m8 l8 input-field">
                <input v-model="search" id="search" type="text">
                <label for="search">Search Breeder Family</label>
            </div>
            <div class="col s12 m4 l4">
                <a class="waves-effect waves-light btn blue-gray">Search
                    <i class="material-icons right">search</i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="card blue-grey lighten-5">
                            <div class="card-content">
                                <span class="card-title">Card Title</span>
                            </div>
                            <div class="card-action">
                                <a href="#add_breeder" class="black-text modal-trigger">This is a link</a>
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
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>