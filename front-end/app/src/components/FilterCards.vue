<template>
    <div class="mb-4">
        <label class="mb-2" style="font-weight: bold;">Sélectionnez une ville</label>
        <div class="row">
            <div class="col">
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <div v-for="(city, index) in cities" :key="index">
                        <input type="checkbox" class="btn-check" :id="'btncheckCity' + index" autocomplete="off" :value="index" v-model="selectedCities" @change="updateFilters">
                        <label class="btn btn-outline-dark mb-2" :for="'btncheckCity' + index" style="margin-right: 1rem;">{{ city }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <label class="mb-2" style="font-weight: bold;">Sélectionnez une équipe</label>
        <div class="row">
            <div class="col">
                <div class="btn-group-vertical" role="group" aria-label="Basic checkbox toggle button group">
                    <div v-for="(team, index) in teams" :key="index">
                        <input type="checkbox" class="btn-check" :id="'btncheck' + index" autocomplete="off" :value="index" v-model="selectedTeams" @change="updateFilters">
                        <label class="btn btn-outline-dark mb-3" :for="'btncheck' + index">{{ team }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'FilterCards',
    emits: ['filterChange'],
    data() {
        return {
            selectedTeams: [],
            selectedCities: [],
            cities: ['Rennes', 'Angers'],
        };
    },
    props: {
        teams: {
            type: Array,
            required: true,
        },
    },
    methods: {
        updateFilters() {
            const selected = this.selectedTeams.map(index => this.teams[index]);
            const selectCities = this.selectedCities.map(index => this.cities[index]);
            this.$emit('filterChange', {
                teams: selected,
                cities: selectCities,
            });
        },
    },
}

</script>
