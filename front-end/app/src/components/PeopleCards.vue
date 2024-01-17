<template>
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <div v-for="user in this.users" :key="user.nom" class="col">
        <div class="card text-center position-relative" style="border: 0;" @mouseover="showInfo(user)" @mouseleave="hideInfo(user)">
          <img v-if="hoveredIndex !== user" :src="user.photo_pro ? user.photo_pro : noPicture" class="card-img-top" alt="...">
          <img v-else :src="user.photo_fun ? user.photo_fun : noPicture" class="card-img-top" alt="...">
          <div class="card-overlay"  v-if="hoveredIndex === user">
            <p class="card-title" style="font-weight: bold;">{{ user.nom }} {{ user.prenom }}</p>
            <p class="card-text">{{ user.poste }}</p>
          </div>
        </div>
      </div>
    </div>
</template>

<script>

export default {
  props: {
    users: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      hoveredIndex: null,
      noPicture: require('@/assets/no_pic.png'),
    };
  },
  methods: {
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