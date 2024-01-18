<template>
  <SideBar @element-selected="handleElementSelected"/>
    <div class="content">
    <TopBar />
    <div style="margin: 30px;">
  <template v-if="selectedElement == 'Trombi'">
    <TheCard />
  </template>
  <template v-if="selectedElement == 'Home'">
    <AdminHome />
  </template>
  </div>
  </div>
</template>

<script>
import TheCard from "@/components/admin/TheCard.vue";
import AdminHome from "@/components/admin/TheAdminHome.vue"
import SideBar from "@/components/ui/TheSidebar.vue";
import TopBar from "@/components/ui/TheTopbar.vue";
import { mapState } from "vuex";

export default {
  components: {
    TheCard,
    AdminHome,
    SideBar,
    TopBar,
  },
  methods: {
    handleElementSelected(elem) {
      console.log("Élément sélectionné :", elem);
    },
  },
  computed: {
    ...mapState(["selectedElement"]),
  },
}
</script>

<style scoped>
</style>