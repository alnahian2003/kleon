<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header> Users </template>

        <SearchForm
            v-if="users.data.length > 0"
            :url="route('users.index')"
            placeholder="Search users by name, email..."
        />

        <div
            v-if="users.data.length > 0"
            class="overflow-hidden mb-8 w-full rounded-lg border shadow"
        >
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b"
                        >
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr
                            v-for="user in users.data"
                            :key="user.id"
                            class="text-gray-700"
                        >
                            <td class="px-4 py-3 text-sm">
                                {{ user.name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ user.email }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9"
            >
                <pagination :links="users.links" />
            </div>
        </div>

        <h3 v-else>No User Available</h3>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchForm from "@/Shared/SearchForm.vue";

const props = defineProps({
    users: Object,
});
</script>
