<template>
    <Head :title="dish.name" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Hero Section with Image -->
                    <div class="relative h-96 w-full">
                        <img
                            :src="dish.image"
                            :alt="dish.name"
                            class="w-full h-full object-cover"
                        />
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <h1 class="text-4xl font-bold text-white mb-2">{{ dish.name }}</h1>
                            <p class="text-white text-lg">{{ dish.description }}</p>
                        </div>
                    </div>

                    <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Left Column: Video and Categories -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Video Section -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h2 class="text-2xl font-semibold mb-4">Video Tutorial</h2>
                                <div class="aspect-w-16 aspect-h-9">
                                    <a :href="dish.url_video" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                                        {{ dish.url_video }}
                                    </a>
                                </div>
                            </div>

                            <!-- Step by Step Instructions -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h2 class="text-2xl font-semibold mb-4">Preparation Steps</h2>
                                <div class="prose max-w-none">
                                    <div v-html="dish.step_by_step"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Ingredients and Additional Info -->
                        <div class="space-y-6">
                            <!-- Categories and Country -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-lg font-semibold mb-2">Categories</h3>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        v-for="category in dish.categories"
                                        :key="category.id"
                                        class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm"
                                    >
                                        {{ category.name }}
                                    </span>
                                </div>
                                <div class="mt-4">
                                    <h3 class="text-lg font-semibold mb-2">Origin</h3>
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                        {{ dish.country.name }}
                                    </span>
                                </div>
                            </div>

                            <!-- Ingredients -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-lg font-semibold mb-3">Ingredients</h3>
                                <div class="prose max-w-none">
                                    <div v-html="dish.ingredients"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    dish: {
        type: Object,
        required: true,
    },
});
</script>
