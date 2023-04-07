<script setup>
import StatCard from "@/Components/StatCard.vue";
</script>
<template>
    <header class="text-xl text-gray-600 my-6">
        <slot name="header">Statistics</slot>
    </header>
    <section class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <slot />
    </section>
</template>
