<template>
    <div class="container mt-5">
        <div class="text-center">
            <h2 class="mb-4" style="font-weight: bold;">Les <span style="color: #52c4a7;">belles personnes</span> qui composent 6TM</h2>
            <h5>Découvrez notre équipe de plus de <span style="font-weight: bold;">100 experts</span> répartie entre Rennes et Angers.</h5>
        </div>
        <PeopleCards class="mt-5 mb-5"/>
    </div>
</template>

<script>

import PeopleCards from '@/components/PeopleCards.vue'

export default {
    name: 'HomePage',
    components: {
        PeopleCards,
    }
}

</script>