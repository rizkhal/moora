<template>
  <span :class="{ 'text-gray-400': value === 'N/A' }">
    {{ value }}
  </span>
</template>
<script>
export default {
  props: {
    value: String,
  },
}
</script>