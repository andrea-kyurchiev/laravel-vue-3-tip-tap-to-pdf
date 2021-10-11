<template>
  <div>
    <div id="tableControlsWrapper" ref="tableControlsWrapper" class="d-flex">
      <div id="tableControls" ref="tableControls" class="table-controls-wrapper w-50">
        <div class="card">
          <div class="card-title">
            <h4 class="headline">Tables</h4>
          </div>
          <div class="card-text">
            <div class="p-inputgroup input-group input-group-login">
              <label class="text-left text-muted" for="rows">Rows count</label>
              <input class="w-100" id="rows" type="text" placeholder="" v-model="rows"/>
            </div>
            <div class="p-inputgroup input-group input-group-login mt-3">
              <label class="text-left text-muted" for="columns">Columns count</label>
              <input id="columns" v-model="cols" class="w-100" type="text" placeholder=""/>
            </div>
            <div class="p-inputgroup input-group input-group-login mt-3">
              <div class="row">
                <div class="col-12">
                  <input type="checkbox" id="withHeader" v-model="withHeader" class=""/>
                  <label class="text-left text-muted ml-2" for="withHeader">With header</label>
                </div>
              </div>
            </div>
          </div>
          <div class="card-actions mb-4">
            <button @click="closeTableControls()" type="button" class="btn btn-primary mt-2">
              Close
            </button>
            <button @click="addTable()" type="button" class="btn btn-primary mt-2">
              Apply
            </button>
          </div>
        </div>
      </div>
    </div>
    <template v-for="(item, index) in items">
      <div class="divider" v-if="item.type === 'divider'" :key="`divider${index}`" />
      <menu-item v-else :key="index" v-bind="item" />
    </template>
  </div>
</template>

