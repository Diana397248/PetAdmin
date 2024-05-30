<script setup>
import {onMounted} from 'vue';
import {initFlowbite} from 'flowbite'
import '../../css/app.scss';

onMounted(() => {
    initFlowbite();
})

</script>

<template>
    <slot/>
</template>
