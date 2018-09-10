<template>
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="col s12 m6 l6">
                    <label>Line</label>
                    <select id="line_choice" class="browser-default">
                        <option value="" disabled selected>Choose line</option>
                    </select>
                </div>
            </div>
        </div>       
</template>

<script>
    export default {
        
        mounted() {
            console.log('Component mounted.');
        },
        
    }
</script>
