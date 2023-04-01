<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TaskCard from "@/Components/TaskCard.vue";
import { Head, Link } from "@inertiajs/vue3";

const { tasks } = defineProps({
    tasks: Object,
});
</script>

<template>
    <Head title="Manage Tasks" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                Tasks

                <Link :href="route('tasks.create')"
                    ><PrimaryButton>Create Task</PrimaryButton></Link
                >
            </div>
        </template>

        <!-- Task Gallery -->
        <section class="grid lg:grid-cols-3 gap-2">
            <TaskCard v-for="task in tasks.data" :task="task" />
        </section>

        <div
            v-if="tasks.links.length > tasks.per_page"
            class="py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9"
        >
            <Pagination :links="tasks.links" />
        </div>
    </AuthenticatedLayout>
</template>
