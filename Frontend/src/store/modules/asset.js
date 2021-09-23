export default {
    namespaced: true,
    state: {
      asset: {},
      allAssets: [],
      assetCounts: []
    },
    getters: {
      asset: state => state.asset,
      allAssets: state => state.allAssets,
      assetCounts: state => state.assetCounts
    },
    mutations: {
      SET_ASSET(state, asset) {
        state.asset = asset;
      },

      ALL_ASSETS(state, asset) {
        state.allAssets = asset;
      },

      GET_ASSET_COUNT(state, asset) {
        state.assetCounts = asset;
      },

      UPDATE_ASSET(state, asset) {
        var index = state.assets.findIndex(function(item, i) {
          return item.id === asset.id;
        });
        state.assets = [
           ...state.assets.slice(0, index),
           payload,
           ...state.assets.slice(index + 1)
         ]
      },

      DELETE_ASSET(state, asset){
        var index = state.assets.findIndex(function(item, i) {
          return item.id === asset;
        });
        state.assets.splice(index, 1)
        state.count--
      },
    },
    actions: {
      async createAsset({ commit }, payload) {
        let asset = await this.$apiService.asset.post(payload);
        commit("SET_ASSET", asset);
      },
      
      async getAllAssets({ commit }) {
        let asset = await this.$apiService.asset.fetch();
        commit("ALL_ASSETS", asset.data);
      },

      async getAsset({ commit }, payload) {
        let asset = await this.$apiService.asset.get(payload);
        commit("SET_ASSET", asset.data);
      },

      async getMediaAssets({ commit }, payload) {
        let assets = await this.$apiService.asset.getMediaAssets(payload);
        commit("SET_ASSET", assets);
      },

      async getAssetCounts({ commit }) {
        let assets = await this.$apiService.asset.getAssetCounts();
        commit("GET_ASSET_COUNT", assets.data);
      },

      async updateAsset({ commit }, payload) {
        let asset = await this.$apiService.asset.put(payload.id, payload.data);
        commit("UPDATE_ASSET", asset.data);
      },

      async deleteAsset({ commit }, payload) {
        let asset = await this.$apiService.asset.delete(payload);
        commit("DELETE_ASSET", asset.data);
      },
    }
  };
  