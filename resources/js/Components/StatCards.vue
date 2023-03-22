<script setup>
import StatCard from "@/Components/StatCard.vue";
</script>
<template>
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <StatCard type="success" title="Total Projects" stat="10" />
        <StatCard type="info" title="Total Tasks" stat="36" />
    </div>
</template>