<script>
import MenuItem from './MenuItem.vue'
export default {
  components: {
    MenuItem,
  },
  props: {
    editor: {
      type: Object,
      required: true,
    },
  },
  methods:{
    showTableControls() {
      var tableControlsWrapper = document.getElementById('tableControlsWrapper');
      var tableControls = document.getElementById('tableControls');
      tableControlsWrapper.style.visibility = 'visible';
      tableControls.style.visibility = 'visible';
    },
    closeTableControls(){
      var tableControlsWrapper = document.getElementById('tableControlsWrapper');
      var tableControls = document.getElementById('tableControls');
      tableControlsWrapper.style.visibility = 'hidden';
      tableControls.style.visibility = 'hidden';
    },
    addTable(){
      if(this.rows && this.cols){
        this.editor.chain().focus().insertTable({ rows: this.rows, cols: this.cols, withHeaderRow: this.withHeader }).run();
        this.closeTableControls();
      }
    },
    addImage() {
      const url = window.prompt('URL');

      if (url) {
        this.editor.chain().focus().setImage({ src: url }).run();
      }
    },
  },
  data() {
    return {
      rows: 3,
      cols: 3,
      withHeader: false,
      items: [
        {
          icon: 'fa fa-bold',
          title: 'Bold',
          action: () => this.editor.chain().focus().toggleBold().run(),
          isActive: () => this.editor.isActive('bold'),
        },
        {
          icon: 'fa fa-italic',
          title: 'Italic',
          action: () => this.editor.chain().focus().toggleItalic().run(),
          isActive: () => this.editor.isActive('italic'),
        },
        {
          icon: 'fa fa-strikethrough',
          title: 'Strike',
          action: () => this.editor.chain().focus().toggleStrike().run(),
          isActive: () => this.editor.isActive('strike'),
        },
        {
          icon: 'fa fa-code',
          title: 'Code',
          action: () => this.editor.chain().focus().toggleCode().run(),
          isActive: () => this.editor.isActive('code'),
        },
        {
          type: 'divider',
        },
        {
          icon: 'fa fa-header',
          title: 'Heading 1',
          action: () => this.editor.chain().focus().toggleHeading({ level: 1 }).run(),
          isActive: () => this.editor.isActive('heading', { level: 1 }),
        },
        {
          icon: 'fa fa-header',
          title: 'Heading 2',
          action: () => this.editor.chain().focus().toggleHeading({ level: 2 }).run(),
          isActive: () => this.editor.isActive('heading', { level: 2 }),
        },
        {
          icon: 'fa fa-paragraph',
          title: 'Paragraph',
          action: () => this.editor.chain().focus().setParagraph().run(),
          isActive: () => this.editor.isActive('paragraph'),
        },
        {
          icon: 'fa fa-list-ul',
          title: 'Bullet List',
          action: () => this.editor.chain().focus().toggleBulletList().run(),
          isActive: () => this.editor.isActive('bulletList'),
        },
        {
          icon: 'fa fa-list-ol',
          title: 'Ordered List',
          action: () => this.editor.chain().focus().toggleOrderedList().run(),
          isActive: () => this.editor.isActive('orderedList'),
        },
        // {
        //   icon: 'fa fa-table',
        //   title: 'Image',
        //   action: () => this.addImage(),
        //   isActive: () => this.editor.isActive('image'),
        // },
        {
          icon: 'fa fa-table',
          title: 'Table',
          action: () => this.editor.chain().focus().insertTable({ rows: this.rows, cols: this.cols, withHeaderRow: this.withHeader }).run(),
          //this.showTableControls(),
          isActive: () => this.editor.isActive('table'),
        },
        {
          icon: 'fa fa-align-left',
          title: 'Align Left',
          action: () => this.editor.chain().focus().setTextAlign('left').run(),
          isActive: () => this.editor.isActive('table'),
        },
        {
          icon: 'fa fa-align-center',
          title: 'Align Center',
          action: () => this.editor.chain().focus().setTextAlign('center').run(),
          isActive: () => this.editor.isActive('table'),
        },
        {
          icon: 'fa fa-align-right',
          title: 'Align Right',
          action: () => this.editor.chain().focus().setTextAlign('right').run(),
          isActive: () => this.editor.isActive('table'),
        },
        // {
        //   icon: 'fa fa-list-check-2',
        //   title: 'Task List',
        //   action: () => this.editor.chain().focus().toggleTaskList().run(),
        //   isActive: () => this.editor.isActive('taskList'),
        // },
        // {
        //   icon: 'fa fa-code-box-line',
        //   title: 'Code Block',
        //   action: () => this.editor.chain().focus().toggleCodeBlock().run(),
        //   isActive: () => this.editor.isActive('codeBlock'),
        // },
        {
          type: 'divider',
        },
        {
          icon: 'fa fa-quote-right',
          title: 'Blockquote',
          action: () => this.editor.chain().focus().toggleBlockquote().run(),
          isActive: () => this.editor.isActive('blockquote'),
        },
        {
          icon: 'fa fa-minus',
          title: 'Horizontal Rule',
          action: () => this.editor.chain().focus().setHorizontalRule().run(),
        },
        // {
        //   type: 'divider',
        // },
        // {
        //   icon: 'fa fa-text-wrap',
        //   title: 'Hard Break',
        //   action: () => this.editor.chain().focus().setHardBreak().run(),
        // },
        // {
        //   icon: 'fa fa-format-clear',
        //   title: 'Clear Format',
        //   action: () => this.editor.chain()
        //       .focus()
        //       .clearNodes()
        //       .unsetAllMarks()
        //       .run(),
        // },
        // {
        //   type: 'divider',
        // },
        // {
        //   icon: 'fa fa-undo',
        //   title: 'Undo',
        //   action: () => this.editor.chain().focus().undo().run(),
        // },
        // {
        //   icon: 'fa fa-arrow-go-forward-line',
        //   title: 'Redo',
        //   action: () => this.editor.chain().focus().redo().run(),
        // },
      ],
    }
  },
}
</script>

<style lang="scss">
.divider {
  width: 2px;
  height: 1.25rem;
  background-color: rgba(#000, 0.1);
  margin-left: 0.5rem;
  margin-right: 0.75rem;
}
button i {
  margin-left: auto;
  margin-right: auto;
}
</style>