<template>
  <lists :items="announcements" :filter="filters" />
</template>
<script>
import Lists from './lists.vue';
import NestedLayout from './layout.vue';
import AppLayout from '@/layouts/app-layout.vue';

export default {
  layout: [AppLayout, NestedLayout],
  components: {
    Lists
  },
  props: {
    filters: Object,
    announcements: Object,
  },
  methods: {
    // 
  }
}
</script>