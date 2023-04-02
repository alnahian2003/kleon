<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TaskCard from "@/Components/TaskCard.vue";
import { Head, Link } from "@inertiajs/vue3";
import SearchForm from "@/Shared/SearchForm.vue";

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

        <SearchForm
            v-if="tasks.data.length > 0"
            :url="route('tasks.index')"
            placeholder="Search tasks by title, comment..."
        />

        <!-- Task Gallery -->
        <template v-if="tasks.data.length > 0">
            <section class="grid lg:grid-cols-3 gap-2">
                <TaskCard v-for="task in tasks.data" :task="task" />
            </section>

            <div
                v-if="tasks.per_page"
                class="my-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 sm:grid-cols-9 mx-auto"
            >
                <Pagination :links="tasks.links" />
            </div>
        </template>

        <h4 class="text-gray-400" v-else>
            No tasks To Show Yet. Why Don't You
            <Link class="text-purple-600" :href="route('tasks.create')"
                >Create</Link
            >
            One?
        </h4>
    </AuthenticatedLayout>
</template>
