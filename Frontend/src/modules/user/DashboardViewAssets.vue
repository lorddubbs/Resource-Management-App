<template>
  <div class="container-dashboard">
    <div class="page-main-area">
      <bread-crumb :action="page"></bread-crumb>

      <div class="assets-showcase-container">
          <asset-box-table :assets="assets" :admin="admin"></asset-box-table>
      </div>

    </div>
  </div>
</template>

<script>

import { mapGetters, mapActions } from "vuex";

const BreadCrumb = () => import(/* webpackChunkName: "filters" */ /* webpackPrefetch: true */ "@/common/components/filters/BreadCrumb.vue");
const AssetBoxTable = () => import(/* webpackChunkName: "tables" */ /* webpackPrefetch: true */ "@/common/components/tables/AssetBoxTable.vue");

export default {
  
  name: "DashboardViewAsset",
  components: {
    BreadCrumb,
    AssetBoxTable
  },
  async created() {
    await this.getAllAssets();
  },
   data() {
    return {
      page: 'index',
      admin: 'restricted'
    };
  },
  computed: {
    ...mapGetters({
      assets: "asset/allAssets"
    })
  },
  methods: {
    ...mapActions({
      getAllAssets: "asset/getAllAssets"
    })
  }
};
</script>