<template>
  <div class="p-5 text-center">
    <div class="rounded-full bg-red-200 flex items-center justify-center w-24 h-24 flex-shrink-0 mx-auto">
      <icon name="TrashIcon" type="solid" class="w-16 h-16 text-red-500" />
    </div>
    <div class="text-3xl mt-5">{{ title }}</div>
    <div class="text-gray-600 mt-2 leading-7">{{ message }}</div>
  </div>
  <div class="flex justify-center space-x-2 mt-4">
    <button type="button" class="btn-close" @click="$emit('close')">Close</button>
    <loading-button :loading="loading" class="btn-red ml-auto" @click="$emit('destroy')" type="button"> Delete </loading-button>
  </div>
</template>
<script>
export default {
  emits: ["close", "destroy"],
  props: {
    loading: Boolean,
    title: {
      type: String,
      default: "Are you sure?",
    },
    message: {
      type: String,
      default: "Do you really want to delete these records? This process cannot be undone.",
    },
  },
};
</script>