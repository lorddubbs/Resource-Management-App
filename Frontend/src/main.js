
Vue.filter("capitalize", function(value) {
  if (!value) return "";
  value = value.toString().toLowerCase();
  return value.charAt(0).toUpperCase() + value.slice(1);
});

import Vue from "vue";
import axios from "./services/request";
Vue.prototype.$axios = axios;

import App from "./App.vue";

import "bootstrap/dist/css/bootstrap.min.css";
import "jquery/src/jquery.js";
import "bootstrap/dist/js/bootstrap.min.js";
import "./assets/sass/srm.scss";
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';
Vue.use(VueToast, {
  position: 'top-right',
  queue: true,
  duration: 20000
});

import "./common/mixins/apiMixin";
import router from "./router";
import store from "./store/index";

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount("#srmapp");
