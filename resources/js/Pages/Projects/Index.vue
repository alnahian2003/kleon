<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchForm from "@/Shared/SearchForm.vue";

const { projects } = defineProps({
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

        <SearchForm
            :url="route('projects.index')"
            placeholder="Search projects by title, status..."
        />

        <!-- Table -->
        <div
            v-if="projects.data.length > 0"
            class="w-full overflow-hidden rounded-lg shadow"
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
                            <th class="px-4 py-3 text-center">Tasks</th>
                            <th class="px-4 py-3">Created (M/D/Y)</th>
                            <th class="px-4 py-3 text-center">Actions</th>
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

                            <td class="px-4 py-3 text-sm text-center">
                                {{ project.tasks_count }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                {{ project.created_at }}
                            </td>
                            <td class="px-4 py-3">
                                <div
                                    class="flex items-center text-sm justify-center"
                                >
                                    <!-- View Project Button -->
                                    <Link
                                        :href="
                                            route('projects.show', project.slug)
                                        "
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Show"
                                        as="button"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            class="w-5 h-5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                        </svg>
                                    </Link>

                                    <!-- Edit Button -->
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

                                    <!-- Delete button -->
                                    <button
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg text-gray-400 focus:outline-none focus:shadow-outline-gray"
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
            <Link class="text-purple-600" :href="route('projects.create')"
                >Create</Link
            >
            One?
        </h4>

        <div
            v-if="projects.per_page"
            class="py-3 mx-auto text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 sm:grid-cols-9"
        >
            <pagination :links="projects.links" />
        </div>
    </AuthenticatedLayout>
</template>
