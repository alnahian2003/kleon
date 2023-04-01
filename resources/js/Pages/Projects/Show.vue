<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const { project } = defineProps({
    project: Object,
    tasks: Object,
});
</script>

<template>
    <Head :title="project.title" />
    <AuthenticatedLayout>
        <template #header>
            <Link :href="route('projects.index')"
                ><SecondaryButton>Browse Projects</SecondaryButton></Link
            >
        </template>

        <div class="p-4 bg-white rounded-lg shadow mb-8">
            <!-- Status Indicator -->
            <span
                class="px-2 py-1 font-medium leading-tight rounded-full capitalize text-center text-sm"
                :class="{
                    'text-green-700 bg-green-100':
                        project.status === 'completed',
                    'text-red-700 bg-red-100': project.status === 'cancelled',
                    'text-gray-700 bg-gray-100': project.status === 'pending',
                    'text-blue-700 bg-blue-100': project.status === 'open',
                    'text-yellow-700 bg-yellow-100':
                        project.status === 'delayed',
                }"
            >
                {{ project.status }}
            </span>

            <article>
                <header>
                    <div class="my-3">
                        <span>
                            <p class="text-sm text-gray-400">Project Title:</p>
                        </span>
                        <h1 class="text-xl font-semibold text-gray-600">
                            {{ project.title }}
                        </h1>
                    </div>

                    <div class="my-3">
                        <span>
                            <p class="text-sm text-gray-400">Budget:</p>
                        </span>
                        <h5 class="text-xl text-purple-700">
                            ${{ project.budget }}
                        </h5>
                    </div>

                    <div class="my-3">
                        <span>
                            <p class="text-sm text-gray-400">
                                Project Description:
                            </p>
                        </span>

                        <p>{{ project.description }}</p>
                    </div>

                    <div class="my-3">
                        <span>
                            <p class="text-sm text-gray-400">Deadline:</p>
                        </span>

                        <p class="font-medium text-slate-500">
                            {{ project.deadline }}
                        </p>
                    </div>
                </header>
            </article>
        </div>

        <hr />

        <!-- Tasks -->
        <section class="my-8">
            <h3 class="text-xl font-semibold text-gray-500 mb-3">Tasks</h3>
            <div
                v-if="tasks.length > 0"
                class="sm:grid lg:grid-cols-3 xl:grid-cols-4 gap-2"
            >
                <article
                    v-for="task in tasks"
                    class="p-4 bg-white rounded-lg shadow space-y-2"
                >
                    <header>
                        <p class="text-gray-400 text-sm">
                            {{ task.created_at }}
                        </p>
                        <h4 class="font-medium text-gray-600">
                            {{ task.title }}
                        </h4>
                    </header>
                    <footer class="text-sm text-gray-400 italic">
                        {{ task.comment }}
                    </footer>
                </article>
            </div>

            <h4 v-else class="text-lg text-gray-400">No Tasks Assigned Yet</h4>
        </section>
    </AuthenticatedLayout>
</template>
