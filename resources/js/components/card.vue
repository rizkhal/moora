<template>
  <div
    class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
  >
    <div
      class="p-3 mr-4 rounded-full"
      :class="`bg-${color}-100 text-${color}-500 dark:text-${color}-100 dark:bg-${color}-500`"
    >
      <icon :name="icon" type="outline" />
    </div>
    <div>
      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
        {{ title }}
      </p>
      <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
        {{ value }}
      </p>
    </div>
  </div>
</template>
<script>
import icon from "@/components/icon.vue";

export default {
  components: {
    icon,
  },
  props: {
    color: String,
    icon: String,
    title: String,
    value: String,
  },
};
</script>