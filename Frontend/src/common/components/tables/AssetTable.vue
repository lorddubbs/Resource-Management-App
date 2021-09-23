<template>
  <div class="container">
      <div class="container-filter">
        <asset-filter @media="processMedia"></asset-filter>
      </div>
    <div class="container-table"> 
        <table class="custom-table">
            <thead>
               <tr>
                   <th>Title</th>
                   <th>Description</th>
                   <th>Type</th>
                   <th>Preview</th>
                   <th>Uploaded</th>
               </tr>
            </thead>
            <tbody>
               <tr v-for="asset in assetData" :key="asset.id" @click="pushToPage(asset.slug)">
                   <td>
                     <span>
                       {{ asset.title }}
                     </span>
                   </td>
                   <td>
                     <span>
                     {{ asset.description }}
                     </span>
                   </td>
                   <td>
                     <span>
                     {{ asset.type | capitalize }}
                     </span>
                   </td>
                   <td>
                     <span v-if="asset.type === 'link'">
                       {{ asset.content }}
                      </span>
                      <span v-else>
                       -
                      </span>
                   </td>
                   <td>
                     <span>
                       {{ asset.updated_at }}
                      </span>
                    </td>
               </tr>
            </tbody>
        </table>
    </div>
  </div>
</template>

<script>

const AssetFilter = () => import(/* webpackChunkName: "filters" */ /* webpackPrefetch: true */ "@/common/components/filters/AssetFilter.vue");
export default {
  name: "AssetTable",
  props: {
    assets: {
        type: Array,
        required: true
        /*validator: function(obj) {
        }*/
    }
  },
  data() {
    return {
      assetData: [],
    }
  },
   computed: {
    items() {
      this.assetData = this.assets;
    }
  },
  watch: {
    assets(assets) {
      this.assetData = assets;
    }
  },
  components: {
      AssetFilter
  },
  methods: {
      processMedia(media) {
      const options = {
         pdf: 'pdf',
         snippet: 'snippet',
         link: 'link'
       }
       this.media = options[media];
       this.initiate(this.media)
    },
    initiate(media) {
      this.assetData = this.assets.filter(item => item.type == media);
    },
    pushToPage(slug) {
       this.$router.push({
              name: 'userViewAsset',
              params: { asset: slug, role: 'user' }
        });
    }
  }
};
</script>
