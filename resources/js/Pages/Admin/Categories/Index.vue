<template>
    <AdminNav>
        <div class="p-7">
            <div class="w-full flex justify-between">
                <h3 class="text-2xl font-medium">CATEGORIAS</h3>
            </div>
            <br>
            <div class="grid md:grid-cols-5 gap-4 mb-8">
                <div v-for="category in categories.data" v-if="categories.data.length > 0" class="w-full bg-gray-200 border border-gray-400 p-3">
                    <div class="w-full h-48 mb-3">
                        <img v-if="category.image" :src="category.image" alt="category Logo" width="50px" height="50px" class="object-cover w-full h-full" />
                    </div>
                    <span class="my-5">{{ category.name }}</span>
                    <br>
                    <Link :href="route('categories.edit', category)" class="mr-2 text-blue-600">
                        <span class="material-symbols-outlined">edit</span>
                    </Link>
                    <button @click="deleteCategory(category)" class="text-red-500">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>
            <Paginator :links="categories.links"/>
        </div>
    </AdminNav>
</template>

<script setup>
import AdminNav from '@/Layouts/AdminNav.vue';
import Paginator from '@/Components/Paginator.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    categories: {
        type: Object,
        required: true,
    },
});

const deleteCategory = (category) => {
  if (confirm('Estas seguro que deseas eliminar esta categoria?')) {
    router.delete(route('categories.destroy', category), {
        preserveScroll: true,
        preserveState: true,
    });
  }
};

</script>

<style>
.portrait-ca {
    width: 100px;
    height: 100px;
    overflow: hidden;
}
</style>

