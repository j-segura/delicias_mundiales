<template>
  <Head title="Delicias Mundiales" />

  <AuthenticatedLayout>
    <!-- Hero Section -->
    <div class="relative h-96 bg-gradient-to-r from-orange-500 to-red-600">
      <div class="absolute inset-0 bg-black opacity-50"></div>
      <div class="relative z-10 flex flex-col items-center justify-center h-full text-white px-4">
        <h1 class="text-5xl font-bold mb-4">Delicias Mundiales</h1>
        <p class="text-xl mb-8 text-center">Descubre los sabores más exquisitos de la cocina internacional</p>

        <!-- Barra de búsqueda -->
        <div class="relative w-full max-w-2xl">
          <input
            v-model="busqueda"
            type="text"
            placeholder="Buscar platos, ingredientes o cocinas..."
            class="w-full px-6 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
        </div>
      </div>
    </div>

    <!-- Categorías -->
    <div class="py-12 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Explora por Categorías</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
          <div
            v-for="categoria in categories"
            :key="categoria"
            class="bg-white rounded-lg shadow-md p-4 text-center hover:shadow-lg transition-shadow cursor-pointer"
          >
            <span class="font-medium">{{ categoria.name }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Platos Destacados -->
    <div class="py-12">
      <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Platos Destacados</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <Card
            v-if="dishes"
            v-for="dish in dishes.data"
            :dish="dish"
            class="hover:shadow-xl transition-shadow"
          >
          </Card>
        </div>
        <Paginator :links="dishes.links"/>
      </div>
    </div>

    <!-- Características -->
    <div class="py-12 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="text-center">
            <h3 class="text-xl font-bold mb-2">Cocina Internacional</h3>
            <p class="text-gray-600">Explora platos de todo el mundo</p>
          </div>
          <div class="text-center">
            <h3 class="text-xl font-bold mb-2">Chefs Expertos</h3>
            <p class="text-gray-600">Recetas elaboradas por profesionales</p>
          </div>
          <div class="text-center">
            <h3 class="text-xl font-bold mb-2">Búsqueda Fácil</h3>
            <p class="text-gray-600">Encuentra tus platos favoritos</p>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Card from '@/Components/MisComponentes/Card.vue';
import Paginator from '@/Components/Paginator.vue';

const props = defineProps({
    dishes: {
        type: Object,
        required: true,
    },
    categories: {
        type: Object,
        required: true,
    },
});

const busqueda = ref('');
</script>
