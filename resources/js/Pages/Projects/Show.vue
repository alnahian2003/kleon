<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const { auth } = usePage().props;

const isAdmin = computed(() => {
    return auth.user.is_admin;
});

const { project } = defineProps({
    project: Object,
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
            <section class="flex flex-row justify-between">
                <!-- Status Indicator -->
                <span
                    class="px-2 py-1 font-medium leading-tight rounded-full capitalize text-center text-sm flex-shrink-0"
                    :class="{
                        'text-green-700 bg-green-100':
                            project.status === 'completed',
                        'text-red-700 bg-red-100':
                            project.status === 'cancelled',
                        'text-gray-700 bg-gray-100':
                            project.status === 'pending',
                        'text-blue-700 bg-blue-100': project.status === 'open',
                        'text-yellow-700 bg-yellow-100':
                            project.status === 'delayed',
                    }"
                >
                    {{ project.status }}
                </span>

                <!-- Action Buttons -->
                <div class="flex gap-2 items-center text-sm justify-end">
                    <!-- Edit Button -->
                    <Link
                        :href="route('projects.edit', project.slug)"
                        class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
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
                        class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 rounded-lg text-gray-400 focus:outline-none focus:shadow-outline-gray"
                        aria-label="Delete"
                        @click="
                            router.delete(
                                route('projects.destroy', project.slug)
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
            </section>

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

                    <div class="my-3" v-if="isAdmin">
                        <span>
                            <p class="text-sm text-gray-400">Client Name:</p>
                        </span>

                        <p>{{ project.client.name }}</p>
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
                v-if="project.tasks.length > 0"
                class="sm:grid lg:grid-cols-3 xl:grid-cols-4 gap-2"
            >
                <article
                    v-for="task in project.tasks"
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
