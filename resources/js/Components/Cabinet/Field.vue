<template>
    <div class="field">
        <p>{{ props.label }}</p>
        <h3>{{ props.text }}</h3>
    </div>
</template>

<script setup>
const props = defineProps({
    label: String,
    text: String
})
</script>

<style scoped>
.field {
    display: flex;
    flex-direction: column;
}

p {
    color: #C3B9B5;
    font-size: 15px;
}

h3 {
    font-size: 20px;
}
</style>
