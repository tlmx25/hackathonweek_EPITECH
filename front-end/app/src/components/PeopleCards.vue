<template>
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <div v-for="index in 10" :key="index" class="col">
        <div class="card text-center position-relative" style="border: 0;" @mouseover="showInfo(index)" @mouseleave="hideInfo(index)">
          <img v-if="hoveredIndex !== index" src="@/assets/test_before.jpg" class="card-img-top" alt="...">
          <img v-else src="@/assets/test_after.jpg" class="card-img-top" alt="...">
          <div class="card-overlay"  v-if="hoveredIndex === index">
            <p class="card-title" style="font-weight: bold;">Nom Prénom</p>
            <p class="card-text">Poste</p>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      hoveredIndex: null,
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        const response = await axios.get('http://localhost:8000/infos/');

        console.log(response.data);
      } catch (error) {
        console.error('Erreur lors de la requête GET :', error);
      }
    },
    showInfo(index) {
      this.hoveredIndex = index;
    },
    hideInfo() {
      this.hoveredIndex = null;
    },
  },
}
</script>

<style scoped>
.card {
  position: relative;
  overflow: hidden;
}

.card-overlay {
    position: absolute;
    height: 15%;
    bottom: 0;
    left: 0;
    right: 0;
    /* background: #C5C2FF; */
    /* background: #D0FFE9; */
    background: #151F2A;
    /* color: #D0FFE9; */
    color: #FFFFFF;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.card-text,
.card-title {
    margin: 0 !important;
}

/* .card:hover .card-overlay {
  opacity: 1;
} */

</style>