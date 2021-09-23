<template>
  <div class="container-home default-block-entry left-alignment">
    <div class="page-message-area" v-if="status">
      <message @min="minimizeWindow"></message>
    </div>

    <div class="page-main-area">
      <asset-table :assets="assets"></asset-table>
    </div>
  </div>
</template>

<script>

import { mapGetters } from "vuex";
const Message = () => import(/* webpackChunkName: "overlays" */ /* webpackPrefetch: true */ "@/common/components/overlays/Message.vue");
const AssetTable = () => import(/* webpackChunkName: "tables" */ /* webpackPrefetch: true */ "@/common/components/tables/AssetTable.vue");

export default {
  name: "Home",
  components: {
      Message,
      AssetTable
  },
  data() {
    return {
      status: true
    }
  },
  computed: {
    ...mapGetters({
      assets: "asset/allAssets"
    })
  },
  methods: {
  minimizeWindow(min) {
      if(min) {
        this.status = false;
      }
    }
  }
};
</script>
