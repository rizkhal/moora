<template>
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-2">
      <div class="bg-white shadow-md rounded border">
        <div class="flex flex-col">
          <div class="p-4 flex items-center justify-center border-b border-gray-300">
            <app-link href="/announcement/create" class="bg-red-500 w-full p-3 flex items-center rounded-md text-white">
              <icon name="SparklesIcon" class="w-4 h-4 mr-2" />
              Buat Pengumuman
            </app-link>
          </div>
          <div class="p-2">
            <div class="flex flex-col space-y-2">
              <template v-for="(m, index) in menu" :key="index">
                <hr v-if="m.divider" />
                <app-link :href="m.route" :class="{ 'bg-red-500 text-white': isUrl(m.route.slice(1)) }" class="flex flex-row p-2 items-center transition rounded-md text-gray-600 hover:bg-red-500 hover:text-white">
                  <icon :name="m.icon" type="outline" class="w-6 h-6 mr-2" />
                  <span class="text-md">{{ m.text }}</span>
                </app-link>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-span-10">
      <div class="flex flex-col">
          <slot />
      </div>
    </div>
  </div>
</template>
<script>
import menu from './menu.json';

export default {
  name: 'NestedLayout',
  data() {
    return {
      menu: menu,
    }
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1);
      if (urls[0] === "") {
        return currentUrl === "";
      }

      return urls.filter((url) => currentUrl.startsWith(url)).length;
    },
  }
}
</script>