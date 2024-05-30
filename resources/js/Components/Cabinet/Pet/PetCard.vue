<template>
    <v-card class="pa-8 card ">
        <v-card-text>
            <v-row>


                <v-col class="d-flex flex-column">
                    <!--                    TODO:                         "text-btn="Изменить"/>
                    -->
                    <Picture
                        :img="props.pet.photo"/>
                </v-col>

                <v-col class="d-flex flex-column gap-5">
                    <p class="pet-name">{{ props.pet.name }}</p>
                    <div>
                        <Field label="тип" :text="props.pet?.breed?.name"/>
                        <Field label="порода" :text="props.pet?.species?.name"/>
                        <Field label="возраст" :text="props.pet?.age"/>
                        <Field label="пол" :text="props.pet?.gender"/>
                    </div>
                </v-col>


                <v-col>
                    <div class="mb-7">
                        <p class="text-aibolit-gray mb-3">медецинская карта</p>

                        <div class="d-flex flex-column gap-3">
                            <CardAnalysis></CardAnalysis>
                        </div>
                    </div>

                    <div class="mb-7">
                        <p class="text-aibolit-gray mb-3">результаты анализов</p>
                        <div class="d-flex flex-column gap-3">
                            <CardAnalysis></CardAnalysis>
                            <CardAnalysis></CardAnalysis>
                        </div>
                    </div>

                </v-col>

            </v-row>
        </v-card-text>
    </v-card>
</template>

<script setup>
import CardAnalysis from "@/Components/Cabinet/Pet/CardAnalysis.vue"
import Picture from "@/Components/Cabinet/Picture.vue"
import Field from "@/Components/Cabinet/Field.vue"
// import {getFileUrl} from "@/axios/index.js"/
const props = defineProps({
    pet: Object
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

</style>
