<template>
  <div>
    <ul class="hidden items-center text-md font-medium text-sm lg:flex">
      <li class="flex items-center">
        <Link href="/home">Beranda</Link>
        <svg v-if="items.length" class="w-6 h-6 m-0 text-gray-300" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
          <path d="m12.5 3.5-4 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </li>

      <li v-for="(item, index) in items" :key="index" :class="{ 'flex items-center text-gray-500': !isLast(index) }">
        <Link v-if="!isLast(index)" :href="item.url" class="text-gray-500">
          {{ item.title }}
        </Link>

        <Link v-else href="#" class="text-gray-500">
          {{ item.title }}
        </Link>

        <svg v-if="!isLast(index)" class="w-6 h-6 m-0 text-gray-300" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
          <path d="m12.5 3.5-4 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </li>
    </ul>
  </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    Link,
  },
  props: {
    items: Object,
  },
  methods: {
    isLast(index) {
      return index === this.items.length - 1
    },
  },
}
</script>