<template>
    <div class="grid grid-cols-4 h-screen">
        <div class="bg-escarcha-200">
            <h3>MENÚ</h3>
            <ul>
                <button><li>Platos</li></button>
                <p>
                <button><li>Categorías</li></button>
                </p>
            </ul>
        </div>

        <div class="bg-white-400 col-span-3">
            <div class="bg-white-300">
                <slot name="alejo"/>
            </div>
            <slot/>
        </div>
    </div>
</template>

<style scoped>
.casa {
    background: purple;
}

.funcion {
    @apply bg-slate-400 border-4;
}
</style>

