<template>
  <div class="container-home default-block-entry left-alignment">

    <div class="page-main-area">
      <asset-table :assets="items"></asset-table>
    </div>
  </div>
</template>

<script>

import { mapGetters } from "vuex";
const AssetTable = () => import(/* webpackChunkName: "tables" */ /* webpackPrefetch: true */ "@/common/components/tables/AssetTable.vue");

export default {
  name: "assets",
  components: {
      AssetTable
  },
  data() {
    return {
      assetData: []
    }
  },
  computed: {
    ...mapGetters({
      assets: "asset/allAssets"
    }),
    items() {
      return this.assets.filter(item => item.type == this.$route.params.asset);
    }
  }
};
</script>
