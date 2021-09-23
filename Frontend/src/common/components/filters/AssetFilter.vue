<template>
<div class="filter-box">
    <div class="filter-box-container">
        <div class="filter-box-header">
            <h1>All {{ header }}</h1>
        </div>
        <div class="filter-box-options" v-if="route === null">
            <div class="filter-menu-container">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown width-fix">
                        <div class="filter-menu">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" 
                            aria-haspopup="true" aria-expanded="false">
                            <div class="filter-menu-options">
                                <div class="filter">
                                    <div class="filter-option">
                                        <span>{{ type | capitalize }}</span>
                                    </div>
                                </div>
                            </div>
                            <span class="caret">
                                <i class="fas fa-angle-down"></i>
                            </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <ul class="filter-buttons">
                                    <li>
                                        <button @click="initiate('pdf')">
                                            PDF
                                        </button>
                                    </li>
                                   
                                    <li>
                                        <button @click="initiate('link')">
                                            Link
                                        </button>
                                    </li>
                                    <li>
                                        <button @click="initiate('snippet')">
                                            Snippet
                                        </button>
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
</template>

<script>

export default {
  name: "AssetFilter",
  data() {
    return {
      header: 'assets',
      type: 'choose content',
      route: this.$route.params.asset || null
    };
  },
   methods: {
    initiate(media) {
      this.header = media;
      this.type = media;
      this.$emit('media', media);
    }
  }
};
</script>
