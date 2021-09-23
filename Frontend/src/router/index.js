import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";

import Asset from "../modules/assets/asset.vue";
import Assets from "../modules/assets/assets.vue";

import DashboardCreateAssets from "../modules/user/DashboardCreateAsset.vue";
import DashboardViewAssets from "../modules/user/DashboardViewAssets.vue";

const Error404 = () => import(/* webpackChunkName: "utilities" */ /* webpackPrefetch: true */ "@/views/404.vue");


Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: {
      layout: "UserLayout",
      title: "SRM | Home"
    }
  },
  {
    path: "/asset/view/:role/:asset",
    name: "userViewAsset",
    component: Asset,
    props: true,
    meta: {
      layout: "UserLayout",
      title: "SRM | View Asset"
    }
  },
  {
    path: "/assets/:asset",
    name: "assets",
    component: Asset,
    props: {
      asset: String
    }
  },
  {
    path: "/niche/assets/:asset",
    name: "viewAssets",
    component: Assets,
    props: {
      asset: String,
      required: true
    },
    meta: {
      layout: "UserLayout",
      title: "SRM"
    }
  },
  {
    path: "/dashboard/asset/create",
    name: "dashboardCreateAsset",
    component: DashboardCreateAssets,
    meta: {
      layout: "AdminLayout",
      title: "SRM | Dashboard"
    }
  },
  {
    path: "/dashboard/asset/view/:role/:asset",
    name: "dashboardViewAsset",
    component: Asset,
    props: true,
    meta: {
      layout: "AdminLayout",
      title: "SRM | Dashboard"
    }
  },
  {
    path: "/dashboard/asset/index",
    name: "dashboardViewAssets",
    component: DashboardViewAssets,
    meta: {
      layout: "AdminLayout",
      title: "SRM | Dashboard"
    }
  },
  { 
    path: "*",
    name: 'Error',
    component: Error404, 
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
