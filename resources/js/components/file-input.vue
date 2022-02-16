<template>
  <div>
    <label class="form-label">{{ label }}</label>
    <input :class="{ error: error }" :id="id" type="file" class="form-input" v-bind="{ ...$attrs, class: null }" />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>
<script>
import { v4 as uuid } from "uuid";

export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `file-input-${uuid()}`;
      },
    },
    label: String,
    error: String,
  },
};
</script>