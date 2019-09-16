<template>
    <div v-html='content'></div>
</template>

<script>
    export default {
      props: ['htmlData'],
      data: function () {
          return {
            content: this.htmlData
          }
      }
    }
</script>
