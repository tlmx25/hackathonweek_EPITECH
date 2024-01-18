<template>
    <div class="chart" v-if="this.users.length > 0">
        <div class="" style="flex: 1;">
            <PieGraph :users="users"/>
        </div>
        <div class="" style="flex: 2;">
            <CurvedGraph :users="users" />
        </div>
    </div>
    <div class="mt-3" v-if="this.users.length > 0">
        <AllGraph :users="users"/>
    </div>
</template>

<script>
import AllGraph from "./TheAllGraph.vue"
import PieGraph from "./ThePieGraph.vue"
import CurvedGraph from "./TheCurvedGraph.vue"
import axios from 'axios'
import { fetchData } from "@/services/api";

export default {
    components: {
        AllGraph,
        PieGraph,
        CurvedGraph,
    },
    data() {
        return {
            postes: [],
            agences: [],
            equipes: [],
            users: [],
        }
    },
    methods: {
        async fetchUsers() {
            const users = await fetchData('infos');
            this.users = users;
        },
        async fetchUser() {
        axios.defaults.baseURL = 'http://localhost:8000/';
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token'); 
        try {
            const data = await axios.get('auth/users');
            console.log(data.data);
        } catch (error) {
            console.error('Erreur lors de la récupération des données:', error);
        }
        }
    },
    mounted() {
        this.fetchUsers();
        this.fetchUser();
    }
}
</script>
<style scoped>
.chart {
    width: 100%;
    display: flex;
    flex-direction: row;
}
.mt-5 {
    width: 100%;
}
</style>