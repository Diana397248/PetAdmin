<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { onMounted, ref } from 'vue'
import { useToast } from "vue-toastification"
import Spinner from '@/Components/Spinner.vue'
import { validateForm, watchFields, errors } from '@/Validation/Items/Index';

const toast = useToast();
const isSubmitting = ref(false)
const createForm = ref({
  item_name: '',
    description: '',
    quantity: '',
    unit_price: ''
})
const resetForm = () => {
  createForm.value = {
    item_name: '',
    description: '',
    quantity: '',
    unit_price: ''
  }
}

const submitForm = async () => {
  isSubmitting.value = true;

  validateForm(createForm.value);

  // Check if there are any errors
  if (Object.keys(errors.value).length > 0) {
    toast.error("Пожалуйста, исправьте ошибки в форме.");
    isSubmitting.value = false;
    return;
  }

  const response = await axios.post('/items/store', createForm.value);
  resetForm();
  isSubmitting.value = false;
  toast.success(response.data.message);
};

onMounted(() => {
  watchFields(createForm.value);
});

</script>

<template>
  <AppLayout title="Добавление услуги">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Добавить услугу
      </h2>
    </template>

    <section class="bg-white dark:bg-gray-900 rounded-xl">
      <div class="px-4 mx-auto py-4">
        <form @submit.prevent="submitForm">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="sm:col-span-2">
              <label for="item_name" class="block mb-2 text-xs font-medium text-gray-400 dark:text-white">Название услуги</label>
              <input v-model="createForm.item_name" type="text" name="item_name" id="item_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                :class="errors.item_name ? 'border-red-500' : ''"
                placeholder="Название услуги">
              <span class="text-red-500 text-xs">{{ errors.item_name }}</span>
            </div>
<!--            <div class="w-full">-->
<!--              <label for="quantity" class="block mb-2 text-xs font-medium text-gray-400 dark:text-white">Количество</label>-->
<!--              <input v-model="createForm.quantity" type="number" name="quantity" id="quantity"-->
<!--                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"-->
<!--                :class="errors.quantity ? 'border-red-500' : ''"-->
<!--                placeholder="Количество">-->
<!--              <span class="text-red-500 text-xs">{{ errors.quantity }}</span>-->
<!--            </div>-->
            <div class="w-full">
              <label for="unit_price" class="block mb-2 text-xs font-medium text-gray-400 dark:text-white">Цена</label>
              <input v-model="createForm.unit_price" type="text" name="unit_price" id="unit_price"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                :class="errors.unit_price ? 'border-red-500' : ''"
                placeholder="Цена">
              <span class="text-red-500 text-xs">{{ errors.unit_price }}</span>
            </div>
            <div class="sm:col-span-2">
              <label for="description" class="block mb-2 text-xs font-medium text-gray-400 dark:text-white">Почта</label>
              <textarea v-model="createForm.description"
                type="text" name="description" id="description" rows="4"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                :class="errors.description ? 'border-red-500' : ''"
                placeholder="Описание услуги"></textarea>
              <span class="text-red-500 text-xs">{{ errors.description }}</span>
            </div>
          </div>

          <button type="submit"
            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-indigo-900 hover:bg-indigo-800 disabled:bg-indigo-300 disabled:cursor-not-allowed">
            Создать
          </button>

        </form>
      </div>
    </section>
  </AppLayout>
</template>
