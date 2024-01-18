<template>
    <div class="mb-4" ref="searchContainer">
      <label class="mb-2" for="search" style="font-weight: bold;">Vous cherchez quelqu'un ?</label>
      <div class="input-group mb-3">
        <input v-model="searchInput" type="text" class="form-control" placeholder="Nom Prénom" aria-label="Nom Prénom" aria-describedby="button-addon2" @input="handleInput" @keydown.enter="startSearch">
        <button @click="startSearch" class="btn btn-dark" type="button" id="button-addon2">
          <span class="material-icons" style="vertical-align: middle;">search</span>
        </button>
      </div>
      <ul v-if="suggestions.length && searchInput.trim() !== ''" class="list-group">
        <li v-for="(user, index) in suggestions" :key="index" class="list-group-item" @click="selectSuggestion(user)">
          {{ user.name }} {{ user.lastName }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    name: 'SearchBar',
    emits: ['searchChange'],
    props: {
      users: {
        type: Array,
        required: true,
      },
    },
    data() {
      return {
        searchInput: '',
        suggestions: [],
      };
    },
    computed: {
      filteredUsers() {
        const searchLower = this.searchInput.toLowerCase();
        return this.users.filter(user => user.name.toLowerCase().startsWith(searchLower) || user.lastName.toLowerCase().startsWith(searchLower));
      },
    },
    methods: {
      handleInput() {
        this.suggestions = this.filteredUsers;
      },
      startSearch() {
        this.$emit('searchChange', {
          search: this.searchInput,
        });
      },
      selectSuggestion(user) {
        this.searchInput = `${user.name} ${user.lastName}`;
        this.suggestions = [];
        this.startSearch();
      },
      closeSuggestions(event) {
        if (!this.$refs.searchContainer.contains(event.target)) {
          this.suggestions = [];
        }
      },
    },
    mounted() {
      document.addEventListener('click', this.closeSuggestions);
    },
    destroy() {
      document.removeEventListener('click', this.closeSuggestions);
    },
  };
  </script>
  