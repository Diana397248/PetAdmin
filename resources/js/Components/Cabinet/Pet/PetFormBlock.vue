<template>
    <template v-if="isEdit">
        <PetForm @updatePets="updatePets" @close="changeMode" class="mb-8"/>
    </template>

    <template v-else>
        <AddPetBtn @click="changeMode" class="mb-8"/>
    </template>
</template>

<script setup>
import AddPetBtn from "@/Components/Cabinet/Base/AddPetBtn.vue"
import {ref} from "vue";
import PetForm from "@/Components/Cabinet/Pet/PetForm.vue";

const isEdit = ref(false)

const changeMode = () => {
    isEdit.value = !isEdit.value
}
const emmit = defineEmits([
    'updatePets'
])

const updatePets = () => {
    emmit('updatePets')
}
</script>

<style scoped>

</style>
