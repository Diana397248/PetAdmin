<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {onMounted, ref} from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import {errors} from '@/Validation/Appointments/Index'
import CreateModal from './Partials/CreateModal.vue'
import esLocale from "@fullcalendar/core/locales/ru";
import {EyeIcon} from '@heroicons/vue/24/outline'
import {Link} from '@inertiajs/vue3';

const selectedCreateClient = ref([])
const selectedCreateVet = ref([])
const selectedEditClient = ref([])
const isCreateModalOpen = ref(false)
const isEditModalOpen = ref(false)

const matchingClients = ref([]);
const matchingVets = ref([]);

const editData = ref({})

const openCreateModal = () => {
    isCreateModalOpen.value = true;
}

const closeCreateModal = () => {
    isCreateModalOpen.value = false;
    errors.value = {}
    selectedCreateClient.value = null
};

const openEditModal = async (id) => {
    const response = await axios.get(`/appointments/${id}`);
    editData.value = response.data;
    isEditModalOpen.value = true;
};

const closeEditModal = () => {
    isEditModalOpen.value = false;
    errors.value = {}
    selectedEditClient.value = null
};

const calendarOptions = ref({
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    headerToolbar: {
        left: 'prev,next today addEvent',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
    },
    eventTimeFormat: {
        hour: 'numeric',
        minute: '2-digit',
        omitZeroMinute: false,
        meridiem: true,
    },
    customButtons: {
        addEvent: {
            text: 'Записать',
            click: () => {
                openCreateModal();
            }
        }
    },
    locale: esLocale,
    eventClick: (info) => {
        openEditModal(info.event.id)
    },
})

const allAppointments = ref([]);

const fetchAllAppointments = async () => {
    const response = await axios.get('/appointments/fetchAllAppointments');
    allAppointments.value = response.data
    calendarOptions.value.events = response.data.map((appointment) => {
        let end = new Date(appointment.start_time);
        // TODO end.setMinutes(end.getMinutes()+30)
        return ({
            id: appointment.id,
            start: new Date(appointment.start_time),
            end: end,
            description: appointment.description
            // todo client
        })
    });
};

const fetchAllClients = async () => {
    const response = await axios.get('/appointments/fetchAllClients');
    matchingClients.value = response.data;
};

const fetchAllVets = async () => {
    const response = await axios.get('/appointments/fetchAllVets');
    matchingVets.value = response.data;
};

const searchClients = async (query) => {
    const response = await axios.get('/appointments/searchClients', {params: {query}});
    matchingClients.value = response.data;
};

const searchVets = async (query) => {
    const response = await axios.get('/appointments/searchVets', {params: {query}});
    matchingVets.value = response.data;
};

const getClientName = (client) => {
    let result = ""
    if (client.second_name) {
        result += client.second_name;
        if (client.name && client.name !== "") {
            result += " " + client.name[0] + ". ";
        }
        if (client.patronymic && client.patronymic !== "") {
            result += client.patronymic[0] + ".";
        }
        return result
    } else return client.name
}

onMounted(async () => {
    await fetchAllAppointments();
});
</script>

