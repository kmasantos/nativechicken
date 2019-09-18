<template>
  <div v-html='content'></div>
</template>

<script>

  import 'quill/dist/quill.core.css';
  import 'quill/dist/quill.snow.css';

  export default {
    props: ['data'],
    data: function () {
        return {
          content: this.data
        }
    },
    mounted() {
    }
  }

</script>
<style scoped>
</style>