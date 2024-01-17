<template>
    <div class="container mt-5">
        <IntroText />
        <div class="row">
            <div class="col-md-3">
                <SearchBar />
                <FilterCards />
            </div>
            <div class="col">
                <PeopleCards class="mt-5 mb-5" :users="users"/>
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
        };
    },
    mounted() {
      this.getData();
    },
    methods: {
      async getData() {
      this.users = await fetchData('/infos');
      console.log(this.users);
      },
    }
}

</script>