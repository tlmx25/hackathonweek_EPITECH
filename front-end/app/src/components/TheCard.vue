<template>
  <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-4 g-4">
      <div class="col">
        <div class="card h-100">
          <div class="d-flex">
            <div class="transi">
              <img src="https://trombi.6tmphp.fr/images/pro/AHMANE-Hafid.jpg" class="card-img-top flex-grow-1 img-fluid transi" style="width: 100%;" alt="...">
              <div role="button" class="middle">
                <div class="text">Change</div>
              </div>
          </div>
          <div class="transi2">
              <img src="https://trombi.6tmphp.fr/images/fun/AHMANE-Hafid.jpg" class="card-img-top flex-grow-1 img-fluid transi" style="width: 100%;" alt="...">
              <div role="button" class="middle2">
                <div class="text">Change</div>
              </div>
          </div>
          </div>
          <div class="card-body">
            <h5 class="card-title">Jonas Jonassien</h5>
            <div class="mt-3">
              <p class="card-text">Responsable d'équipe</p>
              <p class="">Pole AI</p>
              <p class="">Rennes</p>
            </div>
            <div class="collapse" id="EpicCollapse">
              <div class="d-flex" style="border-top: 2px solid #dee2e6;">
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label shadow-none">Name</label>
                <input type="email" class="form-control" style="width: 90%;" id="exampleFormControlInput1" placeholder="Jonas">
              </div>
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label shadow-none">Firstname</label>
                <input type="email" class="form-control" style="width: 90%;" id="exampleFormControlInput1" placeholder="Jonas">
              </div>
            </div>
            </div>
          </div>
          <div class="card-footer d-flex justify-content-between">
            <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#EpicCollapse" aria-expanded="false" 
            aria-controls="EpicCollapse" >Edit</button>
            <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#EpicCollapse" aria-expanded="false" 
            aria-controls="EpicCollapse" >Remove</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="d-flex">
            <div class="transi">
              <img src="https://trombi.6tmphp.fr/images/pro/BEAUFILS-Maud.jpg" class="card-img-top flex-grow-1 img-fluid" style="width: 100%; cursor: pointer" alt="...">
          </div>
          <div class="transi2">
              <img src="https://trombi.6tmphp.fr/images/fun/BEAUFILS-Maud.jpg" class="card-img-top flex-grow-1 img-fluid" style="width: 100%; cursor: pointer" alt="...">
          </div>
          </div>
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Rennes</small>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="d-flex">
            <img src="https://trombi.6tmphp.fr/images/pro/BAUDOT-Tom.jpg" class="card-img-top flex-grow-1 img-fluid" style="width: 50%;" alt="...">
            <img src="https://trombi.6tmphp.fr/images/fun/BAUDOT-Tom.jpg" class="card-img-top flex-grow-1 img-fluid" style="width: 50%;" alt="...">
          </div>
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Angers</small>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="d-flex">
            <img src="https://trombi.6tmphp.fr/images/pro/AULNETTE-Philippe.jpg" class="card-img-top flex-grow-1 img-fluid" style="width: 50%;" alt="...">
            <img src="https://trombi.6tmphp.fr/images/fun/AULNETTE-Philippe.jpg" class="card-img-top flex-grow-1 img-fluid" style="width: 50%;" alt="...">
          </div>
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Angers</small>
          </div>
        </div>
      </div>
      </div>
      <div class="card p-3 mt-3">
        <div class="mb-3">
          <div class="d-flex">
          <div class="mb-3 me-5">
            <label for="exampleFormControlInput1" class="form-label shadow-none">Name</label>
            <input type="email" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="Jonas">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label shadow-none">Firstname</label>
            <input type="email" class="form-control" style="width: 100%;" id="exampleFormControlInput1" placeholder="Jonassien">
          </div>
          </div>
          <div class="d-flex">
          <div class="dropdown me-4">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; color: #212529be;">
              Poste
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div>
          <div class="dropdown me-4">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; color: #212529bd;">
              Equipe
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div>
          <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; color: #212529bb;">
              Agence
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div>
          </div>
          <label for="formFile" class="form-label mt-2">Choose a picture</label>
          <input class="form-control" type="file" id="formFile">
      </div>
    </div>
</template>

<script>
import { fetchData } from '@/services/api';

export default {
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