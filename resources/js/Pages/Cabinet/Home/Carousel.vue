<template>

    <!--  <v-img :src="Photoroom"/>-->

    <div class="pb-10 block-container">
        <div class="block-info d-flex flex-column ">
            <div>
                <p class="text">Ветеринарная </p>
                <p class="text">клиника </p>
                <p class="text">Айболит </p>
                <AppointmentBtn class="btn-appoint"/>
            </div>
        </div>

        <div>
            <v-img
                src="/assets/Photoroom.png"
                class=""
                width="1175"
                height="855"
            ></v-img>
        </div>
    </div>

    <!--    <v-carousel show-arrows="hover" cycle>-->

    <!--      &lt;!&ndash;    <v-carousel-item&ndash;&gt;-->
    <!--      &lt;!&ndash;        :src="carousel1"&ndash;&gt;-->
    <!--      &lt;!&ndash;        cover&ndash;&gt;-->
    <!--      &lt;!&ndash;    ></v-carousel-item>&ndash;&gt;-->

    <!--  <v-carousel-item :src="Photoroom">-->

    <!--  </v-carousel-item>-->

    <!--      <v-carousel-item-->
    <!--          :src="carousel2"-->
    <!--          cover-->
    <!--      ></v-carousel-item>-->

    <!--      <v-carousel-item-->
    <!--          :src="carousel3"-->
    <!--          cover-->
    <!--      ></v-carousel-item>-->
    <!--      <v-carousel-item-->
    <!--          :src="carousel4"-->
    <!--          cover-->
    <!--      ></v-carousel-item>-->
    <!--      <v-carousel-item-->
    <!--          :src="carousel5"-->
    <!--          cover-->
    <!--      ></v-carousel-item>-->
    <!--      <v-carousel-item-->
    <!--          :src="carousel6"-->
    <!--          cover-->
    <!--      ></v-carousel-item>-->
    <!--    </v-carousel>-->

</template>

<script setup>
import AppointmentBtn from "@/Pages/Cabinet/Home/AppointmentBtn.vue";</script>

<style scoped>
.text {
    font-size: 50px;
}

.btn-appoint {
}

.block-info {
    width: 400px;
}

.block-container {
    font-family: Alice,serif;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
}
</style>
