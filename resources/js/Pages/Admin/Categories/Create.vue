<template>
    <AuthenticatedLayout>
        <div class="p-7">
            <div class="w-full flex justify-between">
                <h3 class="text-2xl font-medium">CREAR CATEGORIA</h3>
                <Link :href="route('categories.index')" class="px-5 py-2 bg-slate-400 text-gray-800 font-medium ">
                    <button class="basic-gray-btn">Regresar</button>
                </Link>
            </div>
            <form @submit.prevent="submit">
                <div class="space-y-6">
                    <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        ref="nameInput"
                        v-model="form.name"
                        type="text"
                        class="block w-full"
                        autocomplete="name-input"
                    />
                    <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        @input="handleImageUpload"
                    />
                    </div>
                </div>

                <div  class="mt-5">
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-blue-800 font-medium">CREAR CATEGORIA</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    image: null,
});

const handleImageUpload = (event) => {
    form.image = event.target.files[0];
};

const submit = () => {
    form.post(route('categories.store'), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
        if (form.errors.name) {
        form.reset('name');
        }
        if (form.errors.image) {
        form.reset('image');
        }
    },
    });
};
</script>
