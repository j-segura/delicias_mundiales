<template>
    <div class="w-full bg-white-200 border border-gray-400 p-3">
        <div class="w-full h-48 mb-3">
            <img v-if="dish.image" :src="dish.image" alt="dish Logo" width="50px" height="50px" class="object-cover w-full h-full" />
        </div>
        <span class="my-5">{{ dish.name }}</span>
        <br>
        <p class="text-gray-500">{{ dish.description }}</p>
        <Link :href="route('dishes.show', dish)" class="mr-2 text-blue-600 text-sm">
            <span >Ver receta</span>
        </Link>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    dish: {
        type: Object,
        required: true,
    },
});

</script>
