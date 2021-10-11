<template>
  <div class="editor" v-if="editor">
    <menu-bar class="editor__header" :editor="editor" />
    <bubble-menu id="bubbleMenu" :editor="editorRef" :shouldShow="() => { return this.editorRef.isActive('table'); }" v-if="editorRef">
       <button class="btn btn-primary mr-0" @click="editorRef.chain().focus().addColumnAfter().run()" :disabled="!editor.can().addColumnAfter()">
        Add Column
       </button>
       <button class="btn btn-primary mr-0" @click="editorRef.chain().focus().deleteColumn().run()" :disabled="!editor.can().deleteColumn()">
        Delete Column
       </button>
       <button class="btn btn-primary mr-0" @click="editorRef.chain().focus().addRowAfter().run()" :disabled="!editor.can().addRowAfter()">
        Add Row
       </button>
       <button class="btn btn-primary mr-0" @click="editorRef.chain().focus().deleteRow().run()" :disabled="!editor.can().deleteRow()">
        Delete Row
       </button>
       <button class="btn btn-primary mr-0" @click="editorRef.chain().focus().mergeOrSplit().run()" :class="!editor.can().mergeOrSplit() ? 'd-none' : ''">
        Merge Or Split
       </button>
        <button class="btn btn-primary mr-0" @click="editorRef.chain().focus().deleteTable().run()" :disabled="!editor.can().deleteTable()">
          Delete Table
        </button>
    </bubble-menu>
    <editor-content class="editor__content text-left" :editor="editorRef" />
    <div class="editor__footer">
    </div>
  </div>
</template>

<script>
import { Editor, EditorContent, TaskItem, TaskList, BubbleMenu} from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import MenuBar from './MenuBar.vue'
import {onBeforeUnmount, shallowRef} from 'vue';
import Text from '@tiptap/extension-text';
import TextAlign from '@tiptap/extension-text-align';
import Focus from '@tiptap/extension-focus'
import Table from '@tiptap/extension-table';
import TableRow from '@tiptap/extension-table-row';
import TableCell from '@tiptap/extension-table-cell';
import TableHeader from '@tiptap/extension-table-header';

export default {
  components: {
    EditorContent,
    MenuBar,
    BubbleMenu,
  },

  data() {
    return {
    }
  },
  setup(_, { emit }) {
    let editor = new Editor({
      extensions: [
        StarterKit.configure({
          history: true
        }),
        Focus.configure({
          className: 'has-focus',
          mode: 'all',
        }),
        TaskList,
        TaskItem,
        Text,
        TextAlign.configure({
          types: ['heading', 'paragraph'],
        }),
        Table.configure({
          resizable: false,
        }),
        TableRow,
        TableHeader,
        TableCell,
        // CharacterCount.configure({
        //   limit: 10000,
        // }),
      ],
      content: `<p></p> <p></p> <p></p>`,
      emits: 'update:modelValue',
      onUpdate: () => {
        emit('update:modelValue', editor.getHTML())
      },
    })

    const editorRef = shallowRef(editor);
    editor.on('transaction', () => {
      editorRef.value = null;
      editorRef.value = editor;
    });

    onBeforeUnmount(() => {
      editor.destroy()
    })

    return {
      editor,editorRef
    }
  },
  mounted() {

  },

  watch: {
    modelValue(value) {
      const isSame = this.editor.getHTML() === value

      if (isSame) {
        return
      }

      this.editor.commands.setContent(value, false)
    },
  },

  methods:{
  },
}
</script>

