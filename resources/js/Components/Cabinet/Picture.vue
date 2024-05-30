<template>
    <div class="block-f">
        <v-avatar color="surface-variant" size="130">
            <v-img :src="props.img"></v-img>
        </v-avatar>
        <v-btn v-if="props.textBtn" class="my-btn" variant="text" color="#FFC59E">
            {{ props.textBtn }}
        </v-btn>
    </div>
</template>

<script setup>
const props = defineProps({
    img: String,
    textBtn: String
})

</script>

<style scoped>
.block-f {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 30px;
    width: 130px;

}


.block-f :deep(.v-btn__content) {
    white-space: pre-wrap;
}
</style>
