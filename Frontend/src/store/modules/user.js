export default {
    namespaced: true,
    state: {
      user: []
    },
    getters: {
      user: state => state.user
    },
    mutations: {
      SET_USER(state, user) {
        state.user = user;
      },
      GET_USER(state, user) {
        state.user = user;
      }
    },
    actions: {
      
    }
  };
  