<script setup>
import StatCard from "@/Components/StatCard.vue";
</script>
<template>
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <StatCard type="success" title="Total Projects" stat="6" />
        <StatCard type="info" title="Total Tasks" stat="12" />
        <StatCard type="warning" title="Pending Projects" stat="4" />
        <StatCard type="danger" title="Cancelled Projects" stat="36" />
    </div>
</template>
