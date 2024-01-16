<template>
    <div class="mb-4">
        <label class="mb-2">Sélectionnez une ville</label>
        <div class="row">
            <div class="col">
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <div>
                        <input type="checkbox" class="btn-check" id="btncheckRennes" autocomplete="off">
                        <label class="btn btn-outline-dark mb-2" for="btncheckRennes">Rennes</label>
                    </div>
                    <div>
                        <input type="checkbox" class="btn-check" id="btncheckAngers" autocomplete="off">
                        <label class="btn btn-outline-dark mb-2" for="btncheckAngers">Angers</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <label class="mb-2">Sélectionnez une équipe</label>
        <div class="row">
            <div class="col">
                <div class="btn-group-vertical" role="group" aria-label="Basic checkbox toggle button group">
                    <div v-for="index in 10" :key="index">
                        <input type="checkbox" class="btn-check" :id="'btncheck' + index" autocomplete="off">
                        <label class="btn btn-outline-dark mb-2" :for="'btncheck' + index">Test</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
