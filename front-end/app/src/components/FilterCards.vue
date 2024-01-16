<template>
    <div class="btn-group-vertical" role="group" aria-label="Basic checkbox toggle button group">
        <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
        <label class="btn btn-outline-dark mb-2" for="btncheck1">Exemple</label>

        <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
        <label class="btn btn-outline-dark mb-2" for="btncheck2">Exemple</label>

        <!-- <input v-for="index in 10" :key="index" v-model="checkboxValues[index]" type="checkbox" class="btn-check" :id="'btncheck' + index" autocomplete="off">
        <label v-for="index in 10" :key="index" class="btn btn-outline-dark mb-2" :for="'btncheck' + index">Exemple {{ index }}</label> -->
    </div>
</template>

<script>

export default {
    data() {
        // return {
        //     checkboxValues: {},
        // };
    },
};

</script>