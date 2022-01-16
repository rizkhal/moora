<template>
  <span :class="{ 'text-gray-400': value === null }">
    {{ value ? value : "N/A" }}
  </span>
</template>
<script>
export default {
  props: {
    value: {
      type: String,
      default: null,
    },
  },
};
</script>