<template>
    <v-card class=" pa-8 card">
        <v-card-text>
            <v-row>
                <v-col cols="3">
                    <Picture
                        :img="props.appointment.vet.img"
                        text-btn="Отменить прием"
                    />
                </v-col>


                <v-col>
                    <v-row class="h-100 gap-5">
                        <v-col class="d-flex flex-column justify-content-between">
                            <Field label="врач" :text="props.appointment.vet.name"/>
                            <Field label="ветклиника" text="Айболит на Краснополянской"/>
                        </v-col>

                        <v-col class="d-flex flex-column justify-content-between">
                            <Field label="питомец" :text="props.appointment.pet.name"/>
                            <Field label="дата" :text="appDate.toLocaleDateString()"/>
                            <Field label="время" :text="appDate.toLocaleTimeString()"/>
                        </v-col>

                    </v-row>
                </v-col>


            </v-row>
        </v-card-text>
    </v-card>
</template>

<script setup>
import Field from "@/Components/Cabinet/Field.vue"
import Picture from "@/Components/Cabinet/Picture.vue"
import {computed} from "vue";

const props = defineProps({
    appointment: Object,

})

const appDate = computed(() => {
    return new Date(props.appointment.app_date)
})

</script>

<style scoped>
.card {
    border-radius: 20px;
}
</style>
