<template>
    <AdminNav>
        <div class="p-7">
            <div class="w-full flex justify-between">
                <h3 class="text-2xl font-medium">CREAR PLATO DE COMIDA</h3>
                <Link :href="route('dishes.index')" class="px-5 py-2 bg-slate-200 text-gray-800 font-medium ">
                    <button class="basic-gray-btn">Regresar</button>
                </Link>
            </div>
            <form @submit.prevent="submit">
                <div class="space-y-6 col-6 col-md-6">
                    <div class="input-p">
                        <InputLabel for="name" value="Nombre *" />

                        <TextInput
                            id="name"
                            ref="nameInput"
                            v-model="form.name"
                            type="text"
                            class="block w-full"
                            placeholder="Dale un nombre"
                            autocomplete="name-input"
                        />

                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                </div>
                <div class="space-y-6 col-6 col-md-6">
                    <div class="input-p">
                        <InputLabel for="url_video" value="URL video *" />

                        <TextInput
                            id="url_video"
                            ref="nameInput"
                            v-model="form.url_video"
                            type="text"
                            class="block w-full"
                            placeholder="Coloca la url del video de la receta"
                            autocomplete="name-input"
                        />

                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                </div>
                <div class="grid-2">
                    <div class="col-12 col-md-6">
                        <label class="typo__label">Categorias *</label>
                        <multiselect
                            v-model="form.categories"
                            tag-placeholder="Agregar"
                            placeholder="Busca o añade una categoria"
                            label="name" track-by="id"
                            :options="categories"
                            :multiple="true"
                            :taggable="true">
                        </multiselect>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="col-12 col-md-6">
                        <label class="typo__label">Pais *</label>
                        <multiselect
                            v-model="form.country_id"
                            track-by="id"
                            label="name"
                            placeholder="Select one"
                            :options="countries"
                            :searchable="true">
                            <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> is written in<strong>
                                {{ option.language }}</strong></template>
                        </multiselect>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 mt-4">
                    <label for="description">Descripcion *</label>
                    <label for="ingredients">Ingredientes *</label>
                    <label for="step_by_step">Paso a Paso *</label>
                    <textarea name="description" v-model="form.description" cols="30" rows="10" placeholder="Escribe una descripcion interesante..."></textarea>
                    <textarea name="ingredients" v-model="form.ingredients" cols="30" rows="10" placeholder="Escribe los ingredites necesarios..."></textarea>
                    <textarea name="step_by_step" v-model="form.step_by_step" cols="30" rows="10" placeholder="Escribe el paso a paso..."></textarea><br>
                </div>
                <div class="my-4 mt-6">
                    <label for="image" class="px-5 py-2 bg-blue-200 text-blue-800 font-medium">Carga una imagen</label>
                    <input type="file" id="image" name="image" hidden
                        @input="form.image = $event.target.files[0]"/>
                </div>
                <div class="omt-8">
                    <button type="submit" class="px-5 py-2 bg-green-200 text-green-800 font-medium">CREAR PLATO</button>
                </div>
            </form>

        </div>
    </AdminNav>
</template>

<script>

import AdminNav from '@/Layouts/AdminNav.vue';
import Multiselect from 'vue-multiselect'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { Head, Link } from '@inertiajs/vue3';

export default {

    components: {
        Link,
        AdminNav,
        Head,
        Multiselect,
        InputError,
        InputLabel,
        TextInput,

    },

    props: {
        countries: Object,
        categories: Object,
    },

    data () {
        return {

            form: useForm({
                name: '',
                url_video: '',
                ingredients: '',
                step_by_step: '',
                categories: [],
                country_id: [],
                description: '',
                image: '',
            })
        }
    },

    methods: {

        submit() {
            this.form.post(route('dishes.store'), {
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.name) {
                        this.form.reset('name');
                    }
                    if (this.form.errors.url_video) {
                        this.form.reset('url_video');
                    }
                    if (this.form.errors.ingredients) {
                        this.form.reset('ingredients');
                    }
                    if (this.form.errors.step_by_step) {
                        this.form.reset('step_by_step');
                    }
                    if (this.form.errors.description) {
                        this.form.reset('description');
                    }
                    if (this.form.errors.image) {
                        this.form.reset('image');
                    }
                },
            });
        },
    }

}

</script>
