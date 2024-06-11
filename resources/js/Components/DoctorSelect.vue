<template>
    <label for="vet" class="mb-2 block text-sm font-medium text-gray-500">Главный ветеринар</label>
    <VueMultiselect :modelValue="props.modelValue" @update:modelValue="onChangeVal" :options="matchingVets"
                    :multiple="false"
                    :clear-on-select="true"
                    placeholder="Введите для поиска ветеринара"
                    @search-change="searchVets"
                    :class="{ 'error': errors.vet_id }">
        <template #noResult>
            Упс! Ветеринары не найдены. Попробуйте другой поисковый запрос.
        </template>
    </VueMultiselect>
</template>

<script setup>
import VueMultiselect from 'vue-multiselect'
import {onMounted, ref} from "vue";

const matchingVets = ref([]);
const selectedCreateVet = ref("");

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue'])
const errors = ref({});


const onChangeVal = (val) => {
    emit('update:modelValue', val)
}


const fetchAllVets = async () => {
    const response = await axios.get('/appointments/fetchAllVets');
    matchingVets.value = response.data.map(x=> x.user.name);
};
const searchVets = async (query) => {
    const response = await axios.get('/appointments/searchVets', {params: {query}});
    matchingVets.value = response.data.map(x=> x.user.name);
};
// const customLabelVet = (vetData) => `${vetData.user.name}`
onMounted(async () => {
    await fetchAllVets()
})


</script>

<style scoped>

</style>
