<template>
    <p class="title">Мои питомцы</p>
    <PetFormBlock @updatePets="getMyPets"/>
    <div class="d-flex flex-column gap-5">
        <PetCard v-for="pet in myPets " :pet="pet"/>
    </div>

</template>

<script setup>
import PetCard from "@/Components/Cabinet/Pet/PetCard.vue"
import PetFormBlock from "@/Components/Cabinet/Pet/PetFormBlock.vue"
// import {http} from "@/axios/index.js";
import {onMounted, ref} from "vue";

const myPets = ref([])

const getMyPets = () => {
    //todo возращает пагинацию
    axios.get('/pets/fetchAllPets?page=1')
        .then((res) => {
          myPets.value = res.data.pets.data
        })
}

onMounted(() => {
    getMyPets()
})
</script>

<style scoped>

</style>
