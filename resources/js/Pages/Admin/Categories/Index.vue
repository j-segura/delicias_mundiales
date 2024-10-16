<template>
    <AuthenticatedLayout>
        <div class="p-7">
            <div class="w-full flex justify-between">
                <h3 class="text-2xl font-medium">CATEGORIAS</h3>
                <Link :href="route('categories.create')" class="px-5 py-2 bg-emerald-200 text-emerald-800 font-medium ">
                    <button class="uppercase">Crear categoria</button>
                </Link>
            </div>
            <br>
            <table>
            <thead>
                <th>id</th>
                <th>name</th>
                <th>actions</th>
            </thead>
            <tbody>
                <tr v-for="category in categories.data" v-if="categories.data.length > 0">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td>
                        <Link :href="route('categories.edit', category)" class="mr-2 text-blue-600">
                            <button>Edit</button>
                        </Link>
                        <button @click="deleteCategory(category)" class="text-red-500">Delete</button>
                    </td>
                </tr>
                <tr v-else>Papi, No hay categorias creadas aun 😔</tr>
            </tbody>
        </table>

        <Paginator :links="categories.links"/>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
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

