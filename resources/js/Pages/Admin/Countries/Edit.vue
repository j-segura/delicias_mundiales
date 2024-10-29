<template>
    <AdminNav>
        <div class="p-7">
            <div class="w-full flex justify-between">
                <h3 class="text-2xl font-medium">ACTUALIZAR PAIS</h3>
                <Link :href="route('countries.index')" class="px-5 py-2 bg-slate-200 text-gray-800 font-medium ">
                    <button>Regresar</button>
                </Link>
            </div>
            <form @submit.prevent="submit">
                <div class="space-y-6">
                    <div>
                    <InputLabel for="name" value="Nombre" />
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
                </div>

                <div  class="mt-5">
                    <button type="submit" class="px-5 py-2 bg-blue-200 text-blue-800 font-medium">ACTUALIZAR PAIS</button>
                </div>
            </form>
        </div>
    </AdminNav>
</template>


<script>
import AdminNav from '@/Layouts/AdminNav.vue';
import { Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

export default {

    components: {
        Link,
        InputError,
        InputLabel,
        TextInput,
        AdminNav,
    },

    props: {
        country: Object
    },

    data() {
        return {
            form: useForm({
                name: "",
                _method: 'put',
            })
        };
    },

    mounted() {
        this.form.name = this.country.name;
    },

    methods: {
        submit() {
            this.form.post(route('countries.update', this.country), this.form, {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.name) {
                        this.form.reset('name');
                    }
                },
            });
        },
    },
}

</script>
