<template>
    <v-card class="pa-8 card ">
        <v-card-text>
            <v-row>

                <!--                <v-col class="d-flex flex-column align-center justify-content-center " cols="4">-->
                <!--                    <image-input v-model="avatar"/>-->
                <!--                </v-col>-->

                <v-col class="d-flex flex-column gap-5">

                    <v-row justify="end" class="mx-3">
                        <v-btn @click="emmit('close')" color="rgba(245, 67, 55, 0.94)" :icon="CloseIcon"></v-btn>
                    </v-row>

                    <v-col class="d-flex flex-column gap-5">
                        <v-form fast-fail @submit.prevent>
                            <v-text-field
                                v-model="model.name"
                                :rules="rules.name"
                                label="имя"/>
                            <v-text-field
                                v-model="model.surname"
                                :rules="rules.surname"
                                label="фамилия"/>
                            <v-text-field
                                v-model="model.patronymic"
                                :rules="rules.patronymic"
                                label="отчество"/>
                            <v-text-field
                                v-model="model.number"
                                :rules="rules.number"
                                label="телефон"/>
                            <v-text-field
                                v-model="model.notes"
                                :rules="rules.notes"
                                label="о себе"/>
                            <!--            TODO сделать кнопке размер-->
                            <v-btn @click="createUser" class="mt-2 text-white fw-bold" color="#FFC59E" type="submit"
                                   block>Изменить
                            </v-btn>
                        </v-form>
                    </v-col>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>

</template>

<script setup>
import {reactive} from 'vue'

import CloseIcon from "@/Components/Cabinet/Icons/CloseIcon.vue"
// import ImageInput from "@/Components/Cabinet/Base/ImageInput.vue"

const props = defineProps({
    profileData: Object,
})

const emmit = defineEmits([
    'close',
    'updateUser'
])

const createUser = () => {
    const user = {
        "name": model.name,
        "second_name": model.surname,
        "patronymic": model.patronymic,
        "phone_number": model.number,
        "notes": model.notes,
    }
    axios.put('/cabinet/user/profile', user)
        .then((res) => {
            if (res.status === 201) {
                emmit('updateUser')
            }

        })
        .catch((error) => {
            console.log(error)
        })
}

// const avatar = ref(
//     null
// );

const rules = {
    name: [
        value => {
            if (false) return true
            return 'Это поле не может быть пустым'
        }
    ],
    surname: [
        value => {
            if (false) return true
            return 'Это поле не может быть пустым'
        }
    ],
    patronymic: [
        value => {
            if (false) return true
            return 'Это поле не может быть пустым'
        }
    ],
    number: [
        value => {
            if (value > 0) return true
            return 'Введите свой номер телефона'
        },
    ],
    //TODO это не обязательное поле
    // about_me: [
    //   value => {
    //     if (value > 0) return true
    //     return 'Расскажите о себе'
    //   },
    // ],
}

const model = reactive({
    name: props.profileData.name || "",
    surname: props.profileData.second_name || "",
    patronymic: props.profileData.patronymic || "",
    number: props.profileData.phone_number || "",
    notes: props.profileData.notes || "",
})
</script>

<style scoped>
:deep(.v-field__field label) {
    margin-left: 10px !important;
}
</style>
