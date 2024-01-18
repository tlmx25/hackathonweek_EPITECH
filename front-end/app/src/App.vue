<template>
    <RouterView />
</template>

<script>

export default {
  components: {
  },
  methods: {
    handleElementSelected(elem) {
      console.log("Élément sélectionné :", elem);
    },
  },
};
</script>

<style>
</style>