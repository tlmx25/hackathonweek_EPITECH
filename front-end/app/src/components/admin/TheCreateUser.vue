<template>
    <div class="ms-2">
      <h1 style="font-size: 2rem; color: #51767A; font-weight: bold;">Ajout de personnes</h1>
    </div>
    <div class="card p-3 mt-3 mb-3">
        <div class="mb-3">
          <div class="d-flex">
          <div class="mb-3 me-5">
            <label for="exampleFormControlInput1" class="form-label shadow-none">Nom</label>
            <input v-model="selectedName" type="email" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="Nom">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label shadow-none">Prénom</label>
            <input v-model="selectedFirstname" type="email" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="Prénom">
          </div>
          </div>
          <div class="d-flex">
            <div class="dropdown me-4" v-if="trigger">
              <label for="exampleFormControlInput1" class="form-label shadow-none">Poste</label>
              <input v-model="selectedPoste" type="email" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="Poste">
            </div>
            <div class="dropdown me-4" v-if="trigger">
              <label for="exampleFormControlInput1" class="form-label shadow-none">Equipe</label>
              <input v-model="selectedTeam" type="email" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="Equipe">
            </div>
            <div class="dropdown me-4" v-if="trigger">
              <label for="exampleFormControlInput1" class="form-label shadow-none">Agence</label>
              <input v-model="selectedAgency" type="email" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="Agence">
            </div>
          </div>
          <label for="formFile" class="form-label mt-2">Photo pro</label>
          <input class="form-control" type="file" id="formFile">
          <label for="formFile" class="form-label mt-2">Photo fun</label>
          <input class="form-control" type="file" id="formFile">
      </div>
    </div>
</template>

<script>
 
import fetchData from '@/services/api';

export default {
    data() {
        return {
            posts: [],
            agencies: [],
            teams: [],
            trigger: false,
            selectedPost: '',
            selectedTeam: '',
            selectedAgency: '',
            selectedName: '',
            selectedFirstname: '',
        }
    },
    methods: {
      async fetchPostes() {
        const data = await fetchData('infos/posts');
        this.posts = data.data;
      },
      async fetchAgences() {
        const data = await fetchData('infos/agencies');
        this.agencies = data.data;
      },
      async fetchEquipes() {
        const data = await fetchData('infos/teams');
        this.teams = data.data;
      },
    },
    async mounted() {
      await this.fetchPostes();
      await this.fetchAgences();
      await this.fetchEquipes();
      this.trigger = true;
    }
}
</script>