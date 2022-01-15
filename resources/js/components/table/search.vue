<template>
  <div class="relative text-gray-600 focus-within:text-gray-400">
    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
      <button type="button" class="p-1 focus:outline-none focus:shadow-outline">
        <SearchIcon class="w-5 h-5" />
      </button>
    </span>
    <input type="search" name="q" class="py-2 text-sm text-gray-800 rounded-md pl-10 border appearance-none focus:ring-0 outline-none focus:border-indigo-500 border-gray-300" placeholder="Search..." autocomplete="off" />
  </div>
</template>
<script>
import { SearchIcon } from '@heroicons/vue/outline'

export default {
  components: {
    SearchIcon,
  },
}
</script>