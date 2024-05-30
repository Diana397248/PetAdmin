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
                                <Picture
                                    img="https://upload.wikimedia.org/wikipedia/commons/0/0e/Felis_silvestris_silvestris.jpg"
                                    textBtn="Изменить"
                                />
                            </Link>
                        </v-col>

                        <v-col class="fields">
                            <Field label="имя" text="Диана"/>
                            <Field label="фамилия" text="Юсупова"/>
                            <Field label="отчество" text="Ринатовна"/>
                            <Field label="телефон" text="+8 938 274 62 84"/>
                        </v-col>


                    </v-row>
                </v-col>

                <v-col>
                    <Field label="О себе" text="Живу в Астрахани, люблю животных, мечтала стать ветеринаром! Пока что у меня кот и собака с улитками!
            :)"/>
                </v-col>

            </v-row>
        </v-card-text>
    </v-card>
</template>

<script setup>
import Picture from "@/Components/Cabinet/Picture.vue"
import Field from "@/Components/Cabinet/Field.vue"
import {Link} from '@inertiajs/vue3';</script>

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
