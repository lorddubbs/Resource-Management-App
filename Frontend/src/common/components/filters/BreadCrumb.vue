<template>
<div class="breadcrumb-container">
  <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item">
           <router-link :to="{name: 'dashboardCreateAsset'}">
               Asset
            </router-link>
        </li>
       <li class="breadcrumb-item active" aria-current="page">{{ action }}</li>
     </ol>
   </nav>
</div>
</template>

<script>
export default {
  name: "BreadCrumb",
  props: {
      action: {
        type: String
    }
  }
}
</script>

<style scoped>
</style>
