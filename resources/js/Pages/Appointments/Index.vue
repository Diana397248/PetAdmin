<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {onMounted, ref} from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import {errors} from '@/Validation/Appointments/Index'
import CreateModal from './Partials/CreateModal.vue'
import esLocale from "@fullcalendar/core/locales/ru";

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

const fetchAllAppointments = async () => {
    const response = await axios.get('/appointments/fetchAllAppointments');
    calendarOptions.value.events = response.data.map((appointment) => {
        let end = new Date(appointment.start_time);
        end.setMinutes(end.getMinutes()+30)
        return ({
            id: appointment.id,
            start:  new Date(appointment.start_time),
            end:  end,
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
        <p>xxx{{ JSON.stringify(calendarOptions.events) }}</p> TODO
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


    </AppLayout>
</template>
