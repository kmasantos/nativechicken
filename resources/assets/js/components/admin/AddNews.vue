<template>
  <div>
    <a @click.prevent='showPreview = !showPreview' class="waves-effect waves-light btn-large">
      {{ showPreview ? 'Hide' : 'Show' }} Preview
    </a>
    <div v-html='content' style="border: 1px solid black; margin: 32px; padding: 32px;" v-if='showPreview' ></div>
    <div class='row' v-else>
      <div class='col s12 m12 l12'>
          <div class='row'>
            <div class='input-field col s12'>
                <h5 class='indigo-text'>News Title: </h5>
                <input placeholder='Enter Title' type='text' v-model='title'>
            </div>
            <div class='input-field col s12'>
                <h5 class='indigo-text'>News Content: </h5>
                <quill-editor
                  id='editor'
                  v-model='content'
                  :options='editorOptions'
                >
                </quill-editor>
            </div>
            <a @click.prevent='addNews' class='waves-effect waves-light btn-large indigo' style='margin-top: 32px;'>
              Submit
            </a>
          </div>
      </div>
    </div>
  </div>
</template>

<script>

  import moment from 'moment';
  import _ from 'lodash';
  import { quillEditor } from 'vue-quill-editor';
  import ImageResize from 'quill-image-resize-module';

  import 'quill/dist/quill.core.css';
  import 'quill/dist/quill.snow.css';

  
  Quill.register('modules/imageResize', ImageResize);

  export default {
    components: {
      quillEditor
    },
    data () {
      return {
        showPreview: false,
        title: null,
        content: null,
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
    methods : {
        trimValues: function(...data) {
          return data.every(value => {
            if (_.isString(value)) {
              return value.trim() !== '';
            }
            else !!data;
          });
        },
        addNews: async function () {

          if (this.trimValues(this.title, this.content)) {
            try {
              const response = await axios.post('/admin/news', { 
                title: this.title,
                content: this.content
              });
              Materialize.toast('Successfully added a News!', 5000, 'green rounded');
              this.setFormData(null);
            } catch (error) {
              console.error(error);
            }
          }
          else {
            Materialize.toast('Please fill up all fields!', 5000, 'red rounded');
          }
          
        },
        setFormData: function(data) {
          if (data) {

          }
          else {
            this.title = null;
            this.content = null;
          }
        }
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