<style lang='scss'>
.tippy-box{
  display: contents;
}
.editor {
  display: flex;
  flex-direction: column;
  max-height: 26rem;
  color: #0D0D0D;
  background-color: #FFF;
  border: 3px solid #0D0D0D;
  border-radius: 0.75rem;
  &__header {
    display: flex;
    align-items: center;
    flex: 0 0 auto;
    flex-wrap: wrap;
    padding: 0.25rem;
    border-bottom: 3px solid #0D0D0D;
  }
  &__content {
    padding: 1.25rem 1rem;
    flex: 1 1 auto;
    overflow-x: hidden;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
  }
  &__footer {
    display: flex;
    flex: 0 0 auto;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    white-space: nowrap;
    border-top: 3px solid #0D0D0D;
    font-size: 12px;
    font-weight: 600;
    color: #0D0D0D;
    white-space: nowrap;
    padding: 0.25rem 0.75rem;
  }
  /* Some information about the status */
  &__status {
    display: flex;
    align-items: center;
    border-radius: 5px;
    &::before {
      content: ' ';
      flex: 0 0 auto;
      display: inline-block;
      width: 0.5rem;
      height: 0.5rem;
      background: rgba(#0D0D0D, 0.5);
      border-radius: 50%;
      margin-right: 0.5rem;
    }
    &--connecting::before {
      background: #616161;
    }
    &--connected::before {
      background: #B9F18D;
    }
  }
  &__name {
    button {
      background: none;
      border: none;
      font: inherit;
      font-size: 12px;
      font-weight: 600;
      color: #0D0D0D;
      border-radius: 0.4rem;
      padding: 0.25rem 0.5rem;
      &:hover {
        color: #FFF;
        background-color: #0D0D0D;
      }
    }
  }
}

/* Give a remote user a caret */
.collaboration-cursor__caret {
  position: relative;
  margin-left: -1px;
  margin-right: -1px;
  border-left: 1px solid #0D0D0D;
  border-right: 1px solid #0D0D0D;
  word-break: normal;
  pointer-events: none;
}
/* Render the username above the caret */
.collaboration-cursor__label {
  position: absolute;
  top: -1.4em;
  left: -1px;
  font-size: 12px;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  user-select: none;
  color: #0D0D0D;
  padding: 0.1rem 0.3rem;
  border-radius: 3px 3px 3px 0;
  white-space: nowrap;
}
.ProseMirror {
  table {
    border-collapse: collapse;
    table-layout: fixed;
    width: 100%;
    margin: 0;
    overflow: hidden;

    td,
    th {
      min-width: 1em;
      border: 2px solid #ced4da;
      padding: 3px 5px;
      vertical-align: top;
      box-sizing: border-box;
      position: relative;

      > * {
        margin-bottom: 0;
      }
    }

    th {
      font-weight: bold;
      text-align: left;
      background-color: #f1f3f5;
    }

    .selectedCell:after {
      z-index: 2;
      position: absolute;
      content: '';
      left: 0; right: 0; top: 0; bottom: 0;
      background: rgba(200, 200, 255, 0.4);
      pointer-events: none;
    }

    .column-resize-handle {
      position: absolute;
      right: -2px;
      top: 0;
      bottom: -2px;
      width: 4px;
      background-color: #adf;
      pointer-events: none;
    }
  }
}

.tableWrapper {
  padding: 1rem 0;
  overflow-x: auto;
}

.resize-cursor {
  cursor: ew-resize;
  cursor: col-resize;
}
/* Basic editor styles */
.ProseMirror {
  > * + * {
    margin-top: 0.75em;
  }
  ul,
  ol {
    padding: 0 1rem;
  }
  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    line-height: 1.1;
  }
  code {
    background-color: rgba(#616161, 0.1);
    color: #616161;
  }
  pre {
    background: #0D0D0D;
    color: #FFF;
    font-family: 'JetBrainsMono', monospace;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    code {
      color: inherit;
      padding: 0;
      background: none;
      font-size: 0.8rem;
    }
  }
  mark {
    background-color: #FAF594;
  }
  img {
    max-width: 100%;
    height: auto;
  }
  hr {
    margin: 1rem 0;
  }
  blockquote {
    padding-left: 1rem;
    border-left: 2px solid rgba(#0D0D0D, 0.1);
  }
  hr {
    border: none;
    border-top: 2px solid rgba(#0D0D0D, 0.1);
    margin: 2rem 0;
  }
  ul[data-type='taskList'] {
    list-style: none;
    padding: 0;
    li {
      display: flex;
      align-items: center;
      > label {
        flex: 0 0 auto;
        margin-right: 0.5rem;
        user-select: none;
      }
      > div {
        flex: 1 1 auto;
      }
    }
  }
}
</style>