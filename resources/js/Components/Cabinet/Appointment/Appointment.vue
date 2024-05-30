<template>
    <p class="title">Запись на прием</p>
    <div class="d-flex flex-column gap-5 mb-16">
        <AppointmentCard v-for="appoin in appointments" :appointment="appoin"/>

    </div>
</template>

<script setup>
import AppointmentCard from "@/Components/Cabinet/Appointment/AppointmentCard.vue"
import {onMounted, ref} from "vue";
// import {http} from "@/axios/index.js";

const appointments = ref([])

const getAppointments = () => {
    // http.get('/api/appointments')
    //     .then((res) => {
    //       appointments.value = res.data
    //     })
}

onMounted(() => {
    getAppointments()
})


</script>

<style scoped>

</style>
