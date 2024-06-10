<template>
    <p class="title">Личные данные</p>
    <template v-if="isEdit">
        <!--            <PetForm @updatePets="updatePets" @close="changeMode" class="mb-8"/>-->
        <UserForm :profileData="profileData" @updateUser="updateUser" @close="changeMode" class="mb-8"/>
    </template>

    <template v-else>

        <v-card class=" pa-8 card">
            <v-card-text>
                <v-row>
                    <v-col>
                        <v-row no-gutters="true" class="left-site">

                            <v-col>
                                <div class="d-flex flex-column align-center">
                                    <v-avatar color="info" size="130">{{
                                            profileData?.name && profileData?.name[0]
                                        }}
                                    </v-avatar>
                                    <v-btn @click="changeMode" class="my-btn" variant="text" color="#FFC59E">
                                        Изменить
                                    </v-btn>
                                </div>
                                <!--                                TODO:-->
                                <!--                                <Picture-->
                                <!--                                    :img="profileData?."-->
                                <!--                                    textBtn="Изменить"-->
                                <!--                                />-->
                            </v-col>

                            <v-col class="fields">
                                <Field label="имя" :text="profileData?.name"/>
                                <Field label="фамилия" :text="profileData?.second_name"/>
                                <Field label="отчество" :text="profileData?.patronymic"/>
                                <Field label="телефон" :text="profileData?.phone_number"/>
                            </v-col>


                        </v-row>
                    </v-col>

                    <v-col>
                        <Field label="О себе" :text="profileData?.notes"/>
                    </v-col>

                </v-row>
            </v-card-text>
        </v-card>
    </template>
</template>

<script setup>
import Field from "@/Components/Cabinet/Field.vue"
import UserForm from "@/Components/Cabinet/UserForm.vue"
import {onMounted, ref} from "vue";
import {router} from "@inertiajs/vue3";

const isEdit = ref(false)

const changeMode = () => {
    isEdit.value = !isEdit.value
};


const updateUser = () => {
    getUserProfile();
    isEdit.value = false;
    router.get(route('UserProfile'))
}
const profileData = ref({});

onMounted(() => {
    getUserProfile();
});
const getUserProfile = () => {
    axios.get('/clients/profile')
        .then((res) => {
            profileData.value = res.data;
        })
        .catch((res) => {
        })
}


</script>


<style scoped>
.left-site {
}

.fields {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.card {
    border-radius: 20px;
}
</style>
