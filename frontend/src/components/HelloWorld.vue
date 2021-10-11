<template>
  <div class="d-flex">
    <div class="my-auto mx-auto text-black-white-bg-shadow py-5 w-80">
      <form @submit.prevent="generatePdf()">
        <div class="p-fluid">
          <h2 class="mb-4 text-left font-weight-bold">Create a PDF</h2>
          <div class="input-group">
            <label class="text-left text-muted" for="title">Document Title</label>
            <input type="text" class="w-100" id="title"  placeholder="Type the document title here" v-model="title"/>
          </div>
          <div class="input-group mt-3">
            <label class="text-left text-muted" for="heading1">Heading</label>
            <input id="heading1" v-model="heading1" class="w-100" type="text" placeholder="Type the document heading here"/>
          </div>
          <div class="input-group mt-3 mb-3 w-100">
            <label class="text-left text-muted w-100" for="richtext">Description</label>
            <tiptap class="w-100" v-model="richtext" id="richtext" />
          </div>
          <div class="input-group mt-3 mb-3">
            <button type="submit" class="btn btn-primary mt-2" :disabled="loading">
              Export to PDF
              <i v-if="loading" class='fa fa-circle-o-notch fa-spin'></i>
              <i v-else class='fa fa-arrow-right'></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Tiptap from '@/components/TipTap'
export default {
  name: 'Home',
  data() {
    return {
      title: null,
      heading1: null,
      richtext: null,
      loading: false,
      addedElements: [],
      addedTipTapStrings: [],
      addedHtmlElements: [],
    };
  },
  methods: {
    async generatePdf(){
      this.loading = true;
      const formData = new FormData();
      formData.append('title', this.title);
      formData.append('heading', this.heading1);
      formData.append('richtext', this.richtext);
      await axios.post('http://localhost:8000/api/pdf', formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          }
      ).then((response) => {
        let pdfName = response['data'];
        window.open('http://localhost:8000/pdfs/' + pdfName);
        // console.log("Getting pdf with name: " + pdfName);
        // axios.get(`http://localhost:8000/pdf/${pdfName}`, {
        //   headers: {
        //     Accept: 'application/pdf',
        //     'Content-Type': 'application/pdf',
        //   },
        //   params: {
        //     name: pdfName,
        //   },
        // })
        //     .then((response) => {
        //
        //       this.loading = false;
        //     });
      });
    }
  },
  components: {
    Tiptap
  }
};
</script>

<style>
.text-left{
  text-align: left;
}
.p-button-text:hover{
  color: white!important;
}
.table-controls-wrapper{
  visibility: hidden;
  z-index: 9999;
  position: fixed;
  margin-left: 2%;
  bottom: 40%;
}
</style>
