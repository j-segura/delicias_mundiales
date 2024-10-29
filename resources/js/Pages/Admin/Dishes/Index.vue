<template>
    <AdminNav>
        <div class="p-7">
            <div class="w-full flex justify-between">
                <h3 class="text-2xl font-medium">PLATOS</h3>
            </div>
            <br>
            <div class="grid md:grid-cols-5 gap-4 mb-8">
                <div v-for="dish in dishes.data" v-if="dishes.data.length > 0" class="w-full bg-gray-200 border border-gray-400 p-3">
                    <div class="w-full h-48 mb-3">
                        <img v-if="dish.image" :src="dish.image" alt="dish Logo" width="50px" height="50px" class="object-cover w-full h-full" />
                    </div>
                    <span class="my-5">{{ dish.name }}</span>
                    <br>
                    <Link :href="route('dishes.edit', dish)" class="mr-2 text-blue-600">
                        <span class="material-symbols-outlined">edit</span>
                    </Link>
                    <button @click="deleteDish(dish)" class="text-red-500">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>
            <Paginator :links="dishes.links"/>
        </div>
    </AdminNav>
</template>

<script setup>
import AdminNav from '@/Layouts/AdminNav.vue';
import Paginator from '@/Components/Paginator.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    dishes: {
        type: Object,
        required: true,
    },
});

const deleteDish = (dish) => {
  if (confirm('Estas seguro que deseas eliminar este plato?')) {
    router.delete(route('dishes.destroy', dish), {
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

