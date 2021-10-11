<template>
    <button
        class="btn btn-primary tip-tap-menu-item-btn d-flex"
        :class="isActive ? (isActive() ? 'is-active' : null ): null"
        @click="action"
        :title="title"
        type="button">
      <i :class="icon"></i>
    </button>
</template>

<script>
export default {
  props: {
    icon: {
      type: String,
      required: true,
    },
    // label: {
    //   type: String,
    //   required: true,
    // },
    title: {
      type: String,
      required: true,
    },
    action: {
      type: Function,
      required: true,
    },
    isActive: {
      type: Function,
      default: null,
    },
  },
  data() {
    return {
    }
  },
}
</script>

<style lang="scss">
.tip-tap-menu-item-btn {
  width: 1.75rem;
  height: 1.75rem;
  color: #0D0D0D;
  border: none;
  background-color: transparent;
  border-radius: 0.4rem;
  padding: 0.25rem;
  margin-right: 0.25rem;
  &.is-active,
  &:hover {
    color: #FFF!important;
    background-color: #856262 !important;
  }
}

.editor__footer{
  display: none!important;
}

button span {
  margin: auto;
}

.tip-tap-menu-item-btn .p-button-label{
  display:none;
}
</style>