<template>
    <v-card class="pa-8 card ">
        <v-card-text>
            <v-row>
                <v-col class="d-flex flex-column align-center justify-content-center " cols="4">
                    <image-input v-model="model.img"/>
                </v-col>

                <v-col class="d-flex flex-column gap-5">

                    <v-row justify="end" class="mx-3">
                        <!--            <p class="pet-name">Добавление питомца</p>-->
                        <v-btn @click="emmit('close')" color="rgba(245, 67, 55, 0.94)" :icon="CloseIcon"></v-btn>
                    </v-row>

                    <v-form @submit.prevent>
                        <v-text-field
                            v-model="model.name"
                            :rules="rules.name"
                            label="имя"/>

                        <v-select
                            v-model="selectedTypeID"
                            :rules="rules.type"
                            label="тип"
                            :items="matchingSpecies"
                            item-title="name"
                            item-value="id"
                        ></v-select>


                        <v-select
                            label="порода"
                            v-model="selectedBreedID"
                            :rules="rules.breed"
                            :items="matchingBreeds"
                            item-title="name"
                            item-value="id"
                        ></v-select>

                        <v-select
                            label="пол"
                            v-model="model.gender"
                            :rules="rules.gender"
                            :items="['Мужской', 'Женский', 'Никто']"
                        ></v-select>

                        <VNumberInput
                            :max="100"
                            :min="1"
                            v-model="model.age"
                            :rules="rules.age"
                            label="возраст"
                        ></VNumberInput>

                        <AddPetBtn class="mt-2" size="small" @click="createPet"/>
                    </v-form>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>

<script setup>
import CloseIcon from "@/Components/Cabinet/Icons/CloseIcon.vue"
import ImageInput from "@/Components/Cabinet/Base/ImageInput.vue"
import AddPetBtn from "@/Components/Cabinet/Base/AddPetBtn.vue"
import {usePage} from '@inertiajs/vue3'
import {computed, nextTick, onMounted, reactive, ref, watch} from 'vue'
import {toast} from "vue3-toastify";
import {VNumberInput} from 'vuetify/labs/VNumberInput'

const page = usePage()
const userId = computed(() => page.props.auth.user.id)

const isSubmitting = ref(false)
const selectedBreed = ref(null);
const matchingSpecies = ref([]);
const matchingBreeds = ref([]);
const loadingBreeds = ref(false);

const selectedTypeID = ref(1);
const selectedBreedID = ref(null);

const model = reactive({
    name: "",
    type: "",
    gender: "Мужской",
    breed: "",
    age: "",
    img: "",
    species_id: 1, // TODO
    client_id: 1,
    breed_id: 1,
})

onMounted(() => {
    fetchAllSpecies()
})
const fetchAllSpecies = async () => {
    const response = await axios.get('/pets/fetchAllSpecies');
    matchingSpecies.value = response.data;
    await nextTick();
}


const fetchSpecies = async (query) => {
    const response = await axios.get(`/pets/species?name=${query}`);
    const data = response.data;
    matchingSpecies.value = data.slice(0, 10);
};
const fetchBreeds = async (speciesId) => {
    loadingBreeds.value = true;

    const response = await axios.get(`/pets/breeds?species_id=${speciesId}`);
    const data = response.data;

    matchingBreeds.value = data;
    await nextTick();

    loadingBreeds.value = false;
};

watch(selectedTypeID, async () => {
    selectedBreedID.value = null
    if (selectedTypeID.value) {
        await fetchBreeds(selectedTypeID.value);
    } else {
        console.log('Виды не выбраны')
    }
});


const emmit = defineEmits([
    'close',
    'updatePets'
])

const createPet = () => {
    const pet = {
        //TODO:
        species_id: selectedTypeID.value,
        client_id: userId.value || 1,
        breed_id: selectedBreedID.value || 1,

        "name": model.name,
        "type": model.type,
        "age": model.age,
        "gender": model.gender,
        "photo": model.img,
    }
    const formData = new FormData();
    formData.append('name', pet.name);
    formData.append('species_id', pet.species_id);
    formData.append('breed_id', pet.breed_id);
    formData.append('age', pet.age);
    formData.append('gender', pet.gender);
    if (pet.photo && pet.photo.file instanceof File) {
        formData.append('photo', pet.photo.file);
    }
    formData.append('client_id', pet.client_id);

    axios.post('/pets/store', formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    })
        .then((res) => {
            if (res.status === 201) {
                emmit('updatePets')
                resetForm();

                emmit('close')
                toast.success('Питомец успешно создан!');

            }

        })
        .catch((error) => {
            console.log(error)
        })
}

const resetForm = () => {
    model.name = "";
    model.type = "";
    model.gender = "";
    model.breed = "";
    model.age = "";
    model.img = "";
}

const avatar = ref(
    null
);

const rules = {
    name: [
        value => {
            if (value.trim() !== "") return true
            return 'Поле должно быть заполнено.'
        }
    ],
    type: [
        value => {
            if (true) return true
            return 'Поле должно быть заполнено.'
        }
    ],
    gender: [
        value => {
            if (true) return true
            return 'Выберите пол животного.'
        }
    ],
    breed: [
        value => {
            if (value !== null) return true
            return 'Введите породу животного.'
        }
    ],
    age: [
        value => {
            if (value > 0) return true
            return 'Возраст должен быть больше 0'
        },
    ],
}


watch(avatar, (newValues, prevValues) => {
    console.log(newValues, prevValues)
})

</script>

<style scoped>
.card {
    border-radius: 20px;
}

.pet-name {
    font-size: 30px;
    display: flex;
    gap: 20px;
}

.ex-col {
    width: 50px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

:deep(.v-field__field label) {
    margin-left: 10px !important;
}
</style>
