<template>
    <div class="width-fix">
        <div class="width-fix edit-header margin-t-10">
            <textarea 
            placeholder="Enter a Description" 
            id="description" spellcheck="true" 
            v-model="snippet.description"
            @keyup="updateContent($event)">
            </textarea>
        </div>

        <div class="smart-text-container margin-t-10">
            <textarea 
            v-model="snippet.content"
            placeholder="Enter Html Snippet" 
            id="editor" 
            spellcheck="false"
            @input="highlightCode($event);
            textareaScroll();"
            @scroll="textareaScroll()"
            @keydown="textareaTabKeys($event)"
            @keyup="updateContent($event)">
            </textarea>

            <pre id="highlights" ref="highlightdisplay" aria-hidden="true">
              <code class="language-html" ref="highlightContent">
              </code>
            </pre>
        </div>
    </div>
</template>

<script>

import Prism from "prismjs";
import 'prismjs/themes/prism.css';
export default {
  name: "Wysiwyg",
  props: {
      content: {
          type: String
      },
      description: {
          type: String
      },
  },
  created() {
    this.$nextTick(function() {
      Prism.highlightAll();
    })
  },
  data() {
    return {
        snippet: {
            description: '' || this.description,
            content: '' || this.content
        },
        keyTimer: undefined,
        timeoutValue: 1000
    };
  },
  methods: {
    highlightCode(e) {
      let content = e.target.value
      let result_element = this.$refs.highlightContent;

      if(content[content.length-1] == "\n") {
        content += " ";
        }
        
        result_element.innerHTML = content.replace(new RegExp("&", "g"), "&amp;").replace(new RegExp("<", "g"), "&lt;");
        Prism.highlightElement(result_element);
    },

    textareaScroll() {
      let element = this.snippet.content;
      let result_element = this.$refs.highlightdisplay;
      result_element.scrollTop = element.scrollTop;
      result_element.scrollLeft = element.scrollLeft;
    },
    
    textareaTabKeys(e) {
      let code = e.target.value;
      if(e.key == "Tab") {
        e.preventDefault(); 
        let before_tab = code.slice(0, element.selectionStart); 
        let after_tab = code.slice(element.selectionEnd, element.value.length); 
        let cursor_pos = element.selectionEnd + 1; 
        element.value = before_tab + "\t" + after_tab; 
        element.selectionStart = cursor_pos;
        element.selectionEnd = cursor_pos;
        update(element.value);
      }
    },
    
    updateContent(e) {
      clearTimeout(this.keyTimer);
      this.keyTimer = setTimeout(() => {
        this.$emit('snippet', this.snippet);
      }, this.timeoutValue);
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only 
<style scoped lang="scss">

</style>
-->