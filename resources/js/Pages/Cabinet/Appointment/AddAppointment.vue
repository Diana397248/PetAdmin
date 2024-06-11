<template>
    <ClientLayout title="Items">
        <v-row class="d-flex justify-center mb-10">
            <v-row>
                <v-col cols="4"></v-col>
                <v-col>
                    <v-btn
                        variant="text"
                        prepend-icon="mdi-chevron-left"
                        color="#FFC59E"
                        size="large"
                        class="fw-bold"
                    >
                        <template v-slot:prepend>
                            <v-icon color="#FFC59E"></v-icon>
                        </template>

                        НАЗАД
                    </v-btn>
                </v-col>

            </v-row>
            <v-row>
                <v-col cols="4">
                    <div class="text-h2">
                        Оформление заявки
                    </div>
                </v-col>
                <v-col>
                    <v-form v-model="valid" @submit.prevent>
                        <v-container>
                            <!--Блок формы-->


                            <v-row>
                                <v-col cols="5"
                                       class="mt-5 mr-2"
                                       style="height: 55px">
                                    <v-select
                                        label="ветеринар"
                                        v-model="selectedVetID"
                                        :items="allVets"
                                        item-title="user.name"
                                        item-value="id"
                                    ></v-select>
                                </v-col>
                                <v-col
                                    cols=""
                                    class="d-flex justify-center mt-5 ml-2"
                                >
                                    <input v-model="model.date" type="datetime-local" name="start_time"
                                           style="background-color: #F6F5F6; height: 55px"
                                           class="d-block w-100  text-sm  focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                           :class="rules.date === true ? 'border-red-500' : 'border-gray-300'">
                                    <!--                                               :class="errors.start_time ? 'border-red-500' : 'border-gray-300'">-->
                                    <!--                                        todo-->
                                    <!--                                        <div v-if="errors.start_time" class="text-xs text-red-500 mt-1">-->
                                    <!--                                            {{ errors.start_time }}-->
                                    <!--                                        </div>-->
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col cols="12"
                                       class="mt-5">
                                    <v-textarea
                                        class="text-area-description"
                                        auto-grow
                                        v-model="model.desc"
                                        :rules="rules.desc"
                                        label="Кратко опишите проблему"
                                        variant="outlined"
                                    ></v-textarea>
                                    <!--      <span class="d-block mb-4 text-danger" v-if="errors?.description">{{ errors.description[0] }}</span>-->
                                </v-col>
                            </v-row>

                            <!--      Блок капчи-->
                            <v-row>
                                <v-col cols="12">
                                    <v-card
                                        variant="flat"
                                        class="mx-auto"
                                        color="#EDE9E8"
                                    >
                                        <v-card-item class="justify-center">
                                            <v-row>
                                                <v-col
                                                    cols="6"
                                                >
                                                    <v-text-field
                                                        class="mx-2 mt-1"
                                                        disabled
                                                        v-model="model.capcha_gen"
                                                        :counter="10"
                                                        :rules="rules.capcha_gen"
                                                        hide-details
                                                        required
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col
                                                    cols="6"
                                                >
                                                    <v-text-field
                                                        class="mx-2 mt-1"
                                                        v-model="model.capcha_val"
                                                        :counter="10"
                                                        :rules="rules.capcha_val"
                                                        label="Введите капчу"
                                                        hide-details
                                                        required
                                                    ></v-text-field>
                                                </v-col>
                                            </v-row>
                                            <v-row>
                                                <v-col class="mx-5 mt-3">
                                                    Ваши личные данные будут использоваться для обработки ваших заказов,
                                                    упрощения вашей работы с
                                                    сайтом и
                                                    для других целей, описанных в нашей политика конфиденциальности.
                                                </v-col>
                                            </v-row>
                                        </v-card-item>

                                        <v-card-actions class="justify-center mb-6">
                                            <v-btn class=" mt-10 px-16 text-white py-5 h-100 text-h5"
                                                   style="border-radius: 34px " color="#FFC59E"
                                                   variant="flat"
                                                   :disabled="!valid"
                                                   @click="submitAppointmentForm"
                                            >
                                                Записаться
                                            </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-form>
                </v-col>
            </v-row>
        </v-row>
    </ClientLayout>
</template>

<script setup>
import {toast} from "vue3-toastify";

import ClientLayout from "@/Layouts/ClientLayout.vue"
import {onMounted, reactive, ref} from "vue";
import {router} from "@inertiajs/vue3";

const valid = ref(false);
const selectedVetID = ref(1);
const allVets = ref([]);

onMounted(() => {
    fetchAllVets()
})


const fetchAllVets = async () => {
    const response = await axios.get('/appointments/fetchAllVets');
    allVets.value = response.data;
    selectedVetID.value = 1
}
const submitAppointmentForm = async () => {
    // validateForm(createForm);

    // if (Object.keys(errors.value).length > 0) {
    //     toast.error("Пожалуйста, исправьте ошибки в форме.");
    //     return;
    // }

    const formData = {
        vet_id: selectedVetID.value || 1,
        start_time: model.date,
        description: model.desc,
        firstname: "",
        phone: "",
        // TODO
    };

    axios.post("/appointments/create", formData)
        .then(() => {
            toast.success("Встреча успешно создана!");
            router.get(route('Calendars'));
        })
        .catch((err) => {
            toast.error(err);
        })

};

function makeid(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        counter += 1;
    }
    return result;
}

const rules = {
    firstname: [
        value => {
            if (value.trim() !== "") return true
            return 'Поле должно быть заполнено.'
        }
    ],
    phone: [
        value => {
            if (value.trim() !== "") return true
            return 'Поле должно быть заполнено.'
        }
    ],
    desc: [
        value => {
            return true
        }
    ],
    date: [
        value => {
            if (value.trim() !== "") return true
            return 'Поле должно быть заполнено.'
        }
    ],
    capcha_gen: [
        value => {
            if (true) {
                return true;
            }
            return 'Поле должно быть заполнено.'
        }
    ],
    capcha_val: [
        value => {
            if (value.trim() !== "" && value === model.capcha_gen) return true
            return 'Поле должно быть заполнено.'
        }
    ],

}

const model = reactive({
    firstname: "",
    phone: "",
    desc: "",
    date: "",
    capcha_gen: makeid(6),
    capcha_val: "",

})

</script>

<style scoped>
.text-area-description:deep(textarea) {
    padding: 15px 10px 0 !important;
}
</style>
