<template>
  <div class="container">
      <div class="form-group">
          <h1>Finalize Asset</h1>
      </div>

      <div class="form-group margin-t-40 default-flex-entry">
          <input type="text" placeholder="Title" v-model="asset.title" />
      </div>
      <div class="form-group margin-t-10 default-flex-entry">
          <div class="upload-box" v-if="assetType === 'pdf'">
              <label class ="upload-button" for="upload_file"> Select PDF
              <input id="upload_file" type="file" ref="pdf" @change="getFile($event)" /> 
              </label>
          </div>

          <div class="container" v-else-if="assetType === 'snippet'">
              <smart-text @snippet="processContent"></smart-text>
          </div>

          <div class="container" v-else-if="assetType === 'link'">
              <div class="width-fix">
              <input type="text" placeholder="Enter a valid url" v-model="asset.content" />
              </div>

              <div class="width-fix margin-t-10 checkbox">
                  <input type="checkbox" id="option" true-value="1" false-value="0" v-model="asset.option">
                  <label for="option">Open in a new tab</label>
              </div>
          </div>
      </div>

      <div class="form-group margin-t-200 default-flex-entry">
          <button class="btn" @click="initiate">
              <div class="form-group-loader" v-if="loading">
              <div class="loader">
                    <span>
                    <i class="fas fa-spinner fa-spin"></i>
                    </span>
                </div>
                </div>
                Post it!
          </button>
        </div>
  </div>
</template>

<script>

//import { mapGetters, mapActions } from "vuex";

const SmartText = () => import(/* webpackChunkName: "forms" */ /* webpackPrefetch: true */ "@/common/components/forms/Wysiwyg.vue");

export default {
  name: "CreateAsset",
  props: {
      assetType: {
        type: String,
        required: true
    }
  },
  components: {
      SmartText
  },
  data() {
    return {
        asset: {
            title: '',
            description: '',
            content: '',
            type: this.assetType,
            option: '0'
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
              let payload = this.getPayload();
              await this.$store.dispatch('asset/createAsset', payload);
              this.loader(false);
              this.asset = {};
              this.$router.push({
                  name: 'dashboardViewAssets'
              });
              } catch (error) {
                  this.loader(false);
                  this.asset = {};
              }
      },
      getPayload() {
          let payload = new FormData();
          //payload.append('asset', JSON.stringify(this.asset));
          payload.append('content', this.asset.content);
          payload.append('title', this.asset.title);
          payload.append('description', this.asset.description);
          payload.append('type', this.asset.type);
          payload.append('option', this.asset.option);
          return payload;
      },
      loader(args) {
        this.loading = args;
      }
  }

};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only 
<style scoped lang="scss">

</style>
-->
