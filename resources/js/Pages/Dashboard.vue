<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header> Dashboard </template>

        <StatCards v-if="isAdmin">
            <template #header>Overview</template>

            <StatCard type="info" title="Total Users" :stat="data.users_count">
            </StatCard>

            <StatCard
                type="brand"
                title="Total Clients"
                :stat="data.clients_count"
            >
                <template #icon><ClientIcon /></template>
            </StatCard>
            <StatCard
                type="success"
                title="Active Users"
                :stat="data.active_users_count"
            >
                <template #icon><ActiveUserIcon /></template>
            </StatCard>
            <StatCard
                type="danger"
                title="Inactive Users"
                :stat="data.inactive_users_count"
            >
                <template #icon><InactiveUserIcon /></template>
            </StatCard>
        </StatCards>

        <StatCards>
            <StatCard
                type="success"
                title="Total Projects"
                :stat="data.projects_count"
            >
                <template #icon><ProjectIcon /></template>
            </StatCard>

            <StatCard type="info" title="Total Tasks" :stat="data.tasks_count">
                <template #icon><TaskIcon /></template>
            </StatCard>

            <StatCard
                type="success"
                title="Completed Projects"
                :stat="data.completed_projects_count"
            >
                <template #icon><CompletedProjectIcon /></template>
            </StatCard>

            <StatCard
                type="dark"
                title="Pending Projects"
                :stat="data.pending_projects_count"
            >
                <template #icon><PendingProjectIcon /></template>
            </StatCard>
            <StatCard
                type="danger"
                title="Cancelled Projects"
                :stat="data.cancelled_projects_count"
            >
                <template #icon><CancelledProjectIcon /></template>
            </StatCard>

            <StatCard
                type="warning"
                title="Delayed Projects"
                :stat="data.delayed_projects_count"
            >
                <template #icon><DelayedProjectIcon /></template>
            </StatCard>
        </StatCards>
    </AuthenticatedLayout>
</template>

<script setup>
import { computed } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import StatCard from "@/Components/StatCard.vue";
import StatCards from "@/Components/StatCards.vue";

import CancelledProjectIcon from "@/Components/Icons/CancelledProjectIcon.vue";
import ActiveUserIcon from "@/Components/Icons/ActiveUserIcon.vue";
import ClientIcon from "@/Components/Icons/ClientIcon.vue";
import CompletedProjectIcon from "@/Components/Icons/CompletedProjectIcon.vue";
import DelayedProjectIcon from "@/Components/Icons/DelayedProjectIcon.vue";
import InactiveUserIcon from "@/Components/Icons/InactiveUserIcon.vue";
import PendingProjectIcon from "@/Components/Icons/PendingProjectIcon.vue";
import ProjectIcon from "@/Components/Icons/ProjectIcon.vue";
import TaskIcon from "@/Components/Icons/TaskIcon.vue";

const isAdmin = computed(() => usePage().props.auth.user.is_admin);

const { data } = defineProps({
    data: Object,
});
</script>
