<script setup>
import {onMounted, ref, watch} from 'vue'
import {useForm} from "@inertiajs/vue3"
import VueMultiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.css'
import {useToast} from "vue-toastification"
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {errors, validateForm, watchFields} from '@/Validation/Appointments/Index'

const toast = useToast();
const emit = defineEmits(['closeCreateModal'])

const selectedCreateClient = ref([]);
const selectedCreateVet = ref([]);


const props = defineProps({
    isCreateModalOpen: Boolean,
    calendarOptions: Object,
    fetchAllAppointments: Function,

    selectedClient: Object,
    selectedVet: Object,

    fetchAllClients: Function,
    fetchAllVets: Function,

    searchClients: Function,
    searchVets: Function,

    matchingClients: Object,
    matchingVets: Object,
})

const createForm = useForm({
    client_id: '',
    vet_id: '',
    start_time: '',
    description: '',
})

const resetForm = () => {
    createForm.client_id = '';
    createForm.vet_id = '';
    createForm.start_time = '';
    createForm.description = '';
    selectedCreateClient.value = null;
}

const closeCreateModal = () => {
    emit('closeCreateModal')
    errors.value = {}
    selectedCreateClient.value = null
    selectedCreateVet.value = null
};

const submitAppointmentForm = async () => {
    validateForm(createForm);

    if (Object.keys(errors.value).length > 0) {
        toast.error("Пожалуйста, исправьте ошибки в форме.");
        return;
    }

    const formData = {
        client_id: selectedCreateClient.value.id,
        vet_id: selectedCreateVet.value.id,
        start_time: createForm.start_time,
        description: createForm.description,
    };

    await axios.post("/appointments/create", formData);
    props.fetchAllAppointments();
    closeCreateModal()
    resetForm()
    toast.success("Встреча успешно создана!");
};

const setClientId = () => {
    if (selectedCreateClient.value) {
        errors.value.client_id = [];
        createForm.client_id = selectedCreateClient.value.id;
    }
};


const setVetId = () => {
    if (selectedCreateVet.value) {
        errors.value.vet_id = [];
        createForm.vet_id = selectedCreateVet.value.id;
    }
};

watch(selectedCreateClient, () => {
    if (selectedCreateClient.value) {
        setClientId();
    }
});

watch(selectedCreateVet, () => {
    if (selectedCreateVet.value) {
        setVetId();
    }
});

onMounted(async () => {
    await props.fetchAllClients();
    await props.fetchAllVets();
    watchFields(createForm);
});

const customLabelVet =(vetData)=> `${vetData.user.name}`

</script>
<template>
    <TransitionRoot appear :show="isCreateModalOpen" as="template">
        <Dialog as="div" @close="$emit('closeCreateModal')" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                             leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black/25"/>
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                                     enter-to="opacity-100 scale-100" leave="duration-200 ease-in"
                                     leave-from="opacity-100 scale-100"
                                     leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                            <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                Добавить встречу
                            </DialogTitle>
                            <form @submit.prevent="submitAppointmentForm" class="py-5">
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="vet"
                                               class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Ветеринар</label>
                                        <VueMultiselect v-model="selectedCreateVet" :options="props.matchingVets"
                                                        :multiple="false"
                                                        :clear-on-select="true"
                                                        placeholder="Введите для поиска ветеринара"
                                                        :custom-label="customLabelVet" track-by="id"
                                                        @search-change="props.searchVets" @input="setVetId"
                                                        :class="{ 'error': errors.vet_id }">
                                            <template #noResult>
                                                Упс! Ветеринары не найдены. Попробуйте другой поисковый запрос.
                                            </template>
                                        </VueMultiselect>
                                        <div v-if="errors.vet_id" class="text-xs text-red-500 mt-1">
                                            {{ errors.vet_id }}
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="client"
                                               class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Клиент</label>
                                        <VueMultiselect v-model="selectedCreateClient" :options="props.matchingClients"
                                                        :multiple="false"
                                                        :clear-on-select="true" placeholder="Введите для поиска клиета"
                                                        label="name" track-by="id"
                                                        @search-change="props.searchClients" @input="setClientId"
                                                        :class="{ 'error': errors.client_id }">
                                            <template #noResult>
                                                Упс! Пользователи не найдены. Попробуйте другой поисковый запрос.
                                            </template>
                                        </VueMultiselect>
                                        <div v-if="errors.client_id" class="text-xs text-red-500 mt-1">
                                            {{ errors.client_id }}
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="start_time"
                                               class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Начало </label>
                                        <input v-model="createForm.start_time" type="datetime-local" name="start_time"
                                               id="start_time"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                               :class="errors.start_time ? 'border-red-500' : 'border-gray-300'">
                                        <div v-if="errors.start_time" class="text-xs text-red-500 mt-1">
                                            {{ errors.start_time }}
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="description"
                                               class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Описание</label>
                                        <textarea v-model="createForm.description" id="description" rows="4"
                                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                                  placeholder="Напишите причину визита здесь"></textarea>
                                    </div>
                                </div>
                                <button type="submit"
                                        class="text-white inline-flex items-center bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    Записать
                                </button>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<style scoped>
.multiselect >>> .multiselect__tags {
    border: 1px solid #D1D5DBFF;
}

.multiselect.error >>> .multiselect__tags {
    border: 1px solid #f05252;
}
</style>
