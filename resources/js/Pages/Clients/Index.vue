<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    clients: Object,
});
</script>

<template>
    <Head title="Clients" />

    <AuthenticatedLayout>
        <template #header> Clients </template>

            <div class="overflow-hidden mb-8 w-full rounded-lg border shadow">
                <div class="overflow-x-auto w-full">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b"
                            >
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Projects</th>
                                <th class="px-4 py-3">Company</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Address</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            <tr
                                v-for="client in clients.data"
                                :key="client.id"
                                class="text-gray-700"
                            >
                                <td class="px-4 py-3 text-sm">
                                    {{ client.name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ client.projects_count }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ client.company_name || "Not Available" }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <span
                                        class="px-2 py-1 font-normal leading-tight rounded-full capitalize text-center"
                                        :class="
                                            client.is_active
                                                ? 'text-green-700 bg-green-100'
                                                : 'text-red-700 bg-red-100'
                                        "
                                    >
                                        {{
                                            client.is_active
                                                ? "Active"
                                                : "Deactivated"
                                        }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ client.address || 'Not Available'}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 sm:grid-cols-9"
                >
                    <pagination :links="clients.links" />
                </div>
            </div>
    </AuthenticatedLayout>
</template>
