<template>
  <CreateUser @personAdded="addPerson"/>
  <form class="d-flex justify-content-center mb-3" style="margin-left: 75px;" @submit.prevent="filterUser">
    <input v-model="searchTerm" @input="updateSearchResults" class="form-control" style="width: 30vw;" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success ms-2" type="submit">Search</button>
  </form>
  <div class="d-flex justify-content-center">
    <ul v-if="showResults && searchResults.length > 0" class="list-group" style="position: absolute; z-index: 1; width: 30vw; max-height: 210px; overflow-y: auto;">
      <li v-for="(result, index) in searchResults" :key="index" @click="getRes(result.lastName)" class="list-group-item list-hover" style="cursor: pointer;">
        <img class="card-img-top flex-grow-1 img-fluid me-3" style="width: 1rem;" 
             :src="result.proImage ? result.proImage : require('@/assets/no_picture.png')">
        {{ capitalize(result.lastName) }} {{ capitalize(result.name) }}
    </li>
    </ul>
  </div>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-4">
      <div class="col" v-for="(user, index) in filteredUsers" :key="user.lastName">
        <div class="card h-100">
          <div class="d-flex">
            <div class="transi">
              <img v-if="user.proImage" :src="user.proImage" class="card-img-top flex-grow-1 img-fluid transi" style="width: 100%;" alt="...">
              <img v-else src="@/assets/no_picture.png" class="card-img-top flex-grow-1 img-fluid transi" style="width: 100%;" alt="...">
              <div role="button" class="middle">
                <div class="text">Change</div>
              </div>
          </div>
          <div class="transi2">
              <img v-if="user.funImage" :src="user.funImage" class="card-img-top flex-grow-1 img-fluid transi" style="width: 100%;" alt="...">
              <img v-else src="@/assets/no_picture.png" class="card-img-top flex-grow-1 img-fluid transi" style="width: 100%;" alt="...">
              <div role="button" class="middle2">
                <div class="text">Change</div>
              </div>
          </div>
          </div>
          <div class="card-body">
            <h5 class="card-title">{{ capitalize(user.lastName) }} {{ capitalize(user.name) }} </h5>
            <div class="mt-3">
              <p class="card-text">{{ capitalize(user.job) }}</p>
              <p class="">{{ capitalize(user.team) }}</p>
              <p class="">{{ capitalize(user.agency) }}</p>
            </div>
            <div class="collapse" :id="'EpicCollapse' + index">
              <div class="d-flex" style="border-top: 2px solid #dee2e6;">
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label shadow-none">Nom</label>
                  <input type="email" class="form-control" style="width: 90%;" id="'exampleFormControlInput1' + index" :placeholder="user.lastName">
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label shadow-none">Prenom</label>
                  <input type="email" class="form-control" style="width: 90%;" id="'exampleFormControlInput1' + index" :placeholder="user.name">
                </div>
              </div>
              <div class="d-flex" style="border-top: 2px solid #dee2e6;">
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label shadow-none">Poste</label>
                  <input type="email" class="form-control" style="width: 90%;" id="'exampleFormControlInput1' + index" :placeholder="user.job">
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label shadow-none">Equipe</label>
                  <input type="email" class="form-control" style="width: 90%;" id="'exampleFormControlInput1' + index" :placeholder="user.team">
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label shadow-none">Agence</label>
                  <input type="email" class="form-control" style="width: 90%;" id="'exampleFormControlInput1' + index" :placeholder="user.agency">
                </div>
              </div>
              <div class="d-flex ">
                <button @click="editPerson(user.id)" class="btn btn-success">Save</button>
              </div>
            </div>
          </div>
          <div class="card-footer d-flex justify-content-between">
            <button class="btn btn-success" type="button" data-bs-toggle="collapse" :data-bs-target="'#EpicCollapse' + index" aria-expanded="false" aria-controls="'EpicCollapse' + index">Edit</button>
            <button @click="deleteUser(user.id)" class="btn btn-danger" type="button" data-toggle="collapse" :data-target="'#EpicCollapse' + index" aria-expanded="false" aria-controls="'EpicCollapse' + index">Remove</button>
          </div>
        </div>
      </div>
      </div>
</template>

<script>
import { fetchData } from '@/services/api';
import CreateUser from './TheCreateUser.vue';

export default {
  components: {
    CreateUser,
  },
  data() {
    return {
      users: [],
      searchTerm: '',
      filteredUsers: [],
      searchResults: [],
      showResults: false,
      editLastName: '',
      editName: '',
      editJob: '',
      editTeam: '',
      editAgency: '',
    };
  },
  methods: {
    async editPerson(id) {
      const data = {
        name: this.editName,
        lastName: this.editLastName,
        job: this.editJob,
        team: this.editTeam,
        agency: this.editAgency,
      };
      try {
        const response = await fetch('http://localhost:8000/infos/employee/' + id, {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'Access-Control-Allow-Origin': '*'
          },
          body: JSON.stringify(data),
        });
        if (response.ok) {
          this.users = this.users.filter(user => user.id !== id);
          this.filteredUsers = this.filteredUsers.filter(user => user.id !== id);
        } else {
          console.log('La suppression a échoué.');
        }
      } catch (error) {
        console.log(error);
      }
    },
    addPerson(person) {
      this.users.push(person);
    },
    async fetchUsers() {
      const users = await fetchData('/infos');
      this.users = users;
    },
    capitalize(str) {
      return str.charAt(0).toUpperCase() + str.slice(1);
    },
    filterUser() {
      if (this.searchTerm.trim() === '') {
        this.filteredUsers = this.users;
        this.showResults = false;
      } else {
        this.filteredUsers = this.users.filter(user =>
          user.lastName.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
          user.name.toLowerCase().includes(this.searchTerm.toLowerCase())
        );
        this.showResults = false;
      }
    },
    updateSearchResults() {
      if (this.searchTerm.trim() === '') {
        this.showResults = false;
      } else {
        this.searchResults = this.users.filter(user =>
          user.lastName.toLowerCase().startsWith(this.searchTerm.toLowerCase()) ||
          user.name.toLowerCase().startsWith(this.searchTerm.toLowerCase())
        );
        this.showResults = true;
      }
    },
    getRes(result) {
      this.searchTerm = result;
      this.showResults = false;
    },
    async deleteUser(id) {
      try {
        const response = await fetch('http://localhost:8000/infos/employee/' + id, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
          },
        });
        if (response.ok) {
          this.users = this.users.filter(user => user.id !== id);
          this.filteredUsers = this.filteredUsers.filter(user => user.id !== id);
        } else {
          console.log('La suppression a échoué.');
        }
      } catch (error) {
        console.log(error);
      }
    },
    handlePersonAdded(newPerson) {
      this.users.push(newPerson);
      this.filteredUsers.push(newPerson);
    },
  },
  async mounted() {
    await this.fetchUsers();
    this.filteredUsers = this.users;
  },
};
</script>

<style scoped>

.list-hover:hover {
  background-color: rgb(241, 241, 241);
}

.centered-list {
  left: 50%;
  transform: translateX(-50%);
}
</style>