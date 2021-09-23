<template>
  <div class="container-dashboard">
    <div class="page-main-area">
      <bread-crumb :action="page"></bread-crumb>

      <div class="multi-step-form-container">
                <div class="form-group" v-if="assetPush > 0">
                  <span id="back" @click="pushBack">
                    <i class="far fa-arrow-alt-circle-left"></i>
                    Go back
                  </span>
              </div>
              <div class="multi-step-form-item margin-t-40" v-if="assetPush === 0">
                <select-asset @media="selectAsset"></select-asset>
              </div>
              <div class="multi-step-form-item margin-t-40" v-if="assetPush === 1">
                <create-asset :asset-type = assetType></create-asset>  
              </div>
        </div>
      </div>
  </div>
</template>

<script>

const BreadCrumb = () => import(/* webpackChunkName: "filters" */ /* webpackPrefetch: true */ "@/common/components/filters/BreadCrumb.vue");
const SelectAsset = () => import(/* webpackChunkName: "forms" */ /* webpackPrefetch: true */ "@/common/components/forms/SelectAsset.vue");
const CreateAsset = () => import(/* webpackChunkName: "forms" */ /* webpackPrefetch: true */ "@/common/components/forms/CreateAsset.vue");

export default {
  
  name: "DashboardCreateAsset",
  components: {
    BreadCrumb,
    SelectAsset,
    CreateAsset
  },
   data() {
    return {
      page: 'create',
      assetPush: 0,
      assetType: null
    };
  },
  methods: {
    selectAsset(media) {
      if(media) {
        this.assetPush++;
        this.assetType = media;
      }
    },
    pushBack() {
      this.assetPush--;
    }
  }
};
</script>