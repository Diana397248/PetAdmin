<template>
    <div>
        <!-- slot for parent component to activate the file changer -->
        <div @click="launchFilePicker()">
            <slot name="activator">
                <div class="d-flex flex-column align-center gap-3">
                    <div>
                        <v-avatar size="250px" color="#D3D3D3" v-ripple v-if="!image" class="grey lighten-3 mb-3">
                        </v-avatar>
                        <v-avatar size="250px" v-ripple v-else class="mb-3">
                            <img :src="image.imageURL" alt="avatar">
                        </v-avatar>
                    </div>
                    <span class="change-text text-black fs-4">Нажмите чтобы изменить аватар</span>
                </div>
            </slot>
        </div>
        <!-- image input: style is set to hidden and assigned a ref so that it can be triggered -->
        <input type="file"
               ref="file"
               :name="uploadFieldName"
               @change="onFileChange(
          $event.target.name, $event.target.files)"
               style="display:none">
        <!-- error dialog displays any potential error messages -->
        <v-dialog v-model="errorDialog" max-width="300">
            <v-card class="pa-4 d-flex flex-column align-center ">
                <v-card-text class="subheading">{{ errorText }}</v-card-text>
                <v-card-actions>
                    <v-btn @click="errorDialog = false" color="danger" variant="tonal">Закрыть ошибку</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
import {defineEmits, ref} from "vue";

const props = defineProps({
    modelValue: Object
})

const emit = defineEmits([
    'input',
    'update:modelValue'
])


const errorDialog = ref(false)
const errorText = ref('')
const uploadFieldName = ref('file')
const maxSize = ref(100_000 * 1024)
const file = ref(null)
const image = ref(null);


const launchFilePicker = () => {
    file.value.click();
}

const onFileChange = (fieldName, files) => {
    let imageFile = files[0]

    if (files.length > 0) {
        if (!imageFile.type.match('image.*')) {
            // check whether the upload is an image
            errorDialog.value = true
            errorText.value = 'Please choose an image file'
        } else if (imageFile.size > maxSize.value) {
            // check whether the size is greater than the size limit
            errorDialog.value = true
            errorText.value = 'Your file is too big! Please select an image under 1MB'
        } else {
            // Append file into FormData and turn file into image URL
            let formData = new FormData()
            let imageURL = URL.createObjectURL(imageFile)
            formData.append(fieldName, imageFile)
            // Emit the FormData and image URL to the parent component
            emit('input', {formData, imageURL})
            emit('update:modelValue', {file: imageFile, imageURL})
            image.value = {imageURL}
        }
    }
}
</script>
<style scoped>
.change-text {
    max-width: 200px;
    text-align: center;
}
</style>
