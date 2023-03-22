<script setup>
import { Head, Link, router } from "@inertiajs/vue3";

import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    projects: Object,
});
</script>

<template>
    <Head title="Browse Projects" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                Projects

                <Link :href="route('projects.create')"
                    ><PrimaryButton>Create Project</PrimaryButton></Link
                >
            </div>
        </template>

        <!-- Table -->
        <div
            v-if="projects.data.length > 0"
            class="w-full overflow-hidden rounded-lg shadow-xs"
        >
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap border">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-200"
                        >
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Budget</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Deadline (M/D/Y)</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr
                            v-for="project in projects.data"
                            class="text-gray-700"
                        >
                            <td class="px-4 py-3 max-w-sm truncate">
                                {{ project.title }}
                            </td>

                            <td class="px-4 py-3 max-w-sm truncate">
                                $ {{ project.budget }}
                            </td>

                            <td class="px-4 py-3 text-xs">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight rounded-full capitalize text-center"
                                    :class="{
                                        'text-green-700 bg-green-100':
                                            project.status === 'completed',
                                        'text-red-700 bg-red-100':
                                            project.status === 'cancelled',
                                        'text-gray-700 bg-gray-100':
                                            project.status === 'pending',
                                        'text-blue-700 bg-blue-100':
                                            project.status === 'open',
                                        'text-yellow-700 bg-yellow-100':
                                            project.status === 'delayed',
                                    }"
                                >
                                    {{ project.status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ project.deadline }}
                            </td>
                            <td class="px-4 py-3">
                                <div
                                    class="flex items-center space-x-4 text-sm"
                                >
                                    <Link
                                        :href="
                                            route('projects.edit', project.slug)
                                        "
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit"
                                        as="button"
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                            ></path>
                                        </svg>
                                    </Link>
                                    <button
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Delete"
                                        @click="
                                            router.delete(
                                                route(
                                                    'projects.destroy',
                                                    project.slug
                                                )
                                            )
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <h4 class="text-gray-400" v-else>
            No Projects To Show Yet. Why Don't You
            <Link :href="route('projects.create')">Create</Link> One?
        </h4>

        <div
            v-if="projects.data.length > 0"
            class="py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9"
        >
            <pagination :links="projects.links" />
        </div>
    </AuthenticatedLayout>
</template>
