<template>
    <div class="ms-2">
      <h1 style="font-size: 2rem; color: #000000; font-weight: light;">Ajout de personnes</h1>
    </div>
    <div class="card p-3 mt-3 mb-3">
        <div class="mb-3">
          <div class="d-flex">
          <div class="mb-3 me-4">
            <label for="exampleFormControlInput1" class="form-label shadow-none">Prénom</label>
            <input v-model="selectedFirstname" type="email" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="Prénom">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label shadow-none">Nom</label>
            <input v-model="selectedName" type="email" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="Nom">
          </div>
          </div>
          <div class="d-flex">
            <div class="dropdown me-4" v-if="trigger">
              <label for="exampleFormControlInput1" class="form-label shadow-none">Poste</label>
              <input v-model="selectedPost" type="email" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="Poste">
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
          <div class="dropdown me-4 mt-2" v-if="trigger">
            <label for="exampleFormControlInput1" class="form-label shadow-none">Photo pro</label>
            <input v-model="selectedPhotoPro" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="http://...">
          </div>
          <div class="dropdown me-4 mt-2" v-if="trigger">
            <label for="exampleFormControlInput1" class="form-label shadow-none">Photo fun</label>
            <input v-model="selectedPhotoFun" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="http://...">
          </div>
          <div class="row justify-content-end mt-3 me-3">
            <div class="col-auto">
              <input @click="createPerson()" type="submit" class="btn" style="background-color: #78fdbf;" value="Créer un employé">
            </div>
          </div>
      </div>
    </div>
</template>

<script>

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
            selectedPhotoFun: '',
            selectedPhotoPro: '',
        }
    },
    methods: {
      async createPerson() {
        const data = {
          name: this.selectedFirstname,
          lastName: this.selectedName,
          job: this.selectedPost,
          team: this.selectedTeam,
          agency: this.selectedAgency,
          proImage: this.selectedPhotoFun,
          funImage: this.selectedPhotoPro,
        }
        try {
          const response = await fetch('http://localhost:8000/infos/employee', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
          });
          console.log(response);
          if (response.ok) {
            this.sendMsg(data);
          }
        } catch (error) {
          console.log(error);
        }
      },
      sendMsg(newPerson) {
        this.$emit('personAdded', newPerson);
      },
    },
    async mounted() {
      this.trigger = true;
    }
}
</script>