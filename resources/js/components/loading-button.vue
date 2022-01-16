<template>
  <button :disabled="loading" class="flex items-center bg-red-500 py-2 px-4 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-offset-2">
    <div v-if="loading" class="btn-spinner mr-2" />
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    loading: Boolean,
  },
};
</script>
