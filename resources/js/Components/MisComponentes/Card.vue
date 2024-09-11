<template>
    <div class="bg-white border border-black p-4">
        <div class="bg-gray-200 w-full h-28">
            <img src="" alt="">
        </div>
        <div>
            <h3>{{ name }}</h3>
            <p>{{ description }}</p>
        </div>
    </div>
</template>

<script setup>

defineProps({
    name: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
});

</script>
