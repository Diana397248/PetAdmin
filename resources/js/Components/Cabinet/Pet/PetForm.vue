<template>
    <v-card class="pa-8 card ">
        <v-card-text>
            <v-row>

                <v-col class="d-flex flex-column align-center justify-content-center " cols="4">
                    <image-input v-model="model.img"/>
                </v-col>

                <v-col class="d-flex flex-column gap-5">

                    <v-row justify="end" class="mx-3">
                        <!--            <p class="pet-name">Добавление питомца</p>-->
                        <v-btn @click="emmit('close')" color="rgba(245, 67, 55, 0.94)" :icon="CloseIcon"></v-btn>
                    </v-row>

                    <v-form @submit.prevent>
                        <v-text-field
                            v-model="model.name"
                            :rules="rules.name"
                            label="имя"/>
                        <v-text-field
                            v-model="model.type"
                            :rules="rules.type"
                            label="тип"/>
                        <v-text-field
                            v-model="model.gender"
                            :rules="rules.gender"
                            label="пол"/>
                        <v-text-field
                            v-model="model.breed"
                            :rules="rules.breed"
                            label="порода"/>
                        <v-text-field
                            v-model="model.age"
                            :rules="rules.age"
                            label="возраст"/>
                        <AddPetBtn class="mt-2" size="small" @click="createPet"/>
                    </v-form>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>

<script setup>
import CloseIcon from "@/Components/Cabinet/Icons/CloseIcon.vue"
import ImageInput from "@/Components/Cabinet/Base/ImageInput.vue"
import AddPetBtn from "@/Components/Cabinet/Base/AddPetBtn.vue"

import {reactive, ref, watch} from 'vue'
// import {http, upload} from "@/axios/index.js";

const emmit = defineEmits([
    'close',
    'updatePets'
])

const createPet = () => {
    const pet = {
        "name": model.name,
        "type": model.type,
        "species": model.breed,
        "year_birth": model.age,
        "gender": model.gender,
    }
        // console.log(model.img.file)
        // upload(model.img.file, null, 'img', '/api/pets', (formData) => {
        //   for (let key in pet) {
        //     formData.append(key, pet[key]);
        //   }
        // })
        .then((res) => {
            if (res.status === 201) {
                emmit('updatePets')
            }

        })
        .catch((error) => {
            console.log(error)
        })
}

const avatar = ref(
    null
);

const rules = {
    name: [
        value => {
            if (false) return true
            return 'Поле должно быть заполнено.'
        }
    ],
    type: [
        value => {
            if (false) return true
            return 'Поле должно быть заполнено.'
        }
    ],
    gender: [
        value => {
            if (false) return true
            return 'Выберите пол животного.'
        }
    ],
    breed: [
        value => {
            if (false) return true
            return 'Введите породу животного.'
        }
    ],
    age: [
        value => {
            if (value > 0) return true
            return 'Возраст должен быть больше 0'
        },
    ],
}

const model = reactive({
    name: "",
    type: "",
    gender: "",
    breed: "",
    age: "",
    img: "",
})

watch(avatar, (newValues, prevValues) => {
    console.log(newValues, prevValues)
})

</script>

<style scoped>
.card {
    border-radius: 20px;
}

.pet-name {
    font-size: 30px;
    display: flex;
    gap: 20px;
}

.ex-col {
    width: 50px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

:deep(.v-field__field label) {
    margin-left: 10px !important;
}
</style>
