<template>
  <div class="container">
      <div class="form-group">
          <h1>Select an Asset Type</h1>
      </div>

      <div class="form-group">
          <div class="form-group-options">
              <div class="radio-options">
                  <input type="radio" id="option_pdf" value="pdf"  checked="checked" v-model="assetType.selected">
                  <label class="radio" for="option_pdf">
                      <i class="far fa-file-pdf margin-b-10"></i>
                      PDF File
                  </label>
              </div>
              <div class="radio-options">
                  <input type="radio" id="option_html" value="snippet" v-model="assetType.selected">
                  <label class="radio" for="option_html">
                      <i class="fas fa-code margin-b-10"></i>
                      HTML Snippet
                  </label>
              </div>
              <div class="radio-options">
                  <input type="radio" id="option_link" value="link" v-model="assetType.selected">
                  <label class="radio" for="option_link">
                      <i class="fas fa-link margin-b-10"></i>
                      Link
                  </label>
              </div>
          </div>
      </div>

      <div class="form-group margin-t-40 default-flex-entry">
          <button @click="initiate">
            Continue
          </button>
        </div>
  </div>
</template>

<script>
export default {
  name: "SelectAsset",
  data() {
    return {
      assetType: {
          selected: null
        }
    };
  },
  methods: {
    initiate() {
      this.$emit('media', this.assetType.selected);
    }
  }

};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only 
<style scoped lang="scss">

</style>
-->
