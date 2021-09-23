<template>
  <div class="width-fix default-block-entry left-alignment height-fix dashboard-view">
    <admin-dashboard>
      <template v-slot:left-sidebar></template>
      <template v-slot:right-sidebar></template>
    </admin-dashboard>
    <slot/>
  </div>
</template>

<script>
import AdminDashboard from "./AdminLayoutDashboard";

export default {
  name: "AdminLayout",
  components: {
    AdminDashboard
  }
};
</script>
