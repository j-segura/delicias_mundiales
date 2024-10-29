<template>
    <Head title="Admin"/>

    <AuthenticatedLayout>
        <section id="admin-dashboard">
            <aside :class="is_expanded && 'is-expanded'">
                <button @click="ToggleMenu">
                    <span class="material-symbols-outlined" v-if="is_expanded">
                        arrow_back
                    </span>
                    <span class="material-symbols-outlined" v-else>
                        arrow_forward
                    </span>
                </button>

                <h3>Tables</h3>
                <div class="menu">
                    <Link :href="route('dishes.index')" class="button" :active="route().current('categories.index')">
                        <span class="material-symbols-outlined">lunch_dining</span>
                        <span class="text">Platos</span>
                    </Link>
                    <Link :href="route('dishes.create')" class="button" :active="route().current('categories.index')">
                        <span class="material-symbols-outlined">library_add</span>
                        <span class="text">Crear platos</span>
                    </Link>
                    <Link :href="route('categories.index')" class="button" :active="route().current('categories.index')">
                        <span class="material-symbols-outlined">view_cozy</span>
                        <span class="text">Categorias</span>
                    </Link>
                    <Link :href="route('categories.create')" class="button" :active="route().current('categories.index')">
                        <span class="material-symbols-outlined">library_add</span>
                        <span class="text">Crear categoria</span>
                    </Link>
                    <Link :href="route('countries.index')" class="button" :active="route().current('categories.index')">
                        <span class="material-symbols-outlined">Flag</span>
                        <span class="text">Paises</span>
                    </Link>
                    <Link :href="route('countries.create')" class="button" :active="route().current('categories.index')">
                        <span class="material-symbols-outlined">library_add</span>
                        <span class="text">Añadir pais</span>
                    </Link>
                </div>
             </aside>
            <div class="w-full">
                <slot />
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<script>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

export default {

    components: {

        AuthenticatedLayout,
        Head,
        Link,

    },

    data() {

        return {

            is_expanded: false,

        };

    },

    methods: {

        ToggleMenu() {

            this.is_expanded = !this.is_expanded;

        }

    },

}

</script>

<style>
#admin-dashboard {
    display: flex;
    height: 91vh;
}

#admin-dashboard aside {
    display: flex;
    flex-direction: column;
    width: calc(2rem + 32px);
    height: 100%;
    overflow: hidden;
    padding: 1rem;
    background-color: #212121;
    color: aliceblue;
    transition: 0.2s ease-out;

    button {
        text-align: center;
    }

    h3, .button .text {
        opacity: 0;
        transition: 0.3s ease-out;
    }

    h3 {
        color: rgb(122, 122, 122);
        text-transform: uppercase;
        margin-top: 2rem
    }

    .menu {
        margin: 0 -1rem;

        .button {
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 0.5rem 1.2rem;
            transition: 0.2s ease-out;

            .material-symbols-outlined {
                font-size: 1.5rem;
                transition: 0.2s ease-out;
            }

            .text {
                color: #d1d1d1;
                transition: 0.2s ease-out;
            }

            &:hover {
                background-color: var(--second-color-alt);
                border-right: 5px solid var(--second-color);

                .material-symbols-outlined, .text {
                    color: var(--second-color-light);
                }
            }

        }
    }

    &.is-expanded {
        width: 300px;

        h3, .button .text {
            opacity: 1;
        }

        button {
            text-align: right;
        }

        .menu {
            .material-symbols-outlined {
                margin-right: 1rem;
            }
        }
    }

    @media (max-width: 768px) {
        position: fixed;
        z-index: 99;
    }
}
</style>
