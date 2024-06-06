<template>
  <v-btn @click="goToAppointmentForm" class="button mt-2 text-white fw-bold" color="#FFC59E" type="submit" block>ЗАПИСАТЬСЯ
  </v-btn>
</template>

<script setup>
import {router} from "@inertiajs/vue3";

const goToAppointmentForm = () => {
    router.get(route('Calendars'));
}
</script>

<style scoped>
.button {
  border-radius: 33px;
  height: 68px;
  width: 284px;
  font-size: 20px;
}
</style>
