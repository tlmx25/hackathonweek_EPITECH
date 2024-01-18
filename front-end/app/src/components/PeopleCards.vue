<template>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      <div v-for="(user, index) in this.users" :key="generateKey(user, index)" class="col">
        <div 
          class="card text-center position-relative"
          @mouseover="showInfo(index)" 
          @mouseleave="hideInfo()"
          @click="flipCard(index)"
        >
          <img v-if="hoveredIndex !== index" :src="user.proImage ? user.proImage : noPicture" class="card-img-top" alt="...">
          <img v-else :src="user.funImage ? user.funImage : noPicture" class="card-img-top" alt="...">
          <div class="card-overlay"  v-if="hoveredIndex === index">
            <p class="card-title" style="font-weight: bold;">{{ user.lastName }} {{ user.name }}</p>
            <p class="card-text">{{ user.job }}</p>
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
    generateKey(user, index) {
      return `${user.lastName}_${user.name}_${index}`;
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
  transition: transform 0.3s ease;
}

.card:hover {
    transform: scale(1.05);
}

.card-overlay {
    position: absolute;
    height: 20%;
    bottom: 0;
    left: 0;
    right: 0;
    background: #151F2A;
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

</style>