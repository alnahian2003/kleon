<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed } from "vue";

const { project, statuses } = defineProps({
    project: Object,
    statuses: Array,
});

const formattedDeadline = () => {
    return project.deadline
        ? new Date(project.deadline).toISOString().slice(0, 10)
        : "";
};

const formattedBudget = () => {
    return project.budget ? parseInt(project.budget.replace(",", "")) : "";
};

const form = useForm({
    title: project.title,
    description: project.description,
    budget: formattedBudget(),
    status: project.status,
    deadline: formattedDeadline(),
});

function submit() {
    form.put(route("projects.update", project.slug), form);
}
</script>
<template>
    <Head title="Edit Project" />
    <AuthenticatedLayout>
        <template #header> Edit Project </template>

        <form
            @submit.prevent="submit"
            class="sm:px-6 md:px-0 lg:px-0 space-y-6"
        >
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="space-y-6">
                    <div>
                        <InputLabel for="title" value="Title" />

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            :placeholder="form.title"
                            v-model="form.title"
                        />

                        <InputError :message="form.errors.title" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="description" value="Description" />

                        <TextAreaInput
                            id="description"
                            type="text"
                            class="mt-1 block w-full"
                            :placeholder="form.description"
                            v-model="form.description"
                        />

                        <InputError
                            :message="form.errors.description"
                            class="mt-2"
                        />
                    </div>

                    <div
                        class="space-y-6 md:space-y-0 md:grid md:grid-cols-3 md:gap-6"
                    >
                        <div class="w-full">
                            <InputLabel for="budget" value="Budget ($)" />
                            <TextInput
                                id="budget"
                                type="number"
                                class="mt-1 block w-full"
                                :placeholder="form.budget"
                                v-model="form.budget"
                            />

                            <InputError
                                :message="form.errors.budget"
                                class="mt-2"
                            />
                        </div>

                        <div class="w-full">
                            <InputLabel for="status" value="Status" />
                            <select
                                id="status"
                                v-model="form.status"
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600 capitalize"
                            >
                                <option
                                    v-for="status in statuses"
                                    :value="status"
                                    :selected="status === project.status"
                                >
                                    {{ status }}
                                </option>
                            </select>

                            <InputError
                                :message="form.errors.status"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="deadline" value="Deadline" />
                            <input
                                type="date"
                                id="deadline"
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600"
                                v-model="form.deadline"
                            />
                            <InputError
                                :message="form.errors.deadline"
                                class="mt-2"
                            />
                        </div>
                    </div>
                </div>
                <PrimaryButton type="submit" class="mt-6"
                    >Edit Project</PrimaryButton
                >
            </div>
        </form>
    </AuthenticatedLayout>
</template>
