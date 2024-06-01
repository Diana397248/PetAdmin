<template>
    <p class="title">Диана</p>

    <div class="links-block">
        <p>Личные данные</p>
        <p>Мои питомцы</p>
        <p>Запись на прием</p>
    </div>

</template>

<script setup>

</script>

<style scoped>
.links-block p {
    color: #C3B9B5;
    font-size: 20px;
    font-weight: bold;
    text-transform: uppercase;
}

.links-block {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.title {
    font-size: 80px;
    margin-bottom: 100px !important;
}
</style>