<template>
    <AppLayout title="Appointments">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Встречи
            </h2>
        </template>
        <!--        <p>xxx{{ JSON.stringify(calendarOptions.events) }}</p> TODO-->
        <div class="rounded-xl">
            <FullCalendar :options="calendarOptions"/>
        </div>

        <CreateModal
            :isCreateModalOpen="isCreateModalOpen"
            @closeCreateModal="closeCreateModal"
            :calendarOptions="calendarOptions"
            :fetchAllAppointments="fetchAllAppointments"

            :selectedClient="selectedCreateClient"
            :selectedVet="selectedCreateVet"

            :fetchAllClients="fetchAllClients"
            :fetchAllVets="fetchAllVets"

            :searchClients="searchClients"
            :searchVets="searchVets"

            :matchingClients="matchingClients"
            :matchingVets="matchingVets"
        />

        <!--        <EditModal :isEditModalOpen="isEditModalOpen"-->
        <!--                   @closeEditModal="closeEditModal"-->
        <!--                   :calendarOptions="calendarOptions"-->
        <!--                   :selectedClient="selectedEditClient"-->
        <!--                   :fetchAllAppointments="fetchAllAppointments"-->

        <!--                   :fetchAllClients="fetchAllClients"-->
        <!--                   :fetchAllVets="fetchAllVets"-->

        <!--                   :searchClients="searchClients"-->
        <!--                   :searchVets="searchVets"-->

        <!--                   :matchingClients="matchingClients"-->
        <!--                   :matchingVets="matchingVets"-->

        <!--                   :editData="editData"-->
        <!--        />-->

        <section class="bg-gray-50 dark:bg-gray-900 mt-8">
            <div class="mx-auto max-w-full max-h-max">
                <div class="bg-white dark:bg-gray-800 relative shadow-md rounded-xl overflow-hidden">
                    <div class="overflow-x-auto h-[700px]">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="hidden md:table-header-group text-xs text-gray-400 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3 w-[20%]">Ветеринар</th>
                                <th scope="col" class="px-4 py-3 w-[20%]">Клиент</th>
                                <th scope="col" class="px-4 py-3 w-[20%]">Дата</th>
                                <th scope="col" class="px-4 py-3 w-[30%]">Описание</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Навигация</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-if="allAppointments.length===0">
                                <td colspan="6" class="pt-8">
                                    <div class="flex items-center justify-center h-full">
                                        <div class="flex items-center mt-6 text-center rounded-lg h-96">
                                            <div class="flex flex-col w-full max-w-sm px-4 mx-auto">
                                                <h1 class="mt-3 text-lg text-gray-400 dark:text-white">Встречи не
                                                    найдены</h1>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr v-for="ap in allAppointments" :key="ap.id"
                                class="lg:table-row flex flex-col lg:flex-row border-b dark:border-gray-700">
                                <td class="px-4 py-1 lg:py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ ap.vet.user.name }}
                                </td>
                                <td class="px-4 py-1 lg:py-">{{
                                        getClientName(ap.client)
                                    }}
                                </td>
                                <td class="px-4 py-1 lg:py-3">{{
                                        ap.start_time
                                    }}
                                </td>
                                <td class="px-4 py-1 lg:py-3">{{
                                        ap.description
                                    }}
                                </td>
                                <!--                                <td class="px-4 py-1 lg:py-3">{{ moment(pet.created_at).format('MMMM Do, YYYY') }}</td>-->
                                <td class="px-4 py-4 lg:py-3 flex items-center justify-start ">
                                    <!--                                    TODO-->
                                    <Link :href="route('clients.show', { slug: ap.client.slug })"
                                          class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                                        <EyeIcon class="w-5 h-5 mr-1"/>
                                        <span class="sr-only">View</span>
                                    </Link>
                                    <!--                                    <Link :href="route('pets.edit', { slug: pet.slug })"-->
                                    <!--                                          class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">-->
                                    <!--                                        <PencilSquareIcon class="w-5 h-5 text-indigo-500 hover:text-indigo-800 mr-1"/>-->
                                    <!--                                        <span class="sr-only">Edit</span>-->
                                    <!--                                    </Link>-->
                                    <!--                                    <button @click="deletePet(pet.id)"-->
                                    <!--                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"-->
                                    <!--                                            type="button">-->
                                    <!--                                        <TrashIcon class="w-5 h-5 text-red-500 hover:text-red-800"/>-->
                                    <!--                                        <span class="sr-only">Delete</span>-->
                                    <!--                                    </button>-->
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>

                    <!--                    TODO PAGINATION -->
                    <!--                    <Pagination v-if="allAppointments.length > 0"  @change-page="fetchPets"/>-->
                </div>
            </div>
        </section>
    </AppLayout>
</template>
