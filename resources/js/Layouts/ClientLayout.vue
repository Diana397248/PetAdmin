<script setup>
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import {onMounted} from 'vue';
import {initFlowbite} from 'flowbite'
import '@mdi/font/css/materialdesignicons.css'
import "vue3-toastify/dist/index.css";
import '../../css/cabinet.scss';

onMounted(() => {
    initFlowbite();
})

defineProps({});

</script>

<template>
    <div class="header-wrapper">
        <Header/>
    </div>

    <div class="container-wrapper">
        <div class="container">
            <main>
                <slot/>
            </main>
        </div>
    </div>
    <Footer/>
</template>


<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

.header-wrapper {
    padding: 30px !important;
}

body {
    background: #FFFEFE;
    font-family: 'Inter', monospace;
}

.container-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
}

* {
    margin: 0 !important;
    padding: 0 !important;
}

.title {
    font-size: 40px;
    margin-bottom: 30px !important;
}

.text-aibolit-gray {
    color: #C3B9B5;

}

.example {
    height: 100px;
    width: 100px;
    background-color: red;
}
</style>
