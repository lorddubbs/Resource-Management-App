<template>
<div class="highlight-syntax-container">
    <div class="syntax-container" ref="starter">
         <div class="form-group margin-b-10 margin-t-10">
            <pre>
              <code class="language-html">
               {{ content }}
              </code>
            </pre>
        </div>
        <div class="highlight-copy">
        <span class="copy-btn btn btn-info" @click="copySnippet">
          <i class="far fa-copy">
          </i>
          Copy
        </span>
        </div>
    </div>
</div>
</template>


<script>

import Prism from "prismjs";
import 'prismjs/themes/prism.css';
export default {
  name: "Highlight",
  props: {
    content: {
        type: String,
        required: true
    }
  },
  created() {
    this.$nextTick(function() {
      Prism.highlightAll();
    })
  },
  methods: {
      copySnippet() {
        let copyText = this.$refs.highlightingContent.textContent;
        if(copyText) {
          let textArea = document.createElement('textarea');
          textArea.textContent = copyText;
          let body = this.$refs.starter;
          if(body) {
            body.append(textArea);
            textArea.select();
            document.execCommand('copy');
            textArea.setAttribute("hidden", true);
          }
        }
      }
  }
};
</script>

<style scoped lang="scss">
code {
    display: block;
    /* flex-flow: column; */
    font-size: 14px;
    max-width: 100%;
    word-break: break-word;
    white-space: normal;
}
</style>
