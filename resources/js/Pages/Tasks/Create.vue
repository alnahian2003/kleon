<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { projects } = defineProps({ projects: Object });

const form = useForm({
    title: null,
    comment: null,
    project_id: null,
});

function submit() {
    form.post(route("tasks.store", form));
}
</script>
<template>
    <Head title="Create a Task" />
    <AuthenticatedLayout>
        <template #header> Create Task </template>

        <form @submit.prevent="submit">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="space-y-6">
                    <div>
                        <InputLabel for="title" value="Title" />

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="Update the sidebar while tweaking system..."
                            v-model="form.title"
                        />

                        <InputError :message="form.errors.title" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="comment" value="Comment (Optional)" />

                        <TextAreaInput
                            id="comment"
                            type="text"
                            class="mt-1 block w-full"
                            :placeholder="form.comment"
                            v-model="form.comment"
                        />

                        <InputError
                            :message="form.errors.comment"
                            class="mt-2"
                        />
                    </div>

                    <div v-if="projects.length > 0" class="w-full">
                        <InputLabel for="project" value="Assign to:" />
                        <select
                            id="project"
                            v-model="form.project_id"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600 capitalize"
                        >
                            <option
                                v-for="project in projects"
                                :value="project.id"
                            >
                                {{ project.title }}
                            </option>
                        </select>

                        <InputError
                            :message="form.errors.project_id"
                            class="mt-2"
                        />
                    </div>
                </div>
                <PrimaryButton type="submit" class="mt-6">Create</PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
