<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div class="w-full h-screen overflow-hidden relative">
        <img src="../img/welcome.jpg" alt="" class="object-cover w-full h-full">
        <div class="absolute top-0 right-0 w-full h-screen flex justify-center items-center">
            <div class="w-2/4 h-3/4 bg-black/80 p-8 text-white flex flex-col justify-center items-center space-y-7">
                <h1 class="text-6xl">Delicias Mundiales</h1>
                <p class="text-xl text-gray-300 text-center">Unete a nuestra comunidad, crea, aprende y comparte lar mejores recetas</p>
                <div >
                    <div v-if="canLogin">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="tline-red-500"
                            >Dashboard</Link
                        >

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="bg-main px-8 py-3 rounded mr-4 text-black font-medium"
                                >Iniciar sesión</Link
                            >

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="border-main px-8 py-3 rounded text-main"
                                >Registarse</Link
                            >
                        </template>
                     </div>
                </div>
            </div>
        </div>
    </div>
</template>
