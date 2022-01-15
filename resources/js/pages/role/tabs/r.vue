<template>
  <div>
    <ul>
      <li v-for="(permission, index) in permissions" :key="index">hello world</li>
    </ul>
  </div>
</template>
<script>
export default {
  props: {
    permissions: Object,
  },
}
</script>