<template>
  <SideBar @element-selected="handleElementSelected"/>
  <div class="content">
    <TopBar />
    <div style="margin: 30px;">
    <RouterView />
    </div>
  </div>
</template>

<script>
import SideBar from "@/components/ui/TheSidebar.vue";
import TopBar from "@/components/ui/TheTopbar.vue";

export default {
  components: {
    SideBar,
    TopBar,
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