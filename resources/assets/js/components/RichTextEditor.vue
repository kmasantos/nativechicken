<template>
  <div>
    <quill-editor
      id='editor'
      v-model='content'
      :options='editorOptions'
    >
    </quill-editor>
  </div>
</template>

<script>

  import moment from 'moment';
  import 'quill/dist/quill.core.css';
  import 'quill/dist/quill.snow.css';

  import { quillEditor } from 'vue-quill-editor';
  import ImageResize from 'quill-image-resize-module';
  
  Quill.register('modules/imageResize', ImageResize);

  export default {
    props: ['content'],
    data () {
      return {
        editorOptions: {
            modules: {
              toolbar: [
              ['bold', 'italic', 'underline', 'strike'],
              ['blockquote', 'code-block'],
              [{ 'header': 1 }, { 'header': 2 }],
              [{ 'list': 'ordered' }, { 'list': 'bullet' }],
              [{ 'script': 'sub' }, { 'script': 'super' }],
              [{ 'indent': '-1' }, { 'indent': '+1' }],
              [{ 'direction': 'rtl' }],
              [{ 'size': ['small', false, 'large', 'huge'] }],
              [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
              [{ 'font': [] }],
              [{ 'color': [] }, { 'background': [] }],
              [{ 'align': [] }],
              ['clean'],
              ['link', 'image', 'video']
              ],
              imageResize: true
            }
          }
      }
    },
    components: {
      quillEditor
    },
    methods : {
    },
    mounted() {
    },
    created() {
        
    }
  }
</script>

<style scoped>

  #editor {
    min-height: 300px;
  }

</style>
