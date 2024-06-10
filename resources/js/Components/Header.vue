<template>
    <header class="desktop">
        <div class="d-flex flex-column flex-md-row align-items-center gap-5">

            <!--      TODO в router-link добавить переадресацию на нужные страницы-->
            <Link :href="route('HomePage')" :active="route().current('HomePage')"
                  class="d-flex align-items-center text-black text-decoration-none"
            >
                <!--                TODO IMPORT NORMAL FOR LOGO-->
                <img src="/assets/logo.png" class="fs-4 py-2"/>

            </Link>
            <nav class="mx-12 d-flex gap-5">
                <template v-if="$page.props.auth?.user.role==='client'">
                    <!--TODO -->
                    <!--                <Link :href="route('UserProfile')" :active="route().current('UserProfile')"-->
                    <!--                      class="me-8 py-2 text-black text-decoration-none fs-4 fw-bold"-->
                    <!--                >-->
                    <!--                    УСЛУГИ-->
                    <!--                </Link>-->

                    <Link :href="route('UserProfile')" :active="route().current('UserProfile')"
                          class="me-8 py-2 text-black text-decoration-none fs-4 fw-bold"
                    >
                        ЛИЧНЫЙ КАБИНЕТ
                    </Link>
                    <!--TODO -->
                    <!--                <Link :href="route('UserProfile')" :active="route().current('UserProfile')"-->
                    <!--                      class="me-8 py-2 text-black text-decoration-none fs-4 fw-bold"-->
                    <!--                >-->
                    <!--                    О НАС-->
                    <!--                </Link>-->
                    <Link :href="route('Calendars')" :active="route().current('Calendars')"
                          class="me-8 py-2 text-black text-decoration-none fs-4 fw-bold"
                    >
                        ЗАПИСАТЬСЯ
                    </Link>

                </template>

                <template v-if="$page.props.auth?.user.role!=='client'">
                    <Link :href="route('dashboard')" :active="route().current('dashboard')"
                          class="me-8 py-2 text-black text-decoration-none fs-4 fw-bold"
                    >
                        ПАНЕЛЬ АДМИНИСТРАТОРА
                    </Link>
                </template>

                <!--                <Link :href="route('CategoryPage')" :active="route().current('CategoryPage')"-->
                <!--                      v-if="store.isAuth && store.isAdmin"-->
                <!--                      class="me-8 py-2 text-black text-decoration-none fs-4 fw-bold"-->
                <!--                >-->
                <!--                    Категории-->
                <!--                </Link>-->
            </nav>
            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto align-center">
                <template v-if="!$page.props.auth?.user">
                    <Link @click="login" :active="route().current('login')"
                          class="me-3 py-2 text-black text-decoration-none fs-5 text-teachat__hover"
                    >
                        Авторизация
                    </Link>
                    <Link @click="register" :active="route().current('register')"
                          class="me-3 py-2 text-black text-decoration-none fs-5 text-teachat__hover"
                    >
                        Регистрация
                    </Link>
                </template>
                <!--                for AUTH USER-->
                <template v-if="!!$page.props.auth?.user">
                    <span class="fs-5 ">{{ $page.props.auth.user.name }}</span>
                    <span
                        @click="logOut"
                        role="button"
                        class="me-3 py-2 text-black text-decoration-none fs-5 ml-4"
                    >Выход</span
                    >
                </template>
            </nav>
        </div>
    </header>
    <template v-if="store.isDebug">
        <h1 class="text-black"> Current user id: {{ store }}</h1>
    </template>
</template>

<script setup>
import {Link, router} from "@inertiajs/vue3";
import {onMounted} from "vue";

const store = {
    isDebug: false
}
const logOut = () => {
    router.post(route('logout'));
};

const login = () => {
    router.get(route('login'));
};

const register = () => {
    router.get(route('register'));
};

onMounted(() => {
});
</script>


<style scoped>
.text-teachat {
    color: #f4d58d;
}

.text-teachat__hover:hover {
    color: #f4d58d;
}

.desktop {
    display: block;
}

@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
    .mobile {
        display: block;
    }

    .desktop {
        display: none;
    }
}

@media only screen and (min-device-width: 481px) {
    .mobile {
        display: none;
    }

    .desktop {
        display: block;
    }
}

</style>
