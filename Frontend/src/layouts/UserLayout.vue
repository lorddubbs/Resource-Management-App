<template>
  <div class="container height-fix">
    <div class="top-navigation-section default-block-entry left-alignment">
      <header class="top-navigation-header navigation-background">
        <div class="container height-fix-2">
          <nav class="navbar navbar-expand-md navbar-light padding-a-0 height-fix-2">
            <div class="container height-fix-2">
              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
                @click="menuClass = !menuClass"
              >
              </button>
              <div class="navigation-entry default-flex-entry height-fix-2 padding-l-r-7">
                <div class="navigation-entry-logo center-alignment padding-t-b-3">
                  <router-link
                    :to="{ name: 'Home' }"
                    class="navbar-brand center-alignment logo-dark"
                  >
                  SRM.
                    <!-- logo stays here -->
                  </router-link>
                </div>
                <div
                  class="collapse navbar-collapse"
                  id="navbarSupportedContent"
                >
                  
                  <div class="navbar-collapse-content default-flex-entry height-fix-2">
                    <div class="top-main-links height-fix-2">
                      <div class="container height-fix-2">
                        <ul class="navbar-nav mr-auto default-flex-entry height-fix-2">
                          <li>
                            <router-link :to="{ name: 'viewAssets', params: { asset: 'pdf' } }">
                              PDFs
                            </router-link>
                          </li>
                          <li>
                            <router-link :to="{ name: 'viewAssets', params: { asset: 'snippet' } }">
                              Snippets
                            </router-link>
                          </li>
                          <li>
                            <router-link :to="{ name: 'viewAssets', params: { asset: 'link' } }">
                              Links
                            </router-link>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="top-main-user-area">
                        <div class="top-main-user height-fix-2">
                          <div class="user-notification">
                                <div class="notification-bell">
                                    <span>
                                      <i class="far fa-file-alt"></i>
                                      </span>
                                </div>
                                <!--<div class="notification-counter" v-if="notificationStatus">
                                    <span>
                                        3
                                    </span>
                                </div>-->
                            </div>
                            <div class="user-menu-container">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item dropdown width-fix">
                                        <div class="user-menu">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" 
                                            aria-haspopup="true" aria-expanded="false">
                                            <div class="user-menu-image">
                                                <div class="user-thumbnail">
                                                    <div class="thumbnail">
                                                      <span>V</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="caret">
                                                <i class="fas fa-angle-down"></i>
                                            </span> 
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <ul class="navigation-bar-dropdown">
                                                    <li>
                                                        <router-link :to="{ name: 'dashboardCreateAsset' }">
                                                            <i class="fas fa-user-circle"></i>
                                                            Visit Admin
                                                        </router-link>
                                                    </li>
                                                </ul>
                                            </div>
                                      </div>
                                    </li>
                                </ul>
                           </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      </div>

    <slot />

  </div>
</template>

<script>

import { mapGetters } from "vuex";
//const Notification = () => import(/* webpackChunkName: "overlays" */ /* webpackPrefetch: true */ "@/common/components/overlays/Notifications.vue");

export default {
  name: "UserLayout",
  data() {
    return {
      menuClass: false,
      notificationStatus: true
    };
  },
  async created() {
    try {
        await this.$store.dispatch('asset/getAllAssets');
      } catch (error) {
        return;
      }
  },
  computed: {
    ...mapGetters({
      assets: "asset/allAssets"
    })
  }
};
</script>
