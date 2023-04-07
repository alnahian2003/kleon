<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header> Dashboard </template>

        <StatCards v-if="user.is_admin">
            <template #header>Overview</template>
            <StatCard
                type="info"
                title="Total Users"
                :stat="data.users_count"
            />
            <StatCard
                type="success"
                title="Total Clients"
                :stat="data.clients_count"
            />
            <StatCard
                type="success"
                title="Active Users"
                :stat="data.active_users_count"
            />
            <StatCard
                type="dark"
                title="Inactive Users"
                :stat="data.inactive_users_count"
            />
        </StatCards>
        <StatCards>
            <template #header>Projects Statistics</template>
            <StatCard
                type="success"
                title="Total Projects"
                :stat="data.projects_count"
            />
            <StatCard
                type="info"
                title="Total Tasks"
                :stat="data.tasks_count"
            />
            <StatCard
                type="success"
                title="Completed Projects"
                :stat="data.completed_projects_count"
            />
            <StatCard
                type="dark"
                title="Pending Projects"
                :stat="data.pending_projects_count"
            />
            <StatCard
                type="danger"
                title="Cancelled Projects"
                :stat="data.cancelled_projects_count"
            />
            <StatCard
                type="warning"
                title="Delayed Projects"
                :stat="data.delayed_projects_count"
            />
        </StatCards>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import StatCard from "@/Components/StatCard.vue";
import StatCards from "@/Components/StatCards.vue";

const user = usePage().props.auth.user;

const { data } = defineProps({
    data: Object,
});
</script>
