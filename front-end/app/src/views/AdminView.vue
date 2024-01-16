<template>
  <template v-if="selectedElement == 'Trombi'">
    <TheCard />
  </template>
</template>

<script>
import TheCard from "@/components/TheCard.vue";
import { mapState } from "vuex";

export default {
  components: {
    TheCard,
  },
  computed: {
    ...mapState(["selectedElement"]),
  },
}
</script>

<style scoped>
</style>