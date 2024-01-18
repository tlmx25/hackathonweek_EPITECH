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
  <template v-if="selectedElement == 'User'">
    <UserHandling />
  </template>
  </div>
  </div>
</template>

<script>
import '@/assets/css/main.scss';
import TheCard from "@/components/admin/TheCard.vue";
import AdminHome from "@/components/admin/TheAdminHome.vue";
import UserHandling from "@/components/admin/TheUserHandling.vue";
import SideBar from "@/components/ui/TheSidebar.vue";
import TopBar from "@/components/ui/TheTopbar.vue";
import { mapState } from "vuex";

export default {
  components: {
    TheCard,
    SideBar,
    TopBar,
    AdminHome,
    UserHandling
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