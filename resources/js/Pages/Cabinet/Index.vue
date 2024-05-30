<script setup>
import {onMounted, ref} from 'vue';
import LeftSide from "@/Components/Cabinet/LeftSide.vue"
import UserInfo from "@/Components/Cabinet/UserInfo.vue"
import MyPets from "@/Components/Cabinet/Pet/MyPets.vue"
import Appointment from "@/Components/Cabinet/Appointment/Appointment.vue"


import Swal from "sweetalert2";
import {initFlowbite} from 'flowbite'
import {useToast} from "vue-toastification"
import ClientLayout from "@/Layouts/ClientLayout.vue";

onMounted(() => {
    initFlowbite();
    // fetchItems();
})

const toast = useToast();
// const meta = ref({})
// const items = ref([])
const isLoading = ref(false)
// const selectedItemIds = ref([])
// const selectAll = ref(false)
// const anyCheckboxSelected = ref(false)

// const fetchItems = async (page = 1) => {
//     isLoading.value = true
//     const response = await axios.get('/items/fetchAllItems', { params: { page } })
//     items.value = response.data.items.data
//     meta.value = response.data.meta
//     isLoading.value = false
// }


const deleteItem = (id) => {
    Swal.fire({
        title: 'Delete Item?',
        text: 'Are you sure you want to delete this item?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/items/${id}`)
                .then(response => {
                    Swal.fire('Deleted!', response.data.message, 'success');
                    fetchItems();
                })
                .catch(error => {
                    Swal.fire('Error!', error.response.data.message, 'error');
                });
        }
    });
}

const editItem = (id) => {
    console.log(`Editing item ${id}`);
}
</script>

<template>
    <ClientLayout title="Items">
        <v-row>

            <v-col cols="3">
                <LeftSide></LeftSide>
            </v-col>

            <v-col cols="9" class="right-side">
                <div class="my-block">
                    <UserInfo></UserInfo>
                </div>
                <div class="my-block">
                    <MyPets></MyPets>
                </div>
                <div class="my-block">
                    <Appointment/>
                </div>
            </v-col>

        </v-row>
    </ClientLayout>
</template>


<style scoped>
.right-side .my-block:not(:last-child) {
    margin-bottom: 90px !important;
}
</style>
