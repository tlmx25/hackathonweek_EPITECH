<template>
  <div id="app">
    <NavBar />
  </div>
  <Router-View />
</template>

<script>
import NavBar from '@/components/NavBar.vue'

export default {
  name: 'App',
  components: {
    NavBar,
  },
};
</script>

<style>
</style>
