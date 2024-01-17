<template>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-4">
      <div class="col" v-for="(user, index) in users" :key="user.nom">
        <div class="card h-100">
          <div class="d-flex">
            <div class="transi">
              <img v-if="user.photo_pro" :src="user.photo_pro" class="card-img-top flex-grow-1 img-fluid transi" style="width: 100%;" alt="...">
              <img v-else src="@/assets/no_picture.png" class="card-img-top flex-grow-1 img-fluid transi" style="width: 100%;" alt="...">
              <div role="button" class="middle">
                <div class="text">Change</div>
              </div>
          </div>
          <div class="transi2">
              <img v-if="user.photo_fun" :src="user.photo_fun" class="card-img-top flex-grow-1 img-fluid transi" style="width: 100%;" alt="...">
              <img v-else src="@/assets/no_picture.png" class="card-img-top flex-grow-1 img-fluid transi" style="width: 100%;" alt="...">
              <div role="button" class="middle2">
                <div class="text">Change</div>
              </div>
          </div>
          </div>
          <div class="card-body">
            <h5 class="card-title">{{ user.nom }} {{ user.prenom }} </h5>
            <div class="mt-3">
              <p class="card-text">{{ user.poste }}</p>
              <p class="">{{ user.equipe }}</p>
              <p class="">{{ user.agence }}</p>
            </div>
            <div class="collapse" :id="'EpicCollapse' + index">
              <div class="d-flex" style="border-top: 2px solid #dee2e6;">
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label shadow-none">Name</label>
                  <input type="email" class="form-control" style="width: 90%;" id="'exampleFormControlInput1' + index" placeholder="Jonas">
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label shadow-none">Firstname</label>
                  <input type="email" class="form-control" style="width: 90%;" id="'exampleFormControlInput1' + index" placeholder="Jonas">
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer d-flex justify-content-between">
            <button class="btn btn-success" type="button" data-bs-toggle="collapse" :data-bs-target="'#EpicCollapse' + index" aria-expanded="false" aria-controls="'EpicCollapse' + index">Edit</button>
            <button class="btn btn-danger" type="button" data-toggle="collapse" :data-target="'#EpicCollapse' + index" aria-expanded="false" aria-controls="'EpicCollapse' + index">Remove</button>
          </div>
        </div>
      </div>
      </div>
      <CreateUser />
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
    };
  },
  methods: {
    async fetchUsers() {
        const users = await fetchData('/infos');
        this.users = users;
        console.log(this.users);
    },
  },
  async mounted() {
    await this.fetchUsers();
  },
};

</script>