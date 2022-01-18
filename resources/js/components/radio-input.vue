<template>
  <div class="relative" :class="$attrs.class">
    <input class="sr-only peer" type="radio" :value="value" name="radio_button" :id="id" v-bind="{ ...$attrs, class: null }" />
    <label
      :for="id"
      class="
        flex
        px-5
        py-2
        bg-white
        capitalize
        border border-gray-300
        rounded-lg
        cursor-pointer
        focus:outline-none
        hover:bg-gray-50
        peer-checked:ring-red-400 peer-checked:ring-2 peer-checked:border-transparent
      "
      >{{ label }}</label
    >
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
        return `radio-input-${uuid()}`;
      },
    },
    label: String,
    error: String,
    value: [String, Number],
  },
};
</script>