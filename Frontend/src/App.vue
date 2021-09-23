<template>
  <div id="srmapp">
    <Layout>
      <router-view :key="$route.fullPath" />
    </Layout> 
  </div>
</template> 

<script>

import Layout from "./layouts/MainLayout";

export default {
  components: {
    Layout
  },
  watch: {
    $route: {
      immediate: true,
      handler(to) {
      document.title = to.meta.title || "SRM";
      }
    }
  }
};
</script>
