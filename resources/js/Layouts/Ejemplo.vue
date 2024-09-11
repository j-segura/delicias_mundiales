<template>
    <div class="grid grid-cols-4 h-screen">
        <div class="bg-red-200">
            Manu lateral
            <ul>
                <li>home</li>
                <li>categorues</li>
                <li>news</li>
            </ul>
        </div>
        <div class="bg-green-100 col-span-3">
            <div class="bg-blue-300">
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
