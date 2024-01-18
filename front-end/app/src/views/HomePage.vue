<template>
    <NavBar />
    <div class="container mt-5">
        <IntroText style="margin-top: 8rem;"/>
        <div class="row">
            <div class="col-md-3" style="margin-top: 4rem;">
                <SearchBar @searchChange="updateSearch" :users="users"/>
                <FilterCards :teams="teams" @filterChange="updateFilters"/>
            </div>
            <div class="col">
                <PeopleCards class="mt-5 mb-5" :users="filteredUsers"/>
            </div>
        </div>
    </div>
</template>

<script>

import NavBar from '@/components/NavBar.vue'
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
        IntroText,
        NavBar
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
        let temp;

        if (search && search.search.trim() != '') {
            temp = this.users.filter(user => user.name.toLowerCase().startsWith(search.search.toLowerCase()) ||
                user.lastName.toLowerCase().startsWith(search.search.toLowerCase()) || search.search.toLowerCase() == user.name.toLowerCase() + ' ' + user.lastName.toLowerCase());
            this.filteredUsers = temp;
        } else {
            this.filteredUsers = [...this.users];
        }
      },

      updateFilters(filters) {
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