<template>
    <div class="container mt-5">
        <div class="text-center">
            <h2 class="mb-4" style="font-weight: bold;">Les <span style="color: #52c4a7;">belles personnes</span> qui composent 6TM</h2>
            <h5>Découvrez notre équipe de plus de <span style="font-weight: bold;">100 experts</span> répartie entre Rennes et Angers.</h5>
        </div>
        <div class="row">
            <div class="col-md-3">
                <SearchBar />
                <FilterCards />
            </div>
            <div class="col">
                <PeopleCards class="mt-5 mb-5"/>
            </div>
        </div>
    </div>
</template>

<script>

import PeopleCards from '@/components/PeopleCards.vue'
import FilterCards from '@/components/FilterCards.vue'
import SearchBar from '../components/SearchBar.vue';

export default {
    name: 'HomePage',
    components: {
        PeopleCards,
        FilterCards,
        SearchBar
    }
}

</script>