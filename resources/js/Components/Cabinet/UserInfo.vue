<template>
    <p class="title">Личные данные</p>

    <v-card class=" pa-8 card">
        <v-card-text>
            <v-row>
                <v-col>
                    <v-row no-gutters="true" class="left-site">

                        <v-col>
                            <Link :href="route('UserForm')" :active="route().current('UserForm')"
                                  class="me-8 py-2 text-black text-decoration-none fs-4 fw-bold"
                            >
                                <v-avatar color="info" size="130">{{
                                        profileData?.name && profileData?.name[0]
                                    }}
                                </v-avatar>
                                <!--                                TODO:-->
                                <!--                                <Picture-->
                                <!--                                    :img="profileData?."-->
                                <!--                                    textBtn="Изменить"-->
                                <!--                                />-->
                            </Link>
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

<script setup>
import Field from "@/Components/Cabinet/Field.vue"
import {Link} from '@inertiajs/vue3';
import {onMounted, ref} from "vue";


const profileData = ref({});

onMounted(() => {
    axios.get('/clients/profile')
        .then((res) => {
            profileData.value = res.data;
        })
        .catch((res) => {
        })
});


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
