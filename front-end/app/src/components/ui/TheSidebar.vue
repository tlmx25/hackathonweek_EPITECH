<template>
    <div class="sidebar" style="overflow: hidden;">
      <div class="text-center pb-4 pt-4">
        <img src="https://www.6tm.com/app/uploads/2023/09/6tm_title-001.svg" alt="Vue" style="width: 14rem; color: black"/>
      </div>
      <div class="text-align bg-custom">
        <div class="container" role="button"  @click="changeElem('Home')" :class="{ 'selected': isSelected === 'Home' }">
          <span class="material-symbols-outlined me-3">home</span>
          <span style="margin-top: 3px">Acceuil</span>
        </div>
        <div class="container" role="button"  @click="changeElem('Trombi')" :class="{ 'selected': isSelected === 'Trombi' }">
          <span class="material-symbols-outlined me-3">photo_library</span>
          <span to="/admin/trombi" style="margin-top: 3px">Trombinoscope</span>
        </div>
        <div class="container" role="button"  @click="changeElem('About')" :class="{ 'selected': isSelected === 'About' }">
          <span class="material-symbols-outlined me-3">model_training</span>
          <span style="margin-top: 3px">A propos</span>
        </div>
      </div>
    </div>
  
    <div class="content">
    </div>
</template>
  
  <script>
  
  export default {
    data() {
      return {
        isSelected : "Home",
      }
    },
    methods: {
      changeElem(elem) {
        this.isSelected = elem;
        this.$emit("element-selected", elem);
        this.$store.commit("setSelectedElement", elem);
      }
    }
  }
  </script>
  
  <style scoped>

  .bg-custom {
    background-color: rgb(41, 41, 41);
    height: 95vh;
  }

  @media screen and (max-width: 700px) {
    .bg-custom {
      background-color: rgb(41, 41, 41);
      height: 100%;
    }
  }
  .selected {
    background-color: #78fdbf;
  }
  
  .selected a {
    color: black;
  }
  
  .selected span {
    color: black;
  }
  </style>