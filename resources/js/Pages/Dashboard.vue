<script setup>
import Card from '@/Components/MisComponentes/Card.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Ejemplo from '@/Layouts/Ejemplo.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const platos = [
    {
        nombre: 'Plato 1',
        descripcion: 'esta es la dedcripcion numero 1',
        ingredites: [
            {
                nombre: 'papita',
            }
        ]
    },
    {
        nombre: 'Plato 2',
        descripcion: 'easdfadsfadsadsf  1',
    },
    {
        nombre: 'Plato 3',
        descripcion: 'esta es la dedcripcion asdfadsfadsf 1',
    },
]

const mostraralgo = ref(true);

const cambiarEstadoDeMostrarAlgo = () => {
    mostraralgo.value = !mostraralgo.value
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <Ejemplo>
            <template #alejo>COMIDAS DEL DIAS</template>
            <p>platos favoritos</p>
            <button class="bg-yellow-300 cursor-pointer" @click.prevent="cambiarEstadoDeMostrarAlgo">mostrar algo</button>
            {{ mostraralgo }}
            <div class="grid grid-cols-4 gap-4 p-5">
                <Card v-for="plato in platos"
                    :name="plato.nombre"
                    :description="plato.ingredites ? plato.ingredites[0].nombre : 'no tenemos ingredientes'"
                />
            </div>
            <h1 v-if="mostraralgo">MAMA MIA</h1>
            <h1 v-else>PAPA MIA</h1>
        </Ejemplo>

    </AuthenticatedLayout>
</template>
