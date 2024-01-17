<template>
    <div class="mb-4">
        <label class="mb-2" for="search" style="font-weight: bold;">Vous cherchez quelqu'un ?</label>
        <div class="input-group mb-3">
            <input v-model="searchInput" type="text" class="form-control" placeholder="Nom Prénom" aria-label="Nom Prénom" aria-describedby="button-addon2">
            <button @click="startSearch" class="btn btn-dark" type="button" id="button-addon2">
                <span class="material-icons" style="vertical-align: middle;">
                    search
                </span>
            </button>
        </div>
    </div>
</template>

<script>

export default {
    name: 'SearchBar',
    emits: ['searchChange'],
    data() {
         return {
             searchInput: '',
         };
    },
    methods: {
        startSearch() {
            this.$emit('searchChange', {
                search: this.searchInput,
            });
        }
    }
}

</script>