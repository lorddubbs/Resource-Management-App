<template>
  <div class="container">
      <div class="message-box">
          <div class="message-box-icon">
              <div class="icon">
                  <span class="default-block-entry center-alignment">
                      <i class="fas fa-bullhorn"></i>
                  </span>
              </div>
          </div>
          <div class="message-box-content">
              <div class="box-content">
                  <h2>The best things are free</h2>
              </div>
              <div class="box-content">
                  <p>Hey, Welcome to SRM. We have a lot to offer. Get free access you want to the best content on the Web. It is free forever. 
                      <br/>
                      Terms and Conditions apply.</p>
              </div>
          </div>
          <div class="message-box-control">
              <div class="icon">
                  <span @click="initiate">
                      <i class="fas fa-times"></i>
                  </span>
              </div>
          </div>
      </div>
  </div>
</template>

<script>

export default {
  name: "Message",
  data() {
      return {
          value: true
      }
  },
  methods: {
      initiate() {
          this.$emit('min', this.value)
      }
  }
};
</script>
