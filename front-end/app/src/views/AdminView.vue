<template>
  <template v-if="selectedElement == 'Trombi'">
    <TheCard />
  </template>
  <template v-if="selectedElement == 'Home'">
    <AdminHome />
  </template>
</template>

<script>
import TheCard from "@/components/admin/TheCard.vue";
import AdminHome from "@/components/admin/TheAdminHome.vue"
import { mapState } from "vuex";

export default {
  components: {
    TheCard,
    AdminHome
  },
  computed: {
    ...mapState(["selectedElement"]),
  },
}
</script>

<style scoped>
</style>