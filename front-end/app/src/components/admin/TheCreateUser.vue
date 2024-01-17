<template>
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

export default {
    data() {
        return {
            postes: [],
            agences: [],
            equipes: [],
        }
    },
    methods: {
    },
}
</script>