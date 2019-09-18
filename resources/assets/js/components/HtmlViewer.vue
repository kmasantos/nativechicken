<template>
    <div class="ql-editor">
        <div v-html="content">
        </div>
    </div>
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
<style scoped>
  @import '~vue2-editor/dist/vue2-editor.css';
  @import '~quill/dist/quill.snow.css';
  @import '~quill/dist/quill.bubble.css';
</style>