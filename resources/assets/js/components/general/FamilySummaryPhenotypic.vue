<template>
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5>{{title}} | Generation {{generation.number}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'animal_type',
        'title',
        'generation'
    ],
    data () {
        return {

        }
    },
    methods : {

    },
    mounted () {

    }
}
</script>

<style scoped>

</style>
