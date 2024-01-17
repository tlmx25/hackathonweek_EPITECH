<template>
    <div class="chart">
        <div class="" style="flex: 1;">
            <PieGraph />
        </div>
        <div class="" style="flex: 2;">
            <CurvedGraph />
        </div>
    </div>
    <div class="mt-3">
        <AllGraph />
    </div>
</template>

<script>
import AllGraph from "./TheAllGraph.vue"
import PieGraph from "./ThePieGraph.vue"
import CurvedGraph from "./TheCurvedGraph.vue"

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
        }
    },
    methods: {
    },
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