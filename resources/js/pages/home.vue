<template>
  <app-head title="Beranda" />

  <h1 class="text-2xl font-bold">Halaman Home</h1>
  <button @click.prevent="test">
    click here
  </button>
</template>
<script>
export default {
  methods: {
    test() {
      this.$dialog.show({
        message: "Tindakan ini akan menghapus satuan secara permanen dan tidak dapat dikembalikan.",
        onConfirm: () => {
          this.$toast.success('dwdw');

          this.$dialog.hide();
        }
      });
    }
  }
};
</script>