<template>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      <div v-for="(user, index) in this.users" :key="generateKey(user, index)" class="col">
        <div 
          class="card text-center position-relative"
          :class="{ 'flipped': flippedCards.includes(index) }"
          @mouseover="showInfo(index)" 
          @mouseleave="hideInfo()"
          @click="flipCard(index)"
        >
          <img v-if="hoveredIndex !== index" :src="user.proImage ? user.proImage : noPicture" class="card-img-top" alt="...">
          <img v-else :src="user.funImage ? user.funImage : noPicture" class="card-img-top" :class="{ 'flipped': flippedCards.includes(index) }" alt="...">
          <div class="card-overlay"  v-if="hoveredIndex === index">
            <div v-if="!flippedCards.includes(index)">
              <p class="card-title" style="font-weight: bold;">{{ user.name }} {{ user.lastName }}</p>
              <p class="card-text">{{ user.job }}</p>
            </div>
            <div v-else>
              <p class="text-rotate"><span style="font-weight: bold;">Nom: </span>{{ user.lastName }}</p>
              <p class="text-rotate"><span style="font-weight: bold;">Prénom: </span>{{ user.name }}</p>
              <p class="text-rotate"><span style="font-weight: bold;">Poste: </span>{{ user.job }}</p>
              <p class="text-rotate"><span style="font-weight: bold;">Team: </span>{{ user.team }}</p>
              <p class="text-rotate"><span style="font-weight: bold;">Agence: </span>{{ user.agency }}</p>
            </div>
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
      flippedCards: [],
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
      this.flippedCards = [];
    },
    flipCard(index) {
      if (this.flippedCards.includes(index)) {
        this.flippedCards = this.flippedCards.filter((cardIndex) => cardIndex !== index);
      } else {
        this.flippedCards.push(index);
      }
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

.card.flipped {
  transform: rotateY(180deg);
}

.card.flipped .card-overlay {
  transform: rotateY(-180deg);
  height: 100%;
  background: #51767A;
  align-items: center;
}

.text-rotate {
  margin-bottom: 1rem !important;
  margin-left: 1rem !important;
  word-wrap: break-word;
  text-align: left;
}

</style>