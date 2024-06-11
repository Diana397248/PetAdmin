<template>
    <v-card class=" pa-8 card">
        <v-card-text>
            <v-row>
                <v-col cols="3">
                    <!--                    Todo: Здесь картинка пета или врача +текст text-btn="Отменить прием"-->
                    <Picture
                        :img="props.appointment.vet.user.profile_photo_url"

                    />
                </v-col>


                <v-col>
                    <v-row class="h-100 gap-5">
                        <v-col class="d-flex flex-column justify-content-between">
                            <Field label="врач" :text="props.appointment.vet.user.name"/>
                            <Field label="ветклиника" text="Айболит на Краснополянской"/>
                        </v-col>

                        <v-col class="d-flex flex-column justify-content-between">
                            <Field label="питомец" :text="appDate.pet.name"/>
                            <!--                TODO:            <Field label="питомец" :text="props.appointment.pet.name"/>-->
                            <Field label="дата" :text="appDate.toLocaleDateString()"/>
                            <Field label="время" :text="appDate.toLocaleTimeString([], {
                                hour: '2-digit',
                                minute: '2-digit'
                            })"/>
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
    return new Date(props.appointment.start_time)
})

</script>

<style scoped>
.card {
    border-radius: 20px;
}
</style>
