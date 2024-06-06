<template>
  <div class="d-flex gap-4 flex-wrap justify-content-center">
    <CardService v-for="service in serviceData" :serviceData="service"/>
  </div>

</template>

<script setup>

import CardService from '@/components/home/CardService.vue'

import services1 from '@/assets/services1.png'
import services2 from '@/assets/services2.png'
import services3 from '@/assets/services3.png'
import services4 from '@/assets/services4.png'
import services5 from '@/assets/services5.png'
import services6 from '@/assets/services6.png'
import services7 from '@/assets/services7.png'
import services8 from '@/assets/services8.png'

import {ref} from "vue";

const serviceData = ref([
      {
        name: "Терапия",
        img: services8,
      },
      {
        name: "Хирургия",
        img: services7,
      },
      {
        name: "Неврология",
        img: services6,
      },
      {
        name: "Онкология",
        img: services4,
      },
      {
        name: "Онкология",
        img: services4,
      },
      {
        name: "Онкология",
        img: services4,
      },
      // {
      //   name: "Онкология",
      //   img: services4,
      // }, {
      //   name: "Онкология",
      //   img: services4,
      // },
    ]
)

</script>

<style scoped>
.services {
  width: 110px !important;
  height: 110px !important;

}

.servicess {
  padding-top: 150px !important;
  padding-bottom: 150px !important;
}


</style>