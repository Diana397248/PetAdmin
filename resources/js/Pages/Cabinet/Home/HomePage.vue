<template>
    <ClientLayout title="Items">
        <Carousel/>
        <!--    <CardServices/>-->
        <div class="d-flex flex-column gap-5">
            <HistoryOfCompany/>
            <AmountHelp/>
            <AboutUs/>
            <WeMap/>
        </div>
    </ClientLayout>
</template>

<script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue"
import Carousel from "@/Pages/Cabinet/Home/Carousel.vue"
// import CardServices from "@/Pages/Cabinet/Home/CardServices.vue"
import HistoryOfCompany from "@/Pages/Cabinet/Home/HistoryOfCompany.vue"
import AmountHelp from "@/Pages/Cabinet/Home/AmountHelp.vue"
import AboutUs from "@/Pages/Cabinet/Home/AboutUs.vue"
import WeMap from "@/Pages/Cabinet/Home/WeMap.vue"</script>

<style scoped>

</style>
