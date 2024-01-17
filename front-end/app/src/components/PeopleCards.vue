<template>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      <div v-for="(user, index) in this.users" :key="generateKey(user, index)" class="col">
        <div 
          class="card text-center position-relative"
          :class="{ flip: flippedUsers[index] }"
          @mouseover="showInfo(index)" 
          @mouseleave="hideInfo()"
          @click="flipCard(index)"
        >
          <img v-if="hoveredIndex !== index" :src="user.photo_pro ? user.photo_pro : noPicture" class="card-img-top" alt="...">
          <img v-else :src="user.photo_fun ? user.photo_fun : noPicture" class="card-img-top" alt="...">
          <div class="card-overlay"  v-if="hoveredIndex === index">
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
      flippedUsers: this.users.map(() => false),
      noPicture: require('@/assets/no_pic.png'),
    };
  },
  methods: {
    generateKey(user, index) {
      return `${user.nom}_${user.prenom}_${index}`;
    },
    showInfo(index) {
      this.hoveredIndex = index;
    },
    hideInfo() {
      this.hoveredIndex = null;
    },
    flipCard(index) {
      this.flippedUsers[index] = !this.flippedUsers[index];
    },
  },
}
</script>

<style scoped>
.card {
  position: relative;
  overflow: hidden;
  transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
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
    transition: transform 0.3s ease;
    transform: translateY(100%);
}

.card:hover .card-overlay {
    transform: translateY(0);
  }

.card-text,
.card-title {
    margin: 0 !important;
}

.card.flip {
    transform: rotateY(180deg);
  }

</style>