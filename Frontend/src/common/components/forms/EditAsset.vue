<template>
    <div class="container">
      <div class="form-group edit-header">
          <h1>Edit Asset</h1>
      </div>

      <div class="form-group edit-header margin-t-40 default-flex-entry">
          <input type="text" placeholder="Title" v-model="asset.title" />
      </div>

      <div class="form-group margin-t-10">
          <div class="upload-box" v-if="asset.type === 'pdf'">
              <label class ="upload-button" for="upload_file"> Select PDF
              <input id="upload_file" type="file" ref="pdf" @change="getFile($event)" /> 
              </label>
          </div>

          <div class="margin-t-20" v-else-if="asset.type === 'snippet'">
              <smart-text @snippet="processContent" :content="asset.content" :description="asset.description"></smart-text>
          </div>

          <div class="container" v-else-if="asset.type === 'link'">
              <div class="width-fix">
              <input type="text" placeholder="Enter a valid url" v-model="asset.content" />
              </div>

              <div class="width-fix margin-t-10 checkbox">
                  <input type="checkbox" id="option" true-value="1" false-value="0" v-model="asset.option">
                  <label for="option">Open in a new tab</label>
              </div>
          </div>
      </div>

      <div class="form-group margin-t-40 default-flex-entry">
          <button class="btn" @click="initiate">
              <div class="form-group-loader" v-if="loading">
              <div class="loader">
                    <span>
                    <i class="fas fa-spinner fa-spin"></i>
                    </span>
                </div>
                </div>
                Update !
          </button>
        </div>
  </div>
</template>

<script>

const SmartText = () => import(/* webpackChunkName: "forms" */ /* webpackPrefetch: true */ "@/common/components/forms/Wysiwyg.vue");

export default {
  name: "EditAsset",
  props: {
      id: {
          type: Number,
          required:true
      },
      title: {
          type: String,
          required:true
      },
      description: {
          type: String
      },
      content: {
          type: String,
          required:true
      },
      type: {
          type: String,
          required:true
      },
      option: {
          type: Number,
          required:true
      }
  },
  components: {
      SmartText
      //PdfViewer
  },
  data() {
    return {
        asset: {
            title: this.title,
            description: this.description,
            content: this.content,
            option: this.option,
            type: this.type
        },
        pdf: null,
        loading: false
    };
  },
  methods: {
      processContent(snippet) {
          this.asset.description = snippet.description;
          this.asset.content = snippet.content;
      },
      getFile(e) {
        let pdf = e.target.files[0] || e.dataTransfer.files;
        this.asset.content = pdf;
      },
      async initiate() {
          try {
              this.loader(true);
              let payload = {
                  'data': this.getPayload(),
                  'id': this.id
              }
              await this.$store.dispatch('asset/updateAsset', payload);
              this.loader(false);
              this.$router.push({
                  name: 'dashboardViewAssets'
              });
              } catch (error) {
                  this.loader(false);
              }
      },
      getPayload() {
          let payload = new FormData();
          //payload.append('asset', JSON.stringify(this.asset));
          payload.append('id', this.id);
          payload.append('content', this.asset.content);
          payload.append('title', this.asset.title);
          payload.append('description', this.asset.description);
          payload.append('type', this.type);
          payload.append('option', this.asset.option);
          payload.append('_method', 'PUT');
          return payload;
      },
      loader(args) {
        this.loading = args;
      }
  }
};
</script>