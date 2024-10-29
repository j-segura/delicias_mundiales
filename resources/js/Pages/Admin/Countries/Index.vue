<template>
    <AdminNav>
        <div class="p-7">
            <div class="w-full flex justify-between">
                <h3 class="text-2xl font-medium">PAISES</h3>
            </div>
            <br>
            <div class="grid md:grid-cols-5 gap-4 mb-8">
                <div v-for="country in countries.data" v-if="countries.data.length > 0" class="w-full bg-gray-200 border border-gray-400 p-3">
                    <span class="my-5">{{ country.name }}</span>
                    <br>
                    <Link :href="route('countries.edit', country)" class="mr-2 text-blue-600">
                        <span class="material-symbols-outlined">edit</span>
                    </Link>
                    <button @click="deleteCountry(country)" class="text-red-500">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>
            <Paginator :links="countries.links"/>
        </div>
    </AdminNav>
</template>

<script setup>
import AdminNav from '@/Layouts/AdminNav.vue';
import Paginator from '@/Components/Paginator.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    countries: {
        type: Object,
        required: true,
    },
});

const deleteCountry = (country) => {
  if (confirm('Estas seguro que deseas eliminar este pais?')) {
    router.delete(route('countries.destroy', country), {
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

