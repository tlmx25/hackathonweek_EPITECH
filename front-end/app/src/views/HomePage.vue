<template>
    <div class="container mt-5">
        <IntroText />
        <div class="row">
            <div class="col-md-3" style="margin-top: 4rem;">
                <SearchBar @searchChange="updateSearch"/>
                <FilterCards :teams="teams" @filterChange="updateFilters"/>
            </div>
            <div class="col">
                <PeopleCards class="mt-5 mb-5" :users="filteredUsers"/>
            </div>
        </div>
    </div>
</template>

<script>

import PeopleCards from '@/components/PeopleCards.vue'
import FilterCards from '@/components/FilterCards.vue'
import SearchBar from '@/components/SearchBar.vue';
import IntroText from '@/components/IntroText.vue';
import { fetchData } from "@/services/api";

export default {
    name: 'HomePage',
    components: {
        PeopleCards,
        FilterCards,
        SearchBar,
        IntroText
    },
    data() {
        return {
            users: [],
            images: [],
            filteredUsers: [],
            teams: ['Pôle AI', 'Pôle Walker', 'Team IT', 'Team Rocket', 'Pôle Cousteau', 'Pôle 8.6', 'Pôle Position',
                'Bug Buster', 'Team Elephant', 'Team Eden', 'Studio Design', 'Pôle Passe Partout', 'Team Dev', 'Pôle Griffondor'],
        };
    },
    mounted() {
      this.getData();
    },
    methods: {
      async getData() {
        this.users = await fetchData('/infos');
        this.filteredUsers = [...this.users];
      },
      updateSearch(search) {
        if (search && search.search.trim() != '') {
            this.filteredUsers = this.filteredUsers.filter(user => user.lastName.toLowerCase().includes(search.search.toLowerCase()) ||
                user.name.toLowerCase().includes(search.search.toLowerCase()));
        } else {
            this.filteredUsers = [...this.users];
            // TODO : if other filters applied ???
        }
      },
      updateFilters(filters) {
        console.log(filters);
        if (filters.teams.length === 0 && (filters.cities.length === 0 || filters.cities.length === 2)) {
            this.filteredUsers = [...this.users];
        } else {
            this.filteredUsers = this.users.filter(user => {
                const teams = filters.teams.length === 0 || filters.teams.some(team => team === user.team);
                const cities = filters.cities.length === 0 || filters.cities.some(city => city === user.agency);
                return teams && cities;
            });
        }
      }
    }
}

</script>