<template>
    <v-btn
        :style="{height:btnStyle.height + 'px', fontSize:btnStyle.fontSize + 'px' }"
        color="#FFC59E" class="btn-add text-white fw-bold"
        @click="emit('clickBtn')"
        block="">
        <template v-slot:prepend>
            <v-icon
                :size="btnStyle.sizeIcon"
                :icon="AddPetIcon"
            />
        </template>

        Добавить нового питомца

    </v-btn>
</template>

<script setup>
import AddPetIcon from "@/Components/Cabinet/Icons/AddPetIcon.vue"
import {computed} from "vue";

const emit = defineEmits([
    'clickBtn'
])

const props = defineProps({
    size: {
        type: String,
        default: 'dig'
        // default: 'small'
    },
    click: Function

})

const btnStyle = computed(() => {
    if (props.size === 'small') {
        return {
            sizeIcon: 65,
            fontSize: 17,
            height: 70
        }
    }
    return {
        sizeIcon: 133,
        fontSize: 30,
        height: 150
    }
})
</script>

<style scoped>
.btn-add {
    border-radius: 20px;
}
</style>
