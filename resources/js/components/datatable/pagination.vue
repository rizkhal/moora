<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, key) in links">
        <div v-if="link.url === null" :key="key" class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded dark:border-cool-gray-400" v-html="link.label" />
        <app-link
          v-else
          :key="`link-${key}`"
          class="
            mb-1
            mr-1
            px-4
            py-3
            border
            text-sm
            rounded
            leading-4
            text-gray-700
            dark:text-white
            hover:bg-white
            focus:text-purple-500 focus:border-purple-500
            dark:border-cool-gray-400 dark:hover:bg-cool-gray-500 dark:hover:text-cool-gray-50
          "
          :class="{ 'border-purple-500 dark:bg-cool-gray-400 dark:text-white': link.active }"
          :href="link.url"
          v-html="link.label"
        />
      </template>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    links: Array,
  },
};
</script>
