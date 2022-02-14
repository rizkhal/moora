<template>
  <app-head :title="title" v-if="title" />

  <div class="flex min-h-screen w-full bg-gray-50 text-gray-700">
    <aside class="hidden fixed inset-y-0 left-0 rtl:left-auto rtl:right-0 z-20 lg:flex flex-col h-screen overflow-hidden shadow-2xl duration-300 lg:border-r w-[14rem] lg:z-0 lg:translate-x-0 translate-x-0">
      <header class="border-b shrink-0 px-6 h-[4rem] flex items-center">
        <app-link class="text-xl font-bold tracking-tight focus:outline-none focus:ring-2 focus:ring-red-500" href="/"> SKRIPSI </app-link>
      </header>

      <!-- desktop navigator -->
      <navigator :navigator="site.navigator" />

      <footer class="border-t px-6 py-3 flex shrink-0 items-center gap-3">
        <img :src="profilePicture" class="w-11 h-11 rounded-full bg-cover bg-center" />

        <div>
          <p class="text-sm font-bold">{{ auth.user.name }}</p>

          <p class="text-xs text-gray-500 hover:text-gray-700 focus:text-gray-700">
            <app-link href="/logout" method="delete" as="button"> Sign out </app-link>
          </p>
        </div>
      </footer>
    </aside>
    <div class="w-screen space-y-6 flex-1 flex flex-col lg:pl-[14rem]">
      <div class="flex-1 w-full">
        <header class="h-[4rem] shrink-0 w-full border-b flex items-center">
          <div class="flex items-center w-full px-2 sm:px-4 md:px-6 lg:px-8">
            <button class="shrink-0 flex items-center justify-center w-10 h-10 text-primary-500 rounded-full hover:bg-gray-500/5 focus:bg-primary-500/10 focus:outline-none lg:hidden">
              <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>

            <div class="flex-1 flex items-center justify-between">
              <div>
                <breadcrumb :items="site.breadcrumbs" />
              </div>

              <!-- global search field -->
              <!-- <div class="flex items-center">
                <div class="relative">
                  <div>
                    <label for="globalSearchQueryInput" class="sr-only"> Global search </label>

                    <div class="relative group max-w-md">
                      <span class="absolute inset-y-0 left-0 flex items-center justify-center w-10 h-10 text-gray-500 pointer-events-none group-focus-within:text-primary-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                      </span>

                      <input
                        id="globalSearchQueryInput"
                        placeholder="Search"
                        type="search"
                        autocomplete="off"
                        class="
                          block
                          w-full
                          h-10
                          pl-10
                          lg:text-lg
                          bg-gray-400/10
                          placeholder-gray-500
                          border-transparent
                          duration-75
                          rounded-lg
                          focus:bg-white focus:placeholder-gray-400 focus:border-red-600 focus:ring-1 focus:ring-inset focus:ring-red-600
                        "
                      />
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </header>

        <div class="p-6 overflow-x-hidden">
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import navigator from "@/components/navigator.vue";
import breadcrumb from "@/components/breadcrumb.vue";

export default {
  components: {
    navigator,
    breadcrumb,
  },
  props: {
    auth: Object,
    site: Object,
    title: String,
  },
  data() {
    return {
      profilePicture: null,
    };
  },
  created() {
    let path = this.auth.user.detail ? this.auth.user.detail.picture : "img/sample.jpg";

    this.profilePicture = `${this.$helper.appUrl}/${path}`;
  },
  methods: {
    something() {
      console.log("fired");
    },
  },
};
</script>
