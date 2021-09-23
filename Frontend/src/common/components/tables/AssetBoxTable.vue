<template>
<div class="assets-showcase-ad margin-t-60">
          <div class="showcase">
              <div class="showcase-item" v-for="asset in assets" :key="asset.id">
                  <div class="item-entry" @click="pushToRoute(asset.slug)">
                  <div class="item-badge margin-b-10">
                    <div class="badge" v-if="asset.type === 'pdf'">
                      <span>
                        <i class="far fa-file-pdf"></i>
                        </span>
                    </div>
                    <div class="badge" v-if="asset.type === 'snippet'">
                      <span>
                        <i class="fas fa-code"></i>
                        </span>
                    </div>
                    <div class="badge" v-if="asset.type === 'link'">
                      <span>
                        <i class="fas fa-link"></i>
                        </span>
                    </div>
                  </div>
                  <div class="item-content">
                      <ul>
                          <li class="margin-b-10">
                            <h1>
                              {{ asset.title }}
                              </h1>
                              </li>
                          <li class="margin-b-10">
                            <span :id="asset.type" class="spantag">
                              {{ asset.type }}
                            </span>
                          </li>
                      </ul>
                  </div>
                  </div>
              </div>
          </div>
      </div>
</template>

<script>

export default {
  name: "AssetBoxTable",
  props: {
    assets: {
        type: Array,
        required: true
        /*validator: function(obj) {
        }*/
    },
    admin: {
        type: String,
        required: true
    }
  },
  methods: {
      pushToRoute(slug) {
          this.$router.push({
              name: 'dashboardViewAsset',
              params: { asset: slug, role: this.admin }
        });
      }
  }
};
</script>