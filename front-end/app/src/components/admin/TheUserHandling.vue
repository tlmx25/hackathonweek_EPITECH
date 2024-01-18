<template>
    <div class="container">
      <div class="d-flex">
        <div class="col-md-8 me-5">
        <div class="card p-3">
          <table class="table">
            <thead style="border-bottom: 1px solid black;">
              <tr style="background-color: rgba(211, 211, 211, 0.678) !important;">
                <th><strong>#</strong></th>
                <th>Nom</th>
                <th>Email</th>
              </tr>
            </thead> 
            <tbody>
              <tr v-for="(user, index) in users" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
              </tr>
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
        <div class="card p-4 mt-4">
        <form @submit.prevent="submitUser">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nom</label>
              <input v-model="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Email</label>
              <input v-model="email" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input v-model="password" class="form-control" id="exampleInputPassword1">
             </div>
            <button class="btn btn-primary">Ajouter un utilisateur au panneau d'administration</button>
          </form>
        </div>
        </div>
        <div v-if="users.length > 0" class="col-md-4">
          <UserGraph :users="users" />
        </div>
        </div>
      </div>
  </template>

  <script>
  import axios from 'axios';
  import UserGraph from '@/components/admin/TheUserGraph.vue';
  
  export default {
    components: {
      UserGraph,
    },
    data() {
      return {
        users: [],
        email: '',
        password: '',
        name: '',
      };
    },
    methods: {
        async fetchUser() {
            try {
                const response = await axios.get('auth/users');
                this.users = response.data.users;
                console.log(this.users.length)
            } catch (error) {
                console.error('Erreur lors de la récupération des données:', error);
            }
        },
        async submitUser() {
            const user = {
              username: this.name,
              password: this.password,
              email: this.email,
            }
            const response = await fetch('http://localhost:8000/auth/addUser', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
              },
              body: JSON.stringify(user),
            });
            if (response.ok) {
                const newUser = await response.json();
                this.users.push(newUser);
            }
        }
    },
    mounted() {
      this.fetchUser();
    }
  };
  </script>
  