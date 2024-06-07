<template>
    <div class="d-flex gap-4 flex-wrap justify-content-center">
        <CardService v-for="service in serviceData" :serviceData="service"/>
    </div>

</template>

<script setup>
import CardService from '@/Pages/Cabinet/Home/CardService.vue'
import {ref} from "vue";

const services4 = '/assets/services4.png'
const services6 = '/assets/services6.png'
const services7 = '/assets/services7.png'
const services8 = '/assets/services8.png'

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
