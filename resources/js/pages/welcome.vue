<style scoped>
#bg {
  z-index: 20;
  background-position: bottom;
  background-repeat: no-repeat;
  background-size: cover;
  overflow: hidden;
}
</style>
<template>
  <app-head :title="site.setting.site_description" />

  <div id="bg" style="background-image: url('img/banner-bg.svg')">
    <!--Nav-->
    <div class="w-full container mx-auto p-6">
      <div class="w-full flex items-center justify-between">
        <a
          class="
            flex
            items-center
            text-gray-200
            hover:no-underline
            font-bold
            text-2xl
            lg:text-4xl
          "
          href="#"
        >
          <img
            class="w-24"
            :src="site.setting.site_logo"
            :alt="site.setting.site_name"
          />
          <div class="flex flex-col ml-3">
            <h3>{{ site.setting.site_logo_text }}</h3>
          </div>
        </a>

        <div class="flex w-1/2 justify-end content-center">
          <a
            href="#"
            class="
              px-4
              py-3
              rounded-md
              font-bold
              text-white
              bg-gradient-to-r bg-red-600
            "
          >
            Alur Pendaftaran
          </a>
        </div>
      </div>
    </div>
    <!--Main-->
    <div
      class="
        container
        pt-20
        pb-24
        px-6
        mx-auto
        flex flex-wrap flex-col
        md:flex-row
        items-center
      "
    >
      <!--Left Col-->
      <div
        class="
          flex flex-col
          w-full
          xl:w-2/5
          justify-center
          lg:items-start
          overflow-y-hidden
        "
      >
        <h1
          class="
            my-4
            text-3xl
            md:text-5xl
            text-gray-200
            leading-tight
            text-center
            md:text-left
            slide-in-bottom-h1
          "
          v-html="site.setting.site_landing_title"
        ></h1>
        <div
          class="
            leading-loose
            flex
            text-gray-800
            flex-col
            font-semibold
            md:text-2xl
            mb-8
            text-center
            md:text-left
          "
          v-html="site.setting.site_landing_description"
        ></div>

        <div
          class="
            flex
            w-full
            justify-center
            space-x-2
            md:justify-start
            pb-24
            lg:pb-0
            fade-in
          "
        >
          <a
            href="#"
            class="
              px-4
              py-3
              bg-red-700
              rounded-md
              text-white
              font-bold
              hover:bg-red-800
            "
            >Daftar</a
          >
          <app-link
            href="/login"
            class="
              px-4
              py-3
              bg-red-700
              rounded-md
              text-white
              font-bold
              hover:bg-red-800
            "
            >Masuk</app-link
          >
        </div>
      </div>

      <!--Right Col-->
      <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
        <img
          class="w-5/6 mx-auto lg:mr-0 slide-in-bottom"
          src="img/bg2.svg"
          alt="Background illustrator"
        />
      </div>

      <!--Footer-->
      <div class="w-full pt-16 pb-6 text-sm text-center md:text-left fade-in">
        <a class="text-gray-500 no-underline hover:no-underline" href="#"
          >&copy; Skripsi {{ new Date().getFullYear() }}</a
        >
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    site: Object,
  },
};
</script>