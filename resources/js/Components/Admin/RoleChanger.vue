<template>
    <form @submit.prevent='handleForm'
          class="flex gap-3 max-w-full max-w-md mx-auto">
        <select
            v-model="data"
            id="countries"
            class="w-[300px]
                bg-gray-50
                border
                border-gray-300
                text-gray-900
                text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5
                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >

            <option value="admin">Администратор</option>
            <option value="cashier">Кассир</option>
            <option value="doctor">Доктор</option>
            <option value="client">Клиент</option>
        </select>
        <button type="submit"
                :disabled="data===props.user.role"
                :class="{'bg-blue-400 dark:bg-blue-500 cursor-not-allowed':data===props.user.role}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Изменить
        </button>
    </form>
</template>

<script setup>
import {watch, ref} from "vue";

const data = ref('client')

const props = defineProps({
    user: Object,
})

const emit = defineEmits(["handleForm"])

const handleForm = () => {
    emit('handleForm',  data.value, props.user.id)
}

watch(props.user.role, () => data.value = props.user.role)

</script>

<style scoped>

</style>
