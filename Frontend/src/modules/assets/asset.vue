<template>
  <div class="container-dashboard">

    <div class="page-main-area">
      <bread-crumb :action="page"></bread-crumb>

      <div class="assets-showcase margin-t-60">
        <div class="showcase">
              <div class="showcase-item" v-for="item in asset" :key="item.id">
                  <div class="item-badge margin-b-10" v-if="!status">
                    <div class="badge" v-if="item.type === 'pdf'">
                      <span>
                        <i class="far fa-file-pdf"></i>
                        </span>
                    </div>
                    <div class="badge" v-if="item.type === 'snippet'">
                      <span>
                        <i class="fas fa-code"></i>
                        </span>
                    </div>
                    <div class="badge" v-if="item.type === 'link'">
                      <span>
                        <i class="fas fa-link"></i>
                        </span>
                    </div>
                  </div>
                  <div class="item-content" v-if="!status">
                      <ul>
                          <li class="margin-b-10">
                            <h1>
                              {{ item.title }}
                            </h1>
                            </li>
                            <li class="margin-b-10">
                            <p>
                              {{ item.description }}
                            </p>
                            </li>
                          <li class="margin-b-10">
                            <span :id="item.type" class="spantag">
                              {{ item.type }}
                            </span>
                          </li>
                          <li class="margin-b-10">
                            <div v-if="item.type === 'link'">
                                  <!--<a :target="{'_blank': item.option === 1}" :href="item.content">{{ item.content }}</a>-->
                                  <a target="_blank" :href="item.content" v-if="item.option === 1">{{ item.content }}</a>
                                  <a :href="item.content" v-else>{{ item.content }}</a>
                            </div>
                            <div v-if="item.type === 'pdf'">
                              <a :href="item.content" download>Download file</a>
                              </div>
                            <div class="highlight-syntax" v-if="item.type === 'snippet'">
                              <high-light :content="item.content"></high-light>
                            </div>
                          </li>
                      </ul>
                  </div>
                  <div class="toolbar" v-if="role === 'restricted'">
                    <ul v-if="!status">
                      <li>
                       <button id="edit" @click="editPage">
                         Edit Asset
                       </button>
                     </li>
                     <li>
                       <button id="delete" @click="deleteAsset(item.id)">
                         Delete 
                       </button>
                     </li>
                    </ul>
                  </div>
                  <div class="assets-edit" v-if="status">
                     <edit-asset 
                     :id="item.id"
                     :title="item.title" 
                     :description="item.description" 
                     :option="item.option"
                     :type="item.type"
                     :content="item.content">
                     </edit-asset>
                   </div>
                  </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>

import { mapGetters, mapActions } from "vuex";
const BreadCrumb = () => import(/* webpackChunkName: "filters" */ /* webpackPrefetch: true */ "@/common/components/filters/BreadCrumb.vue");
const EditAsset = () => import(/* webpackChunkName: "forms" */ /* webpackPrefetch: true */ "@/common/components/forms/EditAsset.vue");
const HighLight = () => import(/* webpackChunkName: "forms" */ /* webpackPrefetch: true */ "@/common/components/forms/Highlight.vue");

export default {
  name: "asset",
  components: {
    BreadCrumb,
    EditAsset,
    HighLight
  },
   created() {
    this.getAsset(this.$route.params.asset);
  },
   data() {
    return {
      page: this.$route.params.asset,
      role: this.$route.params.role,
      status: false
    };
  },
  computed: {
    ...mapGetters({
      asset: "asset/asset"
    })
  },
  methods: {
    ...mapActions({
      getAsset: "asset/getAsset",
      deleteAsset: "asset/deleteAsset"
    }),
     editPage() {
       this.status = true;
    }
  }
};
</script>