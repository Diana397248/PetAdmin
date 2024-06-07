<template>
    <v-card
        :height="220"
        :width="320">
        <v-card-text>
            <v-row>
                <v-col class="pa-6 w-33 d-flex flex-column justify-content-between">

                    <p class="text-service fw-light fs-1 mb-0 ">{{ props.serviceData.name }}</p>

                    <v-img class="services-card-img w-100 h-100" :src="props.serviceData.img"/>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>

</template>

<script setup>

const props = defineProps({
    serviceData: Object
})
</script>

<style scoped>
.text-service {
    justify-self: start;
}

.services-card-img {
    width: 110px !important;
    height: 110px !important;
    align-self: flex-end;

}
</style>
